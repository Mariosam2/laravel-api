<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\NewContact;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'name' => 'required|max:100',
            'email_address' => 'required|email|max:255',
            'message' => 'required|max:16777215'


        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }

        $val_data = $validator->validate();
        $new_contact = Contact::create($val_data);
        Mail::to('info@boolfolio.com')->send(new NewContact($new_contact));

        return response()->json([
            'success' => true,
        ]);
    }
}
