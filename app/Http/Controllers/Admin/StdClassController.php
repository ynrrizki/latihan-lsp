<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StdClassRequest;
use App\Models\Major;
use App\Models\StdClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StdClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classes = StdClass::with('major')->orderBy('name', 'DESC')->get();
        $majors = Major::all();

        $headers = ['Nama', 'Jurusan'];
        $data = [];

        foreach ($classes as $class) {
            $data[] = [
                $class->id,
                $class->name,
                $class->major->name,
            ];
        }

        return view('pages.admin.class.index', compact('headers', 'data', 'majors'));
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
    public function store(StdClassRequest $request)
    {
        $data = $request->only(['name', 'major_id']);

        StdClass::create($data);

        return redirect()->route('class.index');
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
        return response()->json(StdClass::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = StdClass::findOrFail($id);
        $data->delete();
        return redirect()->route('class.index');
    }
}
