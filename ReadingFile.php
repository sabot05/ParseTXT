<?php

/**
 * Чтение файла
 * @return bool
 */

$file = fopen("E:\\Study\\temp\\corpus.txt", "r");
$allWords = [];
$outputFirstWord = [];
$outputBadWords = [];
$outputRequiredWords = [];

//Убираем лишние пробелыы
while ($line = fgets($file)) {
    if (preg_match('/\s/', $line)) {
        //$withoutSpaceLine = preg_replace('/\s/', ' ', $line);
        //разбиваем строки по разделителю
        //$allWords [] = preg_split('/\s/', trim($withoutSpaceLine)); ;
        //выбираем только первое слово
        //  $firstWord = stristr($withoutSpaceLine,' ',true);
        //$outputFirstWord [] = $firstWord;

        $allWords [] = preg_split('/\s/', trim($line));  // массив корпуса
    }
}

$outputFirstWord = array_column($allWords, 0); //массив из первого слова

foreach ($allWords as $number => $value) {
    for ($i = 2; $i <= count($value) - 1; $i++) {
        echo $value[$i] . " ";
    }
    echo "\n";
}

foreach ($allWords as $number => $value) {
    for ($i = 2; $i <= count($value) - 1; $i++) {

        echo $value[$i] ;

    }

}



