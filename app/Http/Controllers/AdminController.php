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
use App\Models\Orderdetail;
use App\Models\Orderstorage;
use App\Models\PasswordResetToken;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AdminController extends Controller
{
    public function dashboard()
    {

        // Overview
        $totalUsers = DB::table('users')->count();
        $totalCostSum = Session::get('totalCostSum');
        $totalSale = DB::table('orderproducts')->sum('totalcost');
        $totalSales = $totalCostSum + $totalSale;
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
                DB::raw('SUM(products.proquantity) as product_count'),
                DB::raw('GROUP_CONCAT(products.proname, " - Quantity: ", products.proquantity SEPARATOR ", ") as product_details')
            )
            ->leftJoin('products', 'categories.catid', '=', 'products.catid')
            ->groupBy('categories.catid', 'categories.catname')
            ->get();

        // Analysis - Popular Products
        $popularProducts = DB::table('products')
            ->orderBy('bestseller', 'desc')
            ->limit(5)
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

        return view('admin.index', compact(
            'totalUsers',
            'totalSales',
            'totalOrders',
            'labels',
            'sales',
            'categories',
            'popularProducts',
            'categorySalesData',
            'orders'
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
                        'adminpassword' => Hash::make($request->input('adminpassword')),
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
            if (Hash::check($request->password, $admin->adminpassword)) {
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
        if ($request->catname != $cate->catname && Category::where('catname', $request->catname)->exists()) {
            return redirect()->back()->with('error', 'Category already exists');
        }
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
        $category = Category::where('catid', $id)->first();
        $hasProducts = Product::where('catid', $category->catid)->exists();

        if ($hasProducts) {
            return redirect()->back()->with('error', 'Cannot delete category. There are products associated with it.');
        }
        $category->delete();

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
    public function suppliersList()
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
        if ($request->suppliername != $supp->suppliername && Supplier::where('suppliername', $request->suppliername)->exists()) {
            return redirect()->back()->with('error', 'Category already exists');
        }
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
        $supp = Supplier::where('id', $id)->first();
        $hasProducts = Product::where('supid',$supp->id)->exists();
        if ($hasProducts) {

            return redirect()->back()->with('error', 'Cannot delete category. There are products associated with it.');
        }
        $supp->delete();

        return redirect()->back()->with('success', 'Category deleted successfully!');
    }
    // Products
    public function productsList(Request $request)
    {
        //Get categories by id
        $categoryId = $request->input('catid');

        $pro = Product::with('category')
            ->when($categoryId, function ($query, $categoryId) {
                return $query->where('catid', $categoryId);
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
        if ($request->proname != $pro->proname && Product::where('proname', $request->proname)->exists()) {
            return redirect()->back()->with('error', 'Product already exists');
        }
        $validator = Validator::make($request->all(), [
            'proprice' => 'required|numeric|between:0,999999.99'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Price of products must be between 0 and 999999');
        }
        $pro->proname = $request->proname;

        $validator = Validator::make($request->all(), [
            'prodescription' => 'required',
            'prodetails' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', 'prodescription and prodetails are required fields');
        }
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
        $pro->proquantity = $request->quantity;
        $pro->bestseller = $request->bestseller;
        $pro->catid = $request->catid;
        $pro->supid = $request->suppid;

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
        if ($request->proname != $product->proname && Product::where('proname', $request->proname)->exists()) {
            return redirect()->back()->with('error', 'Product already exists');
        }
        if ($request->hasFile('proimage') && $request->file('proimage')->isValid()) {
            if ($product->proimage) {
                Storage::delete('pro_img/' . $product->proimage);
            }

            $file = $request->file('proimage');
            $img = $file->getClientOriginalName();
            $file->move('pro_img', $img);
        }
        try {
            $validatedData = $request->validate([
                'proprice' => 'required|numeric|between:0,999999.99'
            ]);
        } catch (ValidationException $e) {
            $errors = $e->errors();
            return redirect()->back()->with('error', 'proprice must be between 0 and 999999');
        }
        Product::where('proid', '=', $request->productid)->update([
            'proname' => $request->proname,
            'prodescription' => $request->prodescription,
            'prodetails' => $request->prodetails,
            'proimage' => $img,
            'proprice' => $validatedData['proprice'],
            'discount' => $request->discount,
            'proquantity' => $request->quantity,
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
        $orderIds = DB::table('orderproducts')
            ->join('orderdetails', 'orderproducts.orderid', '=', 'orderdetails.orderid')
            ->where('orderproducts.userid', $id)
            ->pluck('orderproducts.orderid');
        $orderStorageData = [];

        $totalCostSum = 0;
        foreach ($orderIds as $orderId) {
            $totalCost = DB::table('orderstorages')
                ->join('orderproducts', 'orderstorages.orderid', '=', 'orderproducts.orderid')
                ->sum(DB::raw('orderproducts.totalcost'));

            $totalCostSum += $totalCost;

            $orderDetails = DB::table('orderdetails')
                ->join('orderproducts', 'orderdetails.orderid', '=', 'orderproducts.orderid')
                ->where('orderproducts.userid', $id)
                ->where('orderdetails.orderid', $orderId)
                ->select('orderdetails.orderid', 'orderdetails.proid', 'orderdetails.quantity', 'orderproducts.totalcost')
                ->get();

            foreach ($orderDetails as $orderDetail) {
                $orderStorageData[] = [
                    'orderid' => $orderDetail->orderid,
                    'proid' => $orderDetail->proid,
                    'quantity' => $orderDetail->quantity,
                ];
            }
        }

        Session::put('totalCostSum', $totalCostSum);
        DB::table('orderstorages')->insert($orderStorageData);
        Orderdetail::whereIn('orderid', $orderIds)->delete();
        Orderproduct::where('userid', $id)->delete();
        Productfeedback::where('id', $id)->delete();
        PasswordResetToken::where('id', $id)->delete();
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
        if ($request->hasFile('adminimage')) {
            $file = $request->file('adminimage');
            $adminimage = $file->getClientOriginalName();
            $file->move('admin_img', $adminimage);
        } else {
            $adminimage = '';
        }
        DB::table('admins')->insert([
            'adminusername' => $request->input('adminusername'),
            'adminpassword' => Hash::make($request->input('adminpassword')),
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
                'adminpassword' => Hash::make($request->input('adminpassword')),
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
        $order = DB::table('orderproducts')
            ->join('users', 'orderproducts.userid', '=', 'users.id')
            ->select('orderproducts.*', 'users.*')
            ->get();
        return view('admin.orders-list', compact('order'));
    }
    public function ordersDelete($id)
    {
        $orderstorage = new OrderStorage();
        $proid = Orderdetail::where('orderid',$id)->get();
        foreach($proid as $item){
            $orderstorage->orderid = $id;
            $orderstorage->proid = $item->proid;
            $orderstorage->quantity = $item->quantity;
        }
        Orderdetail::where('orderid', '=', $id)->delete();
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

    public function confirm_order($id)
    {
        DB::table('orderproducts')->where('orderid', $id)->update(['status' => 1]);
        return Redirect::to('admin/orders-list')->with('success', 'The orders has been confirm successfully!');
    }

    public function delivery_order($id)
    {
        DB::table('orderproducts')->where('orderid', $id)->update(['status' => 2]);
        return Redirect::to('admin/orders-list')->with('success', 'The orders has been delivery successfully!');
    }
    public function received_order($id)
    {
        DB::table('orderproducts')->where('orderid', $id)->update(['status' => 0]);
        return Redirect::to('admin/orders-list')->with('success', 'The orders has been receive successfully!');
    }
    public function cancel_order($id)
    {
        DB::table('orderproducts')->where('orderid', $id)->update(['status' => 3]);
        return Redirect::to('admin/orders-list')->with('success', 'The order has been canceled successfully!');
    }

    public function ordersDetail($id)
    {
        $orderDetail = DB::table('orderdetails')
            ->join('products', 'products.proid', '=', 'orderdetails.proid')
            ->select('products.*', 'orderdetails.*')
            ->where('orderid', $id)
            ->get();
        return view('admin.orders-detail', compact('orderDetail'));
    }
}
