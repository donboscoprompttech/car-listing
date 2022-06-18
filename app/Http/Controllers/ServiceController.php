<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimonial;
use App\Models\Banner;
use App\Models\FeaturedDealers;
use App\Models\vehicletype;
use App\Models\Ads;
use App\Models\AdsImage;
use App\Models\MotorCustomeValues;
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
$vehicletypecars = Ads::select("ads.*","ads.id as mainid","vehicletype.*","ads_images.*",'motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename")->leftjoin("ads_images","ads.id","=","ads_images.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("vehicletype","ads.vehicletype","=","vehicletype.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->where("ads_images.vehicletype",1)->get();
        //dd(DB::getQueryLog());

/*$make = MotorCustomeValues::select('motor_custome_values.*','motor_custome_values.make_id',"make_msts.name as makename")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->groupby('make_id')->get();
   return view('cars.index',compact('testimonial','bannerfirst','brands','vehicletype','vehicletypecars','questions','make'));*/
   $sqlQuery = "select `motor_custome_values`.make_id, `make_msts`.`name` as `makename` from `motor_custome_values` left join `make_msts` on `motor_custome_values`.`make_id` = `make_msts`.`id` group by make_id,makename";
$make = DB::select(DB::raw($sqlQuery));
$sqlQuery = "select `motor_custome_values`.model_id, `model_msts`.`name` as `modelname` from `motor_custome_values` left join `model_msts` on `motor_custome_values`.`model_id` = `model_msts`.`id` group by model_id,modelname";
$model = DB::select(DB::raw($sqlQuery));
$sqlQuery = "select distinct registration_year from motor_custome_values";
$year = DB::select(DB::raw($sqlQuery));
return view('cars.index',compact('testimonial','bannerfirst','brands','vehicletype','vehicletypecars','questions','make','model','year'));
}
catch (exception $e) {
$message=$e->getMessage();
return view('cars.errorpage',compact('message'));
}

}
public function carsearch(){
  try {
    $testimonial = Testimonial::orderBy('created_at', 'desc')
            ->get();
    
    $brands = FeaturedDealers::orderBy('dealer_name')
            ->orderBy('created_at', 'desc')
            ->get(); 
            $questions=Questions::get();
        return view('cars.search',compact('testimonial','brands','questions'));
    
    }
    catch (exception $e) {
    $message=$e->getMessage();
    return view('cars.errorpage',compact('message'));
    }
   
}


function detailsshow($id){

$vehicleimages=Adsimage::where('ads_id',$id)->get();
/*$vehicletypecars = Ads::select("ads.*","ads.id as mainid","vehicletype.*","ads_images.*",'motor_custome_values.*',"model_msts.name as modelname")->leftjoin("ads_images","ads.id","=","ads_images.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("vehicletype","ads.vehicletype","=","vehicletype.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->where('ads.id',$id)->first();*/
$vehicletypecars = Ads::select("ads.*","ads.id as mainid","vehicletype.*","ads_images.*",'motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename")->leftjoin("ads_images","ads.id","=","ads_images.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("vehicletype","ads.vehicletype","=","vehicletype.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->where('ads.id',$id)->first();
return view('cars.details',compact('vehicletypecars','vehicleimages'));
}


public function searchresult(Request $request){
  try {
    $testimonial = Testimonial::orderBy('created_at', 'desc')
            ->get();
    
    $brands = FeaturedDealers::orderBy('dealer_name')
            ->orderBy('created_at', 'desc')
            ->get(); 
            $questions=Questions::get();
$make=$request->make;
$model=$request->model;
$year=$request->year;
$vehicletypecars=array();
if (($year!='0')&&($make=='0')&&($model=='0')){
/*$vehicletypecars = Ads::select("ads.*","ads.id as mainid","vehicletype.*","ads_images.*",'motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename")->leftjoin("ads_images","ads.id","=","ads_images.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("vehicletype","ads.vehicletype","=","vehicletype.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->where("ads_images.vehicletype",1)->where("motor_custome_values.registration_year",$year)->get();*/

//DB::enableQueryLog();
$vehicletypecars = Ads::select("ads.*","ads.id as mainid","vehicletype.*","ads_images.*",'motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename")->leftjoin("ads_images","ads.id","=","ads_images.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("vehicletype","ads.vehicletype","=","vehicletype.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->where("ads_images.vehicletype",1)->where("motor_custome_values.registration_year",$year)->get();
        //dd(DB::getQueryLog());



}
else if (($year=='0')&&($make!='0')&&($model=='0')){
$vehicletypecars = Ads::select("ads.*","ads.id as mainid","vehicletype.*","ads_images.*",'motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename")->leftjoin("ads_images","ads.id","=","ads_images.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("vehicletype","ads.vehicletype","=","vehicletype.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->where("ads_images.vehicletype",1)->where("motor_custome_values.make_id",$make)->get();
}
else if (($year=='0')&&($make=='0')&&($model!='0')){
$vehicletypecars = Ads::select("ads.*","ads.id as mainid","vehicletype.*","ads_images.*",'motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename")->leftjoin("ads_images","ads.id","=","ads_images.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("vehicletype","ads.vehicletype","=","vehicletype.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->where("ads_images.vehicletype",1)->where("motor_custome_values.model_id",$model)->get();
}
else if (($year!='0')&&($make!='0')&&($model!='0')){
$vehicletypecars = Ads::select("ads.*","ads.id as mainid","vehicletype.*","ads_images.*",'motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename")->leftjoin("ads_images","ads.id","=","ads_images.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("vehicletype","ads.vehicletype","=","vehicletype.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->where("ads_images.vehicletype",1)->where("motor_custome_values.model_id",$model)->where("motor_custome_values.registration_year",$year)->where("motor_custome_values.make_id",$make)->get();
}
else if (($year=='0')&&($make!='0')&&($model!='0')){
$vehicletypecars = Ads::select("ads.*","ads.id as mainid","vehicletype.*","ads_images.*",'motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename")->leftjoin("ads_images","ads.id","=","ads_images.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("vehicletype","ads.vehicletype","=","vehicletype.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->where("ads_images.vehicletype",1)->where("motor_custome_values.model_id",$model)->where("motor_custome_values.make_id",$make)->get();
}
else if (($year!='0')&&($make!='0')&&($model=='0')){
$vehicletypecars = Ads::select("ads.*","ads.id as mainid","vehicletype.*","ads_images.*",'motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename")->leftjoin("ads_images","ads.id","=","ads_images.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("vehicletype","ads.vehicletype","=","vehicletype.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->where("ads_images.vehicletype",1)->where("motor_custome_values.make_id",$make)->where("motor_custome_values.registration_year",$year)->get();
}
else if (($year!='0')&&($make=='0')&&($model!='0')){
$vehicletypecars = Ads::select("ads.*","ads.id as mainid","vehicletype.*","ads_images.*",'motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename")->leftjoin("ads_images","ads.id","=","ads_images.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("vehicletype","ads.vehicletype","=","vehicletype.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->where("ads_images.vehicletype",1)->where("motor_custome_values.model_id",$model)->where("motor_custome_values.registration_year",$year)->get();
}

        return view('cars.search',compact('testimonial','brands','questions','vehicletypecars'));
    
    }
    catch (exception $e) {
    $message=$e->getMessage();
    return view('cars.errorpage',compact('message'));
    }
   
}





	
	
	
	
}
