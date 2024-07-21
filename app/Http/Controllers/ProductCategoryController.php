<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ProductCategoryController extends Controller
{
    public function index(Request $request)
    {
        $data = [
            'title' => 'Produk',
            'subTitle' => 'Kategori',
            'categories' => ProductCategory::all()
        ];
        return view('pages.product_category', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:product_categories,name',
        ]);
        if ($validator->fails()) {
            return redirect()->route('product.category.index')->with('error', 'Gagal menambahkan kategori baru')->withInput()->withErrors($validator);
        }

        $category = new ProductCategory();
        $category->name = $request->input('name');
        $category->save();
        return redirect()->route('product.category.index')->with('success', 'Berhasil menambahkan kategori baru');
    }

    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:product_categories,name,' . $id,
        ]);
        if ($validator->fails()) {
            return redirect()->route('product.category.index')->with('error', 'Gagal mengubah data kategori')->withInput()->withErrors($validator);
        }

        $category = ProductCategory::findOrFail($id);
        $category->name = $request->input('name');
        $category->save();
        return redirect()->route('product.category.index')->with('success', 'Berhasil mengubah data kategori');
    }

    public function destroy($id)
    {
        $category = ProductCategory::findOrFail($id);
        $category->delete();
        return redirect()->route('product.category.index')->with('success', 'Berhasil menghapus data kategori');
    }
}
