<?php

namespace App\Http\Controllers;

use App\Models\School;
use App\Models\Account;
use App\Models\Billing;
use App\Models\Payment;
use App\Models\Student;
use Illuminate\Http\Request;

class BillingController extends Controller
{
    public function index()
    {
        $invoices = Billing::select('year', 'category')
            ->selectRaw('SUM(CASE WHEN is_monthly = 0 THEN amount ELSE 0 END) AS yearly')
            ->selectRaw('SUM(CASE WHEN is_monthly = 1 THEN amount ELSE 0 END) AS monthly')
            ->groupBy('year', 'category')
            ->get();

        return view('payment.billing', [
            'title' => 'Data Tagihan',
            'billings' => $invoices
        ]);
    }

    public function preview($year = NULL, $category = NULL)
    {
        $school = School::first();
        $accounts = Account::all();
        $categories = Billing::select('category')->distinct()->orderBy('category')->get();
        $items = [];
        $total = 0;
        $current = $school->period;
        if ($year <> NULL) {
            $items = Billing::where('year', $year)->where('category', $category)->get();
            foreach ($items as $i) {
                $total += $i->amount;
            }
            $current = $year;
        }
        return view('payment.billingdetail', [
            'title' => 'Data Tagihan',
            'categories' => $categories,
            'items' => $items,
            'total' => $total,
            'year' => $current,
            'accounts' => $accounts
        ]);
    }

    public function show($id)
    {
        $billing = Billing::find($id);
        return response()->json([
            'billing' => $billing
        ]);
    }

    public function show_balance($id, $ids, $name)
    {
        // Find the billing record
        $billing = Billing::find($id);

        if ($billing) {
            // Calculate the balance using a subquery
            $payment = Payment::selectRaw('SUM(CASE WHEN ids = ? AND billing LIKE ? THEN amount ELSE 0 END) AS balance', [$ids, $name])->first();
            $balance = $billing->amount - $payment->balance;
            // Return the billing and payment data as JSON
            return response()->json([
                'billing' => $billing,
                'balance' => $balance,
                'is_once' => $billing->is_once,
                'is_monthly' => $billing->is_monthly
            ]);
        }

        // Handle the case where the billing record is not found
        return response()->json(['error' => 'Billing record not found'], 404);
    }


    public function save(Request $request)
    {
        $year = $request->input('year');
        $category = $request->input('category');
        $id = $request->input('id');
        $account = $request->input('account');
        $name = $request->input('name');
        $amount = $request->input('amount');
        $is_once = $request->input('is_once');
        $is_monthly = $request->input('is_monthly');

        $allSaved = true; // Initialize the $allSaved variable to true

        foreach ($account as $key => $item) {
            $data = [
                'year' => $year,
                'category' => $category,
                'account' => $account[$key],
                'name' => $name[$key],
                'amount' => $amount[$key],
                'is_once' => isset($is_once[$key]) ? $is_once[$key] : 0,
                'is_monthly' => isset($is_monthly[$key]) ? $is_monthly[$key] : 0,
            ];

            // Save each item into the database
            if ($id[$key] == 0) {
                $saved = Billing::create($data); // Use a separate variable to check if the save was successful
            } else {
                $billing = Billing::find($id[$key]);
                $saved = $billing->update($data); // Use a separate variable to check if the update was successful
            }

            $allSaved = $allSaved && $saved; // Combine the results using boolean AND
        }

        if ($allSaved) {
            return redirect('/admin/tagihan/' . $year . '/' . $category)->with('success', 'Data berhasil disimpan');
        } else {
            return back()->with('danger', 'Data gagal disimpan');
        }
    }

    public function delete_all($year, $category)
    {
        $deleted = Billing::where('year', $year)->where('category', $category)->delete();
        if ($deleted) {
            return back()->with('success', 'Data berhasil dihapus');
        } else {
            return back()->with('danger', 'Data gagal dihapus');
        }
    }

    public function billing_search($ids)
    {
        $school = School::first();
        $student = Student::find($ids);

        if (!$student) {
            return response()->json(['error' => 'Student not found'], 404);
        }

        $billing = Billing::select('id', 'year', 'account', 'name', 'amount', 'is_once', 'is_monthly')
            ->where('year', $student->registered)
            ->where('category', $student->payment_category)
            ->get();

        if ($billing->isEmpty()) {
            return response()->json(['error' => 'Billing data not found for the student'], 404);
        }
            
        $result = [];

        foreach ($billing as $value) {
            if ($value->is_once == 0){
                for ($p = $student->registered; $p <= $school->period; $p++) {
                    if ($value->is_monthly == 0) {
                        $result[] = [
                            'id' => $value->id,
                            'year' => $p,
                            'account' => $value->account,
                            'name' => $value->name . ' ' . $p,
                            'amount' => $value->amount,
                            'is_once' => $value->is_once,
                            'is_monthly' => $value->is_monthly
                        ];
                    } else {
                        $startMonth = strtotime('JULY ' . $p);
                        $months = [];
                        for ($i = 0; $i < 12; $i++) {
                            $month = date('M-Y', $startMonth);
                            $months[] = $month;
                            $startMonth = strtotime('+1 month', $startMonth);
                        }
                        foreach ($months as $remark) {
                            $result[] = [
                                'id' => $value->id,
                                'year' => $p,
                                'account' => $value->account,
                                'name' => $value->name . ' ' . $remark,
                                'amount' => $value->amount,
                                'is_once' => $value->is_once,
                                'is_monthly' => $value->is_monthly
                            ];
                        }
                    }
                }
            }else{
                $result[] = [
                    'id' => $value->id,
                    'year' => $student->registered,
                    'account' => $value->account,
                    'name' => $value->name . ' ' . $student->registered,
                    'amount' => $value->amount,
                    'is_once' => $value->is_once,
                    'is_monthly' => $value->is_monthly
                ];
            }
        }
        
        // Sort the entire result array by 'year'
        usort($result, function ($a, $b) {
            return $a['year'] - $b['year'];
        });
        
        return response()->json([
            'student' => $student,
            'billing' => $result
        ]);
    }
}
