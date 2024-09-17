<?php

namespace App\Http\Controllers\Api;

use App\Models\Withdraw;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;

class MutationController extends Controller
{
    public function index(Request $request){
        try {
            $perPage = $request->input('perpage', 10);            
            $data = Withdraw::where('user_id', Auth::user()->id)->paginate($perPage);
            return response()->json([
                'response' => Response::HTTP_OK,
                'success' => true,
                'message' => 'Withdraw mutation retrieved successfully',
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
