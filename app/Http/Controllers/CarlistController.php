<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimonial;
use App\Models\Banner;
use App\Models\FeaturedDealers;
class CarlistController extends Controller
{
    //

public function index(){

$testimonial = Testimonial::orderBy('created_at', 'desc')
        ->get();
$banner = Banner::get();
$bannerfirst=$banner->first();
$brands = FeaturedDealers::orderBy('dealer_name')
        ->orderBy('created_at', 'desc')
        ->get();       
    return view('cars.index',compact('testimonial','bannerfirst','brands'));
}




}
