<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModelMst;
use App\Models\MakeMst;
use Exception;
class ModelMstsController extends Controller
{
    //

    public function index(){
try {
        $model = ModelMst::join("make_msts","make_msts.id","=","model_msts.make_id")->select("model_msts.*","make_msts.name as makename")->get();
         $make=MakeMst::where('status',1)->orderby('sort_order')->get();
        return view('other.model.model', compact('model','make'));
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

        
        $model                = new modelMst();
        $model->name          = $request->name;
        $model->make_id       =$request->make;
        $model->status         =$request->status;
        $model->sort_order         =$request->sortorder;
        $model->save();

        session()->flash('success', 'Model has been stored');
        return redirect()->route('model.index');
         }
        catch (exception $e) {
        $message=$e->getMessage();
        return view('ads.errorpage',compact('message'));
}
    }

public function delete($id){
try {
        ModelMst::destroy($id);

        session()->flash('success', 'Model has been deleted');
        return redirect()->route('model.index');
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

        

        ModelMst::where('id', $request->id)
        ->update([
            'name' => $request->name,            
            'status'         =>$request->status,
            'sort_order'=>$request->sortorder,'make_id'=>$request->make,
        ]);

        session()->flash('success', 'Model has been updated');
        return redirect()->route('model.index');
    }



}
