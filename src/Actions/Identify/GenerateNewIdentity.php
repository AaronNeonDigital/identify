<?php

namespace Neondigital\Identify\Actions\Identify;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Neondigital\Identify\Actions\BaseAction;
use Neondigital\Identify\Mail\AuthoriseMail;
use Neondigital\Identify\Models\Identity;

class GenerateNewIdentity extends BaseAction
{
    public function handle(): string
    {
        $identities = Identity::where('user_id', Auth::id())
            ->where('validated', false)
            ->first();

        if ($identities) {
            return $identities->identifier;
        }

        $identity = Identity::create([
            'user_id' => Auth::id(),
            'code' => rand(100000, 999999),
            'identifier' => GenerateNewIdentifier::run(),
            'expires_at' => Carbon::now()->addMonth(),
        ]);

        /**
         * We only want to automatically send an email when an identity is first created. Any other time, we should make sure it is only on request.
         */
        Mail::to(Auth::user())
            ->send(new AuthoriseMail($identity)); // Send the authorise email to the user.

        return $identity->identifier;
    }
}
