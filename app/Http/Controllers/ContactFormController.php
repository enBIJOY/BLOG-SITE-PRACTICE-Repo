<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactForm;

class ContactFormController extends Controller
{
    public function contactform(Request $request){
        $request->validate([
            'name'=>'required',
            'phone'=>'required',
            'email'=>'required|email|unique:contact_forms,email',
        ]);
        ContactForm::create([
            'name'=>$request->name,
            'phone'=>$request->phone,
            'email'=>$request->email,
            'message'=>$request->message,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Thank you for Contact Us!'
        ]);
    }

    public function allContact()
    {
        $Contacts = ContactForm::latest()->get();
        return view('dashboard.allContact', compact('Contacts'));
    }
}
