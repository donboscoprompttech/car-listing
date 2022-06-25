<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InteriorMaster;
class InteriorController extends Controller
{
    //

public function index(){
try {
        
         $interior=InteriorMaster::select('interiormaster.*','interiormaster.value as value1')->get();
         //print_r($interior);
         //dd();
        return view('other.interior.interior', compact('interior'));
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

        
        $interior                = new InteriorMaster();
        $interior->label          = $request->label;
        $interior->value       =$request->value;
        $interior->status         =$request->status;
        $interior->sortorder         =$request->sortorder;
        $interior->image='';
        $interior->save();

        session()->flash('success', 'Interior has been stored');
        return redirect()->route('interior.index');
         }
        catch (exception $e) {
        $message=$e->getMessage();
        return view('ads.errorpage',compact('message'));
}
    }

public function delete($id){
try {
        InteriorMaster::destroy($id);

        session()->flash('success', 'Interior has been deleted');
        return redirect()->route('interior.index');
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

        

        InteriorMaster::where('id', $request->id)
        ->update([
            'label' => $request->label,            
            'status'         =>$request->status,
            'sortorder'=>$request->sortorder,'value'=>$request->value,
        ]);

        session()->flash('success', 'Interior has been updated');
        return redirect()->route('interior.index');
    }










}
