<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimonial;
use App\Models\Banner;
use App\Models\FeaturedDealers;
use App\Models\vehicletype;
use App\Models\Ads;
use DB;
use Exception;
use App\Models\Questions;


class ServiceController extends Controller
{
    //
	public function index(){
try {
$testimonial = Testimonial::orderBy('created_at', 'desc')
        ->get();
$banner = Banner::get();
$bannerfirst=$banner->first();
$brands = FeaturedDealers::orderBy('dealer_name')
        ->orderBy('created_at', 'desc')
        ->get(); 
$vehicletype = vehicletype::orderBy('name')
        ->get(); 
        $questions=Questions::get();
//DB::enableQueryLog();
$vehicletypecars = Ads::select("ads.*","vehicletype.*","ads_images.*",'motor_custome_values.*',"model_msts.name as modelname")->leftjoin("ads_images","ads.id","=","ads_images.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("vehicletype","ads.vehicletype","=","vehicletype.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")
               
        ->get();
        //dd(DB::getQueryLog());
    return view('cars.index',compact('testimonial','bannerfirst','brands','vehicletype','vehicletypecars','questions'));

}
catch (exception $e) {
$message=$e->getMessage();
return view('cars.errorpage',compact('message'));
}

}




function checkNum($number) {
  if($number>1) {
    throw new Exception("Value must be 1 or below");
  }
  return true;
}

function checknum2(){
try {
  $this->checkNum(2);
  //If the exception is thrown, this text will not be shown
  echo 'If you see this, the number is 1 or below';
}

//catch exception
catch(Exception $e) {
  //echo 'Message: ' .$e->getMessage();
$message=$e->getMessage();
return view('cars.errorpage',compact('message'));

}

}


	
	
	
	
}
