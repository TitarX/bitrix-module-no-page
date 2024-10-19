<?php

namespace DigitMind\EmailParser\Helpers;

use Bitrix\Main\Application;
use Bitrix\Main\Config\Option;
use CAdminMessage;

class MiscHelper
{
    public static function getModuleId(): string
    {
        return 'digitmind.emailparser';
    }

    public static function getModuleRootPath(): string
    {
        return realpath(__DIR__ . '/../..');
    }

    public static function getAssetsPath(string $type): string
    {
        $moduleId = self::getModuleId();
        $assetsPath = '';
        switch ($type) {
            case 'css':
            {
                $assetsPath = "/bitrix/css/{$moduleId}";
                break;
            }
            case 'js':
            {
                $assetsPath = "/bitrix/js/{$moduleId}";
                break;
            }
            case 'img':
            {
                $assetsPath = "/bitrix/images/{$moduleId}";
                break;
            }
        }
        return $assetsPath;
    }

    public static function getProgressBar(string|int $total, string|int $value, string $message): void
    {
        $total = intval($total);
        $value = intval($value);
        $total1 = $total / 100;
        $progressValue = 100;
        if ($total1 > 0) {
            $progressValue = ($total - $value) / $total1;
        }

        CAdminMessage::ShowMessage(
            [
                'MESSAGE' => $message,
                'DETAILS' => '#PROGRESS_BAR#',
                'HTML' => true,
                'TYPE' => 'PROGRESS',
                'PROGRESS_WIDTH' => '600',
                'PROGRESS_TOTAL' => 100,
                'PROGRESS_VALUE' => $progressValue
            ]
        );
    }

    public static function getModuleUploadDirPath(): string
    {
        $uploadDirectoryName = Option::get('main', 'upload_dir');
        $moduleId = GetModuleID(__FILE__);

        return "/{$uploadDirectoryName}/{$moduleId}";
    }

    public static function getModuleUploadDirFullPath(): string
    {
        $documentRoot = Application::getDocumentRoot();
        $moduleUploadDirPath = self::getModuleUploadDirPath();

        return "{$documentRoot}{$moduleUploadDirPath}";
    }

    public static function removeGetParameters(string $urlString): string
    {
        $urlString = trim($urlString);
        list($path) = explode('?', $urlString);

        return $path;
    }

    /**
     * Проверка URL на ответ с кодом 200
     *
     * @param string $url
     * @param bool $includeRedirects - С учётом редиректов
     *
     * @return ?bool
     */
    public static function checkUrl200(string $url, bool $includeRedirects = true): ?bool
    {
        $curl = curl_init($url);

        curl_setopt_array($curl, [
            CURLOPT_FOLLOWLOCATION => $includeRedirects,
            CURLOPT_NOBODY => true,
            CURLOPT_HEADER => false,
            CURLOPT_RETURNTRANSFER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false
        ]);

        $curlExecResult = curl_exec($curl);

        curl_close($curl);

        if ($curlExecResult !== false) {
            $curlInfo = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            if ($curlInfo == 200) {
                return true;
            } else {
                return false;
            }
        } else {
            return null;
        }
    }

    /**
     * Содержит ли строка заданные подстроки
     *
     * @param string $text
     * @param array $textPieces
     *
     * @return bool
     */
    public static function checkStringContains(string $text, array $textPieces): bool
    {
        $result = false;

        foreach ($textPieces as $textPiece) {
            if (stripos($text, $textPiece) !== false) {
                $result = true;
                break;
            }
        }

        return $result;
    }

    /**
     * Содержит ли строка заданные подстроки по регулярным выражениям
     *
     * @param $text
     * @param $textPieces
     *
     * @return bool
     */
    public static function checkStringContainsRegex($text, $textPieces)
    {
        $result = false;

        foreach ($textPieces as $textPiece) {
            if (preg_match($textPiece, $text) === 1) {
                $result = true;
                break;
            }
        }

        return $result;
    }

    /**
     * Добавляет слеш в начало переданой строки, если его там нет
     *
     * @param string $text
     *
     * @return string
     */
    public static function checkFirstSlash(string $text): string
    {
        if (!empty($text)) {
            if (preg_match('/^(?:(http:\/\/)|(https:\/\/)|(\/))/ui', $text) !== 1) {
                $text = "/$text";
            }
        }

        return $text;
    }

    /**
     * Является ли строка шаблоном регулярного выражения
     * Определяется по наличию начального и конечного слеша
     *
     * @param string $text
     *
     * @return bool
     */
    public static function isRegex(string $text): bool
    {
        $returnResult = false;

        if (mb_substr($text, 0, 1) === '/') {
            $strlen = mb_strlen($text);
            if (mb_substr($text, $strlen - 1, 1) === '/') {
                $returnResult = true;
            }
        }

        return $returnResult;
    }

    /**
     * Проверка на содержание подстрок или соответствий регулярному выражению
     *
     * @param string $text
     * @param array $options
     * @return bool
     */
    public static function isContentRuleMatch(string $text, array $options): bool
    {
        $returnResult = false;

        if (!empty($options)) {
            // Сортируем на regex и обычный текст
            $arString = [];
            $arRegex = [];
            foreach ($options as $option) {
                if (self::isRegex($option)) {
                    $arRegex[] = "{$option}ui";
                } else {
                    $arString[] = $option;
                }
            }

            if (!empty($arString)) {
                $returnResult = self::checkStringContains($text, $arString);
            }

            if (!$returnResult && !empty($arRegex)) {
                $returnResult = self::checkStringContainsRegex($text, $arRegex);
            }
        }

        return $returnResult;
    }
}
