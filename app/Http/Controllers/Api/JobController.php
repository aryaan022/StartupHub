<?php

namespace App\Http\Controllers\Api;

use App\Models\Job;
use App\Models\JobApplication;
use App\Http\Requests\CreateJobRequest;
use App\Http\Requests\ApplyForJobRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class JobController
{
    /**
     * Get all jobs
     */
    public function index(Request $request): JsonResponse
    {
        $query = Job::query()
            ->where('is_active', true)
            ->with('startup', 'creator');

        // Filters
        if ($request->has('job_type')) {
            $query->where('job_type', $request->job_type);
        }

        if ($request->has('experience_level')) {
            $query->where('experience_level', $request->experience_level);
        }

        if ($request->has('remote_type')) {
            $query->where('remote_type', $request->remote_type);
        }

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'ilike', "%$search%")
                    ->orWhere('description', 'ilike', "%$search%");
            });
        }

        if ($request->has('location')) {
            $query->where('location', 'ilike', "%{$request->location}%");
        }

        $jobs = $query->orderBy('created_at', 'desc')->paginate(20);

        return response()->json([
            'success' => true,
            'data' => $jobs,
        ]);
    }

    /**
     * Get single job
     */
    public function show(string $id): JsonResponse
    {
        $job = Job::with('startup', 'creator')->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $job,
        ]);
    }

    /**
     * Create new job
     */
    public function store(CreateJobRequest $request): JsonResponse
    {
        $user = auth()->user();

        if (!$user->isFounder() && !$user->isAdmin()) {
            return response()->json([
                'success' => false,
                'message' => 'Only founders can post jobs',
            ], 403);
        }

        $startup = $user->startup()->firstOrFail();

        $job = Job::create([
            'id' => Str::uuid(),
            'startup_id' => $startup->id,
            'created_by_id' => $user->id,
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'requirements' => $request->requirements,
            'benefits' => $request->benefits,
            'job_type' => $request->job_type,
            'experience_level' => $request->experience_level,
            'salary_min' => $request->salary_min,
            'salary_max' => $request->salary_max,
            'location' => $request->location,
            'remote_type' => $request->remote_type,
            'skills_required' => $request->skills_required,
            'is_active' => true,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Job posted successfully',
            'data' => $job,
        ], 201);
    }

    /**
     * Apply for job
     */
    public function apply(ApplyForJobRequest $request, string $jobId): JsonResponse
    {
        $user = auth()->user();
        $job = Job::findOrFail($jobId);

        if (!$user->isJobSeeker()) {
            return response()->json([
                'success' => false,
                'message' => 'Only job seekers can apply',
            ], 403);
        }

        // Check if already applied
        $existing = JobApplication::where('job_id', $jobId)
            ->where('applicant_id', $user->id)
            ->first();

        if ($existing) {
            return response()->json([
                'success' => false,
                'message' => 'You have already applied for this job',
            ], 409);
        }

        $application = JobApplication::create([
            'id' => Str::uuid(),
            'job_id' => $jobId,
            'applicant_id' => $user->id,
            'startup_id' => $job->startup_id,
            'resume_url' => $request->resume_url,
            'cover_letter' => $request->cover_letter,
            'portfolio_url' => $request->portfolio_url,
            'status' => 'applied',
        ]);

        $job->increment('applications_count');

        return response()->json([
            'success' => true,
            'message' => 'Application submitted successfully',
            'data' => $application,
        ], 201);
    }

    /**
     * Get applications for a job
     */
    public function getApplications(string $jobId): JsonResponse
    {
        $job = Job::findOrFail($jobId);
        $user = auth()->user();

        if ($job->startup->founder_id !== $user->id && !$user->isAdmin()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized',
            ], 403);
        }

        $applications = JobApplication::where('job_id', $jobId)
            ->with('applicant')
            ->paginate(20);

        return response()->json([
            'success' => true,
            'data' => $applications,
        ]);
    }
}
