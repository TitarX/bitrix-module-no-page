<?php

namespace DigitMind\NoPage\Events;

use Bitrix\Main\Loader;

Loader::includeModule('digitmind.nopage');

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
