<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class CustomServiceProvider extends ServiceProvider
{
    protected $bulanIni;
    protected $tahunIni;

    public function __construct($app)
    {
        parent::__construct($app);

        $this->bulanIni = date('n');
        $this->tahunIni = date('Y');
    }

    public function register()
    {
        // Register your bindings here
        $this->app->singleton('generateInitials', function ($app) {
            return function ($name) {
                $words = explode(' ', $name);
                $initials = '';

                foreach ($words as $word) {
                    $initials .= strtoupper(substr($word, 0, 1));
                }

                return $initials;
            };
        });
    }

    public function boot()
    {
        // Set variabel global periode
        $this->app->singleton('periode', function ($app) {
            return ($this->bulanIni >= 7) ? $this->tahunIni : ($this->tahunIni - 1);
        });

        // Fungsi untuk menghitung sisa bulan dalam periode ini
        $this->app->singleton('sisaBulanDalamPeriode', function ($app) {
            $bulanAwalPeriode = 6;  // Juni

            if ($this->bulanIni < $bulanAwalPeriode) {
                return $bulanAwalPeriode - $this->bulanIni;
            } elseif ($this->bulanIni > $bulanAwalPeriode) {
                return 12 - ($this->bulanIni - $bulanAwalPeriode);
            } else {
                return 0;
            }
        });

        // Fungsi untuk menghitung sisa hari dalam bulan ini
        $this->app->singleton('sisaHariDalamBulan', function ($app) {
            $jumlahHariDalamBulan = cal_days_in_month(CAL_GREGORIAN, $this->bulanIni, $this->tahunIni);
            return $jumlahHariDalamBulan - date('j');
        });
    }
}
