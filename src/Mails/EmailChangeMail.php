<?php

declare(strict_types=1);

namespace Exhum4n\Users\Mails;

use Exhum4n\Components\Mails\AbstractMail;
use Illuminate\Mail\Mailable;

class EmailChangeMail extends AbstractMail
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
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): Mailable
    {
        return $this->view('emails.change_email_code')
            ->with([
                'code' => $this->code
            ]);
    }
}
