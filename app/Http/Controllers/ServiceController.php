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

        $vehicletypecars = Ads::select("ads.*","ads.canonical_name as mainid","subcategories.*","ads_images.*",'motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename")->leftjoin("ads_images","ads.id","=","ads_images.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("subcategories","ads.subcategory_id","=","subcategories.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->where("ads_images.vehicletype",1)->get();
   $sqlQuery = "select `motor_custome_values`.make_id, `make_msts`.`name` as `makename` from `motor_custome_values` left join `make_msts` on `motor_custome_values`.`make_id` = `make_msts`.`id` group by make_id,makename";
$make = DB::select(DB::raw($sqlQuery));
$sqlQuery = "select `motor_custome_values`.model_id, `model_msts`.`name` as `modelname` from `motor_custome_values` left join `model_msts` on `motor_custome_values`.`model_id` = `model_msts`.`id` group by model_id,modelname";
$model = DB::select(DB::raw($sqlQuery));
$sqlQuery = "select distinct registration_year from motor_custome_values order by registration_year";
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
$sqlQuery = "select distinct registration_year from motor_custome_values order by registration_year";
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
$sqlQuery = "select distinct registration_year from motor_custome_values order by registration_year";
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
$vehicletypecars = Ads::select("ads.*","ads.canonical_name as mainid","subcategories.*","ads_images.*",'motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename",'places.name as placename','countries.name as countryname')->leftjoin("ads_images","ads.id","=","ads_images.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("subcategories","ads.subcategory_id","=","subcategories.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->leftjoin("places","places.id","=","ads.place")->leftjoin("countries","countries.id","=","ads.country_id")->where("ads_images.vehicletype",1)->paginate(10);

$vehicletypecarscount = Ads::select("ads.*","ads.canonical_name as mainid","subcategories.*","ads_images.*",'motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename",'places.name as placename','countries.name as countryname')->leftjoin("ads_images","ads.id","=","ads_images.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("subcategories","ads.subcategory_id","=","subcategories.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->leftjoin("places","places.id","=","ads.place")->leftjoin("countries","countries.id","=","ads.country_id")->where("ads_images.vehicletype",1)->count();






}else{
      

$vehicletypecars = Ads::select("ads.*","ads.canonical_name as mainid","subcategories.*","ads_images.*",'motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename",'places.name as placename','countries.name as countryname')->leftjoin("ads_images","ads.id","=","ads_images.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("subcategories","ads.subcategory_id","=","subcategories.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->leftjoin("places","places.id","=","ads.place")->leftjoin("countries","countries.id","=","ads.country_id")->where("ads_images.vehicletype",1)->where('subcategories.canonical_name',$cname)->paginate(10);


$vehicletypecarscount = Ads::select("ads.*","ads.canonical_name as mainid","subcategories.*","ads_images.*",'motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename",'places.name as placename','countries.name as countryname')->leftjoin("ads_images","ads.id","=","ads_images.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("subcategories","ads.subcategory_id","=","subcategories.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->leftjoin("places","places.id","=","ads.place")->leftjoin("countries","countries.id","=","ads.country_id")->where("ads_images.vehicletype",1)->where('subcategories.canonical_name',$cname)->count();




}
$sqlQuery = "select distinct registration_year from motor_custome_values order by registration_year limit 0,4";
$year = DB::select(DB::raw($sqlQuery));

$sqlQuery = "select distinct make_id,name from motor_custome_values m join make_msts ma on m.make_id=ma.id order by name limit 0,4";
$make = DB::select(DB::raw($sqlQuery));

$sqlQuery = "select distinct model_id,name from motor_custome_values m join model_msts ma on m.model_id=ma.id order by name limit 0,4";
$model = DB::select(DB::raw($sqlQuery));

$sqlQuery = "select distinct fuel_type from motor_custome_values order by fuel_type limit 0,4";
$fueltype = DB::select(DB::raw($sqlQuery));
$sqlQuery = "select distinct seats from ads order by seats limit 0,4";
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
    $offset=$start+4;
$sqlQuery = "select distinct registration_year from motor_custome_values order by registration_year limit $offset,4";
$year = DB::select(DB::raw($sqlQuery));

    return view('cars.caryear',compact('year','offset'));


}

function passengercapacityrender(){
    //$start=$off;
    $start=$_GET['val'];
    $offsetpassengercapacity=$start+4;
$sqlQuery = "select distinct seats from ads order by seats limit $offsetpassengercapacity,4";
$passengercapacity = DB::select(DB::raw($sqlQuery));

    return view('cars.carpassengercapacity',compact('passengercapacity','offsetpassengercapacity'));


}




function fueltyperender(){
    //$start=$off;
    $start=$_GET['val'];
    $offsetfueltype=$start+4;
$sqlQuery = "select distinct fuel_type from motor_custome_values order by fuel_type limit $offsetfueltype,4";
$fueltype = DB::select(DB::raw($sqlQuery));

    return view('cars.carfueltype',compact('fueltype','offsetfueltype'));


}




function makerender(){
    //$start=$off;
    $start=$_GET['val'];
    $offset=$start+4;
$sqlQuery = "select distinct make_id,name from motor_custome_values m join make_msts ma on m.make_id=ma.id order by name limit $offset,4";
$make = DB::select(DB::raw($sqlQuery));

    return view('cars.carmake',compact('make','offset'));


}
function modelrender(){
    //$start=$off;
    $start=$_GET['val'];
    $offsetmodel=$start+4;
$sqlQuery = "select distinct model_id,name from motor_custome_values m join model_msts ma on m.model_id=ma.id order by name limit $offsetmodel,4";
$model = DB::select(DB::raw($sqlQuery));

    return view('cars.carmodel',compact('model','offsetmodel'));


}
public function searchfilter1count(Request $request){

//dd("en");
    /*Ajax Search-Large Filter*/
    $year=$request->year;
    //dd($year);
    $make=$request->carmake;
    $model=$request->carmodel;
    $fueltype=$request->carfueltype;
    $passengercapacity=$request->carpassengercapacity;
    //dd($passengercapacity);
    $priceflag=$request->priceflag;
$subcategory = Subcategory::orderBy('sort_order')->where('status',1)
        ->get(); 

//dd($year,$make,$model,$fueltype,$passengercapacity,$priceflag);
$query = Ads::select("ads.*","ads.id as mainid","subcategories.*",'motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename",'places.name as placename','countries.name as countryname')->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("subcategories","ads.subcategory_id","=","subcategories.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->leftjoin("places","places.id","=","ads.place")->leftjoin("countries","countries.id","=","ads.country_id");
if ($year!=''){
    //echo "year";
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
   // $pc=explode(",",$passengercapacity);
$query->whereIn('ads.seats',$passengercapacity);
    //$query->whereIn('ads.seats',$pc);
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
if ($request->searchall!=''){
    $keywordsearch=$request->searchall;
    $query->where("make_msts.name",'like',"%$keywordsearch%")->orwhere("motor_custome_values.registration_year",$keywordsearch)->orwhere("model_msts.name",'like',"%$keywordsearch%")->orwhere('motor_custome_values.fuel_type','like',"%$keywordsearch%");
}
//DB::enableQueryLog();
$vehicletypecarscount=$query->count();
//$quries = DB::getQueryLog();
//dd($quries);

echo $vehicletypecarscount;






}

public function searchfilter1(Request $request){
    //dd("en");
    /*Ajax Search-Large Filter*/
    $year=$request->year;
    //dd($year);
    $make=$request->carmake;
    $model=$request->carmodel;
    $fueltype=$request->carfueltype;
    $passengercapacity=$request->carpassengercapacity;
    //dd($passengercapacity);
    $priceflag=$request->priceflag;
$subcategory = Subcategory::orderBy('sort_order')->where('status',1)
        ->get(); 

//dd($year,$make,$model,$fueltype,$passengercapacity,$priceflag);
$query = Ads::select("ads.*","ads.canonical_name as mainid","subcategories.*",'motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename",'places.name as placename','countries.name as countryname')->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("subcategories","ads.subcategory_id","=","subcategories.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->leftjoin("places","places.id","=","ads.place")->leftjoin("countries","countries.id","=","ads.country_id");
if ($year!=''){
    //echo "year";
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
   // $pc=explode(",",$passengercapacity);
$query->whereIn('ads.seats',$passengercapacity);
    //$query->whereIn('ads.seats',$pc);
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
if ($request->searchall!=''){
    $keywordsearch=$request->searchall;
    $query->where("make_msts.name",'like',"%$keywordsearch%")->orwhere("motor_custome_values.registration_year",$keywordsearch)->orwhere("model_msts.name",'like',"%$keywordsearch%")->orwhere('motor_custome_values.fuel_type','like',"%$keywordsearch%");
}
//DB::enableQueryLog();
$vehicletypecars=$query->skip(0)->take(10)->get();
//$quries = DB::getQueryLog();
//dd($quries);
if (($year==null)&&($make==null)&&($model==null)&&($fueltype==null)&&($passengercapacity==null)&&$priceflag==0 &&($request->searchall=='')){
    $vehicletypecars=array();
}
/*if (($year==null)and($make=null)){
    dd("enter");
$vehicletypecars=array();

}*/
$sqlQuery = "select distinct registration_year from motor_custome_values order by registration_year limit 0,4";
$year = DB::select(DB::raw($sqlQuery));

$sqlQuery = "select distinct make_id,name from motor_custome_values m join make_msts ma on m.make_id=ma.id order by name limit 0,4";
$make = DB::select(DB::raw($sqlQuery));

$sqlQuery = "select distinct model_id,name from motor_custome_values m join model_msts ma on m.model_id=ma.id order by name limit 0,4";
$model = DB::select(DB::raw($sqlQuery));
$sqlQuery = "select distinct seats from ads order by seats limit 0,4";
$passengercapacity = DB::select(DB::raw($sqlQuery));

$flag=3;
$offset=0;
$currcount=count($vehicletypecars);
    return view('cars.searchresult',compact('currcount','offset','flag','passengercapacity','subcategory','vehicletypecars','year','make','model'));



}



public function searchfilter2(Request $request){
    //dd("en");
    /*Ajax Search-Large Filter*/
    $year=$request->year;
    //dd($year);
    $make=$request->carmake;
    $model=$request->carmodel;
    $fueltype=$request->carfueltype;
    //dd($fueltype);
    $passengercapacity=$request->carpassengercapacity;
    //dd($passengercapacity);
    $priceflag=$request->priceflag;
$subcategory = Subcategory::orderBy('sort_order')->where('status',1)
        ->get(); 
$offset=$_GET['offset']+10;
//dd($year,$make,$model,$fueltype,$passengercapacity,$priceflag);
$query = Ads::select("ads.*","ads.canonical_name as mainid","subcategories.*",'motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename",'places.name as placename','countries.name as countryname')->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("subcategories","ads.subcategory_id","=","subcategories.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->leftjoin("places","places.id","=","ads.place")->leftjoin("countries","countries.id","=","ads.country_id");

if (isset($year)&&($year[0]!=null)){
   //echo "year";
//dd();
$query->whereIn('registration_year',$year);
}
//if ($make!=''){
if ($make[0]!=null){
$query->whereIn('motor_custome_values.make_id',$make);
}
//if ($model!=''){
if ($model[0]!=null){
$query->whereIn('motor_custome_values.model_id',$model);
}
if ($fueltype[0]!=null){
//if ($fueltype!=''){
$query->whereIn('motor_custome_values.fuel_type',$fueltype);
}
if ($passengercapacity[0]!=null){

$query->whereIn('ads.seats',$passengercapacity);
    //$query->whereIn('ads.seats',$pc);
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
if ($request->searchall!=''){
    $keywordsearch=$request->searchall;
    $query->where("make_msts.name",'like',"%$keywordsearch%")->orwhere("motor_custome_values.registration_year",$keywordsearch)->orwhere("model_msts.name",'like',"%$keywordsearch%")->orwhere('motor_custome_values.fuel_type','like',"%$keywordsearch%");
}
//DB::enableQueryLog();
$vehicletypecars=$query->skip($offset)->take(10)->get();
//$quries = DB::getQueryLog();
//dd($quries);
if (($year==null)&&($make==null)&&($model==null)&&($fueltype==null)&&($passengercapacity==null)&&$priceflag==0 &&($request->searchall=='')){
    $vehicletypecars=array();
}

$sqlQuery = "select distinct registration_year from motor_custome_values order by registration_year limit 0,4";
$year = DB::select(DB::raw($sqlQuery));

$sqlQuery = "select distinct make_id,name from motor_custome_values m join make_msts ma on m.make_id=ma.id order by name limit 0,4";
$make = DB::select(DB::raw($sqlQuery));

$sqlQuery = "select distinct model_id,name from motor_custome_values m join model_msts ma on m.model_id=ma.id order by name limit 0,4";
$model = DB::select(DB::raw($sqlQuery));
$sqlQuery = "select distinct seats from ads order by seats limit 0,4";
$passengercapacity = DB::select(DB::raw($sqlQuery));

$flag=3;
//$offset=0;
$currcount=count($vehicletypecars);
    return view('cars.searchresult',compact('currcount','offset','flag','passengercapacity','subcategory','vehicletypecars','year','make','model'));



}


public function searchfilter2actsort(Request $request){
    //dd("en");
    /*Ajax Search-Large Filter*/
    $year=$request->year;
    //dd($year);
    $make=$request->carmake;
    $model=$request->carmodel;
    $fueltype=$request->carfueltype;
    //dd($fueltype);
    $passengercapacity=$request->carpassengercapacity;
    //dd($passengercapacity);
    $priceflag=$request->priceflag;
$subcategory = Subcategory::orderBy('sort_order')->where('status',1)
        ->get(); 
$offset=0;
//dd($year,$make,$model,$fueltype,$passengercapacity,$priceflag);
$query = Ads::select("ads.*","ads.canonical_name as mainid","subcategories.*",'motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename",'places.name as placename','countries.name as countryname')->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("subcategories","ads.subcategory_id","=","subcategories.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->leftjoin("places","places.id","=","ads.place")->leftjoin("countries","countries.id","=","ads.country_id");
//dd(count($year));
//dd($year);
//if ($year!=''){
if (($year[0]!=null)){
   //echo "year";
//dd();
$query->whereIn('registration_year',$year);
}
//if ($make!=''){
if ($make[0]!=null){
$query->whereIn('motor_custome_values.make_id',$make);
}
//if ($model!=''){
if ($model[0]!=null){
$query->whereIn('motor_custome_values.model_id',$model);
}
if ($fueltype[0]!=null){
//if ($fueltype!=''){
$query->whereIn('motor_custome_values.fuel_type',$fueltype);
}
if ($passengercapacity[0]!=null){
//if ($passengercapacity!=''){
//$query->whereIn('ads.seats',$passengercapacity);
    //$pc=explode(",",$passengercapacity);
$query->whereIn('ads.seats',$passengercapacity);
    //$query->whereIn('ads.seats',$pc);
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

if ($_GET['kw']!=''){
    $kw=$_GET['kw'];
    $keywordsearch=$kw;
    $query->where("make_msts.name",'like',"%$keywordsearch%")->orwhere("motor_custome_values.registration_year",$keywordsearch)->orwhere("model_msts.name",'like',"%$keywordsearch%")->orwhere('motor_custome_values.fuel_type','like',"%$keywordsearch%");
}
//DB::enableQueryLog();
$sortype=$_GET['sortcombo'];
    if ($sortype=='Date'){
$vehicletypecars=$query->orderby('registration_year')->skip($offset)->take(10)->get();
}else{
    $vehicletypecars=$query->orderby('price')->skip($offset)->take(10)->get();
}
//$quries = DB::getQueryLog();
//dd($quries);
if (($year==null)&&($make==null)&&($model==null)&&($fueltype==null)&&($passengercapacity==null)&&$priceflag==0 &&($request->searchall=='')){
    $vehicletypecars=array();
}

$sqlQuery = "select distinct registration_year from motor_custome_values order by registration_year limit 0,4";
$year = DB::select(DB::raw($sqlQuery));

$sqlQuery = "select distinct make_id,name from motor_custome_values m join make_msts ma on m.make_id=ma.id order by name limit 0,4";
$make = DB::select(DB::raw($sqlQuery));

$sqlQuery = "select distinct model_id,name from motor_custome_values m join model_msts ma on m.model_id=ma.id order by name limit 0,4";
$model = DB::select(DB::raw($sqlQuery));
$sqlQuery = "select distinct seats from ads order by seats limit 0,4";
$passengercapacity = DB::select(DB::raw($sqlQuery));

$flag=3;
//$offset=0;
$currcount=count($vehicletypecars);
    return view('cars.searchresult',compact('currcount','offset','flag','passengercapacity','subcategory','vehicletypecars','year','make','model'));



}



public function searchfilter2sort(Request $request){
    //dd("en");
    /*Ajax Search-Large Filter*/
    $year=$request->year;
    //dd($year);
    $make=$request->carmake;
    $model=$request->carmodel;
    $fueltype=$request->carfueltype;
    //dd($fueltype);
    $passengercapacity=$request->carpassengercapacity;
    //dd($passengercapacity);
    $priceflag=$request->priceflag;
$subcategory = Subcategory::orderBy('sort_order')->where('status',1)
        ->get(); 
$offset=$_GET['offset']+10;
//dd($year,$make,$model,$fueltype,$passengercapacity,$priceflag);
$query = Ads::select("ads.*","ads.canonical_name as mainid","subcategories.*",'motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename",'places.name as placename','countries.name as countryname')->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("subcategories","ads.subcategory_id","=","subcategories.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->leftjoin("places","places.id","=","ads.place")->leftjoin("countries","countries.id","=","ads.country_id");

if (isset($year)&&($year[0]!=null)){
   //echo "year";
//dd();
$query->whereIn('registration_year',$year);
}
//if ($make!=''){
if ($make[0]!=null){
$query->whereIn('motor_custome_values.make_id',$make);
}
//if ($model!=''){
if ($model[0]!=null){
$query->whereIn('motor_custome_values.model_id',$model);
}
if ($fueltype[0]!=null){
//if ($fueltype!=''){
$query->whereIn('motor_custome_values.fuel_type',$fueltype);
}
if ($passengercapacity[0]!=null){

$query->whereIn('ads.seats',$passengercapacity);
    //$query->whereIn('ads.seats',$pc);
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
//if ($request->searchall!=''){
if ($_GET['kw']!=''){
    $kw=$_GET['kw'];
    $keywordsearch=$kw;
    $query->where("make_msts.name",'like',"%$keywordsearch%")->orwhere("motor_custome_values.registration_year",$keywordsearch)->orwhere("model_msts.name",'like',"%$keywordsearch%")->orwhere('motor_custome_values.fuel_type','like',"%$keywordsearch%");
}
//DB::enableQueryLog();
$vehicletypecars=$query->skip($offset)->take(10)->get();
//$quries = DB::getQueryLog();
//dd($quries);
if (($year==null)&&($make==null)&&($model==null)&&($fueltype==null)&&($passengercapacity==null)&&$priceflag==0 &&($request->searchall=='')){
    $vehicletypecars=array();
}
/*if (($year==null)and($make=null)){
    dd("enter");
$vehicletypecars=array();

}*/
$sqlQuery = "select distinct registration_year from motor_custome_values order by registration_year limit 0,4";
$year = DB::select(DB::raw($sqlQuery));

$sqlQuery = "select distinct make_id,name from motor_custome_values m join make_msts ma on m.make_id=ma.id order by name limit 0,4";
$make = DB::select(DB::raw($sqlQuery));

$sqlQuery = "select distinct model_id,name from motor_custome_values m join model_msts ma on m.model_id=ma.id order by name limit 0,4";
$model = DB::select(DB::raw($sqlQuery));
$sqlQuery = "select distinct seats from ads order by seats limit 0,4";
$passengercapacity = DB::select(DB::raw($sqlQuery));

$flag=3;
//$offset=0;
$currcount=count($vehicletypecars);
    return view('cars.searchresult',compact('currcount','offset','flag','passengercapacity','subcategory','vehicletypecars','year','make','model'));



}


public function searchtextboxcount(){
$keywordsearch=$_GET['val'];
    //echo $keyword;
$vehicletypecarscount = Ads::select("ads.*","ads.canonical_name as mainid","vehicletype.*",'motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("vehicletype","ads.vehicletype","=","vehicletype.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->where("make_msts.name",'like',"%$keywordsearch%")->orwhere("motor_custome_values.registration_year",$keywordsearch)->orwhere("model_msts.name",'like',"%$keywordsearch%")->orwhere('motor_custome_values.fuel_type','like',"%$keywordsearch%")->count();
echo $vehicletypecarscount;


}

public function searchtextbox(){

    $keywordsearch=$_GET['val'];
    //dd($keywordsearch);
    //echo $keyword;
    
/*$vehicletypecars = Ads::select("ads.*","ads.canonical_name as mainid","vehicletype.*","adm.*",'adm.vehicletype as type1','motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename")->leftjoin("ads_images as adm","ads.id","=","adm.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("vehicletype","ads.vehicletype","=","vehicletype.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->where("adm.vehicletype",1)->where("make_msts.name",'like',"%$keywordsearch%")->orwhere("motor_custome_values.registration_year",$keywordsearch)->orwhere("model_msts.name",'like',"%$keywordsearch%")->orwhere('motor_custome_values.fuel_type','like',"%$keywordsearch%")->skip(0)->take(10)->get();*/

$vehicletypecars = Ads::select("ads.*","ads.canonical_name as mainid","vehicletype.*",'motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename",'places.name as placename','countries.name as countryname')->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("vehicletype","ads.vehicletype","=","vehicletype.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->leftjoin("places","places.id","=","ads.place")->leftjoin("countries","countries.id","=","ads.country_id")->where("make_msts.name",'like',"%$keywordsearch%")->orwhere("motor_custome_values.registration_year",$keywordsearch)->orwhere("model_msts.name",'like',"%$keywordsearch%")->orwhere('motor_custome_values.fuel_type','like',"%$keywordsearch%")->skip(0)->take(10)->get();
/*DB::enableQueryLog();
$sqlQuery="select `ads`.*, `ads`.`canonical_name` as `mainid`, `vehicletype`.*, `adm`.*, `adm`.`vehicletype` as `type1`, `motor_custome_values`.*, `model_msts`.`name` as `modelname`, `make_msts`.`name` as `makename` from `ads`  join `ads_images` as `adm` on `ads`.`id` = `adm`.`ads_id` left join `motor_custome_values` on `ads`.`id` = `motor_custome_values`.`ads_id`  join `vehicletype` on `ads`.`vehicletype` = `vehicletype`.`id` join `model_msts` on `motor_custome_values`.`model_id` = `model_msts`.`id` join `make_msts` on `motor_custome_values`.`make_id` = `make_msts`.`id` where `adm`.`vehicletype` =1 and `make_msts`.`name` like '%$keywordsearch%' or `motor_custome_values`.`registration_year` = '$keywordsearch' or `model_msts`.`name` like '%$keywordsearch%' or `motor_custome_values`.`fuel_type` like '%$keywordsearch%' group by mainid limit 10 offset 0";*/

//$vehicletypecars=DB::select(DB::raw($sqlQuery));
//dd();
//$quries = DB::getQueryLog();
//dd($quries);

//$make = DB::select(DB::raw($sqlQuery));

$vehicletypecarscount=0;

if ($keywordsearch==''){
    $vehicletypecarscount=0;
    $vehicletypecars=array();
}

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
        $currcount=count($vehicletypecars);
    return view('cars.searchresult',compact('currcount','flag','offset','passengercapacity','subcategory','vehicletypecars','year','make','model','vehicletypecarscount'));




}

public function searchtextboxnext(){

    $keywordsearch=$_GET['val'];
    
    $offset=$_GET['offset']+10;

$vehicletypecars = Ads::select("ads.*","ads.canonical_name as mainid","vehicletype.*","adm.*",'adm.vehicletype as type1','motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename")->leftjoin("ads_images as adm","ads.id","=","adm.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("vehicletype","ads.vehicletype","=","vehicletype.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->where("adm.vehicletype",1)->where("make_msts.name",'like',"%$keywordsearch%")->orwhere("motor_custome_values.registration_year",$keywordsearch)->orwhere("model_msts.name",'like',"%$keywordsearch%")->orwhere('motor_custome_values.fuel_type','like',"%$keywordsearch%")->skip($offset)->take(10)->get();




$vehicletypecarscount1 = Ads::select("ads.*","ads.canonical_name as mainid","vehicletype.*","adm.*",'adm.vehicletype as type1','motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename")->leftjoin("ads_images as adm","ads.id","=","adm.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("vehicletype","ads.vehicletype","=","vehicletype.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->where("adm.vehicletype",1)->where("motor_custome_values.registration_year",$keywordsearch)->orwhere("make_msts.name",'like',"%$keywordsearch%")->orwhere("model_msts.name",'like',"%$keywordsearch%")->orwhere('motor_custome_values.fuel_type','like',"%$keywordsearch%")->get();

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
      $currcount=count($vehicletypecars);
    return view('cars.searchresult',compact('currcount','flag','offset','passengercapacity','subcategory','vehicletypecars','year','make','model','vehicletypecarscount'));




}

























public function searchtextboxnextsort(){
$keywordsearch=$_GET['kw'];
    //$keywordsearch=$_GET['val'];
    //$offset=$_GET['val1']+2;
    //dd($offset);
    //echo $keyword;
    $offset=$_GET['offset']+10;
    $sortype=$_GET['sortcombo'];
    if ($sortype=='Date'){
$vehicletypecars = Ads::select("ads.*","ads.canonical_name as mainid","vehicletype.*","adm.*",'adm.vehicletype as type1','motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename")->leftjoin("ads_images as adm","ads.id","=","adm.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("vehicletype","ads.vehicletype","=","vehicletype.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->where("adm.vehicletype",1)->where("motor_custome_values.registration_year",$keywordsearch)->orwhere("make_msts.name",'like',"%$keywordsearch%")->orwhere("model_msts.name",'like',"%$keywordsearch%")->orwhere('motor_custome_values.fuel_type','like',"%$keywordsearch%")->orderby('registration_year')->skip($offset)->take(10)->get();




$vehicletypecarscount1 = Ads::select("ads.*","ads.canonical_name as mainid","vehicletype.*","adm.*",'adm.vehicletype as type1','motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename")->leftjoin("ads_images as adm","ads.id","=","adm.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("vehicletype","ads.vehicletype","=","vehicletype.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->where("adm.vehicletype",1)->where("motor_custome_values.registration_year",$keywordsearch)->orwhere("make_msts.name",'like',"%$keywordsearch%")->orwhere("model_msts.name",'like',"%$keywordsearch%")->orwhere('motor_custome_values.fuel_type','like',"%$keywordsearch%")->get();
}else{

$vehicletypecars = Ads::select("ads.*","ads.canonical_name as mainid","vehicletype.*","adm.*",'adm.vehicletype as type1','motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename")->leftjoin("ads_images as adm","ads.id","=","adm.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("vehicletype","ads.vehicletype","=","vehicletype.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->where("adm.vehicletype",1)->where("motor_custome_values.registration_year",$keywordsearch)->orwhere("make_msts.name",'like',"%$keywordsearch%")->orwhere("model_msts.name",'like',"%$keywordsearch%")->orwhere('motor_custome_values.fuel_type','like',"%$keywordsearch%")->orderby('price')->skip($offset)->take(10)->get();




$vehicletypecarscount1 = Ads::select("ads.*","ads.canonical_name as mainid","vehicletype.*","adm.*",'adm.vehicletype as type1','motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename")->leftjoin("ads_images as adm","ads.id","=","adm.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("vehicletype","ads.vehicletype","=","vehicletype.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->where("adm.vehicletype",1)->where("motor_custome_values.registration_year",$keywordsearch)->orwhere("make_msts.name",'like',"%$keywordsearch%")->orwhere("model_msts.name",'like',"%$keywordsearch%")->orwhere('motor_custome_values.fuel_type','like',"%$keywordsearch%")->get();






}

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


public function searchtextboxfirstcount(){

    $keywordsearch=$_GET['val'];
    //echo $keyword;
    
    DB::enableQueryLog();

    $vehicletypecarscount = Ads::select("ads.*","ads.canonical_name as mainid","vehicletype.*","adm.*",'motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("vehicletype","ads.vehicletype","=","vehicletype.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->where("make_msts.name",'like',"%$keywordsearch%")->orwhere("motor_custome_values.registration_year",$keywordsearch)->orwhere("model_msts.name",'like',"%$keywordsearch%")->orwhere('motor_custome_values.fuel_type','like',"%$keywordsearch%")->count();
    echo $vehicletypecarscount;

}




public function searchtextboxfirst(){

    $keywordsearch=$_GET['val'];
    //echo $keyword;
    
    DB::enableQueryLog();

    /*$vehicletypecars = Ads::select("ads.*","ads.canonical_name as mainid","vehicletype.*","adm.*",'adm.vehicletype as type1','motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename")->leftjoin("ads_images as adm","ads.id","=","adm.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("vehicletype","ads.vehicletype","=","vehicletype.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->where("adm.vehicletype",1)->where("make_msts.name",'like',"%$keywordsearch%")->orwhere("motor_custome_values.registration_year",$keywordsearch)->orwhere("model_msts.name",'like',"%$keywordsearch%")->orwhere('motor_custome_values.fuel_type','like',"%$keywordsearch%")->skip(0)->take(10)->get();*/
    $vehicletypecars = Ads::select("ads.*","ads.canonical_name as mainid","vehicletype.*",'motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename",'places.name as placename','countries.name as countryname')->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("vehicletype","ads.vehicletype","=","vehicletype.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->leftjoin("places","places.id","=","ads.place")->leftjoin("countries","countries.id","=","ads.country_id")->where("make_msts.name",'like',"%$keywordsearch%")->orwhere("motor_custome_values.registration_year",$keywordsearch)->orwhere("model_msts.name",'like',"%$keywordsearch%")->orwhere('motor_custome_values.fuel_type','like',"%$keywordsearch%")->skip(0)->take(10)->get();
$quries = DB::getQueryLog();
//dd($quries);

$vehicletypecarscount = Ads::select("ads.*","ads.canonical_name as mainid","vehicletype.*","adm.*",'adm.vehicletype as type1','motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename")->leftjoin("ads_images as adm","ads.id","=","adm.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("vehicletype","ads.vehicletype","=","vehicletype.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->where("adm.vehicletype",1)->where("motor_custome_values.registration_year",$keywordsearch)->orwhere("make_msts.name",'like',"%$keywordsearch%")->orwhere("model_msts.name",'like',"%$keywordsearch%")->orwhere('motor_custome_values.fuel_type','like',"%$keywordsearch%")->count();

if ($keywordsearch==''){
    $vehicletypecarscount=0;
    $vehicletypecars=array();
}


$sqlQuery = "select distinct registration_year from motor_custome_values order by registration_year limit 0,4";
$year = DB::select(DB::raw($sqlQuery));

$sqlQuery = "select distinct make_id,name from motor_custome_values m join make_msts ma on m.make_id=ma.id order by name limit 0,4";
$make = DB::select(DB::raw($sqlQuery));

$sqlQuery = "select distinct model_id,name from motor_custome_values m join model_msts ma on m.model_id=ma.id order by name limit 0,4";
$model = DB::select(DB::raw($sqlQuery));
$sqlQuery = "select distinct seats from ads order by seats limit 0,4";
$passengercapacity = DB::select(DB::raw($sqlQuery));

$subcategory = Subcategory::orderBy('sort_order')->where('status',1)
        ->get(); 
        //$vehicletypecarscount=count($vehicletypecarscount1);
$flag=2;
$currcount=count($vehicletypecars);
$offset=0;
    return view('cars.searchresult',compact('currcount','flag','passengercapacity','subcategory','vehicletypecars','year','make','model','offset','vehicletypecarscount'));




}
















public function searchtextboxfirstnext(){

    $keywordsearch=$_GET['val'];
    //echo $keyword;
     //$offset=$_GET['val1']+2;
   $offset=$_GET['offset']+10;
   //DB::enableQueryLog();
/*$vehicletypecars = Ads::select("ads.*","ads.canonical_name as mainid","vehicletype.*","adm.*",'adm.vehicletype as type1','motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename")->leftjoin("ads_images as adm","ads.id","=","adm.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("vehicletype","ads.vehicletype","=","vehicletype.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->where("adm.vehicletype",1)->where("make_msts.name",'like',"%$keywordsearch%")->orwhere("motor_custome_values.registration_year",$keywordsearch)->orwhere("model_msts.name",'like',"%$keywordsearch%")->orwhere('motor_custome_values.fuel_type','like',"%$keywordsearch%")->skip($offset)->take(10)->get();*/
$vehicletypecars = Ads::select("ads.*","ads.canonical_name as mainid","vehicletype.*",'motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename",'places.name as placename','countries.name as countryname')->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("vehicletype","ads.vehicletype","=","vehicletype.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->leftjoin("places","places.id","=","ads.place")->leftjoin("countries","countries.id","=","ads.country_id")->where("make_msts.name",'like',"%$keywordsearch%")->orwhere("motor_custome_values.registration_year",$keywordsearch)->orwhere("model_msts.name",'like',"%$keywordsearch%")->orwhere('motor_custome_values.fuel_type','like',"%$keywordsearch%")->skip($offset)->take(10)->get();
//$quries = DB::getQueryLog();
//dd($quries);

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
$currcount=count($vehicletypecars);
    return view('cars.searchresult',compact('currcount','flag','passengercapacity','subcategory','vehicletypecars','year','make','model','offset','vehicletypecarscount'));




}


public function searchtextboxfirstnextsort(){
$sortype=$_GET['sortcombo'];
    $keywordsearch=$_GET['val'];
    //echo $keyword;
     $offset=$_GET['val1']+10;
     if ($sortype=='Date'){
$vehicletypecars = Ads::select("ads.*","ads.canonical_name as mainid","vehicletype.*","adm.*",'adm.vehicletype as type1','motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename")->leftjoin("ads_images as adm","ads.id","=","adm.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("vehicletype","ads.vehicletype","=","vehicletype.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->where("adm.vehicletype",1)->where("motor_custome_values.registration_year",$keywordsearch)->orwhere("make_msts.name",'like',"%$keywordsearch%")->orwhere("model_msts.name",'like',"%$keywordsearch%")->orwhere('motor_custome_values.fuel_type','like',"%$keywordsearch%")->orderby('registration_year')->skip($offset)->take(10)->get();


$vehicletypecarscount = Ads::select("ads.*","ads.canonical_name as mainid","vehicletype.*","adm.*",'adm.vehicletype as type1','motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename")->leftjoin("ads_images as adm","ads.id","=","adm.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("vehicletype","ads.vehicletype","=","vehicletype.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->where("adm.vehicletype",1)->where("motor_custome_values.registration_year",$keywordsearch)->orwhere("make_msts.name",'like',"%$keywordsearch%")->orwhere("model_msts.name",'like',"%$keywordsearch%")->orwhere('motor_custome_values.fuel_type','like',"%$keywordsearch%")->count();

}else{
    $vehicletypecars = Ads::select("ads.*","ads.canonical_name as mainid","vehicletype.*","adm.*",'adm.vehicletype as type1','motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename")->leftjoin("ads_images as adm","ads.id","=","adm.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("vehicletype","ads.vehicletype","=","vehicletype.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->where("adm.vehicletype",1)->where("motor_custome_values.registration_year",$keywordsearch)->orwhere("make_msts.name",'like',"%$keywordsearch%")->orwhere("model_msts.name",'like',"%$keywordsearch%")->orwhere('motor_custome_values.fuel_type','like',"%$keywordsearch%")->orderby('price')->skip($offset)->take(10)->get();


$vehicletypecarscount = Ads::select("ads.*","ads.canonical_name as mainid","vehicletype.*","adm.*",'adm.vehicletype as type1','motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename")->leftjoin("ads_images as adm","ads.id","=","adm.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("vehicletype","ads.vehicletype","=","vehicletype.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->where("adm.vehicletype",1)->where("motor_custome_values.registration_year",$keywordsearch)->orwhere("make_msts.name",'like',"%$keywordsearch%")->orwhere("model_msts.name",'like',"%$keywordsearch%")->orwhere('motor_custome_values.fuel_type','like',"%$keywordsearch%")->count();
}


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

public function searchtextboxsort(){
    $sortype=$_GET['sortcombo'];
    //$keywordsearch=$_GET['val'];
    //echo $keyword;
    $offset=0;
    $keywordsearch=$_GET['kw'];
   //dd($sortype,$keywordsearch);
     if ($sortype=='Date'){
/*$vehicletypecars = Ads::select("ads.*","ads.canonical_name as mainid","vehicletype.*","adm.*",'adm.vehicletype as type1','motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename")->leftjoin("ads_images as adm","ads.id","=","adm.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("vehicletype","ads.vehicletype","=","vehicletype.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->where("adm.vehicletype",1)->where("make_msts.name",'like',"%$keywordsearch%")->orwhere("motor_custome_values.registration_year",$keywordsearch)->orwhere("model_msts.name",'like',"%$keywordsearch%")->orwhere('motor_custome_values.fuel_type','like',"%$keywordsearch%")->orderby('registration_year')->skip($offset)->take(10)->get();*/
/*$vehicletypecars = Ads::select("ads.*","ads.canonical_name as mainid","vehicletype.*","adm.*",'adm.vehicletype as type1','motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename")->leftjoin("ads_images as adm","ads.id","=","adm.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("vehicletype","ads.vehicletype","=","vehicletype.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->where("adm.vehicletype",1)->where("make_msts.name",'like',"%$keywordsearch%")->orwhere("motor_custome_values.registration_year",$keywordsearch)->orwhere("model_msts.name",'like',"%$keywordsearch%")->orwhere('motor_custome_values.fuel_type','like',"%$keywordsearch%")->skip(0)->take(10)->orderby('registration_year')->get();*/
$vehicletypecars = Ads::select("ads.*","ads.canonical_name as mainid","vehicletype.*",'motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename",'places.name as placename','countries.name as countryname')->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("vehicletype","ads.vehicletype","=","vehicletype.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->leftjoin("places","places.id","=","ads.place")->leftjoin("countries","countries.id","=","ads.country_id")->where("make_msts.name",'like',"%$keywordsearch%")->orwhere("motor_custome_values.registration_year",$keywordsearch)->orwhere("model_msts.name",'like',"%$keywordsearch%")->orwhere('motor_custome_values.fuel_type','like',"%$keywordsearch%")->skip(0)->take(10)->orderby('registration_year')->get();

$vehicletypecarscount = Ads::select("ads.*","ads.canonical_name as mainid","vehicletype.*","adm.*",'adm.vehicletype as type1','motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename")->leftjoin("ads_images as adm","ads.id","=","adm.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("vehicletype","ads.vehicletype","=","vehicletype.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->where("adm.vehicletype",1)->where("motor_custome_values.registration_year",$keywordsearch)->orwhere("make_msts.name",'like',"%$keywordsearch%")->orwhere("model_msts.name",'like',"%$keywordsearch%")->orwhere('motor_custome_values.fuel_type','like',"%$keywordsearch%")->count();

}else{
    /*$vehicletypecars = Ads::select("ads.*","ads.canonical_name as mainid","vehicletype.*","adm.*",'adm.vehicletype as type1','motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename")->leftjoin("ads_images as adm","ads.id","=","adm.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("vehicletype","ads.vehicletype","=","vehicletype.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->where("adm.vehicletype",1)->where("make_msts.name",'like',"%$keywordsearch%")->orwhere("motor_custome_values.registration_year",$keywordsearch)->orwhere("model_msts.name",'like',"%$keywordsearch%")->orwhere('motor_custome_values.fuel_type','like',"%$keywordsearch%")->orderby('price')->skip($offset)->take(10)->get();*/
    /*$vehicletypecars = Ads::select("ads.*","ads.canonical_name as mainid","vehicletype.*","adm.*",'adm.vehicletype as type1','motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename")->leftjoin("ads_images as adm","ads.id","=","adm.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("vehicletype","ads.vehicletype","=","vehicletype.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->where("adm.vehicletype",1)->where("make_msts.name",'like',"%$keywordsearch%")->orwhere("motor_custome_values.registration_year",$keywordsearch)->orwhere("model_msts.name",'like',"%$keywordsearch%")->orwhere('motor_custome_values.fuel_type','like',"%$keywordsearch%")->skip(0)->take(10)->orderby('price')->get();*/
$vehicletypecars = Ads::select("ads.*","ads.canonical_name as mainid","vehicletype.*",'motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename",'places.name as placename','countries.name as countryname')->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("vehicletype","ads.vehicletype","=","vehicletype.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->leftjoin("places","places.id","=","ads.place")->leftjoin("countries","countries.id","=","ads.country_id")->where("make_msts.name",'like',"%$keywordsearch%")->orwhere("motor_custome_values.registration_year",$keywordsearch)->orwhere("model_msts.name",'like',"%$keywordsearch%")->orwhere('motor_custome_values.fuel_type','like',"%$keywordsearch%")->skip(0)->take(10)->orderby('price')->get();

$vehicletypecarscount = Ads::select("ads.*","ads.canonical_name as mainid","vehicletype.*","adm.*",'adm.vehicletype as type1','motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename")->leftjoin("ads_images as adm","ads.id","=","adm.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("vehicletype","ads.vehicletype","=","vehicletype.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->where("adm.vehicletype",1)->where("motor_custome_values.registration_year",$keywordsearch)->orwhere("make_msts.name",'like',"%$keywordsearch%")->orwhere("model_msts.name",'like',"%$keywordsearch%")->orwhere('motor_custome_values.fuel_type','like',"%$keywordsearch%")->count();
}
//dd($vehicletypecars,$vehicletypecarscount);

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
$flag=1;
$currcount=count($vehicletypecars);
    return view('cars.searchresult',compact('currcount','flag','passengercapacity','subcategory','vehicletypecars','year','make','model','offset','vehicletypecarscount'));


}

public function searchtextboxsortnext(){
    $sortype=$_GET['sortcombo'];
    //$keywordsearch=$_GET['val'];
    //echo $keyword;
    $offset=$_GET['offset']+10;
    $keywordsearch=$_GET['kw'];
   //dd($sortype,$keywordsearch);
     if ($sortype=='Date'){
/*$vehicletypecars = Ads::select("ads.*","ads.canonical_name as mainid","vehicletype.*","adm.*",'adm.vehicletype as type1','motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename")->leftjoin("ads_images as adm","ads.id","=","adm.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("vehicletype","ads.vehicletype","=","vehicletype.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->where("adm.vehicletype",1)->where("make_msts.name",'like',"%$keywordsearch%")->orwhere("motor_custome_values.registration_year",$keywordsearch)->orwhere("model_msts.name",'like',"%$keywordsearch%")->orwhere('motor_custome_values.fuel_type','like',"%$keywordsearch%")->orderby('registration_year')->skip($offset)->take(10)->get();*/
/*$vehicletypecars = Ads::select("ads.*","ads.canonical_name as mainid","vehicletype.*","adm.*",'adm.vehicletype as type1','motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename")->leftjoin("ads_images as adm","ads.id","=","adm.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("vehicletype","ads.vehicletype","=","vehicletype.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->where("adm.vehicletype",1)->where("make_msts.name",'like',"%$keywordsearch%")->orwhere("motor_custome_values.registration_year",$keywordsearch)->orwhere("model_msts.name",'like',"%$keywordsearch%")->orwhere('motor_custome_values.fuel_type','like',"%$keywordsearch%")->skip($offset)->take(10)->orderby('registration_year')->get();*/
$vehicletypecars = Ads::select("ads.*","ads.canonical_name as mainid","vehicletype.*",'motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename",'places.name as placename','countries.name as countryname')->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("vehicletype","ads.vehicletype","=","vehicletype.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->leftjoin("places","places.id","=","ads.place")->leftjoin("countries","countries.id","=","ads.country_id")->where("make_msts.name",'like',"%$keywordsearch%")->orwhere("motor_custome_values.registration_year",$keywordsearch)->orwhere("model_msts.name",'like',"%$keywordsearch%")->orwhere('motor_custome_values.fuel_type','like',"%$keywordsearch%")->skip($offset)->take(10)->orderby('registration_year')->get();
$vehicletypecarscount = Ads::select("ads.*","ads.canonical_name as mainid","vehicletype.*","adm.*",'adm.vehicletype as type1','motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename")->leftjoin("ads_images as adm","ads.id","=","adm.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("vehicletype","ads.vehicletype","=","vehicletype.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->where("adm.vehicletype",1)->where("motor_custome_values.registration_year",$keywordsearch)->orwhere("make_msts.name",'like',"%$keywordsearch%")->orwhere("model_msts.name",'like',"%$keywordsearch%")->orwhere('motor_custome_values.fuel_type','like',"%$keywordsearch%")->count();

}else{
    /*$vehicletypecars = Ads::select("ads.*","ads.canonical_name as mainid","vehicletype.*","adm.*",'adm.vehicletype as type1','motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename")->leftjoin("ads_images as adm","ads.id","=","adm.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("vehicletype","ads.vehicletype","=","vehicletype.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->where("adm.vehicletype",1)->where("make_msts.name",'like',"%$keywordsearch%")->orwhere("motor_custome_values.registration_year",$keywordsearch)->orwhere("model_msts.name",'like',"%$keywordsearch%")->orwhere('motor_custome_values.fuel_type','like',"%$keywordsearch%")->orderby('price')->skip($offset)->take(10)->get();*/
    /*$vehicletypecars = Ads::select("ads.*","ads.canonical_name as mainid","vehicletype.*","adm.*",'adm.vehicletype as type1','motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename")->leftjoin("ads_images as adm","ads.id","=","adm.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("vehicletype","ads.vehicletype","=","vehicletype.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->where("adm.vehicletype",1)->where("make_msts.name",'like',"%$keywordsearch%")->orwhere("motor_custome_values.registration_year",$keywordsearch)->orwhere("model_msts.name",'like',"%$keywordsearch%")->orwhere('motor_custome_values.fuel_type','like',"%$keywordsearch%")->skip($offset)->take(10)->orderby('price')->get();*/
$vehicletypecars = Ads::select("ads.*","ads.canonical_name as mainid","vehicletype.*",'motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename",'places.name as placename','countries.name as countryname')->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("vehicletype","ads.vehicletype","=","vehicletype.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->leftjoin("places","places.id","=","ads.place")->leftjoin("countries","countries.id","=","ads.country_id")->where("make_msts.name",'like',"%$keywordsearch%")->orwhere("motor_custome_values.registration_year",$keywordsearch)->orwhere("model_msts.name",'like',"%$keywordsearch%")->orwhere('motor_custome_values.fuel_type','like',"%$keywordsearch%")->skip($offset)->take(10)->orderby('price')->get();

$vehicletypecarscount = Ads::select("ads.*","ads.canonical_name as mainid","vehicletype.*","adm.*",'adm.vehicletype as type1','motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename")->leftjoin("ads_images as adm","ads.id","=","adm.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("vehicletype","ads.vehicletype","=","vehicletype.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->where("adm.vehicletype",1)->where("motor_custome_values.registration_year",$keywordsearch)->orwhere("make_msts.name",'like',"%$keywordsearch%")->orwhere("model_msts.name",'like',"%$keywordsearch%")->orwhere('motor_custome_values.fuel_type','like',"%$keywordsearch%")->count();
}
//dd($vehicletypecars,$vehicletypecarscount);

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
$flag=1;
$currcount=count($vehicletypecars);
    return view('cars.searchresult',compact('currcount','flag','passengercapacity','subcategory','vehicletypecars','year','make','model','offset','vehicletypecarscount'));


}








public function searchtextboxfirstsort(){
$sortype=$_GET['sortcombo'];
    //$keywordsearch=$_GET['val'];
    //echo $keyword;
    $offset=0;
    $keywordsearch=$_GET['kw'];
   //dd($sortype,$keywordsearch);
     if ($sortype=='Date'){
/*$vehicletypecars = Ads::select("ads.*","ads.canonical_name as mainid","vehicletype.*","adm.*",'adm.vehicletype as type1','motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename")->leftjoin("ads_images as adm","ads.id","=","adm.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("vehicletype","ads.vehicletype","=","vehicletype.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->where("adm.vehicletype",1)->where("make_msts.name",'like',"%$keywordsearch%")->orwhere("motor_custome_values.registration_year",$keywordsearch)->orwhere("model_msts.name",'like',"%$keywordsearch%")->orwhere('motor_custome_values.fuel_type','like',"%$keywordsearch%")->orderby('registration_year')->skip($offset)->take(10)->get();*/
/*$vehicletypecars = Ads::select("ads.*","ads.canonical_name as mainid","vehicletype.*","adm.*",'adm.vehicletype as type1','motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename")->leftjoin("ads_images as adm","ads.id","=","adm.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("vehicletype","ads.vehicletype","=","vehicletype.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->where("adm.vehicletype",1)->where("make_msts.name",'like',"%$keywordsearch%")->orwhere("motor_custome_values.registration_year",$keywordsearch)->orwhere("model_msts.name",'like',"%$keywordsearch%")->orwhere('motor_custome_values.fuel_type','like',"%$keywordsearch%")->skip(0)->take(10)->orderby('registration_year')->get();*/
$vehicletypecars = Ads::select("ads.*","ads.canonical_name as mainid","vehicletype.*",'motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename",'places.name as placename','countries.name as countryname')->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("vehicletype","ads.vehicletype","=","vehicletype.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->leftjoin("places","places.id","=","ads.place")->leftjoin("countries","countries.id","=","ads.country_id")->where("make_msts.name",'like',"%$keywordsearch%")->orwhere("motor_custome_values.registration_year",$keywordsearch)->orwhere("model_msts.name",'like',"%$keywordsearch%")->orwhere('motor_custome_values.fuel_type','like',"%$keywordsearch%")->skip(0)->take(10)->orderby('registration_year')->get();

$vehicletypecarscount = Ads::select("ads.*","ads.canonical_name as mainid","vehicletype.*","adm.*",'adm.vehicletype as type1','motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename")->leftjoin("ads_images as adm","ads.id","=","adm.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("vehicletype","ads.vehicletype","=","vehicletype.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->where("adm.vehicletype",1)->where("motor_custome_values.registration_year",$keywordsearch)->orwhere("make_msts.name",'like',"%$keywordsearch%")->orwhere("model_msts.name",'like',"%$keywordsearch%")->orwhere('motor_custome_values.fuel_type','like',"%$keywordsearch%")->count();

}else{
    /*$vehicletypecars = Ads::select("ads.*","ads.canonical_name as mainid","vehicletype.*","adm.*",'adm.vehicletype as type1','motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename")->leftjoin("ads_images as adm","ads.id","=","adm.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("vehicletype","ads.vehicletype","=","vehicletype.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->where("adm.vehicletype",1)->where("make_msts.name",'like',"%$keywordsearch%")->orwhere("motor_custome_values.registration_year",$keywordsearch)->orwhere("model_msts.name",'like',"%$keywordsearch%")->orwhere('motor_custome_values.fuel_type','like',"%$keywordsearch%")->orderby('price')->skip($offset)->take(10)->get();*/
   /* $vehicletypecars = Ads::select("ads.*","ads.canonical_name as mainid","vehicletype.*","adm.*",'adm.vehicletype as type1','motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename")->leftjoin("ads_images as adm","ads.id","=","adm.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("vehicletype","ads.vehicletype","=","vehicletype.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->where("adm.vehicletype",1)->where("make_msts.name",'like',"%$keywordsearch%")->orwhere("motor_custome_values.registration_year",$keywordsearch)->orwhere("model_msts.name",'like',"%$keywordsearch%")->orwhere('motor_custome_values.fuel_type','like',"%$keywordsearch%")->skip(0)->take(10)->orderby('price')->get();*/
   $vehicletypecars = Ads::select("ads.*","ads.canonical_name as mainid","vehicletype.*",'motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename",'places.name as placename','countries.name as countryname')->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("vehicletype","ads.vehicletype","=","vehicletype.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->leftjoin("places","places.id","=","ads.place")->leftjoin("countries","countries.id","=","ads.country_id")->where("make_msts.name",'like',"%$keywordsearch%")->orwhere("motor_custome_values.registration_year",$keywordsearch)->orwhere("model_msts.name",'like',"%$keywordsearch%")->orwhere('motor_custome_values.fuel_type','like',"%$keywordsearch%")->skip(0)->take(10)->orderby('price')->get();


$vehicletypecarscount = Ads::select("ads.*","ads.canonical_name as mainid","vehicletype.*","adm.*",'adm.vehicletype as type1','motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename")->leftjoin("ads_images as adm","ads.id","=","adm.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("vehicletype","ads.vehicletype","=","vehicletype.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->where("adm.vehicletype",1)->where("motor_custome_values.registration_year",$keywordsearch)->orwhere("make_msts.name",'like',"%$keywordsearch%")->orwhere("model_msts.name",'like',"%$keywordsearch%")->orwhere('motor_custome_values.fuel_type','like',"%$keywordsearch%")->count();
}
//dd($vehicletypecars,$vehicletypecarscount);

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
$currcount=count($vehicletypecars);
    return view('cars.searchresult',compact('currcount','flag','passengercapacity','subcategory','vehicletypecars','year','make','model','offset','vehicletypecarscount'));




}

public function searchtextboxfirstsortnext(){
$sortype=$_GET['sortcombo'];
    //$keywordsearch=$_GET['val'];
    //echo $keyword;
    $offset=$_GET['offset']+10;
    $keywordsearch=$_GET['kw'];
   //dd($sortype,$keywordsearch,$offset);
     if ($sortype=='Date'){
/*$vehicletypecars = Ads::select("ads.*","ads.canonical_name as mainid","vehicletype.*","adm.*",'adm.vehicletype as type1','motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename")->leftjoin("ads_images as adm","ads.id","=","adm.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("vehicletype","ads.vehicletype","=","vehicletype.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->where("adm.vehicletype",1)->where("make_msts.name",'like',"%$keywordsearch%")->orwhere("motor_custome_values.registration_year",$keywordsearch)->orwhere("model_msts.name",'like',"%$keywordsearch%")->orwhere('motor_custome_values.fuel_type','like',"%$keywordsearch%")->orderby('registration_year')->skip($offset)->take(10)->get();*/
$vehicletypecars = Ads::select("ads.*","ads.canonical_name as mainid","vehicletype.*",'motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename",'places.name as placename','countries.name as countryname')->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("vehicletype","ads.vehicletype","=","vehicletype.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->leftjoin("places","places.id","=","ads.place")->leftjoin("countries","countries.id","=","ads.country_id")->where("make_msts.name",'like',"%$keywordsearch%")->orwhere("motor_custome_values.registration_year",$keywordsearch)->orwhere("model_msts.name",'like',"%$keywordsearch%")->orwhere('motor_custome_values.fuel_type','like',"%$keywordsearch%")->skip($offset)->take(10)->orderby('registration_year')->get();

$vehicletypecarscount = Ads::select("ads.*","ads.canonical_name as mainid","vehicletype.*","adm.*",'adm.vehicletype as type1','motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename")->leftjoin("ads_images as adm","ads.id","=","adm.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("vehicletype","ads.vehicletype","=","vehicletype.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->where("adm.vehicletype",1)->where("motor_custome_values.registration_year",$keywordsearch)->orwhere("make_msts.name",'like',"%$keywordsearch%")->orwhere("model_msts.name",'like',"%$keywordsearch%")->orwhere('motor_custome_values.fuel_type','like',"%$keywordsearch%")->count();

}else{
    /*$vehicletypecars = Ads::select("ads.*","ads.canonical_name as mainid","vehicletype.*","adm.*",'adm.vehicletype as type1','motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename")->leftjoin("ads_images as adm","ads.id","=","adm.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("vehicletype","ads.vehicletype","=","vehicletype.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->where("adm.vehicletype",1)->where("make_msts.name",'like',"%$keywordsearch%")->orwhere("motor_custome_values.registration_year",$keywordsearch)->orwhere("model_msts.name",'like',"%$keywordsearch%")->orwhere('motor_custome_values.fuel_type','like',"%$keywordsearch%")->orderby('price')->skip($offset)->take(10)->get();*/
    $vehicletypecars = Ads::select("ads.*","ads.canonical_name as mainid","vehicletype.*","adm.*",'adm.vehicletype as type1','motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename")->leftjoin("ads_images as adm","ads.id","=","adm.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("vehicletype","ads.vehicletype","=","vehicletype.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->where("adm.vehicletype",1)->where("make_msts.name",'like',"%$keywordsearch%")->orwhere("motor_custome_values.registration_year",$keywordsearch)->orwhere("model_msts.name",'like',"%$keywordsearch%")->orwhere('motor_custome_values.fuel_type','like',"%$keywordsearch%")->skip($offset)->take(10)->orderby('price')->get();


$vehicletypecarscount = Ads::select("ads.*","ads.canonical_name as mainid","vehicletype.*","adm.*",'adm.vehicletype as type1','motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename")->leftjoin("ads_images as adm","ads.id","=","adm.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("vehicletype","ads.vehicletype","=","vehicletype.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->where("adm.vehicletype",1)->where("motor_custome_values.registration_year",$keywordsearch)->orwhere("make_msts.name",'like',"%$keywordsearch%")->orwhere("model_msts.name",'like',"%$keywordsearch%")->orwhere('motor_custome_values.fuel_type','like',"%$keywordsearch%")->count();
}
//dd($vehicletypecars,$vehicletypecarscount);

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
$currcount=count($vehicletypecars);
    return view('cars.searchresult',compact('currcount','flag','passengercapacity','subcategory','vehicletypecars','year','make','model','offset','vehicletypecarscount'));




}


public function carlistingsort(){
$cname=$_GET['val'];
$sortype=$_GET['val1'];
$subcategory = Subcategory::orderBy('sort_order')->where('status',1)
        ->get(); 
if ($sortype=='Date'){
if ($cname=='All'){
$vehicletypecars = Ads::select("ads.*","ads.canonical_name as mainid","subcategories.*",'motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename",'places.name as placename','countries.name as countryname')->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("subcategories","ads.subcategory_id","=","subcategories.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->leftjoin("places","places.id","=","ads.place")->leftjoin("countries","countries.id","=","ads.country_id")->orderby('registration_year')->skip(0)->take(10)->get();
}else{
       
$vehicletypecars = Ads::select("ads.*","ads.canonical_name as mainid","subcategories.*",'motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename",'places.name as placename','countries.name as countryname')->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("subcategories","ads.subcategory_id","=","subcategories.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->leftjoin("places","places.id","=","ads.place")->leftjoin("countries","countries.id","=","ads.country_id")->orderby('registration_year')->where('subcategories.canonical_name',$cname)->skip(0)->take(10)->get();


}}else{


if ($cname=='All'){
/*$vehicletypecars = Ads::select("ads.*","ads.canonical_name as mainid","subcategories.*","ads_images.*",'motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename")->leftjoin("ads_images","ads.id","=","ads_images.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("subcategories","ads.subcategory_id","=","subcategories.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->where("ads_images.vehicletype",1)->orderby('price')->skip(0)->take(10)->get();*/

$vehicletypecars = Ads::select("ads.*","ads.canonical_name as mainid","subcategories.*",'motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename",'places.name as placename','countries.name as countryname')->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("subcategories","ads.subcategory_id","=","subcategories.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->leftjoin("places","places.id","=","ads.place")->leftjoin("countries","countries.id","=","ads.country_id")->orderby('price')->skip(0)->take(10)->get();





}else{
       
/*$vehicletypecars = Ads::select("ads.*","ads.canonical_name as mainid","subcategories.*","ads_images.*",'motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename")->leftjoin("ads_images","ads.id","=","ads_images.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("subcategories","ads.subcategory_id","=","subcategories.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->where("ads_images.vehicletype",1)->orderby('price')->where('subcategories.canonical_name',$cname)->skip(0)->take(10)->get();*/
$vehicletypecars = Ads::select("ads.*","ads.canonical_name as mainid","subcategories.*",'motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename",'places.name as placename','countries.name as countryname')->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("subcategories","ads.subcategory_id","=","subcategories.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->leftjoin("places","places.id","=","ads.place")->leftjoin("countries","countries.id","=","ads.country_id")->where('subcategories.canonical_name',$cname)->orderby('price')->skip(0)->take(10)->get();

}

}
$sqlQuery = "select distinct registration_year from motor_custome_values order by registration_year limit 0,4";
$year = DB::select(DB::raw($sqlQuery));

$sqlQuery = "select distinct make_id,name from motor_custome_values m join make_msts ma on m.make_id=ma.id order by name limit 0,4";
$make = DB::select(DB::raw($sqlQuery));

$sqlQuery = "select distinct model_id,name from motor_custome_values m join model_msts ma on m.model_id=ma.id order by name limit 0,4";
$model = DB::select(DB::raw($sqlQuery));

$sqlQuery = "select distinct fuel_type from motor_custome_values order by fuel_type limit 0,4";
$fueltype = DB::select(DB::raw($sqlQuery));
$sqlQuery = "select distinct seats from ads order by seats limit 0,4";
$passengercapacity = DB::select(DB::raw($sqlQuery));
$sqlQuery = "select max(price) as price from ads";
$maxprice=  DB::select(DB::raw($sqlQuery));
$sqlQuery = "select min(price) as price from ads";
$minprice=  DB::select(DB::raw($sqlQuery)); 
$offset=2;
$flag=4;
$currcount=count($vehicletypecars);
return view('cars.searchresult',compact('currcount','flag','offset','passengercapacity','subcategory','vehicletypecars','year','make','model'));
  
}



public function carlistingsortnext(){
$cname=$_GET['cname'];
$sortype=$_GET['sortcombo'];
$offset=$_GET['offset']+10;
$subcategory = Subcategory::orderBy('sort_order')->where('status',1)
        ->get(); 
if ($sortype=='Date'){
if ($cname=='All'){
$vehicletypecars = Ads::select("ads.*","ads.canonical_name as mainid","subcategories.*","ads_images.*",'motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename")->leftjoin("ads_images","ads.id","=","ads_images.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("subcategories","ads.subcategory_id","=","subcategories.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->where("ads_images.vehicletype",1)->orderby('registration_year')->skip($offset)->take(10)->get();
}else{
       
$vehicletypecars = Ads::select("ads.*","ads.canonical_name as mainid","subcategories.*","ads_images.*",'motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename")->leftjoin("ads_images","ads.id","=","ads_images.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("subcategories","ads.subcategory_id","=","subcategories.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->where("ads_images.vehicletype",1)->orderby('registration_year')->where('subcategories.canonical_name',$cname)->skip($offset)->take(10)->get();


}}else{


if ($cname=='All'){
$vehicletypecars = Ads::select("ads.*","ads.canonical_name as mainid","subcategories.*","ads_images.*",'motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename")->leftjoin("ads_images","ads.id","=","ads_images.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("subcategories","ads.subcategory_id","=","subcategories.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->where("ads_images.vehicletype",1)->orderby('price')->skip($offset)->take(10)->get();
}else{
       
$vehicletypecars = Ads::select("ads.*","ads.canonical_name as mainid","subcategories.*","ads_images.*",'motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename")->leftjoin("ads_images","ads.id","=","ads_images.ads_id")->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("subcategories","ads.subcategory_id","=","subcategories.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->where("ads_images.vehicletype",1)->orderby('price')->where('subcategories.canonical_name',$cname)->skip($offset)->take(10)->get();


}

}
$sqlQuery = "select distinct registration_year from motor_custome_values order by registration_year limit 0,4";
$year = DB::select(DB::raw($sqlQuery));

$sqlQuery = "select distinct make_id,name from motor_custome_values m join make_msts ma on m.make_id=ma.id order by name limit 0,4";
$make = DB::select(DB::raw($sqlQuery));

$sqlQuery = "select distinct model_id,name from motor_custome_values m join model_msts ma on m.model_id=ma.id order by name limit 0,4";
$model = DB::select(DB::raw($sqlQuery));

$sqlQuery = "select distinct fuel_type from motor_custome_values order by fuel_type limit 0,4";
$fueltype = DB::select(DB::raw($sqlQuery));
$sqlQuery = "select distinct seats from ads order by seats limit 0,4";
$passengercapacity = DB::select(DB::raw($sqlQuery));
$sqlQuery = "select max(price) as price from ads";
$maxprice=  DB::select(DB::raw($sqlQuery));
$sqlQuery = "select min(price) as price from ads";
$minprice=  DB::select(DB::raw($sqlQuery));
$flag=4;
$currcount=count($vehicletypecars);
return view('cars.searchresult',compact('currcount','flag','offset','passengercapacity','subcategory','vehicletypecars','year','make','model'));  
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
