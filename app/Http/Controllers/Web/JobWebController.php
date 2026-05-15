<?php

namespace App\Http\Controllers\Web;

use App\Models\Job;
use App\Models\JobApplication;
use App\Models\Startup;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class JobWebController extends Controller
{
    public function index(Request $request)
    {
        $query = Job::with('startup')->where('is_active', true);

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(fn($q) => $q->where('title', 'like', "%$s%")->orWhere('description', 'like', "%$s%"));
        }
        if ($request->filled('job_type'))        $query->where('job_type', $request->job_type);
        if ($request->filled('remote_type'))     $query->where('remote_type', $request->remote_type);
        if ($request->filled('experience_level')) $query->where('experience_level', $request->experience_level);

        $jobs = $query->latest()->paginate(15)->withQueryString();

        return view('jobs.index', compact('jobs'));
    }

    public function show(string $id)
    {
        $job = Job::with(['startup', 'creator'])->findOrFail($id);

        $hasApplied = false;
        if (Auth::check()) {
            $hasApplied = JobApplication::where('job_id', $id)
                ->where('applicant_id', Auth::id())
                ->exists();
        }

        return view('jobs.show', compact('job', 'hasApplied'));
    }

    public function apply(Request $request, string $id)
    {
        $job = Job::findOrFail($id);

        if (!$job->is_active) {
            return back()->with('error', 'This job is no longer accepting applications.');
        }

        if (JobApplication::where('job_id', $id)->where('applicant_id', Auth::id())->exists()) {
            return back()->with('error', 'You have already applied for this job.');
        }

        $data = $request->validate([
            'cover_letter'  => 'nullable|string|max:3000',
            'portfolio_url' => 'nullable|url',
            'resume'        => 'nullable|file|max:5120',
        ]);

        $resumeUrl = null;
        if ($request->hasFile('resume')) {
            $resume = $request->file('resume');
            // Validate file extension manually (no fileinfo needed)
            $allowedExtensions = ['pdf', 'doc', 'docx'];
            $fileExtension = strtolower($resume->getClientOriginalExtension());
            
            if (!in_array($fileExtension, $allowedExtensions)) {
                return back()->withErrors(['resume' => 'Please upload a PDF, DOC, or DOCX file.']);
            }
            
            // Store file using move() to avoid fileinfo requirement
            $filename = Auth::id() . '_' . time() . '.' . $fileExtension;
            $destinationPath = public_path('storage/resumes');
            
            // Create directory if it doesn't exist
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            
            $resume->move($destinationPath, $filename);
            $resumeUrl = '/storage/resumes/' . $filename;
        }

        JobApplication::create([
            'id'            => Str::uuid(),
            'job_id'        => $id,
            'applicant_id'  => Auth::id(),
            'startup_id'    => $job->startup_id,
            'cover_letter'  => $data['cover_letter'] ?? null,
            'portfolio_url' => $data['portfolio_url'] ?? null,
            'resume_url'    => $resumeUrl,
            'status'        => 'applied',
        ]);

        $job->increment('applications_count');

        return back()->with('success', 'Application submitted successfully!');
    }

    public function create()
    {
        $startups = Startup::where('founder_id', Auth::id())->get();
        return view('jobs.create', compact('startups'));
    }

    public function store(Request $request)
    {
        // Validate that the startup belongs to the authenticated user
        $startup = Startup::where('founder_id', Auth::id())
            ->findOrFail($request->input('startup_id'));

        $data = $request->validate([
            'startup_id'       => 'required|string',
            'title'            => 'required|string|max:255',
            'description'      => 'required|string',
            'requirements'     => 'nullable|string',
            'benefits'         => 'nullable|string',
            'job_type'         => 'required|in:full_time,part_time,contract,internship',
            'experience_level' => 'nullable|in:entry,junior,mid,senior',
            'salary_min'       => 'nullable|numeric|min:0',
            'salary_max'       => 'nullable|numeric|min:0',
            'location'         => 'nullable|string|max:255',
            'remote_type'      => 'nullable|in:remote,hybrid,onsite',
            'skills'           => 'nullable|string',
        ]);

        $skills = null;
        if (!empty($data['skills'])) {
            $skills = array_map('trim', explode(',', $data['skills']));
        }

        Job::create([
            'id'               => Str::uuid(),
            'startup_id'       => $startup->id,
            'created_by_id'    => Auth::id(),
            'title'            => $data['title'],
            'slug'             => Str::slug($data['title']).'-'.Str::random(5),
            'description'      => $data['description'],
            'requirements'     => $data['requirements'] ?? null,
            'benefits'         => $data['benefits'] ?? null,
            'job_type'         => $data['job_type'],
            'experience_level' => $data['experience_level'] ?? null,
            'salary_min'       => $data['salary_min'] ?? null,
            'salary_max'       => $data['salary_max'] ?? null,
            'location'         => $data['location'] ?? null,
            'remote_type'      => $data['remote_type'] ?? null,
            'skills_required'  => $skills,
            'is_active'        => true,
        ]);

        $startup->update(['is_hiring' => true]);

        return redirect()->route('dashboard')
            ->with('success', 'Job posted successfully!');
    }

    public function updateApplicationStatus(Request $request, string $applicationId)
    {
        $application = JobApplication::with('job.startup')
            ->where('startup_id', function($q) {
                $q->select('id')->from('startups')->where('founder_id', Auth::id());
            })
            ->findOrFail($applicationId);

        $request->validate(['status' => 'required|in:viewed,shortlisted,rejected,accepted']);
        $application->update(['status' => $request->status]);

        return back()->with('success', 'Application status updated.');
    }
}
