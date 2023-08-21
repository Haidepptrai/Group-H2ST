<?php

namespace App\Http\Controllers;

use App\Mail\ForgetPasswordMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Admin;
use App\Models\User;
use App\Models\Productfeedback;
use App\Models\Orderproduct;
use App\Models\Orderdetail;
use App\Models\PasswordResetToken;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;
use Exception;

use Illuminate\Support\Carbon;

class CustomerController extends Controller
{

    private function buildResponse($success, $message)
    {
        return [
            'success' => $success,
            'message' => $message,
        ];
    }
    // home page
    public function index()
    {
        $new_products = Product::where('date', '>=', date('Y-m-d H:i:s', strtotime('-7 days')))->orderBy('date', 'desc')->limit(3)->get();

        //Fetch featured product IDs
        $featuredProductIds = DB::table('categories')
            ->join('products', 'categories.catid', '=', 'products.catid')
            ->whereIn('products.proid', function ($query) {
                // Subquery to find the minimum proid for each category
                $query->select(DB::raw('MIN(products.proid)'))
                    ->from('products')
                    ->whereRaw('products.catid = categories.catid')
                    ->groupBy('products.catid');
            })
            ->pluck('products.proid');

        //Fetch featured products along with their categories using eager loading
        $featuredProducts = Product::with('category')
            ->whereIn('proid', $featuredProductIds)
            ->get();

        $products = Product::with('category')
            ->join('categories', 'categories.catid', '=', 'products.catid')
            ->select('categories.catname', 'products.proid', 'products.proname', 'products.proimage', 'products.prodescription', 'products.status')
            ->where('categories.status', 1)
            ->where(function ($query) {
                $query->where('products.status', 1)
                    ->orWhere('products.status', 0);
            })
            ->get();


        return view('customer.index', compact('new_products', 'featuredProducts', 'products'));
    }

    public function login()
    {
        return view('customer.login-customer');
    }

    public function loginProcess(Request $request)
    {
        $user = User::where(function ($query) use ($request) {
            $query->where('username', $request->userEmail)
                ->orWhere('useremail', $request->userEmail);
        })->first();
        if ($user) {
            if (Hash::check($request->userPassword, $user->userpassword)) {
                $request->session()->put('id', $user->id);
                $request->session()->put('userfirstname', $user->userfirstname);
                $request->session()->put('userlastname', $user->userlastname);
                $request->session()->put('userimage', $user->userimage);
                $request->session()->put('userpassword', $user->userpassword);
                $request->session()->put('useraddress', $user->useraddress);
                $request->session()->put('userphone', $user->userphone);
                $request->session()->put('userbirthday', $user->userbirthday);
                $request->session()->put('useremail', $user->useremail);
                return redirect('customer/index');
            } else {
                return redirect('customer/login-customer')->with('error', 'Invalid Password');
            }
        } else {
            return redirect('customer/login-customer')->with('error', 'User not found!');
        }
    }

    public function logout()
    {
        Session::pull('id');
        Session::pull('userimage');
        Session::pull('userfirstname');
        Session::pull('userlastname');
        Session::pull('userpassword');
        Session::pull('useraddress');
        Session::pull('userphone');
        Session::pull('userbirthday');
        Session::pull('useremail');
        Auth::logout();
        session()->flush(); // remove all session data
        return redirect('customer/login-customer');
    }

    public function register()
    {
        return view('customer.register-customer');
    }

    public function registerProcess(Request $request)
    {

        $user = new User();

        $user->userpassword = bcrypt($request->userPassword);

        if ($request->hasFile('userimage')) {
            $file = $request->file('userimage');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $user->userimage = $fileName;
            $file->move('user_img', $fileName);
        } else {
            $user->userimage = 'default.jpg';
        }

        $notifications = [];
        // Check if the username already exists in the database
        if ($request->userName != $user->username && User::where('username', $request->userName)->exists()) {
            $notifications[] = 'Username already exists!';
        }

        // Check if the email already exists in the database
        if ($request->userEmail != $user->useremail && User::where('useremail', $request->userEmail)->exists()) {
            $notifications[] = 'Email already exists!';
        }

        // Check if the phone number already exists in the database
        if ($request->contactNum != $user->userphone && User::where('userphone', $request->contactNum)->exists()) {
            $notifications[] = 'Phone number already exists!';
        }

        if (!empty($notifications)) {
            $message = count($notifications) == 1 ? $notifications[0] : implode(PHP_EOL . PHP_EOL, $notifications);
            return response()->json(['success' => false, 'message' => $message]);
        }

        // Update the user data
        $user->username = $request->userName;
        $user->userfirstname = $request->userFirstname;
        $user->userlastname = $request->userLastname;
        $user->useremail = $request->userEmail;
        $user->useraddress = $request->userAddress;
        $user->userphone = $request->contactNum;
        $user->save();

        // Save the user to the database
        if ($user->save()) {
            // Registration success
            return response()->json($this->buildResponse(true, 'Create account successfully!'));
        } else {
            // Registration failed
            return response()->json($this->buildResponse(false, 'An error occurred while creating the account. Please try again.'));
        }
    }

    // Show the forgot password form
    public function showForgotPasswordForm()
    {
        return view('customer.forgot-password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'useremail' => 'required|email',
        ]);

        $user = User::where('useremail', $request->useremail)->first();

        if (!$user) {
            return back()->withErrors(['useremail' => ['User not found']]);
        } else {
            $token = Str::random(60);
            PasswordResetToken::create([
                'email' => $user->useremail,
                'userid' => $user->id,
                'token' => $token
            ]);
            Mail::to($user->useremail)->send(new ForgetPasswordMail($user->userfirstname, $token));
            return back()->with('success', 'We have e-mailed your password reset link!');
        }
    }

    // Show the reset password form
    public function showResetPasswordForm($token)
    {
        $password_reset = PasswordResetToken::where('token', $token)->first();

        if (!$password_reset || Carbon::now()->subMinutes(60) > $password_reset->created_at) {
            return redirect()->route('showResetPasswordForm')->with('error', 'Invalid password reset link or link has expired');
        }

        $user = User::find($password_reset->userid);

        if (!$user) {
            return redirect()->route('showResetPasswordForm')->with('error', 'Invalid user');
        }

        return view('customer.reset-password', [
            'token' => $token,
            'useremail' => $user->useremail,
        ]);
    }

    public function resetPassword(Request $request, $token)
    {
        $password_reset = PasswordResetToken::where('token', $token)->first();
        if (!$password_reset || Carbon::now()->subMinutes(60) > $password_reset->created_at) {
            return redirect()->route('showResetPasswordForm')->with('error', 'Invalid password reset link or link has expired');
        }

        $request->validate([
            'useremail' => 'required|email',
            'userpassword' => 'required|min:6|max:20',
            'password_confirmation' => 'required|same:userpassword',
        ]);

        $user = $password_reset->user;

        if (!$user || $user->useremail != $request->useremail) {
            return redirect()->back()->with('error', 'Invalid user or email address');
        }

        $user->userpassword = bcrypt($request->userpassword);
        $user->save();

        // Delete the password reset token
        $password_reset->delete();

        return redirect('customer/login-customer')->with('success', 'Password reset successfully, you can login now!');
    }

    //Login with Google
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->user();
        $this->_registerOrLoginUser($user);
        return redirect()->route('home');
    }

    //Login with Facebook
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }
    public function handleFacebookCallback()
    {
        $user = Socialite::driver('facebook')->user();
        $this->_registerOrLoginUser($user);
        return redirect()->route('home');
    }
    protected function _registerOrLoginUser($data)
    {

        $user = User::where('useremail', $data->email)->first();
        $name = $data->name;
        $nameParts = explode(' ', $name);

        $firstname = $nameParts[0];

        if (count($nameParts) > 1) {
            $lastname = $nameParts[count($nameParts) - 1];
        } else {
            $lastname = '';
        }

        if (!$user) {

            $user = new User();
            $user->username = $data->name;
            $randomBytes = random_bytes(16);// random 16 characters
            $randomString = bin2hex($randomBytes);// string to hexa by bin2hex
            $user->userpassword = hash('sha256', $randomString);//encrupt randomString by hash()
            $user->userimage = $data->avatar;
            $user->useremail = $data->email;
            $user->userfirstname = $firstname;
            $user->userlastname = $lastname;
            $user->provider_id = $data->id;

            $user->save();
        }
        session(['user' => $data]);
        Auth::login($user);
    }

    public function listProducts(Request $request, $page = 1)
    {
        // Get category ID from the request
        $categoryId = $request->input('catid');

        $query = Product::with('category')
            ->when($categoryId, function ($query, $categoryId) {
                return $query->where('catid', $categoryId);
            })
            ->whereHas('category', function ($query) {
                return $query->where('status', 1);
            });

        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');

        if (!empty($minPrice) && is_numeric($minPrice)) {
            $query->where('proprice', '>=', $minPrice);
        }
        if (!empty($maxPrice) && is_numeric($maxPrice)) {
            $query->where('proprice', '<=', $maxPrice);
        }
        // Apply sorting
        $sort = $request->input('sort');
        $order = $request->input('order', 'asc');
        switch ($sort) {
            case 'name':
                $query->orderBy('proname', $order);
                break;
            case 'price':
                $query->orderBy('proprice', $order);
                break;
            case 'popularity':
            default:
                $query->orderBy('bestseller', $order);
                break;
        }
        // Pagination settings
        $perPage = 12;
        $searchQuery = $request->input('query');
        if ($searchQuery) {
            $products = $query->where('proname', 'LIKE', "%$searchQuery%")->paginate($perPage);
            $categories = Category::where('status', 1)->get();
            $products->appends($request->all());
            $message = $products->isEmpty() ? "Products not found!" : null;
            $provote = Productfeedback::where('proid')->avg('vote');
            $roundedAverageVote = round($provote, 1);
            return view('customer.list-products', compact('message', 'products', 'categories', 'searchQuery', 'roundedAverageVote'));
        } else {
            $products = $query->paginate($perPage)->appends($request->except('page'));
            $categories = Category::where('status', 1)->get();
            $provote = Productfeedback::where('proid')->avg('vote');
            $roundedAverageVote = round($provote, 1);
            return view('customer.list-products', compact('products', 'categories', 'roundedAverageVote'));
        }
    }

    public function aboutUs()
    {
        $products = Product::where('date', '>=', date('Y-m-d H:i:s', strtotime('-7 days')))->orderBy('date', 'desc')->limit(3)->get();
        return view('customer.about', compact('products'));
    }

    public function cart()
    {
        return view('customer.cart');
    }

    public function addToCart($id, Request $request)
    {
        $new_quantity = $request->input('quantity');
        $total = $request->input('totalCost');
        if (auth()->check() || User::get()) {
            $product = Product::where('proid', $id)->first();
            if (!$product) {
                return redirect()->back();
            }
            $price = $product->proprice;
            $discount = $product->discount;
            $discount_price = $price - ($price * $discount / 100);
            $cart = session()->get('cart');
            if (isset($cart[$id]) &&  ($cart[$id]['quantity'] <  $cart[$id]['inventory'])) {
                $cart[$id]['quantity']++;
            } else {
                $cart[$id] = [
                    "proid" => $product->proid,
                    "proname" => $product->proname,
                    "proprice" => $discount_price,
                    "proimage" => $product->proimage,
                    "inventory" => $product->proquantity,
                    "quantity" => 1 ];
            }
            if ($new_quantity) {
                $cart[$id]['quantity'] = $new_quantity;
            }
            if ($total) {
                session()->put('total', $total);
            } else {
                $firsttotal = $discount_price;
                if (session()->get('firsttotal')) {
                    $firsttotal = $firsttotal + $discount_price;
                }
                session()->put('firsttotal', $firsttotal);
                $newtotal = session()->get('firsttotal');
                session()->put('total', $newtotal);
            }
            session()->put('cart', $cart);
            return redirect()->back()->with('AddToCart', 'This Product is added to cart successfully!');
        } else {
            return redirect()->route('login')->with('error', 'You need to be logged in to add products to the cart.');
        }
    }

    public function removeFromCart($id)
    {
        Session::forget('cart.' . $id);
        return redirect()->back();
    }

    public function inputUser()
    {
        return view('customer.input-user');
    }

    public function comfirmOrderPage(Request $request)
    {
        $email = $request->input('userEmail');
        $name = $request->input('userName');
        $phone = $request->input('userPhone');
        $address = $request->input('userAddress');
        $city = $request->input('userCity');
        $district = $request->input('userDistrict');
        $ward = $request->input('userWard');

        return view('customer.confirm-order-page', compact('email', 'name', 'phone', 'address', 'city', 'district', 'ward'));
    }

    public function addOrder(Request $request)
    {
        if (Session::get('cart')) {
            $userId = $request->input('userId');
            $userEmail = $request->input('userEmail');
            $userName = $request->input('userName');
            $nameArray = explode(" ", $userName);
            $firstName = $nameArray[0];
            $lastName = end($nameArray);
            $userPhone = $request->input('userPhone');
            $userAddress = $request->input('userAddress');
            $userWard = $request->input('userWard');
            $userDistrict = $request->input('userDistrict');
            $userCity = $request->input('userCity');

            $user = User::find($userId);
            $user->useremail = $userEmail;
            $user->userfirstname = $firstName;
            $user->userlastname = $lastName;
            $user->userphone = $userPhone;
            $user->useraddress = $userAddress;
            $user->userward = $userWard;
            $user->userdistrict = $userDistrict;
            $user->usercity = $userCity;
            $user->save();

            $total = Session::get('total');
            $order = new Orderproduct;
            $order->userid = $userId;
            $order->status = 1;
            $order->totalcost = $total;
            $order->save();

            $orderid = $order->getKey();
            $cart = Session::get('cart');
            foreach ($cart as $item) {
                $orderDetail = new OrderDetail;

                $orderDetail->orderid = $orderid;
                $orderDetail->proid = $item['proid'];
                $orderDetail->quantity = $item['quantity'];
                $orderDetail->save();

                $proID = $item['proid'];
                $product = Product::find($proID);
                $product->proquantity = $product->proquantity - $item['quantity'];
                $product->save();
            }
            Session::forget('cart');
            Session::forget('total');
            return redirect('customer/list-products')->with('order_success', 'Your order has been successfully!');
        } else {
            return redirect('customer/list-products')->with('order_fail', 'Your order has been failed!');
        }
    }

    public function detailProducts($id)
    {

        // Fetch details of the main product
        $products = DB::table('products')
            ->join('categories', 'products.catid', '=', 'categories.catid')
            ->where('proid', $id)
            ->select('products.*', 'categories.catname')
            ->first();

        // Fetch related products (you need to define how to determine related products)
        $relatedProducts = DB::table('products')
            ->where('catid', $products->catid)
            ->where('proid', '!=', $id)
            ->limit(5)
            ->get();

        $feedbacks = DB::table('productfeedbacks')
            ->join('users', 'productfeedbacks.id', '=', 'users.id')
            ->where('productfeedbacks.proid', $id)
            ->select('productfeedbacks.*', 'users.username', 'users.userimage')
            ->get();

        $averageVote = DB::table('productfeedbacks')
            ->where('proid', $id)
            ->avg('vote');
        $roundedAverageVote = round($averageVote, 1);

        return view('customer.detail-products', compact('products', 'relatedProducts', 'feedbacks', 'roundedAverageVote'));
    }

    public function userProfile($id, Request $request)
    {
        $user = User::find($id);
        $order_id = $request->input('orderId');
        $order = DB::table('orderproducts')
            ->where('userid', $id)
            ->get();
        if ($order_id) {
            $orderDetails = DB::table('orderproducts')
                ->join('orderdetails', 'orderdetails.orderid', '=', 'orderproducts.orderid')
                ->join('products', 'orderdetails.proid', '=', 'products.proid')
                ->where('userid', $id)
                ->where('orderid', $order_id)
                ->select('orderproducts.*', 'orderdetails.*', 'products.*')
                ->get();
        } else {
            $orderDetails = DB::table('orderproducts')
                ->join('orderdetails', 'orderdetails.orderid', '=', 'orderproducts.orderid')
                ->join('products', 'orderdetails.proid', '=', 'products.proid')
                ->where('userid', $id)
                ->select('orderproducts.*', 'orderdetails.*', 'products.*')
                ->get();
        }
        return view('customer.user-profile', compact('order', 'orderDetails','user'));
    }

    public function updateUserProfile(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('userProfile', $id)->with('error', 'User not found.');
        }

        $user->userfirstname = $request->input('userfirstName');
        $user->userlastname = $request->input('userlastName');
        $user->useremail = $request->input('userEmail');
        $user->usergender = $request->input('userGender');
        $user->useraddress = $request->input('userAddress');
        $user->userphone = $request->input('userPhone');
        $user->usercity = $request->input('userCity');
        $user->userdistrict = $request->input('userDistrict');
        $user->userward = $request->input('userWards');

        $user->save();

        return redirect()->route('userProfile', $id)->with('success', 'Profile updated successfully.');
    }

    public function updateUserAvatar(Request $request, $id)
    {
        $user = User::find($id);
        $request->validate([
            'avatar' => 'image|mimes:jpeg,png,jpg,gif|max:4096',
        ]);

        if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
            if ($user->userimage) {
                Storage::delete('user_img/' . $user->userimage);
            }

            $file = $request->file('avatar');
            $img = $file->getClientOriginalName();
            $file->move('user_img', $img);
            $user->userimage = $img;
        }

        $user->save();
        return redirect()->route('userProfile', $id)->with('success', 'Avatar updated successfully. Login again to update your avatar');
    }
    public function confirmDeleteAccount()
    {
        return view('customer.confirm-delete-account');
    }
    public function deleteAccount(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return 'User not found';
        }
        $isGoogleUser = $user->id;
        if (Hash::check($request->userPassDelete, $user->userpassword) || $isGoogleUser) {
            ProductFeedback::where('id', $id)->delete();
            $user->delete();
            Auth::logout();

            if ($isGoogleUser) {
                return redirect('customer/login-customer');
            }

            return redirect('customer/login-customer');
        } else {
            return redirect()->route('userProfile', $id)->with('earror', 'Password is incorrect');
        }
    }

    public function changePassword(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->back()->with('error', 'User not found');
        }

        $request->validate([
            'oldPassword' => 'required|min:6|max:20',
            'newPassword' => 'required|min:6|max:20',
            'newPassConfirm' => 'required|same:newPassword',
        ]);

        if (Hash::check($request->oldPassword, $user->userpassword)) {
            $user->userpassword = bcrypt($request->newPassword);
            $user->save();
            return redirect()->back()->with('success', 'Password changed successfully');
        } else {
            return redirect()->back()->with('error', 'Old password does not match');
        }
    }

    // Controller function
    public function userFeedback(Request $request, $id)
    {
        $validatedData = $request->validate([
            'detail' => 'required',
            'proid' => 'required',
            'rating' => 'required',
        ]);

        $feedback = ProductFeedback::find($id);

        if ($feedback) {
            // Update existing feedback
            $feedback->detail = $validatedData['detail'];
            $feedback->vote = $validatedData['rating'];
            $feedback->date = now();
            $feedback->proid = $validatedData['proid'];
            $feedback->save();
        } else {
            // Create new feedback
            $newFeedback = new ProductFeedback();
            $newFeedback->id = $id;
            $newFeedback->detail = $validatedData['detail'];
            $newFeedback->vote = $validatedData['rating'];
            $newFeedback->date = now();
            $newFeedback->proid = $validatedData['proid'];
            $newFeedback->save();
        }

        return redirect()->back();
    }
}
