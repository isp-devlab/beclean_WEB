<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $data = [
            'title' => 'Produk',
            'subTitle' => 'Data Produk',
            'products' => Product::all(),
            'categories' => ProductCategory::all()
        ];
        return view('pages.product', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_category_id' => 'required|exists:product_categories,id',
            'name' => 'required|unique:products,name',
            'price' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return redirect()->route('product.index')->with('error', 'Gagal menambahkan produk baru')->withInput()->withErrors($validator);
        }

        $product = new Product();
        $product->product_category_id = $request->input('product_category_id');
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->save();
        return redirect()->route('product.index')->with('success', 'Berhasil menambahkan produk baru');
    }

    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_category_id' => 'required|exists:product_categories,id',
            'name' => 'required|unique:products,name,' . $id,
            'price' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return redirect()->route('product.index')->with('error', 'Gagal mengubah data produk')->withInput()->withErrors($validator);
        }

        $product = Product::findOrFail($id);
        $product->product_category_id = $request->input('product_category_id');
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->save();
        return redirect()->route('product.index')->with('success', 'Berhasil mengubah data produk');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('product.index')->with('success', 'Berhasil menghapus data produk');
    }
}
