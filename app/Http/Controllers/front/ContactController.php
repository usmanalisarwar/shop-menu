<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;
class ContactController extends Controller
{
    public function sendEmail(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Prepare data for email and database
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'userMessage' => $request->message, // Rename 'message' to 'userMessage'
        ];

        // Store the contact form data into the contacts table
        Contact::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'subject' => $data['subject'],
            'message' => $data['userMessage'], // Save the message
        ]);

        // Send the email using Laravel's Mail facade
        Mail::send('emails.contact', $data, function ($message) use ($data) {
            $message->to('your-email@example.com')
                    ->subject($data['subject'])
                    ->replyTo($data['email']);
        });

        // Redirect back with a success message
        return back()->with('success', 'Your message has been sent and stored successfully!');
    }
}
