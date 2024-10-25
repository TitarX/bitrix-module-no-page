<?php

use Bitrix\Main\Loader;

// При правильном именовании, классы подключаются автоматически
// Имена файлов классов должны быть в нижнем регистре
Loader::registerAutoloadClasses(
    'digitmind.nopage',
    [
        'DigitMind\NoPage\Events\PageEvents' => 'lib/events/PageEvents.php',
        'DigitMind\NoPage\Events\MailEvents' => 'lib/events/MailEvents.php',
        'DigitMind\NoPage\Entities\OptionTable' => 'lib/entities/OptionTable.php',
        'DigitMind\NoPage\Helpers\MiscHelper' => 'lib/helpers/MiscHelper.php',
        'DigitMind\NoPage\Helpers\TaskHelper' => 'lib/helpers/TaskHelper.php',
        'DigitMind\NoPage\Main\MailMain' => 'lib/main/MailMain.php',
        'DigitMind\NoPage\Main\Parameters' => 'lib/main/Parameters.php',
    ]
);
