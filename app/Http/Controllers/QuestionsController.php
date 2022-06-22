<?php

namespace App\Http\Controllers;
use App\Models\Questions;
use App\Models\MakeMst;
use Illuminate\Http\Request;
use Exception;
class QuestionsController extends Controller
{
    //

public function index(){
try {
        $questions = Questions::get();

        return view('other.questions.questions', compact('questions'));
     }   
catch (exception $e) {
        $message=$e->getMessage();
        return view('ads.errorpage',compact('message'));
}
    }
public function delete($id){
try {
        Questions::destroy($id);

        session()->flash('success', 'Question has been deleted');
        return redirect()->route('questions.index');
         }
catch (exception $e) {
        $message=$e->getMessage();
        return view('ads.errorpage',compact('message'));
}
    }

public function store(Request $request) {
     try {   
        $request->validate([
            'question'     => 'required',
            'answer'     => 'required',
            'description'=>'required'
        ]);

        $questions            = new Questions();
        $questions->question     = $request->question;
        $questions->answer     = $request->answer;
        $questions->shortdescription=$request->description;
        $questions->save();

        session()->flash('success', 'Questions has been stored');
        return redirect()->route('questions.index');
         }
        catch (exception $e) {
        $message=$e->getMessage();
        return view('ads.errorpage',compact('message'));
}
    }

public function update(Request $request){
       try {
        $request->validate([
            'question'     => 'required',
            'answer'     => 'required',
            'description'=>'required'
        ]);

        Questions::where('id', $request->id)
        ->update([
            'question'     => $request->question,
            'answer'     => $request->answer,
            'shortdescription'=>$request->description
        ]);

        session()->flash('success', 'Questions has been updated');
        return redirect()->route('questions.index');
    }
        catch (exception $e) {
        $message=$e->getMessage();
        return view('ads.errorpage',compact('message'));
}
    }



}
