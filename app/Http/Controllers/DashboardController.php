<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\product;
use App\Models\Schedule;
use Illuminate\Http\Request;
use App\Models\productCategory;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;

class DashboardController extends Controller
{
    public function index(){
        $pickup = Schedule::where('user_id', Auth::user()->id)->where('pickup_status', true)->first();
        if($pickup){
            return redirect()->route('dashboard.pickup', $pickup->id);
        }
        $data = [
            'title' => 'Dashboaard',
            'subTitle' => null,
            'category' => productCategory::all(),
            'scheduleCompose' => Schedule::where('date', '<=', Date::now()->format('Y-m-d'))
                                ->where('user_id', Auth::user()->id)
                                ->whereHas('transaction', function ($query) {
                                    $query->where('product_category_id', 2)
                                    ->where('transaction_status', 0);
                                })
                                ->get(),
            'scheduleRecycle' => Schedule::where('date', '<=', Date::now()->format('Y-m-d'))
                                ->where('user_id', Auth::user()->id)
                                ->whereHas('transaction', function ($query) {
                                    $query->where('product_category_id', 1)
                                    ->where('transaction_status', 0);
                                })
                                ->get()         
        ];
        // dd($data['scheduleCompose']);
        return view('dashboard', $data);
    }

    public function pickupAdd(Request $request){
        $id = $request->input('id');
        $schedule = Schedule::findOrFail($id);
        $schedule->pickup_status = true;
        $schedule->save();
        return redirect()->route('dashboard.pickup', $id);
    }

    public function pickup($id){
        $pickup = Schedule::where('user_id', Auth::user()->id)->where('id', $id)->where('pickup_status', true)->first();
        if(!$pickup){
            return redirect()->route('dashboard');
        }
        $data = [
            'title' => 'Pickup',
            'subTitle' => null,
            'schedule' => $pickup, 
            'product' => product::all()       
        ];
        // dd($data['schedule']->transaction->latitude);
        return view('pages.pickup', $data);

    }

    public function selesai(Request $request, $id){
        // dd($request->all());
        $schedule = Schedule::findOrFail($id);
        $schedule->pickup_status = false;
        $schedule->save();

        $transaction = Transaction::findOrFail($schedule->transaction_id);
        $transaction->transaction_status = true;
        $transaction->save();

        $totalPrice = 0; // Inisialisasi total harga

        if(is_array($request->kt_docs_repeater_basic)){
            foreach ($request->kt_docs_repeater_basic as  $result) {
                $product = product::find($result['product']);
                $calculatedPrice = $product->price * $result['weight'];
                $totalPrice += $calculatedPrice;
                Item::updateOrInsert([
                    'transaction_id' => $schedule->transaction_id,
                    'product_name' => $product->name,
                    'weight' => $result['weight'],
                    'price' => $calculatedPrice
                ]);
            }

            $user = User::find($schedule->transaction->user_id);

            if ($user) {
                // Tambahkan totalPrice ke kredit pengguna
                $user->credit += $totalPrice;
                $user->save();
            }
        }

        return redirect()->route('dashboard');
    }
}
