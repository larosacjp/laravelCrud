<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;

class SubjectsController extends Controller
{
    public function createSubject(Request $request)
    {
      $request->validate([
                "name" => "required",
                "description" => "required"
            ]);

      $subject = Subject::create([
        'name' => $request->name,
        'description' => $request->description,
      ]);

      return response()->json($subject);

    }

    public function viewSubjects()
    {

      $subject = Subject::get();
      return response()->json($subject);

    }

    public function deleteSubject($name)
    {

      $subid = Subject::where('name', $name)->get();
      if($subid->isEmpty())
      {

        return response()->json([
                "errors" => [
                    "subject" => 0
                ],
                "message" => "Subject Not Found",
            ], 404);

      }else
      {

        Subject::where('name', $name)->delete();
        $deleteMessage = $name." subject has been deleted";
        return response()->json([
                "status" => 1,
                "message" => $deleteMessage,
            ], 200);

      }

    }

    public function updateSubject($name, Request $request)
    {
      $request->validate([
                "name" => "required",
                "description" => "required"
            ]);

      $SubUpdate = Subject::where('name',$request->name)->update([
                    'name' => $request->name,
                    'description' => $request->description]);
      if(!$SubUpdate)
      {
        return response()->json([
                "errors" => [
                    "subject" => 0
                ],
                "message" => "Subject not Updated",
            ], 404);
      }else
      {

        $updateMessage = $name."  subject successfully updated";
        return response()->json([
                "status" => 1,
                "message" => $updateMessage,
            ], 200);
            
      }

    }

}
