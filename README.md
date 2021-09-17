﻿# Описание проекта

Написать программу для игры "Холодно-горячо"(cold-hot). Игрок пытается угадать случайное трехзначное число (без повторяющихся цифр), сгенерированное компьютером. После каждой попытки компьютер предоставляет игроку подсказки трех типов:

* * *

* "Холодно". Ни одна цифра не отгадана.
* "Тепло" Одна цифра отгадана, но не отгадана ее позиция. 
* "Горячо". Одна цифра и ее позиция отгадана.
На каждом ходе компьютер должен выдать три подсказки, отсортированные в алфавитном порядке. Если секретное число 456, а предположение игрока — 546, подсказки будут иметь вид «Горячо Тепло Тепло». Подсказка «Горячо» относится к 6, а «Тепло Тепло» — к 4 и 5.

* * *

* Информация о датах и исходах всех партий, а также о всех попытках, сделанных во время игры, должна сохраняться в базе данных.
* Для каждой игры в базе должна храниться следующая информация:
    * Дата игры
    * Имя игрока
    * Загаданное компьютером слово
    * Исход игры (угадал/не угадал)
    * Запись попыток в формате: 
      `номер попытки | предложенная буква | результат`

* * *

* Режим работы приложения должны определяться при запуске по аргументам командной строки:
    * `--new`. Новая игра. Этот же режим используется по умолчанию, если программа запускается без параметров.
    * `--list`. Вывод списка всех сохраненных игр.
    * `--replay id`. Повтор игры с идентификатором id.
    * `--help`. Вывод краткой информации о приложении и доступных ключах для запуска в разных режимах.

* * *

## Требования

Минимальная версия PHP: 7.4.13 \
Минимальная версия Composer: 2.1.6

* * *

## Инструкция по установке и запуску игры

Из Github:

1. Склонировать проект на локальную машину;
2. Установить composer, если он не установлен;
3. Перейти в корневой каталог;
4. Выполнить в консоли команду `composer update`;
5. Перейти в каталог bin из корнегого каталога и запустить файл cold_hot.bat.

Из Packagist:

1. Установить composer, если он не установлен;
2. Перейти в каталог, в который вы будете клонировать проект;
3. Выполнить команду `composer create-project sifon/cold-hot`;
4. Перейти в каталог vendor/bin;
5. Запустить файл cold-hot.bat.

* * *

## Ссылки

Packagist: <https://packagist.org/packages/sifon/cold-hot>
