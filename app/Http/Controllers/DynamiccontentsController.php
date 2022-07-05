<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dynamiccontents;

class DynamiccontentsController extends Controller
{
    //

function dynamiccontents(){


$contents=Dynamiccontents::first();
        return view('edit_dynamiccontents',compact('contents'));
}

function dynamiccontentsUpdate(Request $request,$id){
//dd($id);
$request->validate([
            'firstpagebannertitle1'      => 'required',
            'firstpagebannertitle2'     => 'required',
            'firstcolumntitle1'      => 'required',
            'firstcolumntitle2'     => 'required',
            'firstcolumntitle3'      => 'required',
            'secondcolumntitle'     => 'required',
            'secondcolumncontent'      => 'required',
            'thirdcolumntitle'     => 'required',
            'thirdcolumncontent'      => 'required',
            'footertitle'     => 'required',
            'footercontent'      => 'required',
            'secondpagebannertitle1'     => 'required',
            'secondpagebannertitle2'      => 'required',
            'secondpagebannertitle3'     => 'required',
            'bottompagelefttitle'  => 'required',
            'bottompageleftcontent'  => 'required',
            'bottompagerighttitle'  => 'required',
            'bottompagerightContent'  => 'required',
            'faqContent'  => 'required',
            'enquiryContent'  => 'required',
        ]);
//print_r($request->all());
//dd($id);
        Dynamiccontents::where('id', $id)
        ->update([
            'firstpagebannertitle1'      => $request->firstpagebannertitle1,
            'firstpagebannertitle2'     => $request->firstpagebannertitle2,
            'firstcolumntitle1'      => $request->firstcolumntitle1,
            'firstcolumntitle2'     => $request->firstcolumntitle2,
            'firstcolumntitle3'      => $request->firstcolumntitle3,
            'secondcolumntitle'     => $request->secondcolumntitle,
            'secondcolumncontent'      => $request->secondcolumncontent,
            'thirdcolumntitle'     => $request->thirdcolumntitle,
'thirdcolumncontent'      => $request->thirdcolumncontent,
            'footertitle'     => $request->footertitle,
            'footercontent'      => $request->footercontent,
            'secondpagebannertitle1'     => $request->secondpagebannertitle1,
'secondpagebannertitle2'      => $request->secondpagebannertitle2,
            'secondpagebannertitle3'     => $request->secondpagebannertitle3,
            'bottompagelefttitle'  => $request->bottompagelefttitle,
            'bottompageleftcontent'  => $request->bottompageleftcontent,
            'bottompagerighttitle'  => $request->bottompagerighttitle,
            'bottompagerightContent'  => $request->bottompagerightContent,
            'faqContent'  => $request->faqContent,
            'enquiryContent'  => $request->enquiryContent,


        ]);

        session()->flash('success', 'Contents has been changed');
        return redirect('/admin/dynamiccontents/1');



}


}
