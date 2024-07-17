<?php

namespace Neondigital\Identify\Actions\Identify;

use Illuminate\Support\Facades\Auth;
use Neondigital\Identify\Actions\BaseAction;
use Neondigital\Identify\Models\Identity;

class HasValidIdentity extends BaseAction
{
    public function handle(string $token): bool
    {
        $identity = Identity::where('user_id', Auth::id())
            ->where('validated', true)
            ->where('identifier', $token)
            ->first();

        return (bool) $identity;
    }
}
