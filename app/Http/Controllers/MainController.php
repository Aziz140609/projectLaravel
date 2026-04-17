<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Main;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    // Tampilkan halaman pilih lapangan
    public function index()
    {
        return view('index');
    }

    // Tampilkan form booking (harus login)
    public function bookingForm(Request $request)
    {
        $lapangan = $request->query('lapangan', '1'); // default lapangan 1
        return view('booking', compact('lapangan'));
    }

    // Step 1: Pilih Lapangan
    public function step1()
    {
        return view('booking.step-1');
    }

    // Step 2: Pilih Waktu
    public function step2(Request $request)
    {
        $nomor_lapangan = $request->query('lapangan');
        if (!$nomor_lapangan) {
            return redirect()->route('booking.step1');
        }

        return view('booking.step-2', compact('nomor_lapangan'));
    }

    // Step 3: Isi Formulir / Detail
    public function step3(Request $request)
    {
        $request->validate([
            'nomor_lapangan' => 'required',
            'tanggal_main' => 'required|date',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required|after:jam_mulai'
        ]);

        $input = $request->only(['nomor_lapangan', 'tanggal_main', 'jam_mulai', 'jam_selesai']);
        
        // Pengecekan Tabrakan Jadwal
        // (Jam selesai dari input tidak boleh beririsan dengan sesi yang ada)
        // Kita bandingkan jika sesi target tidak overlap
        $conflict = Main::where('nomor_lapangan', $input['nomor_lapangan'])
            ->where('tanggal_main', $input['tanggal_main'])
            ->where(function($query) use ($input) {
                // Irirsan waktu: Start1 < End2 AND End1 > Start2
                $query->where('jam_mulai', '<', $input['jam_selesai'])
                      ->where('jam_selesai', '>', $input['jam_mulai']);
            })
            ->exists();

        if ($conflict) {
            return back()->with('error_conflict', 'Jadwal bertabrakan dengan pesanan lain pada ' . $input['tanggal_main'] . ' ' . $input['jam_mulai'] . '-' . $input['jam_selesai'] . '. Silakan pilih waktu lain!');
        }

        return view('booking.step-3', compact('input'));
    }

    // Simpan data booking ke database (Status Belum Lunas)
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_pemesan' => 'required|string|max:255',
            'no_telepon' => 'required|string|max:20',
            'tanggal_main' => 'required|date',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'nomor_lapangan' => 'required|string',
            'total_harga' => 'required|integer',
        ]);

        $validatedData['status_pembayaran'] = 'belum lunas'; 

        $booking = Auth::user()->mains()->create($validatedData);

        return redirect()->route('booking.payment', $booking->id);
    }

    public function payment(Main $main)
    {
        if ($main->user_id !== Auth::id()) {
            abort(403);
        }
        return view('booking.payment', compact('main'));
    }

    public function processPayment(Request $request, Main $main)
    {
        if ($main->user_id !== Auth::id()) {
            abort(403);
        }

        $main->update([
            'status_pembayaran' => 'lunas'
        ]);

        return redirect()->route('booking.proof', $main->id)->with('success', 'Pembayaran Berhasil Dikonfirmasi!');
    }

    // Tampilkan Struk / Bukti
    public function proof(Main $main)
    {
        if ($main->user_id !== Auth::id()) {
            abort(403);
        }
        return view('booking.proof', compact('main'));
    }

    // Hapus/Batal booking
    public function destroy(Main $main)
    {
        if ($main->user_id !== Auth::id()) {
            abort(403);
        }
        $main->delete();

        return redirect()->route('booking.index')->with('success', 'Booking berhasil dibatalkan!');
    }
}
