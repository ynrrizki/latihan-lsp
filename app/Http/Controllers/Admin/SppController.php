<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Spp;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SppController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $spps = Spp::all();
        $headers = ['ID', 'Tahun Ajaran', 'Nominal'];
        $data = [];

        foreach ($spps as $spp) {
            $data[] = [
                $spp->id,
                $spp->id,
                $spp->year,
                "Rp. " . number_format($spp->amount),
            ];
        }
        return view('pages.admin.spp.index', compact('headers', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        // dd($data);

        Spp::create($data);

        return redirect()->route('spp.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return response()->json(Spp::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->only(['year', 'amount']);
        $spp = Spp::findOrFail($id);
        $spp->update($data);
        return redirect()->route('spp.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $spp = Spp::findOrFail($id);
        $spp->delete();

        return redirect()->route('spp.index');
    }
}
