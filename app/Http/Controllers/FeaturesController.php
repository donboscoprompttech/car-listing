<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Features;

class FeaturesController extends Controller
{
    //

public function index(){
try {
        $features = Features::get();

        return view('other.features.features', compact('features'));
     }   
catch (exception $e) {
        $message=$e->getMessage();
        return view('ads.errorpage',compact('message'));
}
    }


public function store(Request $request) {
     try {   
        $request->validate([
            'name'          => 'required',            
            'status'=>'required',
            'sortorder'=>'required'
            //'image'         => 'required|mimes:png,jpg,jpeg',
        ]);

        
        $feature                = new Features();
        $feature->featuretext          = $request->name;
        $feature->inputtype     = $request->inputtype;
        $feature->status         =$request->status;
        $feature->sortorder         =$request->sortorder;
        $feature->save();

        session()->flash('success', 'Feature has been stored');
        return redirect()->route('features.index');
         }
        catch (exception $e) {
        $message=$e->getMessage();
        return view('ads.errorpage',compact('message'));
}
    }

public function delete($id){
try {
        Features::destroy($id);

        session()->flash('success', 'Feature has been deleted');
        return redirect()->route('features.index');
         }
catch (exception $e) {
        $message=$e->getMessage();
        return view('ads.errorpage',compact('message'));
}
    }


public function update(Request $request){

        $request->validate([
            'name'          => 'required',            
            'status'=>'required',
            'sortorder'=>'required'
            
        ]);

        

        Features::where('id', $request->id)
        ->update([
            'featuretext' => $request->name,            
            'status'         =>$request->status,
            'inputtype'=>$request->inputtype,
            'sortorder'=>$request->sortorder
        ]);

        session()->flash('success', 'Feature has been updated');
        return redirect()->route('features.index');
    }














}
