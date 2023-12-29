<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function billings()
    {
        return $this->hasMany(Billing::class, ['year', 'payment_category'], ['registered', 'category']);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'ids', 'id');
    }
}

