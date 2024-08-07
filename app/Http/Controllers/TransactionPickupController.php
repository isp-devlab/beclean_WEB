<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionPickupController extends Controller
{
    public function index(){
        $data = [
            'title' => 'Transaksi',
            'subTitle' => 'Pickup',
            'transaction' => Transaction::where('transaction_status', true)   
                ->get()
        ];
        return view('pages.transaction.pickup', $data);
    }
}
