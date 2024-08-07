<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionOnProgressController extends Controller
{
    public function index(){
        $data = [
            'title' => 'Transaksi',
            'subTitle' => 'On Progress',
            'transaction' => Transaction::where('transaction_status', false)   
                ->whereHas('schedule')
                ->get()
        ];
        return view('pages.transaction.onprogress', $data);
    }
}
