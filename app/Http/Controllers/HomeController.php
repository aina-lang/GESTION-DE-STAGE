<?php

namespace App\Http\Controllers;

use App\Models\Partenaire;
use App\Models\Stage;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use PDF;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // main dashboard
    public function userProfile()
    {
        // Fetch the user profile data based on the ID
        // $user = User::find(Auth::user()->id);

        // Pass the user data to the view
        return view('dashboard.profile', );
    }
    public function index()
    {
        $studentCount = Student::count(); 
        $partnerCount = Partenaire::count();
        $stageCount = Stage::count();
        $supervisorCount = Teacher::count();
        
        return view('dashboard.home', compact('studentCount', 'partnerCount', 'stageCount', 'supervisorCount'));
    }
    // employee dashboard
    public function emDashboard()
    {
        $dt        = Carbon::now();
        $todayDate = $dt->toDayDateTimeString();
        return view('dashboard.emdashboard',compact('todayDate'));
    }

    public function generatePDF(Request $request)
    {
        // $data = ['title' => 'Welcome to ItSolutionStuff.com'];
        // $pdf = PDF::loadView('payroll.salaryview', $data);
        // return $pdf->download('text.pdf');
        // selecting PDF view
        $pdf = PDF::loadView('payroll.salaryview');
        // download pdf file
        return $pdf->download('pdfview.pdf');
    }
}
