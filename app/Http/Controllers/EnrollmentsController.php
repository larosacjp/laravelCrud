<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enrollments;
use App\Models\Students;
use App\Models\Subject;

class EnrollmentsController extends Controller
{
    public function createEnrollment(Request $request)
    {

      $request->validate([
                "fname" => "required",
                "lname" => "required",
                "subject" => "required"
            ]);

      $student = Students::where(['fname'=>$request->fname, 'lname'=>$request->lname])->first();
      if($student === null)
      {
        return response()->json([
                "errors" => [
                    "student" => 0
                ],
                "message" => "Student does not exist",
            ], 404);
      }else
      {
        $subject = Subject::where('name', $request->subject)->first();
        if($subject === null)
        {

          return response()->json([
                  "errors" => [
                      "subject" => 0
                  ],
                  "message" => "Subject does not exist",
              ], 404);

        }else
        {
          $nonduplicate = Enrollments::where(['student_id'=> $student->id, 'subject_id' =>$subject->id])->get();

          if($nonduplicate->isNotEmpty())
          {
            return response()->json([
                    "errors" => [
                        "enrollment" => 0
                    ],
                    "message" => "Student is already enrolled",
                ], 404);

          }else
          {
            $enrollment = Enrollments::create([
              'student_id' => $student->id,
              'subject_id' => $subject->id,
            ]);

            if(!$enrollment)
            {

              return response()->json([
                      "errors" => [
                          "enrollment" => 0
                      ],
                      "message" => "Student unable to enroll",
                  ], 404);

            }else
            {

              return response()->json([
                      "status" => 1,
                      "message" => "Student Enrolled",
                  ], 200);

            }
          }
        }
      }
    }

    public function viewEnrollments($id)
    {
      $enrollments = \DB::table('enrollments')
                      ->join('students', 'enrollments.student_id', '=', 'students.id')
                      ->join('subjects', 'enrollments.subject_id', '=', 'subjects.id')
                      ->select('students.fname', 'students.lname', 'subjects.name')
                      ->where('student_id', $id)
                      ->get();
      if($enrollments === null)
      {
        return response()->json([
                "errors" => [
                    "enrollment" => 0
                ],
                "message" => "Student has no enrollments",
            ], 404);
      }else
      {
        return response()->json([
                "status" => 1,
                "message" => "Student is Enrolled to Subjects",
                "enrollments"=> $enrollments,
            ], 200);
      }
    }

}
