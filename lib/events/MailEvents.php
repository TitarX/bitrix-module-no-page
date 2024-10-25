<?php

namespace DigitMind\NoPage\Events;

use Bitrix\Main\Loader;
use Bitrix\Main\Event;

Loader::includeModule('digitmind.nopage');

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
