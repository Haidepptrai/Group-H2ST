<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
class AdminController extends Controller
{
    public function dashboard(){
        return view('admin.index');
    }
    // Categories
    public function categoriesList(){
        $cate = Category::get();
        return view('admin.categories-list', compact('cate'));
    }
    public function categoriesAdd(){
        return view('admin.categories-add');
    }
    public function categoriesSave(Request $request){
        $cate = new Category();
        $cate->catname = $request->categoryName;
        $cate->status  = $request->status;
        $cate->save();

        return redirect()->back()->with('success','Category added successfully!');
    }
    public function categoriesEdit($id){
        $cate = Category::where('catid','=',$id)->first();
        return view('admin.categories-edit', compact('cate'));
    }
    public function categoriesUpdate(Request $request){
        Category::where('catid','=',$request->CategoryID)->update([
            'catname' => $request->categoryName,
            'status' => $request->status
        ]);
        return redirect()->back()->with('success','Category updated successfully!');
    }
    public function categoriesDelete($id){
        $cate = Category::where('catid','=',$id)->delete();
        return redirect()->back()->with('success','Category deleted successfully!');
    }

    // Products
    public function productsList(){
        $pro = Product::get();
        return view('admin.products-list', compact('pro'));
    }
    public function productsAdd(){
        $cate = Category::get();
        return view('admin.products-add', compact('cate'));
    }
    public function productsSave(Request $request){
        $pro = new Product();
        $pro -> proname = $request-> proname;
        $pro -> prodescription = $request-> prodescription;
        $pro -> prodetails = $request-> prodetails;
        $pro -> proimage = $request-> proimage;
        $pro -> proprice = $request-> proprice;
        $pro -> status = $request-> status;
        $pro -> discount = $request-> discount;
        $pro -> quantity = $request-> quantity;
        $pro -> bestseller = $request-> bestseller;
        $pro -> date = $request-> date;
        $pro -> catid = $request-> catid;
        $pro->save();

        return redirect()->back()->with('success','Products added successfully!');
    }

    public function productsDelete($id){
        Product::where('proid', '=', $id)->delete();
        return redirect()->back()->with('success', 'Products deleted successfully!');
    }

    public function productsEdit($id){
        $cate = Category::get();
        $pro = Product::where('proid', '=', $id)->first();
        return view('admin.products-edit', compact('pro', 'cate'));
    }

    public function productsUpdate(Request $request)
    {
        $img = $request->new_image == "" ? $request->old_image : $request->new_image;
        Product::where('proid', '=', $request->productid)->update([
            'proname' => $request-> proname,
            'prodescription' => $request-> prodescription,
            'prodetails' => $request-> prodetails,
            'proimage' => $img,
            'proprice' => $request-> proprice,
            'status' => $request-> status,
            'discount' => $request-> discount,
            'quantity' => $request-> quantity,
            'bestseller' => $request-> bestseller,
            'catid' => $request-> catid
        ]);

        return redirect()->back()->with('success', 'Products updated successfully!');
    }
}
