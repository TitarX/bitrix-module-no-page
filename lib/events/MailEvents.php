<?php

namespace DigitMind\EmailParser\Events;

use Bitrix\Main\Loader;
use Bitrix\Main\Event;

Loader::includeModule('digitmind.emailparser');

class MailEvents
{
    /**
     * @param Event $event
     * @return void
     */
    public static function onMailMessageNew(Event $event)
    {
        //
    }
}
