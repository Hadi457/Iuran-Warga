<?php

namespace App\Http\Controllers;

use App\Models\DuesMember;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DuesMemberController extends Controller
{
    public function index()
    {
            {
        $currentYear = Carbon::now()->year;
        $anggotaiuran = DuesMember::with(['member', 'duesCategory'])->paginate(10);
        $anggotaiuran->transform(function ($dm) use ($currentYear) {
            $periodRaw = strtolower($dm->duesCategory->period ?? '');

            if (in_array($periodRaw, ['mingguan', 'weekly'])) {
                $total = 52;
                $unit = 'minggu';
            } elseif (in_array($periodRaw, ['bulanan', 'monthly'])) {
                $total = 12;
                $unit = 'bulan';
            } elseif (in_array($periodRaw, ['tahunan', 'yearly'])) {
                $total = 1;
                $unit = 'tahun';
            } else {
                $total = 0;
                $unit = '';
            }
            $paidCount = Payment::where('member_id', $dm->iduser)
                ->where('dues_category_id', $dm->dues_category_id)
                ->whereYear('due_date', $currentYear)
                ->count();
            $remaining = max(0, $total - $paidCount);
            $dm->sisa_periode = $remaining . ($unit ? ' ' . $unit : '');
            $dm->sudah_bayar = $paidCount;
            $dm->total_periode = $total;

            return $dm;
        });
        return view('Administrator.anggota-iuran', ['anggotaiuran' => $anggotaiuran]);
}
}
}
