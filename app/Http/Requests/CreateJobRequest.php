<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateJobRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->user() && (auth()->user()->isFounder() || auth()->user()->isAdmin());
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'min:50'],
            'requirements' => ['nullable', 'string'],
            'benefits' => ['nullable', 'string'],
            'job_type' => ['required', 'in:full_time,part_time,contract,internship'],
            'experience_level' => ['nullable', 'in:entry,junior,mid,senior'],
            'salary_min' => ['nullable', 'numeric', 'min:0'],
            'salary_max' => ['nullable', 'numeric', 'min:0'],
            'location' => ['nullable', 'string'],
            'remote_type' => ['nullable', 'in:remote,hybrid,onsite'],
            'skills_required' => ['nullable', 'json'],
        ];
    }
}
