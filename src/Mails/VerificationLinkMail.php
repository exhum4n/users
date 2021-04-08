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
    protected $token;

    /**
     * @var string
     */
    protected $email;

    /**
     * VerificationLinkMail constructor.
     *
     * @param string $email
     * @param string $token
     */
    public function __construct(string $email, string $token)
    {
        parent::__construct();

        $this->email = $email;
        $this->token = $token;
    }

    /**
     * @return Mailable
     */
    public function build(): Mailable
    {
        $link = route('web.users.email.verify', [
            'email' => $this->email,
            'token' => $this->token,
        ]);

        return $this->view('emails.verification_link')
            ->with([
                'link' => $link
            ]);
    }
}
