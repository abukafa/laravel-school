<?php

namespace App\Http\Controllers;

use App\Models\School;
use App\Models\Billing;
use App\Models\Payment;
use App\Models\Student;
use App\Models\Discount;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $invoices = Payment::select('invoice')
            ->selectRaw('MIN(date) AS date')
            ->selectRaw('MIN(name) AS name')
            ->selectRaw('COUNT(*) AS items')
            ->selectRaw('SUM(amount) AS total')
            ->groupBy('invoice')
            ->get();

        return view('payment.index', [
            'title' => 'Data Pembayaran',
            'payments' => $invoices
        ]);
    }

    public function detail($inv)
    {
        $billings = Billing::all();
        $students = Student::all();
        $total = 0;
        $items = Payment::where('invoice', $inv)->get();
        foreach ($items as $i) {
            $total += $i->amount;
        }
        return view('payment.detail', [
            'title' => 'Data Pembayaran',
            'invoice' => $inv,
            'total' => $total,
            'items' => $items,
            'billings' => $billings,
            'students' => $students
        ]);
    }

    public function preview($inv)
    {
        $school = School::first();
        $total = 0;
        $items = Payment::where('invoice', $inv)->get();
        foreach ($items as $i) {
            $total += $i->amount;
        }
        return view('payment.preview', [
            'title' => 'Data Pembayaran',
            'total' => $total,
            'items' => $items,
            'school' => $school
        ]);
    }

    public function rekapitulasi(Request $request)
    {
        $year = $request->query('year');
        $students = Student::all();
        $items = collect();
        foreach ($students as $student) {
            $payment = Payment::selectRaw(
                'SUM(CASE WHEN ids = ? AND is_once = ? THEN amount ELSE 0 END) AS once,
                SUM(CASE WHEN ids = ? AND is_monthly = ? THEN amount ELSE 0 END) AS month,
                SUM(CASE WHEN ids = ? AND is_monthly = ? AND is_once = ? THEN amount ELSE 0 END) AS year,
                SUM(CASE WHEN ids = ? AND billing LIKE ? THEN amount ELSE 0 END) AS total',
                [$student->id, 1, $student->id, 1, $student->id, 0, 0, $student->id, '%' . $year])->first();

            $items->push((object)[
                'ids' => $student->id,
                'nis' => $student->nis,
                'name' => $student->name,
                'category' => $student->payment_category,
                'once' => $payment->once,
                'month' => $payment->month,
                'year' => $payment->year,
                'total' => $payment->total,
            ]);
        }
        return view('payment.rekapitulasi', [
            'title' => 'Rekap Pembayaran',
            'items' => $items,
            'period' => $year
        ]);
    }

    public function rekap($ids, $year = NULL)
    {
        $school = School::first();
        $period = $year ?: $school->period;
        $student = Student::find($ids);
        $total = 0;
        $payments = Payment::where('ids', $ids)
            ->where('billing', 'LIKE', '%' . $period . '%')
            ->get();
        $billing = Billing::select('year', 'account', 'name', 'amount', 'is_once', 'is_monthly')
            ->where('year', $student->registered)
            ->where('category', $student->payment_category)
            ->get();

        $filteredDataBilling = collect($billing)->filter(function ($item) {
            return $item->is_once == false;
        })->values()->all();

        $dataBilling = ($year > $student->registered) ? $filteredDataBilling : $billing;

        $items = [];

        foreach ($dataBilling as $bill) {
            $date = '-';
            if ($bill->is_monthly == true) {
                $startMonth = strtotime('JULY ' . $period);
                $months = [];
                for ($i = 0; $i < 12; $i++) {
                    $month = date('M-Y', $startMonth);
                    $months[] = $month;
                    $startMonth = strtotime('+1 month', $startMonth);
                }

                foreach ($months as $remark) {
                    $billing = $bill->name . ' ' . $remark;
                    $ids = $payments->count() > 0 ? $payments[0]->ids : 0;
                    $discountData = Discount::select()->where('ids', $ids)->where('billing', $billing)->get();
                    $discount = $discountData->count() > 0 ? $discountData[0]->amount : 0;
                    $paid = 0;
                    $date = '-';
                    foreach ($payments as $key => $pay) {
                        if ($pay->billing == $billing) {
                            $paid += $pay->amount;
                            $date = $pay->date;
                        }
                    }
                    $items[] = [
                        'ids' => $student->id,
                        'name' => $student->name,
                        'account' => $bill->account,
                        'billing' => $billing,
                        'amount' => $bill->amount - $discount,
                        'paid' => $paid,
                        'date' => $date
                    ];
                }
            } else {
                $billing = $bill->name . ' ' . $period;
                $paid = 0;
                foreach ($payments as $key => $pay) {
                    if ($pay->billing == $billing) {
                        $paid += $pay->amount;
                        $date = $pay->date;
                    }
                }
                $items[] = [
                    'ids' => $student->id,
                    'nis' => $student->nis,
                    'name' => $student->name,
                    'account' => $bill->account,
                    'billing' => $billing,
                    'amount' => $bill->amount,
                    'paid' => $paid,
                    'date' => $date
                ];
            }
        }

        return view('payment.rekap', [
            'title' => 'Rekap Pembayaran',
            'items' => $items,
            'school' => $school
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $saved = Payment::create($data);
        if ($saved) {
            return redirect('/admin/pembayaran/inv/' . $saved->invoice)->with('success', 'Data berhasil disimpan');
        } else {
            return back()->with('danger', 'Data gagal disimpan');
        }
    }

    public function destroy($id)
    {
        $deleted = Payment::destroy($id);
        if ($deleted) {
            return back()->with('success', 'Data berhasil dihapus');
        } else {
            return back()->with('danger', 'Data gagal dihapus');
        }
    }

    public function confirm()
    {
        return view('payment.confirm', ['title' => 'Konfirmasi Pembayaran']);
    }
}
