<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;

class ProductController extends Controller
{
    public function index(Request $request){
        try {
            $keyword = $request->input('q');
            $perPage = $request->input('perpage', 10);            
            $data = Product::where('name', 'like', "%$keyword%")->with('category')->paginate($perPage);
            return response()->json([
                'response' => Response::HTTP_OK,
                'success' => true,
                'message' => 'Product retrieved successfully',
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
