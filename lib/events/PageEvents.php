<?php

namespace DigitMind\EmailParser\Events;

use Bitrix\Main\Loader;

Loader::includeModule('digitmind.emailparser');

class PageEvents
{
    /**
     * @return void
     */
    public static function onPageStart(): void
    {
        //
    }

    /**
     * @param $content
     * @return void
     */
    public static function onEndBufferContent(&$content): void
    {
        //
    }
}
