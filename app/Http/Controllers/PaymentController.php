<?php

namespace App\Http\Controllers;

use App\Models\DuesCategory;
use App\Models\DuesMember;
use App\Models\Member;
use App\Models\Officer;
use App\Models\Payment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class PaymentController extends Controller
{
    public function index()
    {
        $data['warga'] = Member::orderBy('created_at', 'desc')->paginate(10);;
        $data['user'] = User::paginate(10);
        return view('Administrator.payment', $data);
    }

    public function create()
    {
        $members = Member::all();
        $categories = DuesCategory::all();
        return view('Administrator.create-payment', compact('members', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'member_id'        => 'required|exists:members,id',
            'nominal'          => 'required|numeric|min:1000',
        ]);

        $officerId = Auth::user()->officer?->id;
        $member = Member::findOrFail($request->member_id);
        $category = DuesCategory::findOrFail($member->dues_category_id);
        $memberId = $request->member_id;

        $nominalTotal   = $request->nominal;
        $pricePerPeriod = $category->nominal;
        $qty            = ceil($nominalTotal / $pricePerPeriod);

        $period = strtolower($category->period);
        
        $lastPayment = Payment::where('member_id', $memberId)
            ->orderBy('due_date', 'desc')
            ->first();


        if (in_array($period, ['monthly', 'bulanan'])) {
            if ($lastPayment) {
                $dueDate = Carbon::parse($lastPayment->due_date)->addMonth();
            } else {
                $dueDate = Carbon::create(now()->year, 1, 1);
            }
        } elseif (in_array($period, ['yearly', 'tahunan'])) {
            if ($lastPayment) {
                $dueDate = Carbon::parse($lastPayment->due_date)->addYear();
            } else {
                $dueDate = Carbon::create(now()->year, 1, 1);
            }
        } elseif (in_array($period, ['weekly', 'mingguan'])) {
            if ($lastPayment) {
                $dueDate = Carbon::parse($lastPayment->due_date)->addWeek();
            } else {
                $dueDate = Carbon::create(now()->year, 1, 1)->startOfWeek();
            }
        } else {
            $dueDate = now();
        }

        for ($i = 0; $i < $qty; $i++) {
            $storedDueDate  = $dueDate->copy();
            $periodeTagihan = null;

            if (in_array($period, ['weekly', 'mingguan'])) {
                $periodeTagihan = 'Minggu ke-' . $storedDueDate->weekOfYear . ' ' . $storedDueDate->year;
                $dueDate->addWeek();
            } elseif (in_array($period, ['monthly', 'bulanan'])) {
                $periodeTagihan = $storedDueDate->translatedFormat('F Y');
                $dueDate->addMonth();
            } elseif (in_array($period, ['yearly', 'tahunan'])) {
                $periodeTagihan = 'Tahun ' . $storedDueDate->year;
                $dueDate->addYear();
            } else {
                $periodeTagihan = $storedDueDate->format('d-m-Y');
                $dueDate->addDay();
            }

            Payment::create([
                'member_id'        => $memberId,
                'officer_id'       => Auth::user()->officer->id,
                'period'           => $category->period,
                'nominal'          => $pricePerPeriod,
                'due_date'         => $storedDueDate,
                'payment_date'     => Carbon::now(),
                'periode_tagihan'  => $periodeTagihan,
            ]);
        }
        return redirect()->route('payments.detail', $memberId)->with('success', 'Payment berhasil ditambahkan.');
    }

    public function detail($id)
{
    $member = Member::findOrFail($id);
    $payment = Payment::findOrFail($id);

    $payments = Payment::where('member_id', $id)
        ->orderBy('due_date', 'desc')
        ->paginate(10);

    return view('Administrator.detail-payment', compact('member', 'payments', 'payment'));
}

    public function delete(String $id){
        $id = Crypt::decrypt($id);
        $member = Payment::findOrFail($id);
        $member->delete();
        return redirect()->back()->with('success', 'Pembayaran berhasil dihapus');
    }
}