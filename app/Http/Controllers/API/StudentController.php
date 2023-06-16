<?php

namespace App\Http\Controllers\API;
use App\Models\Student;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class StudentController extends Controller
{

    public function index()
    {
        $students = Student::all();
        return response()->json([
            'status' =>200,
            'students' => $students,
        ]);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:191',
            'email' => 'required|email|max:191',
            'phone' => 'required|min:10|max:10',
            'password' => 'required|min:8|max:16',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status' =>422,
                'errors' =>$validator->messages()
            ], 422);
        }
        else
        {
            $student = new Student;
            $student->name = $request->name;
            $student->email = $request->email;
            $student->phone = $request->phone;
            $student->password = $request->password;
            $student->save();

            return response()->json([
                'status' =>200,
                'message' =>'Student Created Successfully',
            ], 200);

        }
    }
    public function show($id)
    {
        $student = Student::find($id);

        if($student){
            return response()->json([
            'status' =>200,
            'student' => $student,
        ], 200);
        }
        else{
            return response()->json([
            'status' =>404,
            'student' => 'Id Not Found',
        ], 404);
        }
    }
    public function update(Request $request, $id)
    {
        $student = Student::find($id);
        if($student)
        {
            $student->name = $request->name;
            $student->email = $request->email;
            $student->phone = $request->phone;
            $student->password = $request->password;
            $student->update();

            return response()->json([
            'status' =>200,
            'message' =>'Student Updated Successfully',
        ], 200);
        }
        else{
            return response()->json([
            'status' =>404,
            'message' => 'Id Not Found',
        ], 404);
            
        }
    }
     public function edit($id)
    {
        $student = Student::find($id);
        if($student)
        {
            return response()->json([
            'status' =>200,
            'student' =>$student,
        ], 200);
        }
        else{
            return response()->json([
            'status' =>404,
            'message' => 'Student Not Found',
        ], 404);
            
        }
    }
    public function delete($id)
    {
        $student = Student::find($id);
        if($student)
        {
            $student->delete();
             return response()->json([
            'status' =>200,
            'message' => 'Student Deleted Successfully',
        ], 200);
        }
        else{
            return response()->json([
            'status' =>404,
            'message' => 'Student Not Found',
        ], 404);
            
        }
    }
}
