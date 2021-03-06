<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function allJobs() {
        $jobs = Job::with(['tags','category','company'])->get();
        // dd($jobs);
        // return response()->json(['title' => 'full stack']);
        return response()->json($jobs);

    }

    public function show($slug) {
        $job = Job::where('slug',$slug)->first();

        return response()->json($job);
    }

    public function filterJobs(Request $request) {
        $jobs = Job::with(['tags','category','company'])
        ->when($request->query,  function($q) {
            $q->where('title','LIKE','%'.request('query').'%');
        })
        ->when($request->category, function($q) {
            $q->where('category_id', request('category'));
        })
        ->when($request->location, function($q) {
            $q->where('location', request('location'));
        })
        ->when($request->level, function($q) {
            $q->where('level', request('level'));
        });

        $jobs = $jobs->get();

        return response()->json($jobs);
    }
}
