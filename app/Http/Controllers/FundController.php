<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FundController extends Controller
{
    public function index(Request $request)
    {
        $data = [
            'title' => 'Dana',
            'subTitle' => 'Pencairan',
            'categories' => ProductCategory::all()
        ];
        return view('pages.product_category', $data);
    }

}
