<?php

namespace App\View\Composers;

use App\Services\AuthService;
use App\Services\UserPreferenceService;
use Illuminate\View\View;

/**
 * Injects the current user's UI preferences into authenticated layouts.
 *
 * Used to render the correct theme + sidebar state on the *first paint*,
 * which avoids the dark-mode flash users get when the JS layer has to
 * apply the theme after the CSS has already loaded.
 */
class PreferenceComposer
{
    public function __construct(
        protected AuthService $auth,
        protected UserPreferenceService $preferences,
    ) {
    }

    public function compose(View $view): void
    {
        $user = $this->auth->user();

        $prefs = $user
            ? $this->preferences->forUser($user->id)
            : UserPreferenceService::DEFAULTS;

        $view->with('preferences', $prefs);
        $view->with('authUser', $user);
    }
}
