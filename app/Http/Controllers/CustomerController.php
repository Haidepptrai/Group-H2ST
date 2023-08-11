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
            if ($user->userpassword == $request->userPassword) {
                $request->session()->put('id', $user->id);
                $request->session()->put('userfirstname', $user->userfirstname);
                $request->session()->put('userimage', $user->userimage);
                $request->session()->put('userpassword', $user->userpassword);
                $request->session()->put('useraddress', $user->useraddress);
                $request->session()->put('userphone', $user->userphone);
                $request->session()->put('userbirthday', $user->userbirthday);
                return redirect('customer/index');
            } else {
                return redirect('customer/login')->with('error', 'Invalid Password');
            }
        }
    }

    public function logout()
    {
        Session::pull('id');
        Session::pull('userimage');
        Session::pull('userfirstname');
        Session::pull('userpassword');
        Session::pull('useraddress');
        Session::pull('userphone');
        Session::pull('userbirthday');
        Auth::logout();
        session()->flush();
        return redirect('customer/login-customer');
    }

    public function register()
    {
        return view('customer.register-customer');
    }

    public function registerProcess(Request $request)
    {
        $user = new User();

        $user->userpassword = $request->userPassword;

        if ($request->hasFile('userimage')) {
            $file = $request->file('userimage');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $user->userimage = $fileName;
            $file->move('user_img', $fileName);
        } else {
            $user->userimage = 'default.jpg';
        }

        $notifications = []; // Array to store notifications

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
        } else {
            return view('customer.reset-password', ['token' => $token]);
        }
    }

    // Update the password
    public function resetPassword(Request $request, $token)
    {
        $password_reset = PasswordResetToken::where('token', $token)->first();
        if (!$password_reset || Carbon::now()->subMinutes(60) > $password_reset->created_at) {
            return redirect()->route('showResetPasswordForm')->with('error', 'Invalid password reset link or link has expired');
        } else {
            $request->validate([
                'useremail' => 'required|email',
                'userpassword' => 'required|min:6|max:20',
                'password_confirmation' => 'required|same:password',
            ]);
            $user = User::find($password_reset->userid);
            if ($user->useremail != $request->email) {
                return redirect()->back()->with('error', 'Enter correct email address');
            } else {
                $password_reset->delete();
                $user->update([
                    'userpassword' => bcrypt($request->password)
                ]);
                return redirect()->route('customerLogin')->with('success', 'Password reset successfully');
            }
        }
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

        if (!$user) {

            $user = new User();
            $user->username = $data->name;
            $randomBytes = random_bytes(16);
            $randomString = bin2hex($randomBytes);
            $user->userpassword = hash('sha256', $randomString);
            $user->userimage = $data->avatar;
            $user->useremail = $data->email;
            $user->userfirstname = $data->name;
            $user->provider_id = $data->id;

            $user->save();
        }
        session(['user' => $data]);
        Auth::login($user);
    }

    public function listProducts(Request $request, $page = 1)
    {
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

        $sort = $request->input('sort');
        $order = $request->input('order', 'asc');

        switch ($sort) {
            case 'name':
                $query->orderBy('proname', $order, $sort);
                break;
            case 'price':
                $query->orderBy('proprice', $order, $sort);
                break;
            case 'popularity':
            default:
                $query->orderBy('bestseller', $order, $sort);
                break;
        }

        $perPage = 9;
        $searchQuery = $request->input('query');
        if (isset($searchQuery)) {
            $products = $query->where('proname', 'LIKE', "%$searchQuery%")->paginate($perPage);
            $categories = Category::where('status', 1)->get();
            $products->appends($request->all());
            return view('customer.list-products', compact('products', 'categories', 'searchQuery'));
        } else {
            $products = $query->paginate($perPage);
            $categories = Category::where('status', 1)->get();
            return view('customer.list-products', compact('products', 'categories'));
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
        $product = Product::where('proid', $id)->first();
        $cart = session()->get('cart');
        $quantity = $request->getQuantity;
        $cart[$id] = [
            "proid" => $product->proid,
            "proname" => $product->proname,
            "proprice" => $product->proprice,
            "proimage" => $product->proimage,
            "quantity" => $quantity
        ];
        session()->put('cart', $cart);

        return redirect()->back()->with('AddToCart', 'This Product is added to cart successfully!');
    }

    public function removeFromCart($id)
    {
        Session::forget('cart.' . $id);
        return redirect()->back();
    }

    public function comfirmOrderPage($id)
    {
        $user = User::where('id', $id)->first();
        return view('customer.confirm-order-page', compact('user'));
    }

    public function detailProducts($id)
    {
        $products = DB::table('products')
            ->join('categories', 'products.catid', '=', 'categories.catid')
            ->where('proid', $id)
            ->select('products.*', 'categories.catname')
            ->first();

        return view('customer.detail-products', compact('products'));
    }


    public function userProfile()
    {
        $user = User::where('id')->first();

        return view('customer.user-profile', compact('user'));
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

        $user->save();

        return redirect()->route('userProfile', $id)->with('success', 'Profile updated successfully.');
    }

    public function updateUserAvatar(Request $request, $id)
    {
        $user = User::find($id);
        $request->validate([
            'avatar' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
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

    public function userfeeback(Request $request, $id)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'vote' => 'required',
            'detail' => 'required',
            'proid' => 'required',
            'rating' => 'required',
        ]);

        $feedback = new ProductFeedback();
        $feedback->vote = $validatedData['vote'];
        $feedback->detail = $validatedData['detail'];
        $feedback->date = now();

        $feedback->id = $id;

        $feedback->proid = $validatedData['proid'];

        $feedback->save();

        return redirect()->back();
    }

    public function showUserReview(Request $request){
        $feedbacks = Productfeedback::all();
        return view('user_feedback', compact('feedbacks'));
    }

}
