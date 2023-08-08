<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Admin;
use App\Models\User;
use App\Models\Productfeedback;
use App\Models\Orderproduct;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;


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
                return response()->json($this->buildResponse(false, 'Password does not match!. Please try again.'));
            }
        } else {
            return response()->json($this->buildResponse(true, 'Login successful!'));
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
        $products = $query->paginate($perPage);
        $categories = Category::where('status', 1)->get();

        return view('customer.list-products', compact('products', 'categories'));
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

    public function updateUserProfile(Request $request)
    {
        $user = User::find(Auth::id());

        $user->userfirstName = $request->input('firstName');
        $user->userlastName = $request->input('lastName');
        $user->useremail = $request->input('userEmail');
        $user->usergender = $request->input('userGender');
        $user->useraddress = $request->input('userAddress');
        $user->userphone = $request->input('userPhone');

        $user->save();

        return redirect()->route('user.profile')->with('success', 'Profile updated successfully');
    }
    public function upload(Request $request)
    {
        // Assuming you have a logged-in user and you want to update their avatar
        $user = User::where('id')->first();
        if (Auth::check()) {
            $userId = Auth::id();
            $user = User::find($userId);
            if ($request->hasFile('userimage')) {
                // Delete the old avatar if it exists
                if ($user->userimage) {
                    $oldAvatarPath = public_path('user_img/' . $user->userimage);
                    if (file_exists($oldAvatarPath)) {
                        unlink($oldAvatarPath);
                    }
                }
                // Store the new avatar
                $avatar = $request->file('userimage');
                $avatarName = time() . '_' . $avatar->getClientOriginalName();
                $avatar->move(asset('user_img'), $avatarName);

                // Update the user's avatar field in the database
                $user->userimage = $avatarName;
                $user->save();
            }
        }
        if (!Auth::check()) {
    return response()->json(['error' => 'User not authenticated.']);
}
        return response()->json(['message' => 'Avatar updated successfully.']);
    }
}
