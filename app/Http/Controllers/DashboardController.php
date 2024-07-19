<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $data = [
            'title' => 'Dashboaard',
            'subTitle' => null,
        ];
        return view('dashboard', $data);
    }
}
