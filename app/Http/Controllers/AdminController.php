<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Main;
use App\Models\User;
use App\Models\Court;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        // 1. Total User
        $totalUser = User::count();

        // 2. Total Booking
        $totalBooking = Main::count();

        // 3. Booking Hari Ini
        $today = Carbon::today()->format('Y-m-d');
        $bookingHariIni = Main::where('tanggal_main', $today)->count();

        // 4. Lapangan Tersedia
        $nowTime = Carbon::now()->format('H:i:s');
        $lapanganDipakai = Main::where('tanggal_main', $today)
            ->where('jam_mulai', '<=', $nowTime)
            ->where('jam_selesai', '>=', $nowTime)
            ->count();
        $totalLapangan = Court::count();
        $lapanganTersedia = max(0, $totalLapangan - $lapanganDipakai);

        // 5. Pendapatan Bulan Ini (Lunas)
        $startOfMonth = Carbon::now()->startOfMonth()->format('Y-m-d');
        $endOfMonth = Carbon::now()->endOfMonth()->format('Y-m-d');
        $pendapatanBulanIni = Main::where('status_pembayaran', 'lunas')
            ->whereDate('created_at', '>=', $startOfMonth)
            ->whereDate('created_at', '<=', $endOfMonth)
            ->sum('total_harga');

        // 6. Jadwal Aktif (booking yang belum selesai)
        $jadwalAktif = Main::where('status_pembayaran', 'lunas')
            ->where(function($query) use ($today, $nowTime) {
                $query->where('tanggal_main', '>', $today)
                      ->orWhere(function($q) use ($today, $nowTime) {
                          $q->where('tanggal_main', $today)
                            ->where('jam_selesai', '>', $nowTime);
                      });
            })->count();

        // 7. Grafik Pendapatan (7 Hari Terakhir)
        $revenueData = [];
        $revenueLabels = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $revenueLabels[] = $date->format('d M');
            
            $dailyRevenue = Main::where('status_pembayaran', 'lunas')
                ->whereDate('created_at', $date->format('Y-m-d'))
                ->sum('total_harga');
            
            $revenueData[] = $dailyRevenue;
        }

        // 8. Lapangan Terpopuler
        $popularCourts = Main::select('nomor_lapangan', DB::raw('count(*) as total'))
            ->groupBy('nomor_lapangan')
            ->orderByDesc('total')
            ->get();
        
        $courtLabels = [];
        $courtData = [];
        $courtColors = ['#4F46E5', '#10B981', '#F59E0B', '#3B82F6', '#EF4444'];
        $bgColors = [];
        $colorIdx = 0;
        
        foreach($popularCourts as $c) {
            $courtLabels[] = 'Lapangan ' . $c->nomor_lapangan;
            $courtData[] = $c->total;
            $bgColors[] = $courtColors[$colorIdx % count($courtColors)];
            $colorIdx++;
        }

        // Default jika belum ada booking sama sekali
        if (count($courtLabels) == 0) {
            $courtLabels = ['Belum ada data'];
            $courtData = [1];
            $bgColors = ['#E5E7EB'];
        }

        // 9. Booking Biasa
        $recentBookings = Main::with('user')->orderBy('created_at', 'desc')->get();

        return view('dashboardAdmin', compact(
            'totalUser',
            'totalBooking',
            'bookingHariIni',
            'lapanganTersedia',
            'pendapatanBulanIni',
            'jadwalAktif',
            'revenueLabels',
            'revenueData',
            'courtLabels',
            'courtData',
            'bgColors',
            'recentBookings'
        ));
    }

    public function bookings(Request $request)
    {
        $search = $request->input('search');
        $query = Main::with('user')->orderBy('created_at', 'desc');
        
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->whereHas('user', function($userQuery) use ($search) {
                    $userQuery->where('name', 'like', "%{$search}%");
                })->orWhere('nomor_lapangan', 'like', "%{$search}%")
                  ->orWhere('tanggal_main', 'like', "%{$search}%");
            });
        }
        
        $bookings = $query->paginate(20);
        
        return view('adminBookings', compact('bookings', 'search'));
    }

    public function users(Request $request)
    {
        $search = $request->input('search');
        $query = User::orderBy('name', 'asc');
        
        if ($search) {
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
        }
        
        $users = $query->paginate(20);
        
        return view('adminUsers', compact('users', 'search'));
    }

    public function destroyUser(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }
        
        $user->delete();
        return back()->with('success', 'User berhasil dihapus.');
    }

    public function confirmPayment(Main $main)
    {
        $main->update(['status_pembayaran' => 'lunas']);
        return back()->with('success', 'Pembayaran berhasil dikonfirmasi');
    }

    public function destroyBooking(Main $main)
    {
        $main->delete();
        return back()->with('success', 'Booking berhasil dihapus');
    }

    public function courts()
    {
        $courts = Court::with(['bookings' => function($q) {
            $q->orderBy('tanggal_main', 'asc')->orderBy('jam_mulai', 'asc');
        }])->get();
        return view('adminCourts', compact('courts'));
    }

    public function storeCourt(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price_per_hour' => 'required|numeric',
        ]);

        Court::create($request->all());
        return back()->with('success', 'Lapangan berhasil ditambahkan');
    }

    public function updateCourt(Request $request, Court $court)
    {
        $request->validate([
            'name' => 'required',
            'price_per_hour' => 'required|numeric',
        ]);

        $court->update($request->all());
        return back()->with('success', 'Lapangan berhasil diperbarui');
    }

    public function destroyCourt(Court $court)
    {
        $court->delete();
        return back()->with('success', 'Lapangan berhasil dihapus');
    }
}
