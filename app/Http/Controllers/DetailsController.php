<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\ContactUs;
//use Illuminate\Http\Request;
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
use App\Models\Subcategory;
use App\Models\Dynamiccontents;
use App\Models\User;
class DetailsController extends Controller
{
    //

public function cardetails(){
    return view('cars.details');  
}


public function carsearch(){
    return view('cars.carsearch');  
}

public function enquiryprocess(Request $request){
$contactus=new ContactUs();
$contactus->name=$request->fullname;
$contactus->email=$request->email;
//$subject=$request->subject;
$contactus->message=$request->message;
$contactus->phone=0;
$contactus->ads_id=$request->vehicleid;
if($contactus->save()){
return ["message"=>"failure","status"=>200,"text"=>"Your Enquiry Send Successfully"];
}else{
    return ["message"=>"failure","status"=>400,"text"=>"Sorry Enquiry not Send"];
}
}

public function carlisting1(Request $request,$id){
        $cname=$id;
        $subcategory = Subcategory::orderBy('sort_order')->where('status',1)
            ->get(); 
            
            $sortcombo=$request->sortcombo;
            //dd($request->flagajax,$request->sortcombo);
        $vehicletypecarscount =0;
        //dd($request->flagajax);
        if ($request->flagajax==1){
        $kw=$request->searchtextbox;
        $keywordsearch=$kw;
        $sortcombo=$request->sortcombo;
        //$cname="All";
        $cname=$id;
    
    
    if ($cname=='All'){
    $query = Ads::select("ads.*","ads.id as mainid1","ads.canonical_name as mainid","subcategories.*",'motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename",'places.name as placename','countries.name as countryname')->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("subcategories","ads.subcategory_id","=","subcategories.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->leftjoin("places","places.id","=","ads.place")->leftjoin("countries","countries.id","=","ads.country_id");
    
    if ($sortcombo=='Date'){
        if ($kw!=''){
        
$vehicletypecarscountall=$query->where("make_msts.name",'like',"%$keywordsearch%")->orwhere("motor_custome_values.registration_year",$keywordsearch)->orwhere("model_msts.name",'like',"%$keywordsearch%")->orwhere('motor_custome_values.fuel_type','like',"%$keywordsearch%")->get();
$vehicletypecarscount =count($vehicletypecarscountall);

            $vehicletypecars=$query->where("make_msts.name",'like',"%$keywordsearch%")->orwhere("motor_custome_values.registration_year",$keywordsearch)->orwhere("model_msts.name",'like',"%$keywordsearch%")->orwhere('motor_custome_values.fuel_type','like',"%$keywordsearch%")->orderby('registration_year')->paginate(2);
            }else{

$vehicletypecarscountall=$query->get();
$vehicletypecarscount =count($vehicletypecarscountall);



                $vehicletypecars=$query->orderby('registration_year')->paginate(2); 
            }




    }
    else if ($sortcombo=='Price'){

        if ($kw!=''){
        
        $vehicletypecarscountall=$query->where("make_msts.name",'like',"%$keywordsearch%")->orwhere("motor_custome_values.registration_year",$keywordsearch)->orwhere("model_msts.name",'like',"%$keywordsearch%")->orwhere('motor_custome_values.fuel_type','like',"%$keywordsearch%")->get();
$vehicletypecarscount =count($vehicletypecarscountall);
            $vehicletypecars=$query->where("make_msts.name",'like',"%$keywordsearch%")->orwhere("motor_custome_values.registration_year",$keywordsearch)->orwhere("model_msts.name",'like',"%$keywordsearch%")->orwhere('motor_custome_values.fuel_type','like',"%$keywordsearch%")->orderby('price')->paginate(2);
            }else{
                $vehicletypecarscountall=$query->get();
$vehicletypecarscount =count($vehicletypecarscountall);
                $vehicletypecars=$query->orderby('price')->paginate(2); 
            }

    }else{
    if ($kw!=''){
        $vehicletypecarscountall=$query->where("make_msts.name",'like',"%$keywordsearch%")->orwhere("motor_custome_values.registration_year",$keywordsearch)->orwhere("model_msts.name",'like',"%$keywordsearch%")->orwhere('motor_custome_values.fuel_type','like',"%$keywordsearch%")->get();
$vehicletypecarscount =count($vehicletypecarscountall);
    $vehicletypecars=$query->where("make_msts.name",'like',"%$keywordsearch%")->orwhere("motor_custome_values.registration_year",$keywordsearch)->orwhere("model_msts.name",'like',"%$keywordsearch%")->orwhere('motor_custome_values.fuel_type','like',"%$keywordsearch%")->paginate(2);
    }else{

        $vehicletypecarscountall=$query->get();
$vehicletypecarscount =count($vehicletypecarscountall);
        $vehicletypecars=$query->paginate(2); 
    }
}
    //$vehicletypecarscount =0;
    
    
    
    
    
    
    }else{
          
    
    

$query = Ads::select("ads.*","ads.id as mainid1","ads.canonical_name as mainid","subcategories.*",'motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename",'places.name as placename','countries.name as countryname')->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("subcategories","ads.subcategory_id","=","subcategories.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->leftjoin("places","places.id","=","ads.place")->leftjoin("countries","countries.id","=","ads.country_id")->leftjoin("subcategories","ads.subcategory_id","=","subcategories.id")->where('subcategories.canonical_name',$cname);
    
    if ($sortcombo=='Date'){
        if ($kw!=''){
        $vehicletypecarscountall=$query->where("make_msts.name",'like',"%$keywordsearch%")->orwhere("motor_custome_values.registration_year",$keywordsearch)->orwhere("model_msts.name",'like',"%$keywordsearch%")->orwhere('motor_custome_values.fuel_type','like',"%$keywordsearch%")->get();
$vehicletypecarscount =count($vehicletypecarscountall);
            $vehicletypecars=$query->where("make_msts.name",'like',"%$keywordsearch%")->orwhere("motor_custome_values.registration_year",$keywordsearch)->orwhere("model_msts.name",'like',"%$keywordsearch%")->orwhere('motor_custome_values.fuel_type','like',"%$keywordsearch%")->orderby('registration_year')->paginate(2);
            }else{
                $vehicletypecarscountall=$query->get();
$vehicletypecarscount =count($vehicletypecarscountall);
                $vehicletypecars=$query->orderby('registration_year')->paginate(2); 
            }




    }
    else if ($sortcombo=='Price'){

        if ($kw!=''){
        $vehicletypecarscountall=$query->where("make_msts.name",'like',"%$keywordsearch%")->orwhere("motor_custome_values.registration_year",$keywordsearch)->orwhere("model_msts.name",'like',"%$keywordsearch%")->orwhere('motor_custome_values.fuel_type','like',"%$keywordsearch%")->get();
$vehicletypecarscount =count($vehicletypecarscountall);
            $vehicletypecars=$query->where("make_msts.name",'like',"%$keywordsearch%")->orwhere("motor_custome_values.registration_year",$keywordsearch)->orwhere("model_msts.name",'like',"%$keywordsearch%")->orwhere('motor_custome_values.fuel_type','like',"%$keywordsearch%")->orderby('price')->paginate(2);
            }else{
                $vehicletypecarscountall=$query->get();
$vehicletypecarscount =count($vehicletypecarscountall);
                $vehicletypecars=$query->orderby('price')->paginate(2); 
            }

    }else{
    if ($kw!=''){
        $vehicletypecarscountall=$query->where("make_msts.name",'like',"%$keywordsearch%")->orwhere("motor_custome_values.registration_year",$keywordsearch)->orwhere("model_msts.name",'like',"%$keywordsearch%")->orwhere('motor_custome_values.fuel_type','like',"%$keywordsearch%")->get();
$vehicletypecarscount =count($vehicletypecarscountall);
    $vehicletypecars=$query->where("make_msts.name",'like',"%$keywordsearch%")->orwhere("motor_custome_values.registration_year",$keywordsearch)->orwhere("model_msts.name",'like',"%$keywordsearch%")->orwhere('motor_custome_values.fuel_type','like',"%$keywordsearch%")->paginate(2);
    }else{
        $vehicletypecarscountall=$query->get();
$vehicletypecarscount =count($vehicletypecarscountall);
        $vehicletypecars=$query->paginate(2); 
    }
}
    //$vehicletypecarscount =0;    
    
    
    }
}
else if ($request->flagajax==2){
        $kw=$request->searchtextboxfirst;
        $keywordsearch=$kw;
        $sortcombo=$request->sortcombo;
        //$cname="All";
        $cname=$id;
    $subcategory = Subcategory::orderBy('sort_order')->where('status',1)
            ->get(); 
    
    if ($cname=='All'){
    $query = Ads::select("ads.*","ads.id as mainid1","ads.canonical_name as mainid","subcategories.*",'motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename",'places.name as placename','countries.name as countryname')->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("subcategories","ads.subcategory_id","=","subcategories.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->leftjoin("places","places.id","=","ads.place")->leftjoin("countries","countries.id","=","ads.country_id");
    
    if ($sortcombo=='Date'){
        if ($kw!=''){
        $vehicletypecarscountall=$query->where("make_msts.name",'like',"%$keywordsearch%")->orwhere("motor_custome_values.registration_year",$keywordsearch)->orwhere("model_msts.name",'like',"%$keywordsearch%")->orwhere('motor_custome_values.fuel_type','like',"%$keywordsearch%")->get();
$vehicletypecarscount =count($vehicletypecarscountall);
            $vehicletypecars=$query->where("make_msts.name",'like',"%$keywordsearch%")->orwhere("motor_custome_values.registration_year",$keywordsearch)->orwhere("model_msts.name",'like',"%$keywordsearch%")->orwhere('motor_custome_values.fuel_type','like',"%$keywordsearch%")->orderby('registration_year')->paginate(2);
            }else{
                $vehicletypecarscountall=$query->get();
$vehicletypecarscount =count($vehicletypecarscountall);
                $vehicletypecars=$query->orderby('registration_year')->paginate(2); 
            }




         }
    else if ($sortcombo=='Price'){

        if ($kw!=''){
        $vehicletypecarscountall=$query->where("make_msts.name",'like',"%$keywordsearch%")->orwhere("motor_custome_values.registration_year",$keywordsearch)->orwhere("model_msts.name",'like',"%$keywordsearch%")->orwhere('motor_custome_values.fuel_type','like',"%$keywordsearch%")->get();
$vehicletypecarscount =count($vehicletypecarscountall);
            $vehicletypecars=$query->where("make_msts.name",'like',"%$keywordsearch%")->orwhere("motor_custome_values.registration_year",$keywordsearch)->orwhere("model_msts.name",'like',"%$keywordsearch%")->orwhere('motor_custome_values.fuel_type','like',"%$keywordsearch%")->orderby('price')->paginate(2);
            }else{
                $vehicletypecarscountall=$query->get();
$vehicletypecarscount =count($vehicletypecarscountall);
                $vehicletypecars=$query->orderby('price')->paginate(2); 
            }

     }
     else{
    if ($kw!=''){
        $vehicletypecarscountall=$query->where("make_msts.name",'like',"%$keywordsearch%")->orwhere("motor_custome_values.registration_year",$keywordsearch)->orwhere("model_msts.name",'like',"%$keywordsearch%")->orwhere('motor_custome_values.fuel_type','like',"%$keywordsearch%")->get();
$vehicletypecarscount =count($vehicletypecarscountall);
    $vehicletypecars=$query->where("make_msts.name",'like',"%$keywordsearch%")->orwhere("motor_custome_values.registration_year",$keywordsearch)->orwhere("model_msts.name",'like',"%$keywordsearch%")->orwhere('motor_custome_values.fuel_type','like',"%$keywordsearch%")->paginate(2);
    }else{
        $vehicletypecarscountall=$query->get();
$vehicletypecarscount =count($vehicletypecarscountall);
        $vehicletypecars=$query->paginate(2); 
    }
}



    //$vehicletypecarscount =0;
        
    }else{
$query = Ads::select("ads.*","ads.id as mainid1","ads.canonical_name as mainid","subcategories.*",'motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename",'places.name as placename','countries.name as countryname')->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("subcategories","ads.subcategory_id","=","subcategories.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->leftjoin("places","places.id","=","ads.place")->leftjoin("countries","countries.id","=","ads.country_id")->where('subcategories.canonical_name',$cname);
    
    if ($sortcombo=='Date'){
        if ($kw!=''){
        $vehicletypecarscountall=$query->where("make_msts.name",'like',"%$keywordsearch%")->orwhere("motor_custome_values.registration_year",$keywordsearch)->orwhere("model_msts.name",'like',"%$keywordsearch%")->orwhere('motor_custome_values.fuel_type','like',"%$keywordsearch%")->get();
$vehicletypecarscount =count($vehicletypecarscountall);
            $vehicletypecars=$query->where("make_msts.name",'like',"%$keywordsearch%")->orwhere("motor_custome_values.registration_year",$keywordsearch)->orwhere("model_msts.name",'like',"%$keywordsearch%")->orwhere('motor_custome_values.fuel_type','like',"%$keywordsearch%")->orderby('registration_year')->paginate(2);
            }else{
                $vehicletypecarscountall=$query->get();
$vehicletypecarscount =count($vehicletypecarscountall);
                $vehicletypecars=$query->orderby('registration_year')->paginate(2); 
            }




         }
    else if ($sortcombo=='Price'){

        if ($kw!=''){
        $vehicletypecarscountall=$query->where("make_msts.name",'like',"%$keywordsearch%")->orwhere("motor_custome_values.registration_year",$keywordsearch)->orwhere("model_msts.name",'like',"%$keywordsearch%")->orwhere('motor_custome_values.fuel_type','like',"%$keywordsearch%")->get();
$vehicletypecarscount =count($vehicletypecarscountall);
            $vehicletypecars=$query->where("make_msts.name",'like',"%$keywordsearch%")->orwhere("motor_custome_values.registration_year",$keywordsearch)->orwhere("model_msts.name",'like',"%$keywordsearch%")->orwhere('motor_custome_values.fuel_type','like',"%$keywordsearch%")->orderby('price')->paginate(2);
            }else{
                $vehicletypecarscountall=$query->get();
$vehicletypecarscount =count($vehicletypecarscountall);
                $vehicletypecars=$query->orderby('price')->paginate(2); 
            }

     }
     else{
    if ($kw!=''){
        $vehicletypecarscountall=$query->where("make_msts.name",'like',"%$keywordsearch%")->orwhere("motor_custome_values.registration_year",$keywordsearch)->orwhere("model_msts.name",'like',"%$keywordsearch%")->orwhere('motor_custome_values.fuel_type','like',"%$keywordsearch%")->get();
$vehicletypecarscount =count($vehicletypecarscountall);
    $vehicletypecars=$query->where("make_msts.name",'like',"%$keywordsearch%")->orwhere("motor_custome_values.registration_year",$keywordsearch)->orwhere("model_msts.name",'like',"%$keywordsearch%")->orwhere('motor_custome_values.fuel_type','like',"%$keywordsearch%")->paginate(2);
    }else{
        $vehicletypecarscountall=$query->get();
$vehicletypecarscount =count($vehicletypecarscountall);
        $vehicletypecars=$query->paginate(2); 
    }

}
    }
}
else if ($request->flagajax==3){
//dd($request->flagajax);
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
//$offset=$_GET['offset']+10;
//dd($year,$make,$model,$fueltype,$passengercapacity,$priceflag);
$query = Ads::select("ads.*","ads.id as mainid1","ads.canonical_name as mainid","subcategories.*",'motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename",'places.name as placename','countries.name as countryname')->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("subcategories","ads.subcategory_id","=","subcategories.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->leftjoin("places","places.id","=","ads.place")->leftjoin("countries","countries.id","=","ads.country_id");

if (isset($year)&&($year[0]!=null)){
   //echo "year";
//dd();
     $year1=implode(",",$year);
    $year2=explode(",",$year1);
$query->whereIn('registration_year',$year2);
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
    //dd("enter");
//if ($fueltype!=''){
    //print_r($fueltype);
    //dd();
    /*$ft2=array();
    foreach($fueltype as $ft1){
        $ft2[]=$ft1;
    }*/
    //dd(count($fueltype));
    $fueltype1=implode(",",$fueltype);
    $ft2=explode(",",$fueltype1);
//$query->whereIn('motor_custome_values.fuel_type',$fueltype);
    $query->whereIn('motor_custome_values.fuel_type',$ft2);
}
if ($passengercapacity[0]!=null){
 $passengercapacity1=implode(",",$passengercapacity);
    $passengercapacity2=explode(",",$passengercapacity1);
$query->whereIn('ads.seats',$passengercapacity2);
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
$sortcombo=$request->sortcombo1;
//dd($sortcombo);
if ($request->searchtextbox!=''){
    $keywordsearch=$request->searchtextbox;
    $query->where("make_msts.name",'like',"%$keywordsearch%")->orwhere("motor_custome_values.registration_year",$keywordsearch)->orwhere("model_msts.name",'like',"%$keywordsearch%")->orwhere('motor_custome_values.fuel_type','like',"%$keywordsearch%");
}

$vehicletypecarscountall=$query->get();
$vehicletypecarscount =count($vehicletypecarscountall);
//dd($vehicletypecarscount);
if ($sortcombo=='Price'){
    //DB::enableQueryLog();
$vehicletypecars=$query->orderby('price')->paginate(2);
//$quries = DB::getQueryLog();
//dd($quries);
//print_r($vehicletypecars);
//dd("enp");
}
else{
    //dd("en");
  // DB::enableQueryLog();
    $vehicletypecars=$query->orderby('registration_year')->paginate(2);
    //$quries = DB::getQueryLog();
//dd($quries);
//print_r($vehicletypecars);
//dd("enp");
}

}else{
         //dd("hai"); 
    /*General Start*/
    if ($cname=='All'){
      $query = Ads::select("ads.*","ads.id as mainid1","ads.canonical_name as mainid","subcategories.*",'motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename",'places.name as placename','countries.name as countryname')->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("subcategories","ads.subcategory_id","=","subcategories.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->leftjoin("places","places.id","=","ads.place")->leftjoin("countries","countries.id","=","ads.country_id");
    }else{

      $query = Ads::select("ads.*","ads.id as mainid1","ads.canonical_name as mainid","subcategories.*",'motor_custome_values.*',"model_msts.name as modelname","make_msts.name as makename",'places.name as placename','countries.name as countryname')->leftjoin("motor_custome_values","ads.id","=","motor_custome_values.ads_id")->leftjoin("subcategories","ads.subcategory_id","=","subcategories.id")->leftjoin("model_msts","motor_custome_values.model_id","=","model_msts.id")->leftjoin("make_msts","motor_custome_values.make_id","=","make_msts.id")->leftjoin("places","places.id","=","ads.place")->leftjoin("countries","countries.id","=","ads.country_id")->where('subcategories.canonical_name',$cname);
     } 
    /*General End*/
    $vehicletypecarscountall=$query->get();
       if ($sortcombo=='Price'){
$vehicletypecars=$query->orderby('price')->paginate(2);

}
else{
    $vehicletypecars=$query->orderby('registration_year')->paginate(2);
    
} 
   $vehicletypecarscount =count($vehicletypecarscountall);  
}
    
//dd($vehicletypecarscount);
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
    //$subcategory=array();
    //dd($vehicletypecarscount);
    $showcarsfirst = Ads::select("ads.*")->skip(0)->take(7)->get();
$showcarssecond = Ads::select("ads.*")->skip(7)->take(7)->get();
$contents=Dynamiccontents::first();
$profile=User::first();
    if($request->ajax()){
        return view('cars.ajax-pagination ',compact('minprice','maxprice','passengercapacity','fueltype','subcategory','vehicletypecars','year','make','model','cname','vehicletypecarscount','showcarsfirst','showcarssecond','contents')); 
    }     
        return view('cars.listing1',compact('minprice','maxprice','passengercapacity','fueltype','subcategory','vehicletypecars','year','make','model','cname','vehicletypecarscount','showcarsfirst','showcarssecond','contents','profile'));  
    }
  




}
