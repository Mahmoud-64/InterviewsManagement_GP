<?php

namespace App\Http\Controllers;

use App\Job;
use Illuminate\Http\Request;
use App\Http\Resources\JobResource;
use App\Http\Repositories\Interfaces\JobRepositoryInterface;

class JobController extends Controller
{
    public function index(JobRepositoryInterface $jobRebo)
    {
        $jobs = $jobRebo->getAllProducts();
        
        return JobResource::collection($jobs);
    }
    public function show(Job $job)
    {
        return new JobResource($job);
    }

    public function store(Request $request)
    {
        $job = $request->only(['title', 'describtion','available','years_exp','seniority']);
        Job::create([
             'title'=> $job['title'],
             'description'=> $job['describtion'],
             'available'=> isset($job['available']) ? 1 : 0,
             'years_exp'=> $job['years_exp'],
             'seniority'=> $job['seniority']
         ]);
        return response()->json('job posted successful');
    }

    public function update(Job $job, Request $request)
    {
        $update_job = $request->only(['title', 'describtion','available','years_exp','seniority']);
        $job->update([
             'title'=> isset($update_job['title']) ? $update_job['title'] : $job->title ,
             'description'=> isset($update_job['describtion']) ? $update_job['describtion'] :$job->describtion,
             'available'=> isset($update_job['available']) ? $update_job['available'] : $job->available,
             'years_exp'=> isset($update_job['years_exp']) ? $update_job['years_exp'] :$job->years_exp ,
             'seniority'=> isset($update_job['seniority']) ? $update_job['seniority'] : $job->seniority,
         ]);
        return response()->json('job updated successful');
    }

    public function destroy(Job $job)
    {
        $job->delete();
        return response()->json('job deleted successful');
    }
}