<?php
    namespace ssiffonn\cold_hot\Controller;
    use function ssiffonn\cold_hot\View\showGame;

    function startGame(){
        showGame();

    $array = array(0, 1, 2, 3, 4, 5, 7, 8, 9);
    shuffle($array);
    $currentNumber = array($array[0], $array[1], $array[2]);
    $number = 0;

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
					
						$hot_array = array_intersect_assoc($numberArray, $currentNumber);
						$heat_array = array_intersect($numberArray, $currentNumber);
					for($i=0;$i<3;$i++){
						if ($numberArray[$i] == $currentNumber[$i]) {
							echo("Горячо!\n");
						} elseif ($numberArray[$i] == $currentNumber[0] || $numberArray[$i] == $currentNumber[1] || $numberArray[$i] == $currentNumber[2]) {
							echo("Тепло!\n");
						} else {
							echo "Холодно!\n";
						}
					}
                }
            }
        } else {
            echo "Ошибка! Введите число.\n";
        }
    }
    }
?>