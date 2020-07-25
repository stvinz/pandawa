<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ContactController extends Controller {

    public function show() {
        return view('pages.contact');
    }

    public function submit(Request $request) {
        $this->validate($request, [
            'company' => 'nullable|string|max:25|min:3',
            'name' => 'required|alpha|max:25|min:3',
            'email' => 'required|E-Mail',
            'enquiry' => 'required|min:10|max:3000',
            'attachment' => 'max:10240'
        ]);

        print_r($request->all());
    }
}