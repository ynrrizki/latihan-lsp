<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentRequest;
use App\Models\Payment;
use App\Models\Spp;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    protected $payments;
    public function __construct(Payment $payments)
    {
        $this->$payments = $payments;
    }
    public function index()
    {
        $payments = Payment::with(['operator', 'student', 'spp'])->get();
        $spps = Spp::all();
        $students = Student::with(['user', 'stdClass', 'stdClass.major'])->get();
        $headers = ['ID', 'NISN', 'Tahun SPP', 'Nominal SPP', 'Tanggal Bayar', 'Jumlah Bayar'];
        $data = [];

        // return response()->json($payments);
        foreach ($payments as $payment) {
            $data[] = [
                $payment->id,
                $payment->id,
                $payment->student->nisn,
                $payment->spp->year,
                "Rp. " . number_format($payment->spp->amount),
                $payment->pay_on,
                "Rp. " . number_format($payment->total),
            ];
        }

        return view('pages.operator.index', compact('headers', 'data', 'spps', 'students'));
    }

    public function show(Request $request)
    {
        // dd(decrypt($request->id));
        // dd($id);
        // if (auth()->user()->role == 'STUDENT') {
        //     $student = Student::where('user_id', auth()->user()->id)->first();
        //     $id = $student->nisn;
        // }
        $student = Student::where('user_id', decrypt($request->id))->first();
        $id = $student->nisn;
        // return response()->json($student);
        $payments = Payment::with(['operator', 'student', 'spp'])->where('nisn', $id)->get();
        // return response()->json($payments);
        $headers = ['ID', 'NISN', 'Tahun SPP', 'Nominal SPP', 'Tanggal Bayar', 'Jumlah Bayar'];
        $data = [];

        // return response()->json($payments);
        foreach ($payments as $payment) {
            $data[] = [
                $payment->id,
                $payment->id,
                $payment->student->nisn,
                $payment->spp->year,
                "Rp. " . number_format($payment->spp->amount),
                $payment->pay_on,
                "Rp. " . number_format($payment->total),
            ];
        }

        return view('pages.student.index', compact('headers', 'data'));
    }

    public function create()
    {
        //
    }

    public function edit(Request $request, $id)
    {
        //
    }

    public function store(PaymentRequest $request)
    {
        $notif = [];
        $data = $request->only(['nisn', 'pay_on', 'spp_id', 'total']);
        $spp = Spp::findOrFail($data['spp_id']);
        $data['user_id'] = auth()->user()->id;

        if ($data['total'] >= $spp->amount) {
            Payment::create($data);
            $notif['notif'] = 'notif-success';
            $notif['message'] = 'Bayaran SPP tahun ' . $spp->year . ' lunas!!';
        } else {
            $notif['notif'] = 'notif-failed';
            $notif['message'] = 'Bayaran SPP tahun ' . $spp->year . ' masih kurang!!';
        }

        return redirect()->route('payment.index')->with($notif['notif'], $notif['message']);
    }

    public function destroy($id)
    {
        $notif = [];
        $payment = Payment::findOrFail($id);
        $delete = $payment->delete();
        if ($delete) {
            $notif['notif'] = 'notif-success';
            $notif['message'] = 'Data berhasil dihapus';
        } else {
            $notif['notif'] = 'notif-failed';
            $notif['message'] = 'Data gagal dihapus';
        }

        return redirect()->route('payment.index')->with($notif['notif'], $notif['message']);
    }
}
