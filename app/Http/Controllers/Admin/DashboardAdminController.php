<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\StdClass;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardAdminController extends Controller
{
    public function index(Request $request)
    {
        $counts = [
            'admin' => User::where('role', 'ADMIN')->count(),
            'operator' => User::where('role', 'OPERATOR')->count(),
            'class' => StdClass::all()->count(),
        ];

        // ambil input tahun dari request
        $year = $request->input('filterByYear') ?? date('Y');

        // generate array bulan dalam setahun
        $months = [
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        ];

        // query data pembayaran spp untuk setiap bulan dalam setahun
        $payments = [];
        foreach ($months as $m => $label) {
            $payments[$label] = Payment::whereYear('pay_on', $year)
                ->whereMonth('pay_on', $m)
                ->sum('total');
        }

        return view('pages.admin.index', compact('counts', 'payments'));
    }
}
