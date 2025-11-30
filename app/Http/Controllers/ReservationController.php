<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ReservationController extends Controller
{
    public function submit(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'date' => 'required',
            'time' => 'required',
            'people' => 'required|integer',
            'note' => 'nullable'
        ]);

        // ===========================================
        // 1️⃣ KIRIM KE WHATSAPP
        // ===========================================
        $waNumber = "62895328879093"; // nomor WA kamu
        $waMessage = urlencode(
            "Reservasi Baru:\n" .
            "Nama: {$data['name']}\n" .
            "No HP: {$data['phone']}\n" .
            "Tanggal: {$data['date']}\n" .
            "Jam: {$data['time']}\n" .
            "Jumlah Orang: {$data['people']}\n" .
            "Catatan: {$data['note']}"
        );

        $waUrl = "https://wa.me/{$waNumber}?text={$waMessage}";

        // ===========================================
        // 2️⃣ KIRIM EMAIL
        // ===========================================
        Mail::raw(
            "Reservasi Baru:\n" .
            "Nama: {$data['name']}\n" .
            "No HP: {$data['phone']}\n" .
            "Tanggal: {$data['date']}\n" .
            "Jam: {$data['time']}\n" .
            "Jumlah Orang: {$data['people']}\n" .
            "Catatan: {$data['note']}",

            function ($message) {
                $message->to('trevaldi10@gmail.com')
                        ->subject('Reservasi Baru - Madame Djeli');
            }
        );

        // Redirect ke WhatsApp setelah submit
        return redirect()->away($waUrl);
    }
}
