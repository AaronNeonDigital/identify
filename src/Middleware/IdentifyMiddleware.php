<?php

namespace Neondigital\Identify\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Mail;
use Neondigital\Identify\Actions\Identify\GenerateNewIdentity;
use Neondigital\Identify\Actions\Identify\HasValidIdentity;
use Neondigital\Secure\Authorise\Mail\AuthoriseMail;

class IdentifyMiddleware
{
    protected bool $shouldTriggerValidation = false;

    public function handle(Request $request, Closure $next)
    {
        /**
         * Only if 2fa is enabled should we apply the contents of this middleware.
         */
        if (! config('identifies.active')) {
            return $next($request);
        }

        $userIdentity = $request->cookie(config('identifies.prefix').'user_identity');

        if (! $userIdentity) {
            /**
             * User currently doesn't have a tfa cookie associated to this system.
             * We need to create them a cookie that would expire 1 month on from now.
             * They then would need to validate this token by email.
             */
            $token = GenerateNewIdentity::run();

            $this->shouldTriggerValidation = true; // Trigger the validation page.

            Cookie::queue(config('identifies.prefix').'user_identity', $token, config('identifies.time_to_persist_cookie_identification', 43800)); // Set Cookie to expire in a month by default.

        } else {
            /**
             * We have found a cookie, but we need to match it to our currently stored validated tokens to see if it exists.
             * If it does not exist, or it has expired then we need to regenerate them a new token, and get the user to validate the token.
             */
            $validIdentity = HasValidIdentity::run($userIdentity);

            if (! $validIdentity) {

                $this->shouldTriggerValidation = true; // Trigger the validation page.
            }
        }

        if ($this->shouldTriggerValidation) {

            return response()->view('identify::authorise');
        }

        /**
         * Only once the validation have been completed then we can continue on to the next request.
         */

        return $next($request);
    }
}
