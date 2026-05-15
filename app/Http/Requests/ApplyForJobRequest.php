<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApplyForJobRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->user() && auth()->user()->isJobSeeker();
    }

    public function rules(): array
    {
        return [
            'resume_url' => ['nullable', 'url'],
            'cover_letter' => ['nullable', 'string', 'max:2000'],
            'portfolio_url' => ['nullable', 'url'],
        ];
    }
}
