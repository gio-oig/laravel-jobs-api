<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\SecretController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\JobController;
use App\Models\Category;
use App\Models\Company;
use App\Models\Job;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/category', function () {
    $jobs = Job::with(['tags','category'])->get();
    // dd($jobs);
    // Company::create([
    //     'name' => 'Viko',
    //     'slug' => 'Viko',
    // ]);
    // Company::create([
    //     'name' => 'Star',
    //     'slug'=> 'Star',
    // ]);
    // Company::create([
    //     'name' => 'Ultra Gaming',
    //     'slug' => 'Ultra-Gaming',
    // ]);
    // $job = Job::create([
    //     'title'=>'Full Stack Developer',
    //     'slug'=>'Full-Stack-Developer',
    //     'description' => 'Pulsar AI is seeking a full-time Full-stack Software Engineer to join our team and help us take our products and services to the next level. We appreciate team players with a solid track record of published projects and experience in a wide range of technologies.',
    //     'salary' => '4000',
    //     'company_id'=>1,
    //     'category_id'=>1
    // ]);
    // $job = Job::find(1);

    // $job->tags()->attach([1,2,3]);
    // dd($job->tags());

    // dd($users);
    return response()->json([$jobs]);
});

Route::get('/jobs', [PostController::class,'allJobs']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::delete('/logout', [UserController::class, 'logout']);



Route::get('/jobs', [JobController::class, 'allJobs'])->middleware('log.route');
Route::get('/job/{slug}', [JobController::class, 'show']);
Route::get('/search/jobs', [JobController::class, 'filterJobs'])->middleware(['cors','log.route']);

Route::fallback(function(){
    return response()->json([
        'message' => 'Page Not Found. If error persists, contact info@website.com'], 404);
});
