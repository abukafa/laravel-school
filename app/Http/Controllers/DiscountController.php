<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Discount;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $discounts = Discount::selectRaw('DISTINCT ids, MAX(year) as year, MAX(name) as name, SUM(amount) as total')->groupBy('ids', 'name')->orderBy('year')->orderBy('name')->get();
        return view('payment.discount', [
            'title' => 'Data Potongan',
            'discounts' => $discounts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $saved = Discount::create($data);
    
        if ($saved) {
            return redirect("admin/potongan/{$saved->ids}")->with('success', 'Data berhasil disimpan');
        } else {
            return back()->with('danger', 'Data gagal disimpan');
        }
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function show($ids)
    {
        $discount = Discount::where('ids', $ids)->get() ?: [];
        // dd($discount);
        return view('payment.discountdetail', [
            'title' => 'Data Potongan',
            'items' => $discount,
            'students' => Student::all()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function edit(Discount $discount)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Discount $discount)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = Discount::destroy($id);
        if($deleted){
            return back()->with('success', 'Data berhasil dihapus');
        }else{
            return back()->with('danger', 'Data gagal dihapus');
        }
    }
}
