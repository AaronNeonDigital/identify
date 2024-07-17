<?php

namespace Neondigital\Identify\Actions\Identify;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Neondigital\Identify\Actions\BaseAction;
use Neondigital\Identify\Models\Identity;

class GenerateNewIdentifier extends BaseAction
{
    public function handle(): string
    {
        return Str::random(32);
    }
}
