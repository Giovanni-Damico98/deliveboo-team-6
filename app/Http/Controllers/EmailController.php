<?php

namespace App\Http\Controllers;

use App\Events\ConfirmationEmailRequested;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    //
    public function sendConfirmationEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        // Trigger the event with the email from the form
        event(new ConfirmationEmailRequested($request->email));

        return response()->json(['message' => 'Email di conferma inviata!']);
    }

}
