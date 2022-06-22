<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MakeMst;
use Exception;
class MakeMstsController extends Controller
{
    //

public function index(){
try {
        $make = MakeMst::get();

        return view('other.make.make', compact('make'));
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

        
        $make                = new MakeMst();
        $make->name          = $request->name;
        
        $make->status         =$request->status;
        $make->sort_order         =$request->sortorder;
        $make->save();

        session()->flash('success', 'Make has been stored');
        return redirect()->route('make.index');
         }
        catch (exception $e) {
        $message=$e->getMessage();
        return view('ads.errorpage',compact('message'));
}
    }

public function delete($id){
try {
        MakeMst::destroy($id);

        session()->flash('success', 'Make has been deleted');
        return redirect()->route('make.index');
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

        

        MakeMst::where('id', $request->id)
        ->update([
            'name' => $request->name,            
            'status'         =>$request->status,
            'sort_order'=>$request->sortorder
        ]);

        session()->flash('success', 'Make has been updated');
        return redirect()->route('make.index');
    }




}
