<?php

namespace DigitMind\EmailParser\Helpers;

use Bitrix\Main\Loader;
use Bitrix\Main\LoaderException;
use Bitrix\Tasks\Item\Task;

class TaskHelper
{
    /**
     * @throws LoaderException
     */
    public function __construct()
    {
        Loader::includeModule('tasks');
    }

    /**
     * @param array $arFields
     * @return bool
     */
    public function createTask(array $arFields): bool
    {
        $task = new Task();

        foreach ($arFields as $itemKey => $itemValue) {
            $task[$itemKey] = $itemValue;
        }

        $createTaskResult = $task->save();

        return $createTaskResult->isSuccess();
    }
}
