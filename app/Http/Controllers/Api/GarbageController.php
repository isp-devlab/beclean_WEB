<?php

namespace App\Http\Controllers\Api;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;

class GarbageController extends Controller
{
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'type' => 'required',
            'address' => 'required|string',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        $validation = array_fill_keys(array_keys($request->all()), []);
        if ($validator->fails()) {
            foreach ($validator->errors()->toArray() as $key => $errors) {
                $validation[$key] = $errors;
            }
            return response()->json([
                'response' => Response::HTTP_BAD_REQUEST,
                'success' => false,
                'message' => 'Validation error occurred', 
                'validation' => $validation,
                'data' => null
            ], Response::HTTP_BAD_REQUEST);
        }

        try {
            $transaksi = New Transaction();
            $transaksi->user_id = Auth::user()->id;
            $transaksi->product_category_id = $request->input('type');
            $transaksi->address = $request->input('address');
            $transaksi->latitude = $request->input('latitude');
            $transaksi->longitude = $request->input('longitude');
            $transaksi->transaction_status = false;
            $transaksi->save();
            return response()->json([
                'response' => Response::HTTP_CREATED,
                'success' => true,
                'message' => 'Transaction created successfully',
                'validation' => $validation,
                'data' => $transaksi
            ], Response::HTTP_CREATED);
        } catch (QueryException $e) {
            return response()->json([
                'response' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'success' => false,
                'message' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function active(Request $request){
        try {
            $keyword = $request->input('q');
            $perPage = $request->input('perpage', 10);            
            $data = Transaction::where('transaction_code', 'like', "%$keyword%")->where('transaction_status', false)->with(['category', 'schedule'])->paginate($perPage);
            return response()->json([
                'response' => Response::HTTP_OK,
                'success' => true,
                'message' => 'Transaction active retrieved successfully',
                'data' => $data
            ], Response::HTTP_OK);
            
        } catch (QueryException $e) {
            return response()->json([
                'response' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'success' => false,
                'message' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function history(Request $request){
        try {
            $keyword = $request->input('q');
            $perPage = $request->input('perpage', 10);            
            $data = Transaction::where('transaction_code', 'like', "%$keyword%")->where('transaction_status', true)->with(['category', 'schedule', 'item'])->paginate($perPage);
            return response()->json([
                'response' => Response::HTTP_OK,
                'success' => true,
                'message' => 'Transaction history retrieved successfully',
                'data' => $data
            ], Response::HTTP_OK);
            
        } catch (QueryException $e) {
            return response()->json([
                'response' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'success' => false,
                'message' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
