<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStartupRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->user() && (auth()->user()->isFounder() || auth()->user()->isAdmin());
    }

    public function rules(): array
    {
        return [
            'name' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'min:20'],
            'short_description' => ['nullable', 'string', 'max:500'],
            'logo_url' => ['nullable', 'url'],
            'banner_url' => ['nullable', 'url'],
            'website_url' => ['nullable', 'url'],
            'industry' => ['nullable', 'string'],
            'stage' => ['nullable', 'in:idea,pre_seed,seed,series_a,series_b,series_c,growth,exit'],
            'founded_at' => ['nullable', 'date'],
            'country' => ['nullable', 'string'],
            'city' => ['nullable', 'string'],
            'team_size' => ['nullable', 'integer'],
            'is_hiring' => ['nullable', 'boolean'],
            'visibility' => ['nullable', 'in:public,private,investors_only'],
            'funding_goal' => ['nullable', 'numeric'],
        ];
    }
}
