<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use Illuminate\Http\Request;
use App\Models\Job;
use Illuminate\Http\RedirectResponse;
use App\Mail\JobApplied;
use Illuminate\Support\Facades\Mail;

class ApplicantController extends Controller{

    public function store(Request $request, Job $job): RedirectResponse {

        $existingApplication = Applicant::where('job_id', $job->id)->where('user_id', auth()->id())->exists();

        if($existingApplication){
            return redirect()->back()->with('error', 'Вы уже отравили резюме на эту вакансию');
        }

            $validatedData = $request->validate([
                'full_name' => 'required|string',
                'contact_phone' => 'string',
                'contact_email' => 'required|string|email',
                'message' => 'string',
                'location' => 'required|string',
                'resume' => 'required|file|mimes:pdf|max:2048',
            ]);


            if($request->hasFile('resume')){
                    $path = $request->file('resume')->store('resumes', 'public');
                    $validatedData['resume_path'] = $path;
            }

            $application = new Applicant($validatedData);
            $application->job_id = $job->id;
            $application->user_id = auth()->id();
            $application->save();

            //Send email
            Mail::to($job->user->email)->send(new JobApplied());

            return redirect()->back()->with('success', 'Ваше резюме успешно отправлено');
    }

    public function destroy($id): RedirectResponse{

            $applicant = Applicant::findOrFail($id);
            $applicant->delete();

            return redirect()->route('dashboard')->with('success', 'Резюме успешно удалено');

    }
    //
}
