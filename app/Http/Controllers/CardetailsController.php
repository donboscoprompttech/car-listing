<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactUs;

class CardetailsController extends Controller
{
    //


public function cardetails(){
    return view('cars.details');  
}


public function enquiryprocess(Request $request){ 


$contactus=new ContactUs();
$contactus->name=$request->fullname;
$contactus->email=$request->email;
//$subject=$request->subject;
$contactus->message=$request->message;
$contactus->save();
echo "success";
}



}
