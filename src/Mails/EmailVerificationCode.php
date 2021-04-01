<?php

declare(strict_types=1);

namespace Exhum4n\Users\Mails;

use Exhum4n\Components\Mails\AbstractMail;
use Illuminate\Mail\Mailable;

class EmailVerificationCode extends AbstractMail
{
    /**
     * @var string
     */
    protected $code;

    /**
     * Create a new message instance.
     *
     * @param string $code
     */
    public function __construct(string $code)
    {
        parent::__construct();

        $this->code = $code;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): Mailable
    {
        $link = route('web.users.email.confirm', [
            'locale' => config('app.fallback_locale'),
            'code' => $this->code,
        ]);

        return $this->view('emails.verificationLink')
            ->with(['link' => $link]);
    }
}
