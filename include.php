<?php

use Bitrix\Main\Loader;

// При правильном именовании, классы подключаются автоматически
// Имена файлов классов должны быть в нижнем регистре
Loader::registerAutoloadClasses(
    'digitmind.emailparser',
    [
        'DigitMind\EmailParser\Events\PageEvents' => 'lib/events/PageEvents.php',
        'DigitMind\EmailParser\Events\MailEvents' => 'lib/events/MailEvents.php',
        'DigitMind\EmailParser\Entities\OptionsTable' => 'lib/entities/OptionsTable.php',
        'DigitMind\EmailParser\Helpers\MiscHelper' => 'lib/helpers/MiscHelper.php',
        'DigitMind\EmailParser\Helpers\TaskHelper' => 'lib/helpers/TaskHelper.php',
        'DigitMind\EmailParser\Main\MailMain' => 'lib/main/MailMain.php',
        'DigitMind\EmailParser\Main\Parameters' => 'lib/main/Parameters.php',
    ]
);
