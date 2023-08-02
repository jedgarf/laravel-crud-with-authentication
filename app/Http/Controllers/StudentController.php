<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Students;
use DB;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('students')->get();
        return view('students/view')->with('students', json_decode($data, true));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('students/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Form validation
        $this->validate($request, [
          'first_name' => 'required|min:2|string',
          'last_name' => 'required|min:2|string',
          'course'=>'required|min:2|string',
          'email' => 'required|email|unique:students'
       ]);

        // Checking Duplicate First Name and Last Name
        $checkName = DB::table('students')->where(['first_name' => $request->first_name, 'last_name' => $request->last_name])->get();

        if (count(json_decode($checkName, true)) > 0) {
            return back()->with('student_save_msg', 'Your Student Name is already used.');
        }

        // get next increment id
        $id=DB::select("SHOW TABLE STATUS LIKE 'students'");
        $next_id=$id[0]->Auto_increment;

        //  Store data in database
        $data = new Students();
        $data->student_id = env('STUD_ID_CODE', 'STUD') . '-' . sprintf('%04d', $next_id);
        $data->first_name  = $request->first_name;
        $data->last_name = $request->last_name;
        $data->course = $request->course;
        $data->email   = $request->email;
        $data->save();
        
        // return back()->with('student_save_msg', 'Your form has been submitted.');
        return redirect('/admin/students')->with('student_save_msg', 'Your form has been submitted.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = DB::table('students')->where('id', $id)->get();
        return view('students/edit')->with('students', json_decode($data, true)[0]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Form validation
        $this->validate($request, [
          'first_name' => 'required|min:2|string',
          'last_name' => 'required|min:2|string',
          'course'=>'required|min:2|string',
          'email' => 'required|email|unique:students,email,' . $id
       ]);

        // Checking Duplicate First Name and Last Name
        $checkName = DB::table('students')->where('id', '<>', $id)->where(['first_name' => $request->first_name, 'last_name' => $request->last_name])->get();

        if (count(json_decode($checkName, true)) > 0) {
            return back()->with('student_save_msg', 'Your Student Name is already used.');
        }

        $student = Students::find($id);
        $student->first_name = $request->input('first_name');
        $student->last_name = $request->input('last_name');
        $student->course = $request->input('course');
        $student->email = $request->input('email');
        $student->update();

        // return back()->with('student_save_msg', 'Your form has been submitted.');
        return redirect('/admin/students')->with('student_save_msg', 'Your form has been submitted.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Students::find($id);

        if ($student->delete()) {
            return redirect('/admin/students')->with('student_save_msg', 'Your selected student has been removed.');
        } else {
            return redirect('/admin/students')->with('student_save_msg', 'Failed to remove student.');
        }

    }

    public function massdestroy($id)
    {

        $ids = explode(",", $id);

        print_r($ids);

        $student = DB::table('students')->whereIn('id', $ids);

        if ($student->delete()) {
            return redirect('/admin/students')->with('student_save_msg', 'Your selected student has been removed.');
        } else {
            return redirect('/admin/students')->with('student_save_msg', 'Failed to remove student.');
        }

    }
}
