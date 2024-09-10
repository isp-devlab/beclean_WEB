<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Withdraw;
use Illuminate\Http\Request;

class FundController extends Controller
{
    public function withdraw(Request $request)
    {
        $data = [
            'title' => 'Dana',
            'subTitle' => 'Tarik Tunai',
            'pendings' => Withdraw::where('is_approve', false)->get()
        ];
        return view('pages.fund.pending', $data);
    }

    public function approve($id)
    {
        $withdraw = Withdraw::findOrFail($id);
        $withdraw->is_approve = true;
        $withdraw->save();
        return redirect()->route('fund.withdraw.pending')->with('success', 'Tarik tunai berhasil di setujui');
    }

    public function mutation(Request $request)
    {
        $data = [
            'title' => 'Dana',
            'subTitle' => 'Tarik Tunai',
            'mutations' => Withdraw::where('is_approve', true)->get()
        ];
        return view('pages.fund.mutation', $data);
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
