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
use App\Models\SubCategory;
use Illuminate\Support\Facades\Input;
use App\Models\AdsInterior;
use App\Models\AdsExterior;
//use Illuminate\Support\Facades\Input;
class ServiceController extends Controller
{
    //
	public function index(){
try {
$testimonial = Testimonial::orderBy('sortorder')->where('status',1)
        ->get();
$banner = Banner::where('page','First Page')->get();
$bannerfirst=$banner->first();
$footerimg = Banner::where('page','Footer')->first();
$question1img = Banner::where('page','Faq1')->first();
    $question2img = Banner::where('page','Faq2')->first();
    $videoimg = Banner::where('page','Video Image')->first();

    $video = Banner::where('page','Video')->first();
    $globe = Banner::where('page','globe')->first();
$brands = FeaturedDealers::orderBy('dealer_name')
        ->orderBy('created_at', 'desc')
        ->get(); 
$vehicletype = vehicletype::orderBy('name')
        ->get(); 
        $questions=Questions::get();
$subcategory = Subcategory::orderBy('sort_order')->where('status',1)
        ->get(); 
/*$vehicletypecars = Ads::select("ads.*","ads.id as mainid","vehicletype.*","ads_images.*",'motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename")->leftjoin("ads_images","ads.id","=","ads_images.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("vehicletype","ads.vehicletype","=","vehicletype.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->where("ads_images.vehicletype",1)->get();*/
        $vehicletypecars = Ads::select("ads.*","ads.canonical_name as mainid","subcategories.*","ads_images.*",'motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename")->leftjoin("ads_images","ads.id","=","ads_images.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("subcategories","ads.subcategory_id","=","subcategories.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->where("ads_images.vehicletype",1)->get();
   $sqlQuery = "select `motor_custome_values`.make_id, `make_msts`.`name` as `makename` from `motor_custome_values` left join `make_msts` on `motor_custome_values`.`make_id` = `make_msts`.`id` group by make_id,makename";
$make = DB::select(DB::raw($sqlQuery));
$sqlQuery = "select `motor_custome_values`.model_id, `model_msts`.`name` as `modelname` from `motor_custome_values` left join `model_msts` on `motor_custome_values`.`model_id` = `model_msts`.`id` group by model_id,modelname";
$model = DB::select(DB::raw($sqlQuery));
$sqlQuery = "select distinct registration_year from motor_custome_values";
$year = DB::select(DB::raw($sqlQuery));
return view('cars.index',compact('testimonial','bannerfirst','brands','vehicletype','vehicletypecars','questions','make','model','year','footerimg','question1img','question2img','videoimg','video','globe','subcategory'));
}
catch (exception $e) {
$message=$e->getMessage();
return view('cars.errorpage',compact('message'));
}

}
public function carsearch(){
  try {
    $testimonial = Testimonial::orderBy('sortorder')->where('status',1)
        ->get();
    
    $brands = FeaturedDealers::orderBy('dealer_name')
            ->orderBy('created_at', 'desc')
            ->get(); 
            $questions=Questions::get();
            $footerimg = Banner::where('page','Footer')->first();
            $searchresult=Banner::where('page','searchresult')->first();
        return view('cars.search',compact('testimonial','brands','questions','searchresult'));
    
    }
    catch (exception $e) {
    $message=$e->getMessage();
    return view('cars.errorpage',compact('message'));
    }
   
}


function detailsshow($id){
$iddt=Ads::where('canonical_name',$id)->first();
$idval=$iddt->id;
$vehicleimages=Adsimage::where('ads_id',$idval)->get();
$vehicleinterior=AdsInterior::leftjoin("interiormaster","ads_interior.interior_id","=","interiormaster.id")->where('ads_id',$idval)->get();
$vehicleexterior=AdsExterior::leftjoin("exteriormaster","ads_exterior.exterior_id","=","exteriormaster.id")->where('ads_id',$idval)->get();
$vehicletypecars = Ads::select("ads.*","ads.canonical_name as mainid","vehicletype.*","ads_images.*",'motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename",'places.name as placename','countries.name as countryname')->leftjoin("ads_images","ads.id","=","ads_images.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("vehicletype","ads.vehicletype","=","vehicletype.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->leftjoin("places","places.id","=","ads.place")->leftjoin("countries","countries.id","=","ads.country_id")->where('ads.canonical_name',$id)->first();
$subcategory = Subcategory::orderBy('sort_order')->where('status',1)
        ->get(); 
return view('cars.details',compact('vehicletypecars','vehicleimages','subcategory','vehicleinterior','vehicleexterior'));
}


public function searchresult(Request $request){
  try {
   $testimonial = Testimonial::orderBy('sortorder')->where('status',1)
        ->get();
    $searchresult=Banner::where('page','search result')->first();
    $footerimg = Banner::where('page','Footer')->first();
    $question1img = Banner::where('page','Faq1')->first();
    $question2img = Banner::where('page','Faq2')->first();
    $videoimg = Banner::where('page','Video Banner')->first();
    $globe = Banner::where('page','globe')->first();
    $brands = FeaturedDealers::orderBy('dealer_name')
            ->orderBy('created_at', 'desc')
            ->get(); 
            $questions=Questions::get();
            $sqlQuery = "select max(price) as price from ads";
$maxprice=  DB::select(DB::raw($sqlQuery));
$sqlQuery = "select min(price) as price from ads";
$minprice=  DB::select(DB::raw($sqlQuery));  

$make=$request->make;
$model=$request->model;
$year=$request->year;
$keywordsearch=$request->keywordsearch;
$vehicletypecars=array();
$pageflag=$request->pageflag;
$subcategory = Subcategory::orderBy('sort_order')->where('status',1)
        ->get(); 
if ($pageflag==1){
if (($year!='0')&&($make=='0')&&($model=='0')){

//DB::enableQueryLog();
$vehicletypecars = Ads::select("ads.*","ads.canonical_name as mainid","vehicletype.*","ads_images.*","ads_images.vehicletype as type1",'motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename")->leftjoin("ads_images","ads.id","=","ads_images.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("vehicletype","ads.vehicletype","=","vehicletype.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->where("ads_images.vehicletype",1)->where("motor_custome_values.registration_year",$year)->get();
        //dd(DB::getQueryLog());



}
else if (($year=='0')&&($make!='0')&&($model=='0')){
$vehicletypecars = Ads::select("ads.*","ads.canonical_name as mainid","vehicletype.*","ads_images.*","ads_images.vehicletype as type1",'motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename")->leftjoin("ads_images","ads.id","=","ads_images.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("vehicletype","ads.vehicletype","=","vehicletype.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->where("ads_images.vehicletype",1)->where("motor_custome_values.make_id",$make)->get();
}
else if (($year=='0')&&($make=='0')&&($model!='0')){
$vehicletypecars = Ads::select("ads.*","ads.canonical_name as mainid","vehicletype.*","ads_images.*","ads_images.vehicletype as type1",'motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename")->leftjoin("ads_images","ads.id","=","ads_images.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("vehicletype","ads.vehicletype","=","vehicletype.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->where("ads_images.vehicletype",1)->where("motor_custome_values.model_id",$model)->get();
}
else if (($year!='0')&&($make!='0')&&($model!='0')){
$vehicletypecars = Ads::select("ads.*","ads.canonical_name as mainid","vehicletype.*","ads_images.*","ads_images.vehicletype as type1",'motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename")->leftjoin("ads_images","ads.id","=","ads_images.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("vehicletype","ads.vehicletype","=","vehicletype.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->where("ads_images.vehicletype",1)->where("motor_custome_values.model_id",$model)->where("motor_custome_values.registration_year",$year)->where("motor_custome_values.make_id",$make)->get();
}
else if (($year=='0')&&($make!='0')&&($model!='0')){
$vehicletypecars = Ads::select("ads.*","ads.canonical_name as mainid","vehicletype.*","ads_images.*","ads_images.vehicletype as type1",'motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename")->leftjoin("ads_images","ads.id","=","ads_images.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("vehicletype","ads.vehicletype","=","vehicletype.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->where("ads_images.vehicletype",1)->where("motor_custome_values.model_id",$model)->where("motor_custome_values.make_id",$make)->get();
}
else if (($year!='0')&&($make!='0')&&($model=='0')){
$vehicletypecars = Ads::select("ads.*","ads.canonical_name as mainid","vehicletype.*","ads_images.*","ads_images.vehicletype as type1",'motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename")->leftjoin("ads_images","ads.id","=","ads_images.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("vehicletype","ads.vehicletype","=","vehicletype.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->where("ads_images.vehicletype",1)->where("motor_custome_values.make_id",$make)->where("motor_custome_values.registration_year",$year)->get();
}
else if (($year!='0')&&($make=='0')&&($model!='0')){
$vehicletypecars = Ads::select("ads.*","ads.canonical_name as mainid","vehicletype.*","ads_images.*","ads_images.vehicletype as type1",'motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename")->leftjoin("ads_images","ads.id","=","ads_images.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("vehicletype","ads.vehicletype","=","vehicletype.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->where("ads_images.vehicletype",1)->where("motor_custome_values.model_id",$model)->where("motor_custome_values.registration_year",$year)->get();
}

   
 $sqlQuery = "select `motor_custome_values`.make_id, `make_msts`.`name` as `makename` from `motor_custome_values` left join `make_msts` on `motor_custome_values`.`make_id` = `make_msts`.`id` group by make_id,makename";
$make = DB::select(DB::raw($sqlQuery));
$sqlQuery = "select `motor_custome_values`.model_id, `model_msts`.`name` as `modelname` from `motor_custome_values` left join `model_msts` on `motor_custome_values`.`model_id` = `model_msts`.`id` group by model_id,modelname";
$model = DB::select(DB::raw($sqlQuery));
$sqlQuery = "select distinct registration_year from motor_custome_values";
$year = DB::select(DB::raw($sqlQuery));
}else {

$priceflag=$request->priceflag;
if ($priceflag==1){
$amount=$request->amount;
$amountarr=explode("-",$amount);
$minprice1=$amountarr[0];
$maxprice1=$amountarr[1];
$maxpricearr=explode("AED",$maxprice1);
$maxpriceval=$maxpricearr[1];
$minpricearr=explode("AED",$minprice1);
$minpriceval=trim($minpricearr[1]);
}

if (($year!='0')&&($make=='0')&&($model=='0') &&($priceflag==0)&&($keywordsearch=='')){
// "year alone";

$vehicletypecars = Ads::select("ads.*","ads.canonical_name as mainid","vehicletype.*","ads_images.*","ads_images.vehicletype as type1",'motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename")->leftjoin("ads_images","ads.id","=","ads_images.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("vehicletype","ads.vehicletype","=","vehicletype.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->where("ads_images.vehicletype",1)->where("motor_custome_values.registration_year",$year)->get();
}
else if (($year!='0')&&($make=='0')&&($model=='0') &&($priceflag!=0)&&($keywordsearch=='')){
// "year and price";

$vehicletypecars = Ads::select("ads.*","ads.canonical_name as mainid","vehicletype.*","ads_images.*","ads_images.vehicletype as type1",'motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename")->leftjoin("ads_images","ads.id","=","ads_images.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("vehicletype","ads.vehicletype","=","vehicletype.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->where("ads_images.vehicletype",1)->where("motor_custome_values.registration_year",$year)->where("ads_images.vehicletype",1)->where('ads.price','>=',"$minpriceval")->where('ads.price','<=',"$maxpriceval")->get();
}
else if (($year=='0')&&($make!='0')&&($model=='0')&&($priceflag==0)&&($keywordsearch=='')){
    // "make alone";

$vehicletypecars = Ads::select("ads.*","ads.canonical_name as mainid","vehicletype.*","ads_images.*","ads_images.vehicletype as type1",'motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename")->leftjoin("ads_images","ads.id","=","ads_images.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("vehicletype","ads.vehicletype","=","vehicletype.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->where("ads_images.vehicletype",1)->where("motor_custome_values.make_id",$make)->get();
}
else if (($year=='0')&&($make!='0')&&($model=='0')&&($priceflag==1)&&($keywordsearch=='')){
    ///"make and price";

$vehicletypecars = Ads::select("ads.*","ads.canonical_name as mainid","vehicletype.*","ads_images.*","ads_images.vehicletype as type1",'motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename")->leftjoin("ads_images","ads.id","=","ads_images.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("vehicletype","ads.vehicletype","=","vehicletype.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->where("ads_images.vehicletype",1)->where("motor_custome_values.make_id",$make)->where('ads.price','>=',"$minpriceval")->where('ads.price','<=',"$maxpriceval")->get();
}
else if (($year=='0')&&($make=='0')&&($model!='0')&&($priceflag==0)&&($keywordsearch=='')){
   // "model alone";

$vehicletypecars = Ads::select("ads.*","ads.canonical_name as mainid","vehicletype.*","ads_images.*","ads_images.vehicletype as type1",'motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename")->leftjoin("ads_images","ads.id","=","ads_images.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("vehicletype","ads.vehicletype","=","vehicletype.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->where("ads_images.vehicletype",1)->where("motor_custome_values.model_id",$model)->get();
}else if (($year=='0')&&($make=='0')&&($model!='0')&&($priceflag==1)&&($keywordsearch=='')){
    //"model and price";

$vehicletypecars = Ads::select("ads.*","ads.canonical_name as mainid","vehicletype.*","ads_images.*","ads_images.vehicletype as type1",'motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename")->leftjoin("ads_images","ads.id","=","ads_images.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("vehicletype","ads.vehicletype","=","vehicletype.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->where("ads_images.vehicletype",1)->where("motor_custome_values.model_id",$model)->where('ads.price','>=',"$minpriceval")->where('ads.price','<=',"$maxpriceval")->get();
}
else if (($year=='0')&&($make=='0')&&($model=='0')&&($priceflag!=0)&&($keywordsearch=='')){
   // "price alone";

$vehicletypecars = Ads::select("ads.*","ads.canonical_name as mainid","vehicletype.*","ads_images.*","ads_images.vehicletype as type1",'motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename")->leftjoin("ads_images","ads.id","=","ads_images.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("vehicletype","ads.vehicletype","=","vehicletype.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->where("ads_images.vehicletype",1)->where('ads.price','>=',"$minpriceval")->where('ads.price','<=',"$maxpriceval")->get();
}
else if (($year!='0')&&($make!='0')&&($model!='0')&&($priceflag!=0)&&($keywordsearch=='')){
    //"all";

$vehicletypecars = Ads::select("ads.*","ads.canonical_name as mainid","vehicletype.*","ads_images.*","ads_images.vehicletype as type1",'motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename")->leftjoin("ads_images","ads.id","=","ads_images.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("vehicletype","ads.vehicletype","=","vehicletype.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->where("ads_images.vehicletype",1)->where("motor_custome_values.model_id",$model)->where("motor_custome_values.registration_year",$year)->where("motor_custome_values.make_id",$make)->where('ads.price','>=',"$minpriceval")->where('ads.price','<=',"$maxpriceval")->get();
}
else if (($year=='0')&&($make!='0')&&($model!='0')&&($priceflag!=0)&&($keywordsearch=='')){
    //"make,model,price";
    
$vehicletypecars = Ads::select("ads.*","ads.canonical_name as mainid","vehicletype.*","ads_images.*","ads_images.vehicletype as type1",'motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename")->leftjoin("ads_images","ads.id","=","ads_images.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("vehicletype","ads.vehicletype","=","vehicletype.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->where("ads_images.vehicletype",1)->where("motor_custome_values.model_id",$model)->where("motor_custome_values.make_id",$make)->where('ads.price','>=',"$minpriceval")->where('ads.price','<=',"$maxpriceval")->get();



}
else if (($year!='0')&&($make!='0')&&($model=='0')&&($priceflag!=0)&&($keywordsearch=='')){
    // "year,make,price";
    
$vehicletypecars = Ads::select("ads.*","ads.canonical_name as mainid","vehicletype.*","ads_images.*","ads_images.vehicletype as type1",'motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename")->leftjoin("ads_images","ads.id","=","ads_images.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("vehicletype","ads.vehicletype","=","vehicletype.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->where("ads_images.vehicletype",1)->where("motor_custome_values.make_id",$make)->where("motor_custome_values.registration_year",$year)->where('ads.price','>=',"$minpriceval")->where('ads.price','<=',"$maxpriceval")->get();
}
else if (($year!='0')&&($make=='0')&&($model!='0')&&($priceflag!=0)&&($keywordsearch=='')){
    //"year,model,price";
     
$vehicletypecars = Ads::select("ads.*","ads.canonical_name as mainid","vehicletype.*","ads_images.*","ads_images.vehicletype as type1",'motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename")->leftjoin("ads_images","ads.id","=","ads_images.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("vehicletype","ads.vehicletype","=","vehicletype.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->where("ads_images.vehicletype",1)->where("motor_custome_values.model_id",$model)->where("motor_custome_values.registration_year",$year)->where('ads.price','>=',"$minpriceval")->where('ads.price','<=',"$maxpriceval")->get();
}
else if (($year!='0')&&($make!='0')&&($model!='0')&&($priceflag==0)&&($keywordsearch=='')){
    //"year,model,make,price=0";
    
$vehicletypecars = Ads::select("ads.*","ads.canonical_name as mainid","vehicletype.*","ads_images.*","ads_images.vehicletype as type1",'motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename")->leftjoin("ads_images","ads.id","=","ads_images.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("vehicletype","ads.vehicletype","=","vehicletype.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->where("ads_images.vehicletype",1)->where("motor_custome_values.model_id",$model)->where("motor_custome_values.registration_year",$year)->where("motor_custome_values.make_id",$make)->get();
}
else if (($year=='0')&&($make!='0')&&($model!='0')&&($priceflag==0)&&($keywordsearch=='')){
    //"model,make,price=0";
     
$vehicletypecars = Ads::select("ads.*","ads.canonical_name as mainid","vehicletype.*","ads_images.*","ads_images.vehicletype as type1",'motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename")->leftjoin("ads_images","ads.id","=","ads_images.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("vehicletype","ads.vehicletype","=","vehicletype.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->where("ads_images.vehicletype",1)->where("motor_custome_values.model_id",$model)->where("motor_custome_values.make_id",$make)->get();
}
else if (($year!='0')&&($make!='0')&&($model=='0')&&($priceflag==0)&&($keywordsearch=='')){
    //"year,make,price=0";
     
$vehicletypecars = Ads::select("ads.*","ads.canonical_name as mainid","vehicletype.*","ads_images.*","ads_images.vehicletype as type1",'motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename")->leftjoin("ads_images","ads.id","=","ads_images.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("vehicletype","ads.vehicletype","=","vehicletype.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->where("ads_images.vehicletype",1)->where("motor_custome_values.make_id",$make)->where("motor_custome_values.registration_year",$year)->get();
}
else if (($year!='0')&&($make=='0')&&($model!='0')&&($priceflag==0)&&($keywordsearch=='')){
    //"year,model,price=0";
    
$vehicletypecars = Ads::select("ads.*","ads.canonical_name as mainid","vehicletype.*","ads_images.*","ads_images.vehicletype as type1",'motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename")->leftjoin("ads_images","ads.id","=","ads_images.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("vehicletype","ads.vehicletype","=","vehicletype.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->where("ads_images.vehicletype",1)->where("motor_custome_values.model_id",$model)->where("motor_custome_values.registration_year",$year)->get();
}

    else if (($keywordsearch!='') && ($priceflag==0)){


$vehicletypecars = Ads::select("ads.*","ads.canonical_name as mainid","vehicletype.*","adm.*",'adm.vehicletype as type1','motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename")->leftjoin("ads_images as adm","ads.id","=","adm.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("vehicletype","ads.vehicletype","=","vehicletype.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->where("motor_custome_values.model_id",$model)->where("motor_custome_values.registration_year",$keywordsearch)->orwhere("make_msts.name",'like',"%$keywordsearch%")->orwhere("model_msts.name",'like',"%$keywordsearch%")->get();



    }else if (($keywordsearch!='') && ($priceflag==1)){
$vehicletypecars = Ads::select("ads.*","ads.canonical_name as mainid","vehicletype.*","adm.*",'adm.vehicletype as type1','motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename")->leftjoin("ads_images as adm","ads.id","=","adm.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("vehicletype","ads.vehicletype","=","vehicletype.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->where("motor_custome_values.model_id",$model)->where("motor_custome_values.registration_year",$keywordsearch)->orwhere("make_msts.name",'like',"%$keywordsearch%")->orwhere("model_msts.name",'like',"%$keywordsearch%")->where('ads.price','>=',"$minpriceval")->where('ads.price','<=',"$maxpriceval")->get();


    }
    else if (($keywordsearch=='') && ($priceflag==1)){
       
$vehicletypecars = Ads::select("ads.*","ads.canonical_name as mainid","vehicletype.*","adm.*",'adm.vehicletype as type1','motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename")->leftjoin("ads_images as adm","ads.id","=","adm.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("vehicletype","ads.vehicletype","=","vehicletype.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->where('ads.price','>=',"$minpriceval")->where('ads.price','<=',"$maxpriceval")->get();

    }
 $sqlQuery = "select `motor_custome_values`.make_id, `make_msts`.`name` as `makename` from `motor_custome_values` left join `make_msts` on `motor_custome_values`.`make_id` = `make_msts`.`id` group by make_id,makename";
$make = DB::select(DB::raw($sqlQuery));
$sqlQuery = "select `motor_custome_values`.model_id, `model_msts`.`name` as `modelname` from `motor_custome_values` left join `model_msts` on `motor_custome_values`.`model_id` = `model_msts`.`id` group by model_id,modelname";
$model = DB::select(DB::raw($sqlQuery));
$sqlQuery = "select distinct registration_year from motor_custome_values";
$year = DB::select(DB::raw($sqlQuery));

}
        return view('cars.search',compact('testimonial','brands','questions','vehicletypecars','searchresult','footerimg','question1img','question2img','videoimg','make','model','year','maxprice','minprice','globe','subcategory'));
    
    }
    catch (exception $e) {
    $message=$e->getMessage();
    return view('cars.errorpage',compact('message'));
    }
   
}


public function getModel($makeid=0){

     // Fetch Models by makeid
     $modelData['data'] = MotorCustomeValues::leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")
        ->select('model_msts.id','name')->groupby('model_msts.id','name')
        ->where('motor_custome_values.make_id',$makeid)
        ->get();

     return response()->json($modelData);

   }

public function searchresultfilter(Request $request){
  try {
   $testimonial = Testimonial::orderBy('sortorder')->where('status',1)
        ->get();
    $searchresult=Banner::where('page','search result')->first();
    $footerimg = Banner::where('page','Footer')->first();
    $question1img = Banner::where('page','Faq1')->first();
    $question2img = Banner::where('page','Faq2')->first();
    $videoimg = Banner::where('page','Video Banner')->first();
    $brands = FeaturedDealers::orderBy('dealer_name')
            ->orderBy('created_at', 'desc')
            ->get(); 
            $questions=Questions::get();
$make=$request->make;
$model=$request->model;
$year=$request->year;
$vehicletypecars=array();
if (($year!='0')&&($make=='0')&&($model=='0')){

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
 $sqlQuery = "select `motor_custome_values`.make_id, `make_msts`.`name` as `makename` from `motor_custome_values` left join `make_msts` on `motor_custome_values`.`make_id` = `make_msts`.`id` group by make_id,makename";
$make = DB::select(DB::raw($sqlQuery));
$sqlQuery = "select `motor_custome_values`.model_id, `model_msts`.`name` as `modelname` from `motor_custome_values` left join `model_msts` on `motor_custome_values`.`model_id` = `model_msts`.`id` group by model_id,modelname";
$model = DB::select(DB::raw($sqlQuery));
$sqlQuery = "select distinct registration_year from motor_custome_values";
$year = DB::select(DB::raw($sqlQuery));
        return view('cars.search',compact('testimonial','brands','questions','vehicletypecars','searchresult','footerimg','question1img','question2img','videoimg','make','model','year',));
    
    }
    catch (exception $e) {
    $message=$e->getMessage();
    return view('cars.errorpage',compact('message'));
    }
   
}
	
	public function carlisting($cname){

$subcategory = Subcategory::orderBy('sort_order')->where('status',1)
        ->get(); 

if ($cname=='All'){
$vehicletypecars = Ads::select("ads.*","ads.id as mainid","subcategories.*","ads_images.*",'motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename",'places.name as placename','countries.name as countryname')->leftjoin("ads_images","ads.id","=","ads_images.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("subcategories","ads.subcategory_id","=","subcategories.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->leftjoin("places","places.id","=","ads.place")->leftjoin("countries","countries.id","=","ads.country_id")->where("ads_images.vehicletype",1)->paginate(2);

$vehicletypecarscount = Ads::select("ads.*","ads.id as mainid","subcategories.*","ads_images.*",'motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename",'places.name as placename','countries.name as countryname')->leftjoin("ads_images","ads.id","=","ads_images.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("subcategories","ads.subcategory_id","=","subcategories.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->leftjoin("places","places.id","=","ads.place")->leftjoin("countries","countries.id","=","ads.country_id")->where("ads_images.vehicletype",1)->count();






}else{
       /* $vehicletypecars = Ads::select("ads.*","ads.id as mainid","subcategories.*","ads_images.*",'motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename")->leftjoin("ads_images","ads.id","=","ads_images.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("subcategories","ads.subcategory_id","=","subcategories.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->where("ads_images.vehicletype",1)->where('subcategories.canonical_name',$cname)->get();*/

$vehicletypecars = Ads::select("ads.*","ads.id as mainid","subcategories.*","ads_images.*",'motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename",'places.name as placename','countries.name as countryname')->leftjoin("ads_images","ads.id","=","ads_images.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("subcategories","ads.subcategory_id","=","subcategories.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->leftjoin("places","places.id","=","ads.place")->leftjoin("countries","countries.id","=","ads.country_id")->where("ads_images.vehicletype",1)->where('subcategories.canonical_name',$cname)->paginate(2);


$vehicletypecarscount = Ads::select("ads.*","ads.id as mainid","subcategories.*","ads_images.*",'motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename",'places.name as placename','countries.name as countryname')->leftjoin("ads_images","ads.id","=","ads_images.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("subcategories","ads.subcategory_id","=","subcategories.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->leftjoin("places","places.id","=","ads.place")->leftjoin("countries","countries.id","=","ads.country_id")->where("ads_images.vehicletype",1)->where('subcategories.canonical_name',$cname)->count();




}
$sqlQuery = "select distinct registration_year from motor_custome_values order by registration_year limit 0,2";
$year = DB::select(DB::raw($sqlQuery));

$sqlQuery = "select distinct make_id,name from motor_custome_values m join make_msts ma on m.make_id=ma.id order by name limit 0,1";
$make = DB::select(DB::raw($sqlQuery));

$sqlQuery = "select distinct model_id,name from motor_custome_values m join model_msts ma on m.model_id=ma.id order by name limit 0,1";
$model = DB::select(DB::raw($sqlQuery));

$sqlQuery = "select distinct fuel_type from motor_custome_values order by fuel_type limit 0,2";
$fueltype = DB::select(DB::raw($sqlQuery));
$sqlQuery = "select distinct seats from ads order by seats limit 0,2";
$passengercapacity = DB::select(DB::raw($sqlQuery));
$sqlQuery = "select max(price) as price from ads";
$maxprice=  DB::select(DB::raw($sqlQuery));
$sqlQuery = "select min(price) as price from ads";
$minprice=  DB::select(DB::raw($sqlQuery)); 
//$vehicletypecarscount=0;
    return view('cars.listing',compact('minprice','maxprice','passengercapacity','fueltype','subcategory','vehicletypecars','year','make','model','cname','vehicletypecarscount'));  
}
	
function yearrender(){
    //$start=$off;
    $start=$_GET['val'];
    $offset=$start+2;
$sqlQuery = "select distinct registration_year from motor_custome_values order by registration_year limit $offset,2";
$year = DB::select(DB::raw($sqlQuery));

    return view('cars.caryear',compact('year','offset'));


}

function passengercapacityrender(){
    //$start=$off;
    $start=$_GET['val'];
    $offsetpassengercapacity=$start+2;
$sqlQuery = "select distinct seats from ads order by seats limit $offsetpassengercapacity,2";
$passengercapacity = DB::select(DB::raw($sqlQuery));

    return view('cars.carpassengercapacity',compact('passengercapacity','offsetpassengercapacity'));


}




function fueltyperender(){
    //$start=$off;
    $start=$_GET['val'];
    $offsetfueltype=$start+2;
$sqlQuery = "select distinct fuel_type from motor_custome_values order by fuel_type limit $offsetfueltype,2";
$fueltype = DB::select(DB::raw($sqlQuery));

    return view('cars.carfueltype',compact('fueltype','offsetfueltype'));


}




function makerender(){
    //$start=$off;
    $start=$_GET['val'];
    $offset=$start+1;
$sqlQuery = "select distinct make_id,name from motor_custome_values m join make_msts ma on m.make_id=ma.id order by name limit $offset,1";
$make = DB::select(DB::raw($sqlQuery));

    return view('cars.carmake',compact('make','offset'));


}
function modelrender(){
    //$start=$off;
    $start=$_GET['val'];
    $offsetmodel=$start+1;
$sqlQuery = "select distinct model_id,name from motor_custome_values m join model_msts ma on m.model_id=ma.id order by name limit $offsetmodel,1";
$model = DB::select(DB::raw($sqlQuery));

    return view('cars.carmodel',compact('model','offsetmodel'));


}


public function searchfilter1(Request $request){
    /*Ajax Search-Large Filter*/
    $year=$request->year;
    $make=$request->carmake;
    $model=$request->carmodel;
    $fueltype=$request->carfueltype;
    $passengercapacity=$request->carpassengercapacity;
    $priceflag=$request->priceflag;
$subcategory = Subcategory::orderBy('sort_order')->where('status',1)
        ->get(); 

//dd($year);
$query = Ads::select("ads.*","ads.id as mainid","subcategories.*","ads_images.*",'motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename",'places.name as placename','countries.name as countryname')->leftjoin("ads_images","ads.id","=","ads_images.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("subcategories","ads.subcategory_id","=","subcategories.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->leftjoin("places","places.id","=","ads.place")->leftjoin("countries","countries.id","=","ads.country_id")->where("ads_images.vehicletype",1);
if ($year!=''){
$query->whereIn('registration_year',$year);
}
if ($make!=''){
$query->whereIn('motor_custome_values.make_id',$make);
}
if ($model!=''){
$query->whereIn('motor_custome_values.model_id',$model);
}
if ($fueltype!=''){
$query->whereIn('motor_custome_values.fuel_type',$fueltype);
}
if ($passengercapacity!=''){
$query->whereIn('ads.seats',$passengercapacity);
}
if ($priceflag==1){
$amount=$request->amount;
$amountarr=explode("-",$amount);
$minprice1=$amountarr[0];
$maxprice1=$amountarr[1];
$maxpricearr=explode("AED",$maxprice1);
$maxpriceval=$maxpricearr[1];
$minpricearr=explode("AED",$minprice1);
$minpriceval=trim($minpricearr[1]);
$query->where('ads.price','>=',"$minpriceval")->where('ads.price','<=',"$maxpriceval");
}
$vehicletypecars=$query->skip(0)->take(2)->get();
//dd($vehicletypecars);
$sqlQuery = "select distinct registration_year from motor_custome_values order by registration_year limit 0,2";
$year = DB::select(DB::raw($sqlQuery));

$sqlQuery = "select distinct make_id,name from motor_custome_values m join make_msts ma on m.make_id=ma.id order by name limit 0,1";
$make = DB::select(DB::raw($sqlQuery));

$sqlQuery = "select distinct model_id,name from motor_custome_values m join model_msts ma on m.model_id=ma.id order by name limit 0,1";
$model = DB::select(DB::raw($sqlQuery));
$sqlQuery = "select distinct seats from ads order by seats limit 0,2";
$passengercapacity = DB::select(DB::raw($sqlQuery));

$flag=3;
$offset=0;
    return view('cars.searchresult',compact('offset','flag','passengercapacity','subcategory','vehicletypecars','year','make','model'));



}

public function searchfilter2(Request $request){
    /*Ajax Search-Large Filter*/
    $year=$request->year;
    $make=$request->carmake;
    $model=$request->carmodel;
    $fueltype=$request->carfueltype;
    $passengercapacity=$request->carpassengercapacity;
    $priceflag=$request->priceflag;
$subcategory = Subcategory::orderBy('sort_order')->where('status',1)
        ->get(); 
$offset=$_GET['val1']+2;
//dd($year);
$query = Ads::select("ads.*","ads.id as mainid","subcategories.*","ads_images.*",'motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename",'places.name as placename','countries.name as countryname')->leftjoin("ads_images","ads.id","=","ads_images.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("subcategories","ads.subcategory_id","=","subcategories.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->leftjoin("places","places.id","=","ads.place")->leftjoin("countries","countries.id","=","ads.country_id")->where("ads_images.vehicletype",1);
if ($year!=''){
$query->whereIn('registration_year',$year);
}
if ($make!=''){
$query->whereIn('motor_custome_values.make_id',$make);
}
if ($model!=''){
$query->whereIn('motor_custome_values.model_id',$model);
}
if ($fueltype!=''){
$query->whereIn('motor_custome_values.fuel_type',$fueltype);
}
if ($passengercapacity!=''){
$query->whereIn('ads.seats',$passengercapacity);
}
if ($priceflag==1){
$amount=$request->amount;
$amountarr=explode("-",$amount);
$minprice1=$amountarr[0];
$maxprice1=$amountarr[1];
$maxpricearr=explode("AED",$maxprice1);
$maxpriceval=$maxpricearr[1];
$minpricearr=explode("AED",$minprice1);
$minpriceval=trim($minpricearr[1]);
$query->where('ads.price','>=',"$minpriceval")->where('ads.price','<=',"$maxpriceval");
}
$vehicletypecars=$query->skip($offset)->take(2)->get();
//dd($vehicletypecars);
$sqlQuery = "select distinct registration_year from motor_custome_values order by registration_year limit 0,2";
$year = DB::select(DB::raw($sqlQuery));

$sqlQuery = "select distinct make_id,name from motor_custome_values m join make_msts ma on m.make_id=ma.id order by name limit 0,1";
$make = DB::select(DB::raw($sqlQuery));

$sqlQuery = "select distinct model_id,name from motor_custome_values m join model_msts ma on m.model_id=ma.id order by name limit 0,1";
$model = DB::select(DB::raw($sqlQuery));
$sqlQuery = "select distinct seats from ads order by seats limit 0,2";
$passengercapacity = DB::select(DB::raw($sqlQuery));
$flag=3;

    return view('cars.searchresult',compact('offset','flag','passengercapacity','subcategory','vehicletypecars','year','make','model'));



}
















public function searchtextbox(){

    $keywordsearch=$_GET['val'];
    //echo $keyword;
$vehicletypecars = Ads::select("ads.*","ads.canonical_name as mainid","vehicletype.*","adm.*",'adm.vehicletype as type1','motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename")->leftjoin("ads_images as adm","ads.id","=","adm.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("vehicletype","ads.vehicletype","=","vehicletype.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->where("motor_custome_values.registration_year",$keywordsearch)->orwhere("make_msts.name",'like',"%$keywordsearch%")->orwhere("model_msts.name",'like',"%$keywordsearch%")->orwhere('motor_custome_values.fuel_type','like',"%$keywordsearch%")->skip(0)->take(2)->get();


$vehicletypecarscount1 = Ads::select("ads.*","ads.canonical_name as mainid","vehicletype.*","adm.*",'adm.vehicletype as type1','motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename")->leftjoin("ads_images as adm","ads.id","=","adm.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("vehicletype","ads.vehicletype","=","vehicletype.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->where("motor_custome_values.registration_year",$keywordsearch)->orwhere("make_msts.name",'like',"%$keywordsearch%")->orwhere("model_msts.name",'like',"%$keywordsearch%")->orwhere('motor_custome_values.fuel_type','like',"%$keywordsearch%")->get();

$vehicletypecarscount=count($vehicletypecarscount1);

//dd($vehicletypecarscount);

$sqlQuery = "select distinct registration_year from motor_custome_values order by registration_year limit 0,2";
$year = DB::select(DB::raw($sqlQuery));

$sqlQuery = "select distinct make_id,name from motor_custome_values m join make_msts ma on m.make_id=ma.id order by name limit 0,1";
$make = DB::select(DB::raw($sqlQuery));

$sqlQuery = "select distinct model_id,name from motor_custome_values m join model_msts ma on m.model_id=ma.id order by name limit 0,1";
$model = DB::select(DB::raw($sqlQuery));
$sqlQuery = "select distinct seats from ads order by seats limit 0,2";
$passengercapacity = DB::select(DB::raw($sqlQuery));

$subcategory = Subcategory::orderBy('sort_order')->where('status',1)
        ->get(); 
        $offset=0;
        $flag=1;
    return view('cars.searchresult',compact('flag','offset','passengercapacity','subcategory','vehicletypecars','year','make','model','vehicletypecarscount'));




}

public function searchtextboxnext(){

    $keywordsearch=$_GET['val'];
    $offset=$_GET['val1']+2;
    //dd($offset);
    //echo $keyword;
$vehicletypecars = Ads::select("ads.*","ads.canonical_name as mainid","vehicletype.*","adm.*",'adm.vehicletype as type1','motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename")->leftjoin("ads_images as adm","ads.id","=","adm.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("vehicletype","ads.vehicletype","=","vehicletype.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->where("motor_custome_values.registration_year",$keywordsearch)->orwhere("make_msts.name",'like',"%$keywordsearch%")->orwhere("model_msts.name",'like',"%$keywordsearch%")->orwhere('motor_custome_values.fuel_type','like',"%$keywordsearch%")->skip($offset)->take(2)->get();




$vehicletypecarscount1 = Ads::select("ads.*","ads.canonical_name as mainid","vehicletype.*","adm.*",'adm.vehicletype as type1','motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename")->leftjoin("ads_images as adm","ads.id","=","adm.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("vehicletype","ads.vehicletype","=","vehicletype.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->where("motor_custome_values.registration_year",$keywordsearch)->orwhere("make_msts.name",'like',"%$keywordsearch%")->orwhere("model_msts.name",'like',"%$keywordsearch%")->orwhere('motor_custome_values.fuel_type','like',"%$keywordsearch%")->get();

$vehicletypecarscount=count($vehicletypecarscount1);

$sqlQuery = "select distinct registration_year from motor_custome_values order by registration_year limit 0,2";
$year = DB::select(DB::raw($sqlQuery));

$sqlQuery = "select distinct make_id,name from motor_custome_values m join make_msts ma on m.make_id=ma.id order by name limit 0,1";
$make = DB::select(DB::raw($sqlQuery));

$sqlQuery = "select distinct model_id,name from motor_custome_values m join model_msts ma on m.model_id=ma.id order by name limit 0,1";
$model = DB::select(DB::raw($sqlQuery));
$sqlQuery = "select distinct seats from ads order by seats limit 0,2";
$passengercapacity = DB::select(DB::raw($sqlQuery));

$subcategory = Subcategory::orderBy('sort_order')->where('status',1)
        ->get(); 
      $flag=1;
    return view('cars.searchresult',compact('flag','offset','passengercapacity','subcategory','vehicletypecars','year','make','model','vehicletypecarscount'));




}










public function searchtextboxfirst(){

    $keywordsearch=$_GET['val'];
    //echo $keyword;
    $offset=0;
$vehicletypecars = Ads::select("ads.*","ads.canonical_name as mainid","vehicletype.*","adm.*",'adm.vehicletype as type1','motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename")->leftjoin("ads_images as adm","ads.id","=","adm.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("vehicletype","ads.vehicletype","=","vehicletype.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->where("adm.vehicletype",1)->where("motor_custome_values.registration_year",$keywordsearch)->orwhere("make_msts.name",'like',"%$keywordsearch%")->orwhere("model_msts.name",'like',"%$keywordsearch%")->orwhere('motor_custome_values.fuel_type','like',"%$keywordsearch%")->skip(0)->take(2)->get();


$vehicletypecarscount = Ads::select("ads.*","ads.canonical_name as mainid","vehicletype.*","adm.*",'adm.vehicletype as type1','motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename")->leftjoin("ads_images as adm","ads.id","=","adm.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("vehicletype","ads.vehicletype","=","vehicletype.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->where("adm.vehicletype",1)->where("motor_custome_values.registration_year",$keywordsearch)->orwhere("make_msts.name",'like',"%$keywordsearch%")->orwhere("model_msts.name",'like',"%$keywordsearch%")->orwhere('motor_custome_values.fuel_type','like',"%$keywordsearch%")->count();




$sqlQuery = "select distinct registration_year from motor_custome_values order by registration_year limit 0,2";
$year = DB::select(DB::raw($sqlQuery));

$sqlQuery = "select distinct make_id,name from motor_custome_values m join make_msts ma on m.make_id=ma.id order by name limit 0,1";
$make = DB::select(DB::raw($sqlQuery));

$sqlQuery = "select distinct model_id,name from motor_custome_values m join model_msts ma on m.model_id=ma.id order by name limit 0,1";
$model = DB::select(DB::raw($sqlQuery));
$sqlQuery = "select distinct seats from ads order by seats limit 0,2";
$passengercapacity = DB::select(DB::raw($sqlQuery));

$subcategory = Subcategory::orderBy('sort_order')->where('status',1)
        ->get(); 
        //$vehicletypecarscount=count($vehicletypecarscount1);
$flag=2;
    return view('cars.searchresult',compact('flag','passengercapacity','subcategory','vehicletypecars','year','make','model','offset','vehicletypecarscount'));




}


public function searchtextboxfirstnext(){

    $keywordsearch=$_GET['val'];
    //echo $keyword;
     $offset=$_GET['val1']+2;
$vehicletypecars = Ads::select("ads.*","ads.canonical_name as mainid","vehicletype.*","adm.*",'adm.vehicletype as type1','motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename")->leftjoin("ads_images as adm","ads.id","=","adm.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("vehicletype","ads.vehicletype","=","vehicletype.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->where("adm.vehicletype",1)->where("motor_custome_values.registration_year",$keywordsearch)->orwhere("make_msts.name",'like',"%$keywordsearch%")->orwhere("model_msts.name",'like',"%$keywordsearch%")->orwhere('motor_custome_values.fuel_type','like',"%$keywordsearch%")->skip($offset)->take(2)->get();


$vehicletypecarscount = Ads::select("ads.*","ads.canonical_name as mainid","vehicletype.*","adm.*",'adm.vehicletype as type1','motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename")->leftjoin("ads_images as adm","ads.id","=","adm.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("vehicletype","ads.vehicletype","=","vehicletype.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->where("adm.vehicletype",1)->where("motor_custome_values.registration_year",$keywordsearch)->orwhere("make_msts.name",'like',"%$keywordsearch%")->orwhere("model_msts.name",'like',"%$keywordsearch%")->orwhere('motor_custome_values.fuel_type','like',"%$keywordsearch%")->count();




$sqlQuery = "select distinct registration_year from motor_custome_values order by registration_year limit 0,2";
$year = DB::select(DB::raw($sqlQuery));

$sqlQuery = "select distinct make_id,name from motor_custome_values m join make_msts ma on m.make_id=ma.id order by name limit 0,1";
$make = DB::select(DB::raw($sqlQuery));

$sqlQuery = "select distinct model_id,name from motor_custome_values m join model_msts ma on m.model_id=ma.id order by name limit 0,1";
$model = DB::select(DB::raw($sqlQuery));
$sqlQuery = "select distinct seats from ads order by seats limit 0,2";
$passengercapacity = DB::select(DB::raw($sqlQuery));

$subcategory = Subcategory::orderBy('sort_order')->where('status',1)
        ->get(); 
        //$vehicletypecarscount=count($vehicletypecarscount1);
$flag=2;
    return view('cars.searchresult',compact('flag','passengercapacity','subcategory','vehicletypecars','year','make','model','offset','vehicletypecarscount'));




}















public function carlistingsort(){
$cname=$_GET['val'];
$sortype=$_GET['val1'];
$subcategory = Subcategory::orderBy('sort_order')->where('status',1)
        ->get(); 
if ($sortype=='Date'){
if ($cname=='All'){
$vehicletypecars = Ads::select("ads.*","ads.id as mainid","subcategories.*","ads_images.*",'motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename")->leftjoin("ads_images","ads.id","=","ads_images.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("subcategories","ads.subcategory_id","=","subcategories.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->where("ads_images.vehicletype",1)->orderby('registration_year')->paginate(2);
}else{
       
$vehicletypecars = Ads::select("ads.*","ads.id as mainid","subcategories.*","ads_images.*",'motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename")->leftjoin("ads_images","ads.id","=","ads_images.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("subcategories","ads.subcategory_id","=","subcategories.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->where("ads_images.vehicletype",1)->orderby('registration_year')->where('subcategories.canonical_name',$cname)->paginate(2);


}}else{


if ($cname=='All'){
$vehicletypecars = Ads::select("ads.*","ads.id as mainid","subcategories.*","ads_images.*",'motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename")->leftjoin("ads_images","ads.id","=","ads_images.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("subcategories","ads.subcategory_id","=","subcategories.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->where("ads_images.vehicletype",1)->orderby('price')->paginate(2);
}else{
       
$vehicletypecars = Ads::select("ads.*","ads.id as mainid","subcategories.*","ads_images.*",'motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename")->leftjoin("ads_images","ads.id","=","ads_images.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("subcategories","ads.subcategory_id","=","subcategories.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->where("ads_images.vehicletype",1)->orderby('price')->where('subcategories.canonical_name',$cname)->paginate(2);


}

}
$sqlQuery = "select distinct registration_year from motor_custome_values order by registration_year limit 0,2";
$year = DB::select(DB::raw($sqlQuery));

$sqlQuery = "select distinct make_id,name from motor_custome_values m join make_msts ma on m.make_id=ma.id order by name limit 0,1";
$make = DB::select(DB::raw($sqlQuery));

$sqlQuery = "select distinct model_id,name from motor_custome_values m join model_msts ma on m.model_id=ma.id order by name limit 0,1";
$model = DB::select(DB::raw($sqlQuery));

$sqlQuery = "select distinct fuel_type from motor_custome_values order by fuel_type limit 0,2";
$fueltype = DB::select(DB::raw($sqlQuery));
$sqlQuery = "select distinct seats from ads order by seats limit 0,2";
$passengercapacity = DB::select(DB::raw($sqlQuery));
$sqlQuery = "select max(price) as price from ads";
$maxprice=  DB::select(DB::raw($sqlQuery));
$sqlQuery = "select min(price) as price from ads";
$minprice=  DB::select(DB::raw($sqlQuery)); 

return view('cars.searchresult',compact('passengercapacity','subcategory','vehicletypecars','year','make','model'));



    //return view('cars.listing',compact('minprice','maxprice','passengercapacity','fueltype','subcategory','vehicletypecars','year','make','model'));  
}


function get_ajax_data(Request $request)
    {
     if($request->ajax())
     {
      /*$data = User::paginate(5);*/

 $year=$request->year;
    $make=$request->carmake;
    $model=$request->carmodel;
    $fueltype=$request->carfueltype;
    $passengercapacity=$request->carpassengercapacity;
    $priceflag=$request->priceflag;
$subcategory = Subcategory::orderBy('sort_order')->where('status',1)
        ->get(); 


$query = Ads::select("ads.*","ads.id as mainid","subcategories.*","ads_images.*",'motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename",'places.name as placename','countries.name as countryname')->leftjoin("ads_images","ads.id","=","ads_images.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("subcategories","ads.subcategory_id","=","subcategories.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->leftjoin("places","places.id","=","ads.place")->leftjoin("countries","countries.id","=","ads.country_id")->where("ads_images.vehicletype",1);
if ($year!=''){
$query->whereIn('registration_year',$year);
}
if ($make!=''){
$query->whereIn('motor_custome_values.make_id',$make);
}
if ($model!=''){
$query->whereIn('motor_custome_values.model_id',$model);
}
if ($fueltype!=''){
$query->whereIn('motor_custome_values.fuel_type',$fueltype);
}
if ($passengercapacity!=''){
$query->whereIn('ads.seats',$passengercapacity);
}
if ($priceflag==1){
$amount=$request->amount;
$amountarr=explode("-",$amount);
$minprice1=$amountarr[0];
$maxprice1=$amountarr[1];
$maxpricearr=explode("AED",$maxprice1);
$maxpriceval=$maxpricearr[1];
$minpricearr=explode("AED",$minprice1);
$minpriceval=trim($minpricearr[1]);
$query->where('ads.price','>=',"$minpriceval")->where('ads.price','<=',"$maxpriceval");
}
//$vehicletypecars=$query->get();
$vehicletypecars=$query->paginate(2);
$sqlQuery = "select distinct registration_year from motor_custome_values order by registration_year limit 0,2";
$year = DB::select(DB::raw($sqlQuery));

$sqlQuery = "select distinct make_id,name from motor_custome_values m join make_msts ma on m.make_id=ma.id order by name limit 0,1";
$make = DB::select(DB::raw($sqlQuery));

$sqlQuery = "select distinct model_id,name from motor_custome_values m join model_msts ma on m.model_id=ma.id order by name limit 0,1";
$model = DB::select(DB::raw($sqlQuery));
$sqlQuery = "select distinct seats from ads order by seats limit 0,2";
$passengercapacity = DB::select(DB::raw($sqlQuery));


    //return view('cars.searchresult',compact('passengercapacity','subcategory','vehicletypecars','year','make','model'));








      return view('cars.pagination_data',compact('vehicletypecars'))->render();
     }
}




	
}
