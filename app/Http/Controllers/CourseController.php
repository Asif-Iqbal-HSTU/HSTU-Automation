<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Course;
use App\Models\TeacherCourse;

class CourseController extends Controller
{
    //
    public function add(): Response
    {
        //$departments = Department::all();
        //$faculties = Faculty::all();
        $user = User::find(session()->get('user'))->first();
        $user_email = $user->email;
        //dd($user_email);
        $courses = \App\Models\TeacherCourse::where('email', $user_email)->get();
        //dd($courses);
        return Inertia::render('Workspace', [
            'courses' => $courses,
        ]);
    }

    public function store(Request $request)
    {        
        $user = User::find(session()->get('user'))->first();
        //dd($user);
        //$user_email = $user->email;
        if ($user) {
            $user_email = $user->email;
            //dd($user_email); // This will display the email address
        } else {
            // Handle the case when the user is not found
            //dd("$user_email not found");
        }
        $course = Course::create([
            'CourseCode' => $request->CourseCode,
            'CourseTitle' => $request->CourseTitle,
            'Faculty' => $request->Faculty,
            'Degree' => $request->Degree,
            'Credit' => $request->Credit,
            'ContactHourPerWeek' => $request->ContactHourPerWeek,
            'Level' => $request->Level,
            'Semester' => $request->Semester,
            'AcademicSession' => $request->AcademicSession,
            'Type' => $request->Type,
            'Type_T_S' => $request->Type_T_S,
            'TotalMarks' => 50.0 * ($request->Credit),
            'Prerequisites' => $request->Prerequisites,
            'Summary' => $request->Summary,
        ]);

        $courseUser = TeacherCourse::create([
            'CourseCode' => $request->CourseCode,
            'email' => $user_email,
        ]);

        
        \Illuminate\Support\Facades\Session::put('CourseCode', $request->CourseCode);
        //return redirect()->back()->with('success', 'Course created successfully!'); 
        //return redirect(RouteServiceProvider::WORKSPACE);
        //return Inertia::render('UserAdding/UserAddSuccess');
        return redirect()->route('success');
    }

    public function success(): Response
    {
        //$departments = Department::all();
        //$faculties = Faculty::all();
        $courseCode = \Illuminate\Support\Facades\Session::get('CourseCode');
        //dd($courseCode);
        return Inertia::render('UserAdding/UserAddSuccess',[
            'courseCode' => $courseCode,
        ]);
    }

    public function setSyllabus($courseCode): Response {
        // Use $courseCode to perform actions, such as fetching data from the database or any other processing
        // Return a response or render a view as needed
        //dd($courseCode);
        return Inertia::render('Course/CourseObjective',[
            'courseCode' => $courseCode,
        ]);
    }
    
}
