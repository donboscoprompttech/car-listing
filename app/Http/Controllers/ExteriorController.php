<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExteriorMaster;
class ExteriorController extends Controller
{
    //

public function index(){
try {
        
         $exterior=ExteriorMaster::select('exteriormaster.*','exteriormaster.value as value1')->get();         
        return view('other.exterior.exterior', compact('exterior'));
     }   
catch (exception $e) {
        $message=$e->getMessage();
        return view('ads.errorpage',compact('message'));
}
    }

public function store(Request $request) {
     try {   
        $request->validate([
            'label'          => 'required',
            'value'=>'required',            
            'status'=>'required',
            'sortorder'=>'required'
            //'image'         => 'required|mimes:png,jpg,jpeg',
        ]);

        
        $exterior                = new ExteriorMaster();
        $exterior->label          = $request->label;
        $exterior->value       =$request->value;
        $exterior->status         =$request->status;
        $exterior->sortorder         =$request->sortorder;
        $exterior->image='';
        $exterior->save();

        session()->flash('success', 'Exterior has been stored');
        return redirect()->route('exterior.index');
         }
        catch (exception $e) {
        $message=$e->getMessage();
        return view('ads.errorpage',compact('message'));
}
    }

public function delete($id){
try {
        ExteriorMaster::destroy($id);

        session()->flash('success', 'Exterior has been deleted');
        return redirect()->route('exterior.index');
         }
catch (exception $e) {
        $message=$e->getMessage();
        return view('ads.errorpage',compact('message'));
}
    }


public function update(Request $request){

        $request->validate([
            'label'          => 'required',
            'value'=> 'required',           
            'status'=>'required',
            'sortorder'=>'required'
            
        ]);

        

        ExteriorMaster::where('id', $request->id)
        ->update([
            'label' => $request->label,            
            'status'         =>$request->status,
            'sortorder'=>$request->sortorder,'value'=>$request->value,
        ]);

        session()->flash('success', 'Exterior has been updated');
        return redirect()->route('exterior.index');
    }









}
