<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentRequest;
use App\Models\StdClass;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with(['student', 'student.stdClass', 'student.stdClass.major'])->where('role', 'STUDENT')->get();
        // $student = Student::with(['stdClass'])->get();
        $classes = StdClass::with('major')->get();
        $headers = ['name', 'email', 'username', 'class'];
        $data = [];

        // dd(User::with(['student', 'student.stdClass', 'student.stdClass.major'])->where('role', 'STUDENT')->get());

        // dd($student);
        foreach ($users as $user) {
            $data[] = [
                $user->id,
                $user->name,
                $user->email,
                $user->username,
                $user->student->stdClass->name . " " . $user->student->stdClass->major->name
            ];
        }

        return view('pages.admin.student.index', compact('headers', 'data', 'classes'));
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
    public function store(StudentRequest $request)
    {
        $user = $request->only([
            "name",
            "email",
            "username",
            "password",
        ]);

        $student = $request->only([
            "nisn",
            "nis",
            "std_class_id",
            "address",
            "phone",
        ]);

        $user['password'] = bcrypt($user['password']);

        $user = User::create($user);

        $student['user_id'] = $user->id;

        Student::create($student);

        return redirect()->route('student.index');
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
        return response()->json(User::with('student')->findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = $request->only([
            "name",
            "email",
            "username",
            "password",
        ]);

        $student = $request->only([
            "nisn",
            "nis",
            "std_class_id",
            "address",
            "phone",
        ]);

        $data = User::findOrFail($id);

        if ($request->has('passowrd')) {
            $user['password'] = bcrypt($user['password']);
        } else {
            unset($user['password']);
        }

        // dd($user);
        $data->update($user);
        // dd($student);
        Student::where('user_id', $id)->update($student);

        return redirect()->route('student.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $student = Student::where('user_id', $id);
        $user->delete();
        $student->delete();

        return redirect()->route('student.index');
    }
}
