<?php

namespace App\Http\Controllers;

use App\Models\School;
use App\Models\Account;
use App\Models\Billing;
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
    
    public function preview($year=NULL, $category=NULL)
    {
        $school = School::first();
        $accounts = Account::all();
        $categories = Billing::select('category')->distinct()->orderBy('category')->get();
        $items = [];
        $total = 0;
        $current = $school->period;
        if ($year <> NULL) {
            $items = Billing::where('year', $year)->where('category', $category)->get();
            foreach($items as $i){ $total += $i->amount; }
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
    
    public function save(Request $request)
    {
        $year = $request->input('year');
        $category = $request->input('category');
        $id = $request->input('id');
        $account = $request->input('account');
        $name = $request->input('name');
        $amount = $request->input('amount');
        $is_monthly = $request->input('is_monthly');
    
        $allSaved = true; // Initialize the $allSaved variable to true
    
        foreach ($account as $key => $item) {
            $data = [
                'year' => $year,
                'category' => $category,
                'account' => $account[$key],
                'name' => $name[$key],
                'amount' => $amount[$key],
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

        $billing = Billing::select('id', 'account', 'name', 'amount', 'is_monthly')
            ->where('year', $school->period)
            ->where('category', $student->payment_category)
            ->get();

        $result = [];

        foreach ($billing as $value) {
            if ($value->is_monthly == true) {
                $startMonth = strtotime('JULY ' . $school->period);
                $months = [];
            for ($i = 0; $i < 12; $i++) {
                $month = date('M-Y', $startMonth);
                $months[] = $month;
                $startMonth = strtotime('+1 month', $startMonth);
            }

                foreach ($months as $remark) {
                    $result[] = [
                        'id' => $value->id, 
                        'account' => $value->account, 
                        'name' => $value->name . ' ' . $remark,
                        'amount' => $value->amount, 
                        'is_monthly' => true 
                    ];
                }
            } else {
                $result[] = [
                    'id' => $value->id, 
                    'account' => $value->account, 
                    'name' => $value->name . ' ' . $school->period,
                    'amount' => $value->amount, 
                    'is_monthly' => false 
                ];
            }
        }

        return response()->json([
            'student' => $student,
            'billing' => $result
        ]);
    }
}
