<?php

namespace App\Http\Controllers;

use App\Models\District;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //Admin home

    public function adminHome()
    {
        return view('admin.dashboard');
    }

    final public function getDistricts($division_id)
    {
        $districts = District::select('id', 'name')->where('division_id', $division_id)->get();
        return response()->json($districts);

    }
   
}
