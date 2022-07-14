<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Students;

class ApiController extends Controller
{
    public function create(Request $request)
    {
      $students = Students::create([
        'fname' => $request->fname,
        'lname' => $request->lname,
        'email' => $request->email,
        'password' => $request->password,
      ]);

      return response()->json($students);
    }

    public function displayStudentS(Request $request)
    {

      $dispstudents = Students::orderBy('created_at','desc')
                      //->where('fname','=', $request->fname)
                      ->get();

      return response()->json($dispstudents);
    }

    public function deleteStudents()
    {
      $maxid = Students::max('id');
      $snapped = Students::find($maxid);
      $snapped->delete();
      \DB::update("ALTER TABLE students AUTO_INCREMENT = ".$maxid);
      return response("entry no ".$maxid." has been deleted");
    }

    public function updateStudents(Request $request)
    {
      $Stupdate = Students::where('id',$request->id)->update([
                    'fname' => $request->fname,
                    'lname' => $request->lname,
                    'email' => $request->email,
                    'password' => $request->password]);
      return response()->json($Stupdate);
    }


}
