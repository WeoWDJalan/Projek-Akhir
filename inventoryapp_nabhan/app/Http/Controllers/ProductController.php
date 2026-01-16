<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\Products;
use Illuminate\Support\Facades\File;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ProductController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            'auth',
            new Middleware('admin', except: ['index', 'show']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Products::get();
        return view('product.read', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Categories::get();
        return view('product.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validation
        $request->validate([
            'name' => 'required|min:2',
            'description' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'image' => 'required|mimes:jpg,jpeg,png|max:2048',
        ]);
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('image'), $imageName);

        $product = new Products;
 
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');  
        $product->stock = $request->input('stock');
        $product->categories_id = $request->input('categories_id');
        $product->image = $imageName;
 
        $product->save();
 
        return redirect('/product')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Products::find($id);
        return view('product.detail', ['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Products::find($id);
        $categories = Categories::get();
        return view('product.edit', ['product' => $product, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // validation
        $request->validate([
            'name' => 'required|min:2',
            'description' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'image' => 'mimes:jpg,jpeg,png|max:2048',
        ]);

        $product = Products::find($id);
        
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if($product->image){
                if(File::exists(public_path('image/'.$product->image))){
                    File::delete(public_path('image/'.$product->image));
                }
                // Upload gambar baru 
                $imageName = time().'.'.$request->image->extension();
                $request->image->move(public_path('image'), $imageName);

                // Simpan nama gambar baru ke database
                $product->image = $imageName;
            }
        }
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');  
        $product->stock = $request->input('stock');
        $product->categories_id = $request->input('categories_id');

        $product->save();

        return redirect('/product')->with('success', 'Product created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Products::find($id);
        if($product->image){
            if(File::exists(public_path('image/'.$product->image))){
                File::delete(public_path('image/'.$product->image));
            }
        }

        $product->delete();

        return redirect('/product')->with('success', 'Product deleted successfully.');
    }
}
