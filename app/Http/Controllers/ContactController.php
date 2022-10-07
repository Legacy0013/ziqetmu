<?php

namespace App\Http\Controllers;

use App\Mail\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    public function create()
    {
        return view('pages.contact');
    }

    public function store(ContactRequest $request)
    {
        Mail::to('webmaster@ziqetmu.fr')
            ->send(new Contact($request->except('_token')));
        return view('pages.contact-confirm');
    }
}
