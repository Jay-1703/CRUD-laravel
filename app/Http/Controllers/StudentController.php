<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    // ========== Show all student ===========
    public function showStudents(){
        $students = DB::table('students')->join('student_info','students.number',"=","student_info.id")->get();
        // return $students;
        return view('allStudents',['students'=>$students]);
    }
    // ========== Show student profile ===========

    public function oneStudent(string $id){
        $student = DB::table('students')->where('id',$id)->get();
        $student_info = DB::table('student_info')->where('id',$id)->get();
        $students = [];
        array_push($students,...$student);
        array_push($students,...$student_info);
        // return $students;
        if ($student) {
            return view('profile',['student'=>$student]);
        }
        else{
            return '<h1>Data show successfully !!</h1>';
        }
    }
    // ========== Insert student ===========

    public function addStudent(Request $req){
        $studnt = DB::table('students')->insert([
            'name'=>$req->name,
            'email'=>$req->email,
            'number'=>$req->number,
            'city'=>$req->city,
        ]);
        if($studnt) {
            return redirect()->route('home');
        }
        else{
            return '<h1>DATA NOT ADD SUCCESSFULLY !!</h1>';
        }
    }
    // ========== Delete student ===========

    public function deleteStudent(string $id){
        $student = DB::table('student_info')->where('id',$id)->delete();
        if ($student) {
            return redirect()->route('home');
        }
        else{
            return '<h1>Data not delete successfully !!</h1>';
        }
    }
    // ========== Update student ===========

    public function updateStudent(Request $req,$id){
       $student = DB::table('students')->where('id',$id)->update([
            'name'=>$req->name,
            'email'=>$req->email,
            'number'=>$req->number,
            'city'=>$req->city,
       ]);
       if ($student) {
            return redirect()->route('home');
       }
       else {
            return '<h1>Data not update successfully !!</h1>';
        }
    }
    public function updatePage(string $id){
        $student = DB::table('students')->find($id);
        return view('updateStudent',['student'=>$student]);
    }
}