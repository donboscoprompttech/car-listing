<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VarientMst;
use Exception;
class VarientMstsController extends Controller
{
    //

public function index(){
try {
        $varient = varientMst::get();

        return view('other.varient.varient', compact('varient'));
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

        
        $varient                = new varientMst();
        $varient->name          = $request->name;
        $varient->model_id       =1;
        $varient->status         =$request->status;
        $varient->order         =$request->sortorder;
        $varient->save();

        session()->flash('success', 'varient has been stored');
        return redirect()->route('varient.index');
         }
        catch (exception $e) {
        $message=$e->getMessage();
        return view('ads.errorpage',compact('message'));
}
    }

public function delete($id){
try {
        varientMst::destroy($id);

        session()->flash('success', 'varient has been deleted');
        return redirect()->route('varient.index');
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

        

        varientMst::where('id', $request->id)
        ->update([
            'name' => $request->name,            
            'status'         =>$request->status,
            'order'=>$request->sortorder
        ]);

        session()->flash('success', 'varient has been updated');
        return redirect()->route('varient.index');
    }





}
