<?php

declare(strict_types=1);

namespace Exhum4n\Users\Mails;

use Exhum4n\Components\Mails\AbstractMail;
use Illuminate\Mail\Mailable;

class VerificationLinkMail extends AbstractMail
{
    /**
     * @var string
     */
    protected $code;

    /**
     * @var string
     */
    protected $email;

    /**
     * Create a new message instance.
     *
     * @param string $email
     * @param string $code
     */
    public function __construct(string $email, string $code)
    {
        parent::__construct();

        $this->email = $email;
        $this->code = $code;

        $this->subject = trans('email.verification_email.subject');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): Mailable
    {
        $link = route('web.users.email.confirm', [
            'locale' => app()->getLocale(),
            'email' => $this->email,
            'code' => $this->code,
        ]);

        return $this->view('emails.verificationLink')
            ->with(['link' => $link]);
    }
}
