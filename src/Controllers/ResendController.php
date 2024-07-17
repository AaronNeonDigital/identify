<?php

namespace Neondigital\Identify\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Neondigital\Identify\Mail\AuthoriseMail;
use Neondigital\Identify\Models\Identity;

class ResendController extends Controller
{
    public function __invoke(Request $request): RedirectResponse
    {
        $userIdentity = $request->cookie(config('identifies.prefix').'user_identity');

        $validIdentity = Identity::where('user_id', Auth::id())
            ->where('validated', false)
            ->where('identifier', $userIdentity)
            ->first();

        if ($validIdentity && auth()->check()) {
            Mail::to($request->user())
                ->send(new AuthoriseMail($validIdentity));

            return back()
                ->with('msg', 'Confirmation Email Successfully Sent');
        }

        return Redirect::route('login');
    }
}
