<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{


    // public function index()
    // {
    //     $products = [];
    //     if (request()->ajax()) {
    //         $products = Product::all();
    //         return datatables()->of($products)->addIndexColumn()->make(true);
    //     }
    //     return view('products.index', compact('products'));
    // }


    public function index()
    {
        if (request()->ajax()) {
            $products = Product::select('id', 'name', 'logo', 'price', 'organization_id')->get();
            // $index=1;
            // foreach($products as $product){
            //     $product->index=$index++;
            //     if($product->logo!=null){
            //         $product->logo=asset('storage/'.$product->logo);
            //     }else{
            //         $product->image=null;
            //     }
            // }
            return datatables()->of($products)->addIndexColumn()->make(true);
        }
        // return view('admin.show.categories');
        return view('products.index');
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'logo' => 'required',
            'price' => 'required',
            'organization_id' => 'required',

        ]);
        $product =[
            'name' => $request->name,
            'price' =>  $request->price,
            'organization_id' => $request->organization_id
        ];
        
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $file_extension = strtolower($file->getClientOriginalExtension());
            $file_name = "logo" . time() . '.' . $file_extension;
            Storage::putFileAs( 'public/product_logo' , $file, $file_name);
            $product['logo']  = 'storage/product_logo/' . $file_name;
        }
        Product::create($product);
        return redirect()->route('products.index');
    }


    public function create()
    {
        $organizations = Organization::all();
        return view('products.create', compact('organizations'));
    }



    public function edit(Product $product)
    {
        $productViewObject = [
            'organizations' =>  Organization::all(),
            'product' =>  $product
        ];
      
        return view('products.edit', compact('productViewObject'));
    }


    public function update(Request $request, Product $product)
    {
      
        $request->validate([
            'name' => 'required',
            // 'logo' => 'required',
            'price' => 'required',
            'organization_id' => 'required',

        ]);

        $_product =[
            'name' => $product->name,
            'price' =>  $product->price,
            'organization_id' => $product->organization_id,
            'logo' => $product->logo,
        ];
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $file_extension = strtolower($file->getClientOriginalExtension());
            $file_name = "logo" . time() . '.' . $file_extension;
            Storage::putFileAs( 'public/product_logo' , $file, $file_name);
            $_product['logo']  = 'storage/product_logo/' . $file_name;
        }

        $product->update($_product);
        return redirect()->route('products.index');
    }


    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index');
    }


    public function deleteProduct(int $id)
    {
        $product = Product::where('id', '=', $id)->first();

        $result = [
            $msg = ""
        ];

        if ($product == null) {
            $result["msg"] =  "product Not found !";
            return $result;
        }

        $product->delete();
        return $result;
    }
}
