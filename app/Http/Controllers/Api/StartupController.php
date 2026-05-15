<?php

namespace App\Http\Controllers\Api;

use App\Models\Startup;
use App\Models\StartupProfile;
use App\Http\Requests\CreateStartupRequest;
use App\Http\Requests\UpdateStartupRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StartupController
{
    /**
     * Get all startups with filtering
     */
    public function index(Request $request): JsonResponse
    {
        $query = Startup::query()
            ->where('visibility', '!=', 'private')
            ->with('founder', 'profile', 'teamMembers');

        // Filters
        if ($request->has('industry')) {
            $query->where('industry', $request->industry);
        }

        if ($request->has('stage')) {
            $query->where('stage', $request->stage);
        }

        if ($request->has('country')) {
            $query->where('country', $request->country);
        }

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'ilike', "%$search%")
                    ->orWhere('description', 'ilike', "%$search%");
            });
        }

        if ($request->has('is_hiring')) {
            $query->where('is_hiring', true);
        }

        $startups = $query->paginate(20);

        return response()->json([
            'success' => true,
            'data' => $startups,
        ]);
    }

    /**
     * Get single startup
     */
    public function show(string $id): JsonResponse
    {
        $startup = Startup::with('founder', 'profile', 'teamMembers', 'jobs', 'investments')
            ->findOrFail($id);

        $startup->increment('view_count');

        return response()->json([
            'success' => true,
            'data' => $startup,
        ]);
    }

    /**
     * Create new startup
     */
    public function store(CreateStartupRequest $request): JsonResponse
    {
        $user = auth()->user();

        if (!$user->isFounder() && !$user->isAdmin()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized',
            ], 403);
        }

        $startup = Startup::create([
            'id' => Str::uuid(),
            'founder_id' => $user->id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'short_description' => $request->short_description,
            'industry' => $request->industry,
            'stage' => $request->stage,
            'website_url' => $request->website_url,
            'founded_at' => $request->founded_at,
            'country' => $request->country,
            'city' => $request->city,
            'visibility' => $request->visibility ?? 'public',
        ]);

        // Create profile
        $startup->profile()->create([
            'id' => Str::uuid(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Startup created successfully',
            'data' => $startup,
        ], 201);
    }

    /**
     * Update startup
     */
    public function update(UpdateStartupRequest $request, string $id): JsonResponse
    {
        $startup = Startup::findOrFail($id);

        $this->authorizeAction($startup);

        $startup->update($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Startup updated successfully',
            'data' => $startup,
        ]);
    }

    /**
     * Get startup statistics
     */
    public function getStats(string $id): JsonResponse
    {
        $startup = Startup::findOrFail($id);
        $this->authorizeAction($startup);

        return response()->json([
            'success' => true,
            'data' => $startup->getStats(),
        ]);
    }

    /**
     * Authorize user to modify startup
     */
    private function authorizeAction(Startup $startup): void
    {
        $user = auth()->user();

        if ($startup->founder_id !== $user->id && !$user->isAdmin()) {
            abort(403, 'Unauthorized');
        }
    }
}
