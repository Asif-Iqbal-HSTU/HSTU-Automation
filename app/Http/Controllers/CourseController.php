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
use App\Models\CourseObjective;
use App\Models\CourseLearningOutcome;

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
        //return redirect()->route('success');
        return redirect()->back();
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

    public function courseView($courseCode): Response {
        $course = \App\Models\Course::where('CourseCode', $courseCode)->first();
        $courseTitle = $course->CourseTitle;
        return Inertia::render('Course/CourseView',[
            'courseCode' => $courseCode,
            'courseTitle' => $courseTitle, // Pass the courseTitle to the frontend
            'course' => $course,
        ]);
    }

    public function setSyllabus($courseCode): Response {
        // Use $courseCode to perform actions, such as fetching data from the database or any other processing
        // Return a response or render a view as needed
        //dd($courseCode);
        $courseObjectives = \App\Models\CourseObjective::where('CourseCode', $courseCode)->get();
        return Inertia::render('Course/CourseObjective',[
            'courseCode' => $courseCode,
            'courseObjectives' => $courseObjectives,
        ]);
    }

    public function storeCourseObjective(Request $request, $courseCode)
    {                
        $courseObjective = CourseObjective::create([
            'CourseCode' => $courseCode,
            'CO_ID' => $request->CO_ID,
            'CO_Description' => $request->CO_Description,
        ]);
        $courseObjectives = \App\Models\CourseObjective::where('CourseCode', $courseCode)->get();
        
        return Inertia::render('Course/CourseObjective',[
            'courseCode' => $courseCode,
            'courseObjectives' => $courseObjectives,
        ]);
        //return redirect()->back()->with('courseObjectives', $courseObjectives);
    }

    public function CLOPage($courseCode): Response {
        // Use $courseCode to perform actions, such as fetching data from the database or any other processing
        // Return a response or render a view as needed
        //dd($courseCode);
        $courseLearningOutcomes = \App\Models\CourseLearningOutcome::where('CourseCode', $courseCode)->get();
        return Inertia::render('Course/CourseLearningOutcome',[
            'courseCode' => $courseCode,
            'courseLearningOutcomes' => $courseLearningOutcomes,
        ]);
    }

    public function storeCourseLearningOutcome(Request $request, $courseCode)
    {                
        $courseLearningOutcome = CourseLearningOutcome::create([
            'CourseCode' => $courseCode,
            'CLO_ID' => $request->CLO_ID,
            'CLO_Description' => $request->CLO_Description,
        ]);
        $courseLearningOutcomes = \App\Models\CourseLearningOutcome::where('CourseCode', $courseCode)->get();
        
        return Inertia::render('Course/CourseLearningOutcome',[
            'courseCode' => $courseCode,
            'courseLearningOutcomes' => $courseLearningOutcomes,
        ]);
        //return redirect()->back()->with('courseObjectives', $courseObjectives);
    }

    public function PLOvsCLOPage($courseCode): Response {
        // Use $courseCode to perform actions, such as fetching data from the database or any other processing
        // Return a response or render a view as needed
        //dd($courseCode);
        
        $courseLearningOutcomes = \App\Models\CourseLearningOutcome::where('CourseCode', $courseCode)->get();
        
        $programLearningOutcomes = \App\Models\ProgramLearningOutcome::all();
        
        $PLOvsCLOs = \App\Models\PLOvsCLO::where('CourseCode', $courseCode)->get();
        return Inertia::render('Course/PLOvsCLO',[
            'courseCode' => $courseCode,
            'courseLearningOutcomes' => $courseLearningOutcomes,
            'programLearningOutcomes' => $programLearningOutcomes,
            
            'PLOvsCLOs' => $PLOvsCLOs,
        ]);
    }

    public function storePLOvsCLO(Request $request, $courseCode)
    {                
        $PLOvsCLO = \App\Models\PLOvsCLO::create([            
            'CourseCode' => $courseCode,
            'CLO_ID' => $request->CLO_ID,
            'PLO_No' => $request->PLO_No,
        ]);
        $PLOvsCLOs = \App\Models\PLOvsCLO::where('CourseCode', $courseCode)->get();
        $courseLearningOutcomes = \App\Models\CourseLearningOutcome::where('CourseCode', $courseCode)->get();
        
        $programLearningOutcomes = \App\Models\ProgramLearningOutcome::all();
        //dd($PLOvsCLOs);
        
        return Inertia::render('Course/PLOvsCLO',[
            'courseCode' => $courseCode,
            'courseLearningOutcomes' => $courseLearningOutcomes,
            'programLearningOutcomes' => $programLearningOutcomes,
            'PLOvsCLOs' => $PLOvsCLOs,
        ]);
        //return redirect()->back()->with('courseObjectives', $courseObjectives);
    }

    public function CourseContent(): Response
    {
        //$departments = Department::all();
        //$faculties = Faculty::all();
        //$courseCode = \Illuminate\Support\Facades\Session::get('CourseCode');
        //dd($courseCode);
        return Inertia::render('Course/CourseContent');
    }
    

    public function storeCourseContent(Request $request)
    {
        $validatedData = $request->validate([
            'content' => 'required|string',
            'teaching_strategy' => 'nullable|string',
            'assessment_strategy' => 'nullable|string',
        ]);

        // Create a new course content instance
        $courseContent = \App\Models\CourseContent::create([
            'content' => $validatedData['content'],
            'teaching_strategy' => $validatedData['teaching_strategy'] ?? null,
            'assessment_strategy' => $validatedData['assessment_strategy'] ?? null,
        ]);

        return redirect()->back()->with('success', 'Course content created successfully.');
    }
}
