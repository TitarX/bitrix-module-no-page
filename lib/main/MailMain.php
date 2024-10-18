<?php

namespace DigitMind\EmailParser\Main;

class MailMain
{
    private array $mailParameters;

    /**
     * @param array $mailParameters
     */
    public function __construct(array $mailParameters)
    {
        $this->mailParameters = $mailParameters;
    }

    /**
     * @return void
     */
    public function mailProcess(): void
    {
        //
    }
}
