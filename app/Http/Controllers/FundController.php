<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class FundController extends Controller
{
    public function withdraw(Request $request)
    {
        $data = [
            'title' => 'Dana',
            'subTitle' => 'Tarik Tunai',
            'categories' => ProductCategory::all()
        ];
        return view('pages.fund.withdraw', $data);
    }

    public function transaction(){
        $data = [
            'title' => 'Dana',
            'subTitle' => 'Transaksi',
            'transactions' => Transaction::where('product_category_id', 1)->where('transaction_status', 1)->get()
        ];
        return view('pages.fund.transaction', $data);
    }

}
