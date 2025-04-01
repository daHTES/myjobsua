<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Job;

class DashboardController extends Controller{

        public function index(): View{

            $user = Auth::user();
            $jobs = Job::where('user_id', $user->id)->with('applicants')->get();
            
            return view('dashboard.index', compact('user', 'jobs'));

        }
    

}
