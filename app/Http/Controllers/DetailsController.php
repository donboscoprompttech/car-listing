<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\ContactUs;
class DetailsController extends Controller
{
    //

public function cardetails(){
    return view('cars.details');  
}

public function carlisting(){
    return view('cars.listing');  
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
