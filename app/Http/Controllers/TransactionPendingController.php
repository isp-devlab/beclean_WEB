<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransactionPendingController extends Controller
{
    public function index(){
        $data = [
            'title' => 'Transaksi',
            'subTitle' => 'Pending',
            'driver' => User::where('role', 'driver')->get(),
            'transaction' => Transaction::where('transaction_status', false)   
                ->whereDoesntHave('schedule')
                ->get()
        ];
        return view('pages.transaction.pending', $data);
    }

    public function addSchedule(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'driver' => 'required',
            'date' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->route('transaction.pending.index')->with('error', 'Gagal menambahkan Jadwal')->withInput()->withErrors($validator);
        }

        $product = new Schedule();
        $product->user_id = $request->input('driver');
        $product->transaction_id = $id;
        $product->date = $request->input('date');
        $product->save();
        return redirect()->route('transaction.pending.index')->with('success', 'Berhasil menambahkan jadwal');
    }
}
