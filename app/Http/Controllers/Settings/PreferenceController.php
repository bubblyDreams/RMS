<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\UpdatePreferenceRequest;
use App\Services\AuthService;
use App\Services\UserPreferenceService;
use Illuminate\Http\JsonResponse;

class PreferenceController extends Controller
{
    public function __construct(
        protected AuthService $auth,
        protected UserPreferenceService $preferences,
    ) {
    }

    public function show(): JsonResponse
    {
        $user = $this->auth->user();
        return response()->json([
            'preferences' => $this->preferences->forUser($user->id),
        ]);
    }

    public function update(UpdatePreferenceRequest $request): JsonResponse
    {
        $user = $this->auth->user();
        $this->preferences->update($user->id, $request->validated());

        return response()->json([
            'preferences' => $this->preferences->forUser($user->id),
        ]);
    }
}
