<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Job;

class BookmarkController extends Controller{

    public function index():View {
            $user = Auth::user();

            $bookmarks = $user->bookmarkedJobs()->orderBy('job_user_bookmarks.created_at', 'desc')->paginate(9);

            return view('jobs.bookmarked')->with('bookmarks', $bookmarks);
    }

    public function store(Job $job):RedirectResponse {
        $user = Auth::user();

        if($user->bookmarkedJobs()->where('job_id', $job->id)->exists()){
            return back()->with('error', 'Вакансия уже добавлена в избранное');

        }

        $user->bookmarkedJobs()->attach($job->id);

        return back()->with('success', 'Вакансия успешно добавлена в избранное');
    }

    public function destroy(Job $job):RedirectResponse {
        $user = Auth::user();

        if(!$user->bookmarkedJobs()->where('job_id', $job->id)->exists()){
            return back()->with('error', 'Вакансии нет в избранном');

        }

        $user->bookmarkedJobs()->detach($job->id);

        return back()->with('success', 'Вакансия была успешно удалена из избранного');
    }

        
}
    //
