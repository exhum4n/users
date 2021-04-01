<?php

declare(strict_types=1);

namespace Exhum4n\Users\Mails;

use Exhum4n\Components\Mails\AbstractMail;
use Illuminate\Mail\Mailable;

class VerificationCodeMail extends AbstractMail
{
    /**
     * @var string
     */
    protected $code;

    /**
     * Create a new message instance.
     *
     * @param int $code
     */
    public function __construct(int $code)
    {
        parent::__construct();

        $this->code = $code;

        $this->subject = trans('email.confirm_code_email.subject');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): Mailable
    {
        return $this->view('emails.verificationCode')
            ->with(['code' => $this->code]);
    }
}
