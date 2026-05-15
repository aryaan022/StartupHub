<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateStartupRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->user() && (auth()->user()->isFounder() || auth()->user()->isAdmin());
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', 'unique:startups'],
            'description' => ['required', 'string', 'min:20'],
            'short_description' => ['nullable', 'string', 'max:500'],
            'industry' => ['required', 'string'],
            'stage' => ['nullable', 'in:idea,pre_seed,seed,series_a,series_b,series_c,growth,exit'],
            'website_url' => ['nullable', 'url'],
            'founded_at' => ['nullable', 'date'],
            'country' => ['nullable', 'string'],
            'city' => ['nullable', 'string'],
            'visibility' => ['nullable', 'in:public,private,investors_only'],
        ];
    }
}
