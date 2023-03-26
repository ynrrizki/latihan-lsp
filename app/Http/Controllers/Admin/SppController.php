<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Spp;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SppController extends Controller
{

    protected $spp;

    public function __construct(Spp $spp)
    {
        $this->spp = $spp;
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $spps = $this->spp->all();
        $headers = ['ID', 'Tahun Ajaran', 'Nominal'];
        $data = [];

        foreach ($spps as $spp) {
            $data[] = [
                $spp->id,
                $spp->id,
                Carbon::parse($spp->year)->format('Y'),
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

        $this->spp->create($data);

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
        return response()->json($this->spp->findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->only(['year', 'amount']);
        $spp = $this->spp->findOrFail($id);
        $spp->update($data);
        return redirect()->route('spp.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $spp = $this->spp->findOrFail($id);
        $spp->delete();

        return redirect()->route('spp.index');
    }
}
