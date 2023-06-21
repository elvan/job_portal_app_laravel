<?php

namespace App\Http\Controllers;

class MyJobApplicationController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User */
        $user = auth()->user();

        return view(
            'my_job_application.index',
            [
                'applications' => $user->jobApplications()
                    ->with([
                        'job' => fn ($query) => $query->withCount('jobApplications')
                            ->withAvg('jobApplications', 'expected_salary'),
                        'job.employer'
                    ])
                    ->latest()->get()
            ]
        );
    }

    public function destroy(string $id)
    {
        //
    }
}
