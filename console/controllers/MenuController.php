<?php
namespace console\controllers;

use yii\console\Controller;
use yii\helpers\Console;
use core\helpers\CommandHelper;

class MenuController extends Controller
{
    public function actionIndex()
    {
        // Получаем список доступных команд через CommandHelper
        $commands = CommandHelper::getCommands(\Yii::getAlias('@console/controllers'));

        if (empty($commands)) {
            $this->stderr("Не найдено ни одной доступной команды.\n", Console::FG_RED);
            return;
        }

        // Создаем интерактивное меню
        while (true) {
            $this->clearScreen();
            echo "Доступные команды:\n";

            $menuOptions = [];
            foreach ($commands as $index => $command) {
                $menuOptions[(string)($index + 1)] = $command['name'];
                echo ($index + 1) . ". " . $command['name'] . "\n";
            }
            echo "0. Выход\n";

            $selected = $this->select("Выберите команду:", array_merge(['0' => 'Выход'], $menuOptions));
            if ($selected === '0') {
                break;
            }

            // Преобразуем строковый индекс обратно в числовой
            $commandIndex = (int)$selected - 1;
            if (!isset($commands[$commandIndex])) {
                $this->stderr("Неверный выбор. Попробуйте снова.\n", Console::FG_RED);
                continue;
            }

            $currentCommand = $commands[$commandIndex];

            $action = $this->selectAction($currentCommand['actions']);
            if ($action !== null) {
                $this->runCommand($currentCommand['name'], $action);
            }
        }
    }

    private function clearScreen()
    {
        Console::clearScreen();
    }

    private function selectAction($actions)
    {
        echo "Доступные действия:\n";
        $menuOptions = [];
        foreach ($actions as $index => $action) {
            $menuOptions[(string)($index + 1)] = $action;
            echo ($index + 1) . ". " . $action . "\n";
        }
        echo "0. Назад\n";

        $selected = $this->select("Выберите действие:", array_merge(['0' => 'Назад'], $menuOptions));
        if ($selected === '0') {
            return null;
        }

        // Преобразуем строковый индекс обратно в числовой
        $selectedIndex = (int)$selected - 1;
        if (!isset($actions[$selectedIndex])) {
            $this->stderr("Неверный выбор. Попробуйте снова.\n", Console::FG_RED);
            return $this->selectAction($actions);
        }

        return $actions[$selectedIndex];
    }

    private function runCommand($command, $action)
    {
        $this->clearScreen();
        $this->stdout("Выполняется команда: {$command} {$action}\n", Console::FG_GREEN);

        try {
            // Запускаем выбранную команду
            $this->run("{$command}/{$action}");
        } catch (\Exception $e) {
            $this->stderr("Ошибка выполнения команды: " . $e->getMessage() . "\n", Console::FG_RED);
            $this->stdout("Нажмите любую клавишу для продолжения...");
            Console::stdin(); // Ждем нажатия клавиши
        }

        $this->stdout("\n");
        $this->stdout("Нажмите любую клавишу для возврата в меню...");
        Console::stdin(); // Ждем нажатия клавиши
    }
}