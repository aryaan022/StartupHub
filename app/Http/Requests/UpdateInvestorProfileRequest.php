<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInvestorProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->user() && auth()->user()->isInvestor();
    }

    public function rules(): array
    {
        return [
            'company_name' => ['nullable', 'string', 'max:255'],
            'company_logo_url' => ['nullable', 'url'],
            'company_description' => ['nullable', 'string'],
            'investment_range_min' => ['nullable', 'numeric', 'min:0'],
            'investment_range_max' => ['nullable', 'numeric', 'min:0'],
            'industries' => ['nullable', 'json'],
            'stages' => ['nullable', 'json'],
            'countries' => ['nullable', 'json'],
            'portfolio_size' => ['nullable', 'integer'],
            'website_url' => ['nullable', 'url'],
        ];
    }
}
