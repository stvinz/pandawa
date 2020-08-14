<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\View;

class ContactController extends Controller {

    public function show() {
        return view('pages.contact');
    }

    public function submit(Request $request) {
        $key = config('services.grecaptcha');

        $this->validate($request, [
            'company' => 'nullable|string|max:25|min:3',
            'name' => 'required|alpha|max:25|min:3',
            'email' => 'required|E-Mail',
            'enquiry' => 'required|min:10|max:3000',
            'attachment' => 'max:10240'
        ]);

        $res = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => $key['secret'],
            'response' => $request->input('g-recaptcha-response'),
        ]);
        
        if (!$res["success"]) {
            return View::make('pages.contact')->withErrcap("Please try again");
        }

        //print_r($request->all());

        print_r($res->json());
    }
}