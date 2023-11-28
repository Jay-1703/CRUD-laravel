<?php

use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('allStudents');
});

Route::view('newstudent', 'newStudent');

Route::controller(StudentController::class)->group(function () {
    Route::get('/','showStudents')->name('home');
    Route::post('/add','addStudent')->name('addstudent');
    Route::get('/delete/{id}','deleteStudent')->name('deleteStudent');
    Route::put('/update/{id}','updateStudent')->name('updateStudent');
    Route::get('/updatestudent/{id}','updatePage')->name('updatePage');
    Route::get('/students/{id}','oneStudent')->name('student');
});
