<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class OperatorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $operators = User::where('role', 'OPERATOR')->get();
        $users = User::where('role', 'OPERATOR')->get();
        $headers = ['nama', 'email', 'username'];
        $data = [];

        foreach ($users as $user) {
            $data[] = [
                $user->id,
                $user->name,
                $user->email,
                $user->username,
            ];
        }
        return view('pages.admin.operator.index', compact('headers', 'data'));
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
        $data = $request->only(['name', 'email', 'username', 'password']);
        $data['password'] = bcrypt($data['password']);
        $data['role'] = 'OPERATOR';
        // dd($data);
        User::create($data);
        return redirect()->route('operator.index');
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
        $user = User::findOrFail($id);

        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->only(['name', 'email', 'username', 'password']);

        $user = User::findOrFail($id);

        if ($request->has('password')) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()->route('operator.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
