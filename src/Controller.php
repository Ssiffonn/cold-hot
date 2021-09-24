<?php

namespace ssiffonn\cold_hot\Controller;

use function ssiffonn\cold_hot\View\showGame;

function coldHot($numberArray, $currentNumber)
{
    for ($i = 0; $i < 3; $i++) {
        if ($numberArray[$i] == $currentNumber[$i]) {
            echo "Горячо!\n";
        } elseif (
            $numberArray[$i] == $currentNumber[0] ||
            $numberArray[$i] == $currentNumber[1] ||
            $numberArray[$i] == $currentNumber[2]
        ) {
            echo "Тепло!\n";
        } else {
            echo "Холодно!\n";
        }
    }
}

function startGame()
{
    showGame();
    $number = 0;
    $currentNumber = random_int(100, 999);
    $currentNumber = str_split($currentNumber);
    while ($number != $currentNumber) {
        $number = readline("Введите трехзначное число : ");
        if (is_numeric($number)) {
            if (strlen($number) != 3) {
                echo "Ошибка! Число должно быть трехзначным\n";
            } else {
                $numberArray = str_split($number);
                if ($numberArray == $currentNumber) {
                    echo "Вы выиграли!\n";
                    exit;
                } else {
                    coldHot($numberArray, $currentNumber);
                }
            }
        } else {
            echo "Ошибка! Введите число.\n";
        }
    }
}
