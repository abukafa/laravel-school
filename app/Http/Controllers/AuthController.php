<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\School;
use App\Models\Billing;
use App\Models\Finance;
use App\Models\Payment;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function home2()
    {
        return view('auth.home2', ['title' => 'Beranda Akademis']);
    }

    public function home1()
    {
        // data Total per akun
        $total = Finance::selectRaw(
            'SUM(CASE WHEN LEFT(account, 2) = "22" THEN amount ELSE 0 END) as masuk, ' .
            'SUM(CASE WHEN LEFT(account, 2) = "33" THEN amount ELSE 0 END) as keluar'
        )->first();
        $total->bayar = Payment::whereRaw("LEFT(account, 2) = '11'")->sum('amount');

        // data Sub Total per Bulan
        $paymentByMonth = (new Payment())->getPaymentByMonth()->pluck('total_payment')->toArray();
        $financeInByMonth = (new Finance())->getFinanceByMonth('22')->pluck('total_finance')->toArray();
        // $monthlyPaymentByMonth = (new Payment())->getMonthlyPaymentByMonth(date(app('periode')))->toArray();
        $monthlyPaymentByMonth = [];
        $myMonth = ['Jul-', 'Aug-', 'Sep-', 'Oct-', 'Nov-', 'Dec-', 'Jan-', 'Feb-', 'Mar-', 'Apr-', 'May-', 'Jun-'];
        for($i=0; $i<count($myMonth); $i++){
            $bulan = $myMonth[$i] . (($i<6) ? app('periode') : app('periode') +1);
            $monthlyPaymentByMonth[$i] = ['month_year' => $bulan];
            $amount = Payment::selectRaw('SUBSTRING_INDEX(billing, " ", 1) AS billing_group, SUM(amount) as totalPayment')
                ->where('billing', 'like', '%' . $bulan . '%')
                ->groupBy('billing_group')
                ->get();
            // SYNTAX UMUM ==========================
            // foreach ($amount as $item) {
            //     $billing_group = $item['billing_group'];
            //     $totalPayment = $item['totalPayment'];
            //     $monthlyPaymentByMonth[$i][$billing_group] = $totalPayment;
            // }
            // KHUSUS ARM ==========================
            if ($amount->count() > 0) {
                $monthlyPaymentByMonth[$i]['Syahriyah'] = $amount->where('billing_group', 'SPP')->first()['totalPayment'] ? $amount->where('billing_group', 'SPP')->first()['totalPayment'] + $amount->where('billing_group', 'Asrama')->first()['totalPayment'] : 0;
                $monthlyPaymentByMonth[$i]['Makan'] = $amount->where('billing_group', 'Makan')->first()['totalPayment'] ?? 0;
            } else {
                $monthlyPaymentByMonth[$i]['Syahriyah'] = 0;
                $monthlyPaymentByMonth[$i]['Makan'] = 0;
            }
        }

        // data gabungan - History input
        $history = Payment::select('date', 'account', 'name', 'billing')
            ->union(Finance::select('date', 'account', 'description as name', 'amount as billing'))
            ->latest('date')->take(10)->get()->toArray();

        // data progres payment
        $students = DB::table('students')
            ->select('id', 'name', 'registered', 'payment_category', 'image')
            ->get();

        $studentPayment = [];
        $total_bill_once = 0;
        $total_bill_monthly = 0;
        $total_bill_yearly = 0;
        $total_pay_once = 0;
        $total_pay_monthly = 0;
        $total_pay_yearly = 0;

        foreach ($students as $student) {
            $billingData = DB::table('billings')
                ->select(
                    DB::raw('SUM(CASE WHEN is_once = 1 THEN amount ELSE 0 END) AS once'),
                    DB::raw('SUM(CASE WHEN is_monthly = 1 THEN amount ELSE 0 END) AS monthly'),
                    DB::raw('SUM(CASE WHEN is_monthly = 0 AND is_once = 0 THEN amount ELSE 0 END) AS yearly')
                )
                ->where('year', $student->registered)
                ->where('category', $student->payment_category)
                ->first();

            $paymentData = DB::table('payments')
                ->select(
                    DB::raw('SUM(CASE WHEN is_once = 1 THEN amount ELSE 0 END) AS once'),
                    DB::raw('SUM(CASE WHEN is_monthly = 1 THEN amount ELSE 0 END) AS monthly'),
                    DB::raw('SUM(CASE WHEN is_monthly = 0 AND is_once = 0 THEN amount ELSE 0 END) AS yearly')
                )
                ->where('ids', $student->id)
                ->first();

            // Menghitung Bulan
            // $bulanAwal = "July " . session('school.period');
            // $dateTimeAwal = DateTime::createFromFormat('F Y', $bulanAwal);
            // $dateTimeSekarang = new DateTime();
            // $interval = $dateTimeAwal->diff($dateTimeSekarang);
            // $jumlahBulan = ($interval->y * 12) + $interval->m +1;
            $jumlahBulan = 12 - app('sisaBulanDalamPeriode');
            $billingMonthly = $billingData->monthly * $jumlahBulan;

            $totalBillingData = $billingData->once + $billingData->monthly + $billingData->yearly;
            if ($totalBillingData > 0){
                $studentPayment[] = [
                    'id' => $student->id,
                    'name' => $student->name,
                    'image' => $student->image,
                    'registered' => $student->registered,
                    'once_percent' => $billingData->once != 0 ? round(($paymentData->once / $billingData->once) * 100, 0) : 0,
                    'monthly_percent' => $billingMonthly != 0 ? round(($paymentData->monthly / $billingMonthly) * 100, 0) : 0,
                    'yearly_percent' => $billingData->yearly != 0 ? round(($paymentData->yearly / $billingData->yearly) * 100, 0) : 0,
                ];
            }

            // Update total billing and total payment
            $total_bill_once += $billingData->once;
            $total_bill_monthly += $billingMonthly;
            $total_bill_yearly += $billingData->yearly;
            $total_pay_once += $paymentData->once;
            $total_pay_monthly += $paymentData->monthly;
            $total_pay_yearly += $paymentData->yearly;
        }

        // Calculate percentages for total billing and total payment
        $total_once_percent = $total_bill_once != 0 ? round($total_pay_once / $total_bill_once * 100, 0) : 0;
        $total_monthly_percent = $total_bill_monthly != 0 ? round($total_pay_monthly / $total_bill_monthly * 100, 0) : 0;
        $total_yearly_percent = $total_bill_yearly != 0 ? round($total_pay_yearly / $total_bill_yearly * 100, 0) : 0;

        $payWait['year'] = 0;
        $payWait['month'] = 0;
        foreach ($studentPayment as $item){
            if ($item['yearly_percent'] < 100){
                $payWait['year'] += 1;
            }
            if ($item['monthly_percent'] < 100 && $item['registered'] <= app('periode')){
                $payWait['month'] += 1;
            }
        }

        // Mendapatkan tanggal awal & akhir
        $today = date('Y-m-d');
        $lastDayOfMonth = date('Y-m-t');

        $totalPayment = [
            'once_percent' => $total_once_percent,
            'monthly_percent' => $total_monthly_percent,
            'yearly_percent' => $total_yearly_percent,
            'monthly_person' => $payWait['month'],
            'yearly_person' => $payWait['year'],
            'remainingDays' => intval((strtotime($lastDayOfMonth) - strtotime($today)) / (60 * 60 * 24)),
            'remainingMonths' => 12 - date('n'),
        ];

        // data alokasi
        $billings = Billing::select('account', 'name')
            ->groupBy('account', 'name')
            ->get();
        $alokasi = [];
        foreach ($billings as $item){
            $paymentData = DB::table('payments')->select(
                DB::raw('SUM(CASE WHEN MID(account,3,2) = MID(' . $item->account . ',3,2) THEN amount ELSE 0 END) AS amount')
            )->first();

            $financeData = DB::table('finances')->select(
                DB::raw('SUM(CASE WHEN MID(account,3,2) = MID(' . $item->account . ',3,2) THEN amount ELSE 0 END) AS amount')
            )->first();

            $alokasi[] = [
                'account' => $item->account,
                'remark' => $item->name,
                'payment' => $paymentData->amount,
                'finance' => $financeData->amount,
                'balance' => $paymentData->amount - $financeData->amount
            ];
        }

        $financeDistnc = Finance::select('invoice')
            ->selectRaw('MIN(date) AS date')
            ->selectRaw('MIN(remark) AS remark')
            ->selectRaw('COUNT(*) AS items')
            ->selectRaw('SUM(amount) AS total')
            ->whereRaw("LEFT(account, 2) = '22'")  // Koreksi pada bagian WHERE
            ->groupBy('invoice')
            ->get();


        return view('auth.home1', [
            'title' => 'Beranda Keuangan',
            'total' => $total,
            'paymentByMonth' => $paymentByMonth,
            'financeInByMonth' => $financeInByMonth,
            'monthlyPaymentByMonth' => $monthlyPaymentByMonth,
            'history' => $history,
            'studentPayment' => $studentPayment,
            'totalPayment' => $totalPayment,
            'payments' => Payment::all(),
            'finances' => $financeDistnc,
            'alokasi' => $alokasi

        ]);
    }

    public function index()
    {
        return view('auth.login', [
            'title' => 'Login',
            'school' => School::first()
        ]);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $school = School::first();
            $role = ($user->role == 5 ? 'Maintainer' : ($user->role == 4 ? 'Auditor' : ($user->role == 3 ? 'Supervisor' : ($user->role == 2 ? 'Administrator' : 'User'))));
            session()->put('user', $user);
            session()->put('rolename', $role);
            session()->put('school', $school);
            return redirect()->intended('/');
        }
        return back()->with('loginError', 'Login failed!');
    }

    public function lockscreen()
    {
        return view('auth.lockscreen', ['title' => 'Kunci Layar']);
    }

    public function unlockscreen(Request $request)
    {
        $request->validate([
            'password' => 'required',
        ]);

        if (Auth::attempt(['username' => Auth::user()->username, 'password' => $request->password])) {
            $request->session()->forget('lockscreen');
            $user = Auth::user();
            $school = School::first();
            $role = ($user->role == 5 ? 'Maintainer' : ($user->role == 4 ? 'Auditor' : ($user->role == 3 ? 'Supervisor' : ($user->role == 2 ? 'Administrator' : 'User'))));
            session()->put('user', $user);
            session()->put('rolename', $role);
            session()->put('school', $school);
            return redirect('/home');
        } else {
            return back()->with('loginError', 'Login failed!');
        }
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/login');
    }
}
