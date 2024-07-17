<?php

namespace Neondigital\Identify\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Neondigital\Identify\Models\Identity;

class VerifyController extends Controller
{
    public function __invoke($code): Response|RedirectResponse
    {
        if (! $code) {
            return response()->view('identify::authorise');
        }

        $validCode = Identity::where('user_id', Auth::id())
            ->where('code', $code)
            ->where('validated', false)
            ->firstOrFail();

        if ($validCode) {
            /**
             * A valid code has been provided, and we can now validate the device and continue.
             */

            $validCode->validated = true;
            $validCode->validated_at = Carbon::now();
            $validCode->save();

            /**
             * Redirect to the route provided.
             */

            $route = config('identifies.redirect-route');

            return Redirect::route($route);
        }

        return Redirect::route('login');
    }
}
