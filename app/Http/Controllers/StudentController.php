<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function index() {
        $students = Student::select('id', 'name', 'email', 'birthdate', 'city_id')->orderby('name')->paginate(4);
  
        return view('students.index', ['students' => $students]);
    }
    public function create() {
        $cities = \App\Models\City::all();
        return view('students.create', compact('cities'));
    }
    
    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:students',
            'birthdate' => 'required|date',
            'city_id' => 'required|exists:cities,id',
            'password' => 'required|string|min:6|max:20',
        ]);

        $student = new Student();
        $student->fill($request->all());
        $student->password = Hash::make($request->password);
        $student->save();

        return redirect(route('student.index'))->withSuccess('Étudiant créé avec succès');

    }
    public function show(Student $student) {
        return view('students.show', ['student' => $student]);
    }
    public function edit(Student $student) {
        $cities = \App\Models\City::all();
        return view('students.edit', ['student' => $student, 'cities' => $cities]);
    }
    public function update(Request $request, Student $student) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:students,email,' . $student->id,
            'birthdate' => 'required|date',
            'city_id' => 'required|exists:cities,id',
            'password' => 'nullable|string|min:6|max:20',
        ]);

        $student->fill($request->all());
        if ($request->filled('password')) {
            $student->password = Hash::make($request->password);
        }
        $student->save();

        return redirect(route('student.index'))->withSuccess('Étudiant mis à jour avec succès');
    }
    public function destroy(Student $student) {
        $student->delete();
        return redirect(route('student.index'))->withSuccess('Étudiant supprimé avec succès');
    }
}
