<?php

namespace App\Services;

use App\Models\Course;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CourseService
{
    public function makeCourse($valedatedData)
    {
         $course = Course::create($valedatedData);
         $media = $course->addMediaFromRequest('image')->toMediaCollection('courses');
         return response()->json([$course], 201);
    }
    public function softDelete($id)
    {
         // Soft delete a package
         $course = Course::findOrFail($id);
         $course->delete();

         return response()->json(['message' => 'Course soft deleted successfully']);
    }



    public function search($search)
    {

    $courses = Course::where( function ($query) use ($search) {
        $query->where('name', 'LIKE', '%' . $search . '%')
              ->orWhere('id', 'LIKE', '%' . $search . '%');
    })->withTrashed()->paginate(10);
    return response()->json([$courses],201);
    }


}
