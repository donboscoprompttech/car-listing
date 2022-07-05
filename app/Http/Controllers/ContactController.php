<?php

namespace App\Http\Controllers;

use App\Mail\EnquiryReplay;
use App\Models\ContactUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index(){

        $contact = ContactUs::leftjoin("ads","contact_us.ads_id","=","ads.id")->select('contact_us.*','ads.title')->orderBy('contact_us.created_at', 'desc')
        ->paginate(10);

        return view('other.contact.contact', compact('contact'));
    }

    public function view($id){

        $contact = ContactUs::leftjoin("ads","contact_us.ads_id","=","ads.id")->select('contact_us.*','ads.title')->where('contact_us.id', $id)
        ->first();

        ContactUs::where('id', $id)
        ->update([
            'status' => 1,
        ]);

        return view('other.contact.view_contact', compact('contact'));
    }

    public function replay(Request $request, $id){

        $request->validate([
            'replay'    => 'required',
        ]);

        $contact = ContactUs::where('id', $id)
        ->first();

        $replay = [
            'name'      => $contact->name,
            'replay'    => $request->replay,
        ];

        ContactUs::where('id', $id)
        ->update([
            'replay'    => $request->replay,
        ]);

        Mail::to($contact->email)->send(new EnquiryReplay($replay));

        session()->flash('success', 'Replay has been sended');
        return redirect()->route('contact.index');
    }
}
