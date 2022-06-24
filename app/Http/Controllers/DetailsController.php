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
use App\Models\SubCategory;
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
if($contactus->save()){
return ["message"=>"failure","status"=>200,"text"=>"Your Enquiry Send Successfully"];
}else{
    return ["message"=>"failure","status"=>400,"text"=>"Sorry Enquiry not Send"];
}
}



}
