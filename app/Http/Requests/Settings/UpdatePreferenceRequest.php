<?php

namespace App\Http\Requests\Settings;

use App\Models\UserPreference;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePreferenceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'theme'             => ['sometimes', 'string', Rule::in(UserPreference::ALLOWED_THEMES)],
            'sidebar_collapsed' => ['sometimes', 'boolean'],
        ];
    }
}
