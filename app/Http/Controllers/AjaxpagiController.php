<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product1;
class AjaxpagiController extends Controller
{
    //


    public function index(Request $request)
    {
        $products = Product1::paginate(5);
        if ($request->ajax()) {
            return view('cars.pagiresult',compact('products'));
        }
        return view('cars.ajaxpagi-show',compact('products'));
    }



}
