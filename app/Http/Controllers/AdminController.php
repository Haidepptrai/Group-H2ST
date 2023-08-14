<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Admin;
use App\Models\User;
use App\Models\Productfeedback;
use App\Models\Orderproduct;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;


class AdminController extends Controller
{
    public function dashboard()
    {
        // Overview
        $totalUsers = DB::table('users')->count();
        $totalSales = DB::table('orderproducts')->sum('totalcost');
        $totalOrders = DB::table('orderproducts')->count();

        // Sales report - last 7 days
        $salesData = DB::table('orderproducts')
            ->select(DB::raw('date(orderdate) as date'), DB::raw('sum(totalcost) as total_sales'))
            ->where('orderdate', '>=', Carbon::now()->subDays(7))
            ->groupBy('date')
            ->get();

        $labels = $salesData->pluck('date')->map(function ($date) {
            return Carbon::parse($date)->format('M d');
        });
        $sales = $salesData->pluck('total_sales');

        // Inventory report
        $categories = DB::table('categories')
            ->select(
                'categories.catid',
                'categories.catname as category_name',
                DB::raw('SUM(products.quantity) as product_count'),
                DB::raw('GROUP_CONCAT(products.proname, " - Quantity: ", products.quantity SEPARATOR ", ") as product_details')
            )
            ->leftJoin('products', 'categories.catid', '=', 'products.catid')
            ->groupBy('categories.catid', 'categories.catname')
            ->get();

        // Analysis - Popular Products
        $popularProducts = DB::table('products')
            ->orderBy('bestseller', 'desc')
            ->limit(5)
            ->get();

        // Analysis - User Demographics
        $userDemographics = DB::table('users')
            ->select(DB::raw('count(*) as user_count, usergender'))
            ->groupBy('usergender')
            ->get();

        // Report - Category Sales
        $categorySalesData = DB::table('products')
            ->join('orderdetails', 'products.proid', '=', 'orderdetails.proid')
            ->join('categories', 'products.catid', '=', 'categories.catid')
            ->select('categories.catname', DB::raw('sum(orderdetails.quantity) as total_sales'))
            ->groupBy('categories.catname')
            ->get();

        // Order Processing
        $orders = DB::table('orderproducts')
            ->join('users', 'orderproducts.userid', '=', 'users.id')
            ->select('orderproducts.*', 'users.username')
            ->orderBy('orderdate', 'desc')
            ->get();

        // Sales report - Monthly and Yearly
        $monthlyYearlySalesData = DB::table('orderproducts')
            ->select(
                DB::raw('YEAR(orderdate) as year'),
                DB::raw('MONTH(orderdate) as month'),
                DB::raw('SUM(totalcost) as total_sales')
            )
            ->groupBy('year', 'month')
            ->get();

        // Prepare the data for the chart - Monthly and Yearly
        $monthlyYearlyLabels = $monthlyYearlySalesData->map(function ($item) {
            return Carbon::createFromDate($item->year, $item->month)->format('M Y');
        });
        $monthlyYearlySales = $monthlyYearlySalesData->pluck('total_sales');

        return view('admin.index', compact(
            'totalUsers',
            'totalSales',
            'totalOrders',
            'labels',
            'sales',
            'categories',
            'popularProducts',
            'userDemographics',
            'categorySalesData',
            'orders',
            'monthlyYearlyLabels',
            'monthlyYearlySales'
        ));
    }

    public function adminProfile()
    {
        $profile = Admin::get();
        return view('admin.admins-profile', compact('profile'));
    }
    public function adminSaveProfile(Request $request)
    {
        if ($request->hasFile('adminimage')) {
            $file = $request->file('adminimage');
            $adminimage = $file->getClientOriginalName();
            $file->move('admin_img', $adminimage);
        } else {
            $adminimage = $request->input('old_image');
        }
        $profile = Admin::where('adminid', '!=', $request->adminid)->pluck('adminemail');
        foreach ($profile as $pf) {
            if ($pf != $request->adminemail) {
                DB::table('admins')
                    ->where('adminid', $request->input('adminid'))
                    ->update([
                        'adminpassword' => $request->input('adminpassword'),
                        'adminfullname' => $request->input('adminfullname'),
                        'adminemail' => $request->input('adminemail'),
                        'adminimage' => $adminimage
                    ]);
                return redirect()->back()->with('success', 'Successfully saved changes');
            } else {
                return redirect()->back()->with('fail', 'This email already exists');
            }
        }
    }
    public function login()
    {
        return view('admin.login');
    }

    public function loginProcess(Request $request)
    {
        $admin = Admin::where('adminusername', '=', $request->username)->first();
        if ($admin) {
            if ($admin->adminpassword == $request->password) {
                $request->session()->put('adminid', $admin->adminid);
                $request->session()->put('adminfullname', $admin->adminfullname);
                $request->session()->put('adminlevel', $admin->level);
                $request->session()->put('adminimage', $admin->adminimage);
                return redirect('admin/index');
            } else {
                return back()->with('fail', 'Password does not match!');
            }
        } else {
            return back()->with('fail', 'Username does not exist!');
        }
    }

    public function logout()
    {
        Session::pull('adminid');
        Session::pull('adminimage');
        Session::pull('adminfullname');
        Session::pull('adminlevel');
        return redirect('admin/login');
    }

    // Categories
    public function categoriesList()
    {
        $cate = Category::get();
        return view('admin.categories-list', compact('cate'));
    }
    public function categoriesAdd()
    {
        return view('admin.categories-add');
    }
    public function categoriesSave(Request $request)
    {
        $cate = new Category();
        $cate->catname = $request->catname;
        $cate->status  = $request->status;
        $cate->save();

        return redirect()->back()->with('success', 'Category added successfully!');
    }
    public function categoriesEdit($id)
    {
        $cate = Category::where('catid', '=', $id)->first();
        return view('admin.categories-edit', compact('cate'));
    }

    public function categoriesUpdate(Request $request)
    {
        Category::where('catid', '=', $request->CategoryID)->update([
            'catname' => $request->catname
        ]);
        return redirect()->back()->with('success', 'Category updated successfully!');
    }

    public function categoriesDelete($id)
    {
        $cate = Category::where('catid', '=', $id)->delete();
        return redirect()->back()->with('success', 'Category deleted successfully!');
    }

    public function unactive_category($id)
    {
        DB::table('categories')->where('catid', $id)->update(['status' => 0]);
        return Redirect::to('admin/categories-list')->with('success', 'The product category has been deactivated successfully!');
    }

    public function active_category($id)
    {
        DB::table('categories')->where('catid', $id)->update(['status' => 1]);
        return Redirect::to('admin/categories-list')->with('success', 'The product category has been activated successfully!');
    }
    //suppliers
    public function suppliersList( )
    {
        $supp = Supplier::get();
        return view('admin.suppliers-list', compact('supp'));
    }
    public function suppliersAdd()
    {
        return view('admin.suppliers-add');
    }
    public function suppliersSave(Request $request)
    {
        $supp = new Supplier();
        $supp->suppliername = $request->suppliername;
        $supp->save();
        return redirect()->back()->with('success', 'Supplier added successfully!');
    }
    public function suppliersEdit($id)
    {
        $supp = Supplier::where('id', '=', $id)->first();
        return view('admin.suppliers-edit', compact('supp'));
    }
    public function suppliersUpdate(Request $request)
    {
        Supplier::where('id', '=', $request->SupplierID)->update([
            'suppliername' => $request->suppliername
        ]);
        return redirect()->back()->with('success', 'Supplier updated successfully!');
    }

    public function suppliersDelete($id)
    {
        $supp = Supplier::where('id', '=', $id)->delete();
        return redirect()->back()->with('success', 'Supplier deleted successfully!');
    }
    // Products
    public function productsList(Request $request)
    {
        $categoryId = $request->input('category_id');

        $pro = Product::with('category')
            ->when($categoryId, function ($query, $categoryId) {
                return $query->where('category_id', $categoryId);
            })
            ->whereHas('category', function ($query) {
                return $query->where('status', 1);
            })
            ->orderBy('date', 'desc')
            ->get();

        $categories = Category::where('status', 1)->get();

        return view('admin.products-list', compact('pro', 'categories'));
    }

    public function productsDetail($id)
    {
        $product = DB::table('products')
            ->join('categories', 'products.catid', '=', 'categories.catid')
            ->where('proid', $id)
            ->select('products.*', 'categories.catname')
            ->first();

        // Pass product to the view
        return view('admin.products-detail')->with('product', $product);
    }

    public function productsAdd()
    {
        $cate = Category::get();
        $supp = Supplier::get();
        return view('admin.products-add', compact('cate', 'supp'));
    }

    public function productsSave(Request $request)
    {
        $pro = new Product();

        $pro->proname = $request->proname;
        $pro->prodescription = $request->prodescription;
        $pro->prodetails = $request->prodetails;
        if ($request->hasFile('proimage')) {
            $file = $request->file('proimage');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $pro->proimage = $fileName;
            $file->move('pro_img', $fileName);
        }
        $pro->proprice = $request->proprice;
        $pro->status = $request->status;
        $pro->discount = $request->discount;
        $pro->quantity = $request->quantity;
        $pro->bestseller = $request->bestseller;
        $pro->catid = $request->catid;
        $pro->suppid = $request->supplierid;

        $pro->save();

        return redirect()->back()->with('success', 'Products added successfully!');
    }

    public function productsDelete($id)
    {
        Product::where('proid', '=', $id)->delete();
        return redirect()->back()->with('success', 'Products deleted successfully!');
    }

    public function productsEdit($id)
    {
        $cate = Category::get();
        $supp = Supplier::get();
        $pro = Product::where('proid', '=', $id)->first();
        return view('admin.products-edit', compact('pro', 'cate', 'supp'));
    }

    public function productsUpdate(Request $request)
    {
        $product = Product::where('proid', $request->productid)->first();

        $img = $product->proimage;

        if ($request->hasFile('proimage') && $request->file('proimage')->isValid()) {
            if ($product->proimage) {
                Storage::delete('pro_img/' . $product->proimage);
            }

            $file = $request->file('proimage');
            $img = $file->getClientOriginalName();
            $file->move('pro_img', $img);
        }

        Product::where('proid', '=', $request->productid)->update([
            'proname' => $request->proname,
            'prodescription' => $request->prodescription,
            'prodetails' => $request->prodetails,
            'proimage' => $img,
            'proprice' => $request->proprice,
            'discount' => $request->discount,
            'quantity' => $request->quantity,
            'catid' => $request->catid,
            'supid' => $request->suppid
        ]);

        return redirect()->back()->with('success', 'Product updated successfully!');
    }

    public function unactive_product($id)
    {
        DB::table('products')->where('proid', $id)->update(['status' => 0]);
        return Redirect::to('admin/products-list')->with('success', 'The product has been deactivated successfully!');
    }

    public function active_product($id)
    {
        DB::table('products')->where('proid', $id)->update(['status' => 1]);
        return Redirect::to('admin/products-list')->with('success', 'The product has been activated successfully!');
    }

    public function normal_product($id)
    {
        DB::table('products')->where('proid', $id)->update(['bestseller' => 0]);
        return Redirect::to('admin/products-list')->with('success', 'The product has been changed successfully!');
    }

    public function best_product($id)
    {
        DB::table('products')->where('proid', $id)->update(['bestseller' => 1]);
        return Redirect::to('admin/products-list')->with('success', 'The product has been changed successfully!');
    }

    //User
    public function usersList()
    {
        $user = User::get();
        return view('admin.users-list', compact('user'));
    }
    public function usersDelete($id)
    {
        User::where('id', '=', $id)->delete();
        return redirect()->back()->with('success', 'Users deleted successfully!');
    }

    //Admin
    public function adminsList()
    {
        $admin = Admin::get();
        return view('admin.admins-list', compact('admin'));
    }

    public function adminsAdd()
    {
        $admin = Admin::get();
        return view('admin.admins-add', compact('admin'));
    }

    public function adminsSave(Request $request)
    {
        $admin = new Admin();
        if ($request->hasFile('adminimage')) {
            $file = $request->file('adminimage');
            $adminimage = $file->getClientOriginalName();
            $file->move('admin_img', $adminimage);
        } else {
            $adminimage = '';
        }
        DB::table('admins')->insert([
            'adminusername' => $request->input('adminusername'),
            'adminpassword' => $request->input('adminpassword'),
            'adminfullname' => $request->input('adminfullname'),
            'adminemail' => $request->input('adminemail'),
            'adminimage' => $adminimage,
            'level' => $request->input('level')
        ]);
        return redirect()->back()->with('success', 'Admin added successfully!');
    }


    public function adminsEdit($id)
    {
        $admin = Admin::where('adminid', '=', $id)->first();
        return view('admin.admins-edit', compact('admin'));
    }

    public function adminsUpdate(Request $request)
    {
        if ($request->hasFile('adminimage')) {
            $file = $request->file('adminimage');
            $adminimage = $file->getClientOriginalName();
            $file->move('admin_img', $adminimage);
        } else {
            $adminimage = $request->input('old_image');
        }

        DB::table('admins')
            ->where('adminid', $request->input('adminid'))
            ->update([
                'adminusername' => $request->input('adminusername'),
                'adminpassword' => $request->input('adminpassword'),
                'adminfullname' => $request->input('adminfullname'),
                'adminemail' => $request->input('adminemail'),
                'adminimage' => $adminimage,
                'level' => $request->input('level')
            ]);
        return redirect()->back()->with('success', 'Admin updated successfully!');
    }

    public function adminsDelete($id)
    {
        Admin::where('adminid', '=', $id)->delete();
        return redirect()->back()->with('success', 'Admin deleted successfully!');
    }

    //Feedback
    public function feedbacksList()
    {
        $feedback = Productfeedback::get();
        return view('admin.feedbacks-list', compact('feedback'));
    }
    public function feedbacksDelete($id)
    {
        Productfeedback::where('feedbackid', '=', $id)->delete();
        return redirect()->back()->with('success', 'Feedback deleted successfully!');
    }

    // Order
    public function ordersList()
    {
        $order = Orderproduct::get();
        return view('admin.orders-list', compact('order'));
    }
    public function ordersDelete($id)
    {
        Orderproduct::where('orderid', '=', $id)->delete();
        return redirect()->back()->with('success', 'Order deleted successfully!');
    }
    public function ordersEdit($id)
    {
        $order = Orderproduct::where('orderid', '=', $id)->first();
        return view('admin.orders-edit', compact('order'));
    }
    public function ordersUpdate(Request $request)
    {
        Orderproduct::where('orderid', '=', $request->OrderID)->update([
            'status' => $request->status
        ]);
        return redirect()->back()->with('success', 'Order updated successfully!');
    }
}
