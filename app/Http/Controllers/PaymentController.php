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
            'dues_category_id' => 'required|exists:dues_categories,id',
            'nominal'          => 'required|numeric|min:1000',
        ]);

        $officerId = Auth::user()->officer?->id;

        $category = DuesCategory::findOrFail($request->dues_category_id);
        $memberId = $request->member_id;

        $existingPayment = Payment::where('member_id', $memberId)->first();
        if ($existingPayment && $existingPayment->period !== $category->period) {
            return back()->withErrors([
                'dues_category_id' => 'Warga ini sudah terdaftar dengan periode ' . $existingPayment->period . ', tidak bisa pilih periode lain.'
            ]);
        }

        $nominalTotal   = $request->nominal;
        $pricePerPeriod = $category->nominal;
        $qty            = ceil($nominalTotal / $pricePerPeriod);

        $period = strtolower($category->period);

        $lastPayment = Payment::where('member_id', $memberId)
            ->where('dues_category_id', $category->id)
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
                'officer_id'       => Auth::user()->officer->id ?? null,
                'dues_category_id' => $category->id,
                'period'           => $category->period,
                'nominal'          => $pricePerPeriod,
                'due_date'         => $storedDueDate,
                'payment_date'     => Carbon::now(),
                'periode_tagihan'  => $periodeTagihan,
            ]);
        }

        DuesMember::firstOrCreate([
            'iduser' => $request->member_id,
            'dues_category_id' => $request->dues_category_id,
        ]);

        return redirect()->route('payments.index')->with('success', 'Payment berhasil ditambahkan.');
    }
    public function detail($id)
    {
        $member = Member::findOrFail($id);
        $payments = Payment::with('duesCategory')->where('member_id', $id)->paginate(10)->sortBy(function($payment) {
                return $payment->due_date->format('Y') . str_pad($payment->due_date->format('m'), 2, '0', STR_PAD_LEFT);
            });
        $payments = Payment::with('duesCategory')->where('member_id', $id)->paginate(10);
        return view('Administrator.detail-payment', compact('member', 'payments'));
    }
    public function delete(String $id){
        $id = Crypt::decrypt($id);
        $member = Payment::findOrFail($id);
        $member->delete();
        return redirect()->back()->with('success', 'Pembayaran berhasil dihapus');
    }
}