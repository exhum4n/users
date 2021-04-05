<?php

declare(strict_types=1);

namespace Exhum4n\Users\Mails;

use Exhum4n\Components\Mails\AbstractMail;
use Illuminate\Mail\Mailable;

class VerificationLinkMail extends AbstractMail
{

    protected $code;
    protected $email;

    public function __construct(string $email, string $code)
    {
        parent::__construct();

        $this->email = $email;
        $this->code = $code;

        $this->subject = trans('email.verification_email.subject');
    }

    public function build(): Mailable
    {
        $link = route('users.email.confirm', [
            'email' => $this->email,
            'code' => $this->code,
        ]);

        return $this->view('emails.verificationLink')
            ->with(['link' => $link]);
    }
}
