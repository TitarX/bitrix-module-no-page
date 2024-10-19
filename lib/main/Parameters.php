<?php
/**
 * Параметры, константы приложения
 */

namespace DigitMind\EmailParser\Main;

use DigitMind\EmailParser\Helpers\MiscHelper;

class Parameters
{
    /**
     * Возвращает массив параметров из /parameters.php
     *
     * @return array
     */
    public static function getOuterConfig(): array
    {
        $rootModulePath = MiscHelper::getModuleRootPath();

        return include "{$rootModulePath}/parameters.php";
    }
}
