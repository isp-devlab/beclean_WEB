<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    public function me()
    {
        $data = User::where('id', Auth::user()->id)->first();
        return response()->json([
            'response' => Response::HTTP_OK,
            'success' => true,
            'message' => 'User recent retrived',
            'data' => $data
        ], Response::HTTP_OK);
    }

    public function update(Request $request)
    {    
        $validator = Validator::make($request->all(), [
            'name' => 'nullable|sometimes|',
            'email' => [
                'nullable',
                'sometimes',
                'email',
                Rule::unique('users')->ignore(Auth::user()->id),
            ],
            'phone' => [
                'nullable',
                'sometimes',
                Rule::unique('users')->ignore(Auth::user()->id),
            ],
            'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
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
            $user = User::findOrFail(Auth::user()->id);
            if($request->has('name')){
                $user->name = $request->name;
            }
            if($request->has('email')){
                $user->email = $request->email;
            }
            if($request->has('phone')){
                $user->phone = $request->phone;
            }
            $user->save();
            $data = User::where('id', Auth::user()->id)->first();
            return response()->json([
                'response' => Response::HTTP_OK,
                'success' => true,
                'message' => 'User account updated successfully',
                'validation' => $validation,
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
