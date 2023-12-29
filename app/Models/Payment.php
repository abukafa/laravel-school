<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Payment extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function getPaymentByMonth($once = null, $month = null)
    {
        $query = $this->selectRaw('
                DATE_FORMAT(payments.date, "%Y-%m") as month_year,
                SUM(payments.amount) as total_payment
            ')
            ->join('billings', function ($join) {
                $join->on('payments.billing', 'LIKE', DB::raw('CONCAT("%", billings.name, "%", billings.year, "%")'));
            })
            ->groupBy('month_year')
            ->orderBy('month_year');

        if (!is_null($once)) {
            $query->whereRaw("billings.is_once = $once");
        }

        if (!is_null($month)) {
            $query->whereRaw("billings.is_monthly = $month");
        }

        return $query->get();
    }

    public function getMonthlyPaymentByMonth($year)
    {
        return $this->selectRaw('
                DATE_FORMAT(NOW() - INTERVAL (a.n + 12 * b.n) MONTH, "%b-%Y") AS month_year,
                COALESCE(SUM(CASE WHEN billing LIKE CONCAT("%", DATE_FORMAT(NOW() - INTERVAL (a.n + 12 * b.n) MONTH, "%b-%Y"), "%") THEN amount ELSE 0 END), 0) AS total
            ')
            ->crossJoin(DB::raw('(SELECT 0 AS n UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9 UNION ALL SELECT 10 UNION ALL SELECT 11) a'))
            ->crossJoin(DB::raw('(SELECT 0 AS n UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9 UNION ALL SELECT 10 UNION ALL SELECT 11) b'))
            ->where(DB::raw('DATE_FORMAT(NOW() - INTERVAL (a.n + 12 * b.n) MONTH, "%Y")'), '=', $year)
            ->groupBy('month_year')
            ->orderByRaw('STR_TO_DATE(CONCAT("01-", month_year), "%d-%b-%Y") ASC')
            ->get();
    }
}

