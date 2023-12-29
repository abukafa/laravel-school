<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Finance extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function getFinanceByMonth($account = null)
    {
        $query = $this->selectRaw('
                DATE_FORMAT(date, "%Y-%m") as month_year,
                SUM(amount) as total_finance
                ')
            ->groupBy('month_year')
            ->orderBy('month_year');

        if (!is_null($account)) {
            $query->whereRaw("LEFT(account, 2) = $account");
        }

        return $query->get();
    }
}
