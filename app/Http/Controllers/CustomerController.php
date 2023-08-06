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


use Illuminate\Support\Carbon;

class CustomerController extends Controller
{   // home page
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
                $request->session()->put('userid', $user->userid);
                $request->session()->put('userfullname', $user->userfullname);
                $request->session()->put('userid', $user->userid);
                $request->session()->put('userimage', $user->userimage);
                return redirect('customer/index');
            } else {
                return back()->with('fail', 'Password does not match!');
            }
        } else {
            return back()->with('fail', 'Username does not exist!');
        }
    }

    public function logout()
    {
        Session::pull('userid');
        Session::pull('userimage');
        Session::pull('userfullname');
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
            $user->userimage = '';
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
        $user->userfullname = $request->userFullname;
        $user->useremail = $request->userEmail;
        $user->useraddress = $request->userAddress;
        $user->userphone = $request->contactNum;
        $user->save();

        // Save the user to the database
        if ($user->save()) {
            // Registration success
            return response()->json([
                'success' => true,
                'message' => 'Create account successfully!',
            ]);
        } else {
            // Registration failed
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while creating the account. Please try again.',
            ]);
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
            $user->userfullname = $data->name;
            $user->provider_id = $data->id;

            $user->save();
        }
        session(['user' => $data]);
        Auth::login($user);

    }

    public function listProducts(Request $request)
    {
        $categoryId = $request->input('category_id');

        $query = Product::with('category')
        ->when($categoryId, function ($query, $categoryId) {
            return $query->where('category_id', $categoryId);
        })
        ->whereHas('category', function ($query) {
            return $query->where('status', 1);
        });

        $products = $query->paginate(9);
        $categories = Category::where('status', 1)->get();

        return view('customer.list-products', compact('products', 'categories'));
    }
}
