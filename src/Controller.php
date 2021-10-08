<?php

namespace ssiffonn\cold_hot\Controller;

use SQLite3;

use function ssiffonn\cold_hot\View\showGame;
use function ssiffonn\cold_hot\View\showList;
use function ssiffonn\cold_hot\View\showReplay;
use function ssiffonn\cold_hot\View\help;

function key($key)
{
    if ($key == "--new" || $key == "-n") {
        startGame();
    } elseif ($key == "--list" || $key == "-l") {
        listGames();
    } elseif ($key == "--replay" || $key == "-r") {
        showReplay();
    } elseif ($key == "--help" || $key == "-h") {
        help();
    } else {
        echo "Неверный ключ.";
    }
}


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

function restart()
{
    $restart = readline("Хотите сыграть ещё?[Y/N]\n");
    if ($restart == "Y") {
        startGame();
    } else {
        exit;
    }
}

function startGame()
{
    $db = openDB();

    date_default_timezone_set("Europe/Moscow");
    $gameData = date("d") . "." . date("m") . "." . date("Y");
    $gameTime = date("H") . ":" . date("i") . ":" . date("s");
    $playerName = getenv("username");


    showGame();
    $number = 0;
    $currentNumber = random_int(100, 999);

    $db->exec("INSERT INTO games (
        gameDate, 
        gameTime,
        playerName,
        secretNumber,
        gameResult
        ) VALUES (
        '$gameData', 
        '$gameTime',
        '$playerName',
        '$currentNumber',
        'Не закончено'
        )");

    $currentNumber = str_split($currentNumber);
    $id = $db->querySingle("SELECT gameId FROM games ORDER BY gameId DESC LIMIT 1");

    while ($number != $currentNumber) {
        $number = readline("Введите трехзначное число : ");
        if (is_numeric($number)) {
            if (strlen($number) != 3) {
                echo "Ошибка! Число должно быть трехзначным\n";
            } else {
                $numberArray = str_split($number);
                if ($numberArray == $currentNumber) {
                    echo "Вы выиграли!\n";
                    $result = "Победа";
                    updateDB($id, $result);
                    restart();
                } else {
                    coldHot($numberArray, $currentNumber);
                }
            }
        } else {
            echo "Ошибка! Введите число.\n";
        }
    }
}

function openDB()
{
    if (!file_exists("gameDB.db")) {
        $db = createDB();
    } else {
        $db = new SQLite3("gameDB.db");
    }
    return $db;
}

function createDB()
{
    $db = new SQLite3("gameDB.db");

    $game = "CREATE TABLE games(
        gameId INTEGER PRIMARY KEY,
        gameDate DATE,
        gameTime TIME,
        playerName TEXT,
        secretNumber INTEGER,
        gameResult TEXT
    )";
    $db->exec($game);

    $turns = "CREATE TABLE info(
        gameId INTEGER,
        gameResult TEXT
    )";
    $db->exec($turns);

    return $db;
}

function updateDB($id, $result)
{
    $db = openDB();
    $db -> exec("UPDATE games
        SET gameResult = '$result'
        WHERE gameId = '$id'");
}

function listGames()
{
    $db = openDB();
    $query = $db->query('SELECT * FROM games');
    while ($row = $query->fetchArray()) {
        \cli\line("ID $row[0])\n Дата: $row[1]\n Время: $row[2]\n Имя: $row[3]\n Загаданное число: $row[4]\n
        Результат: $row[5]");
    }
}
