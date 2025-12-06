<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\ReservationRequest;

class ReservationController extends Controller
{
    public function submit(ReservationRequest $request)
    {
        $data = $request->validated();

        // ===========================================
        // 1️⃣ SEND TO WHATSAPP
        // ===========================================
        $waNumber = "62895328879093"; // WhatsApp number
        $waMessage = urlencode(
            "New Reservation:\n" .
            "Name: {$data['name']}\n" .
            "Phone: {$data['phone']}\n" .
            "Email: {$data['email']}\n" .
            "Date: {$data['date']}\n" .
            "Time: {$data['time']}\n" .
            "Guests: {$data['people']}\n" .
            "Notes: {$data['note']}"
        );

        $waUrl = "https://wa.me/{$waNumber}?text={$waMessage}";

        // ===========================================
        // 2️⃣ SEND EMAIL
        // ===========================================
        Mail::raw(
            "New Reservation:\n" .
            "Name: {$data['name']}\n" .
            "Phone: {$data['phone']}\n" .
            "Email: {$data['email']}\n" .
            "Date: {$data['date']}\n" .
            "Time: {$data['time']}\n" .
            "Guests: {$data['people']}\n" .
            "Notes: {$data['note']}",

            function ($message) use ($data) {
                $message->to('trevaldi10@gmail.com')
                        ->subject('New Reservation - Madame Djeli');
            }
        );

        // ===========================================
        // 3️⃣ SEND CONFIRMATION EMAIL TO CUSTOMER
        // ===========================================
        Mail::raw(
            "Dear {$data['name']},\n\n" .
            "Thank you for your reservation at Madame Djeli!\n\n" .
            "Reservation Details:\n" .
            "Date: {$data['date']}\n" .
            "Time: {$data['time']}\n" .
            "Guests: {$data['people']}\n\n" .
            "We'll confirm your reservation within 2 hours.\n" .
            "If you have any questions, please contact us at +62 895-3288-79093\n\n" .
            "Best regards,\n" .
            "Madame Djeli Team",

            function ($message) use ($data) {
                $message->to($data['email'])
                        ->subject('Reservation Confirmation - Madame Djeli');
            }
        );

        // Return success message and redirect back to form
        return redirect()->back()->with('success',
            'Thank you for your reservation! We\'ve sent a confirmation to your email and will contact you within 2 hours to confirm your booking.'
        );
    }
}
