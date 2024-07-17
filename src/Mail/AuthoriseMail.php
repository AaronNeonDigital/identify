<?php

namespace Neondigital\Identify\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Neondigital\Identify\Models\Identity;

class AuthoriseMail extends Mailable
{
    use Queueable, SerializesModels;

    protected Identity $identify;

    public function __construct($identify)
    {
        $this->identify = $identify;
    }

    public function build(): static
    {
        return $this->view('identify::emails.authorise')
            ->with([
                'identify' => $this->identify,
            ]);
    }
}
