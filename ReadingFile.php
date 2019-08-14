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
$allWordsNew = [];
$allWordsName = [];

//Убираем лишние пробелыы
while ($line = fgets($file)) {
    if (preg_match('/\s/', $line)) {
        $allWords [] = preg_split('/\s/', trim($line));  // массив корпуса
    }
}

//берем первое значение внутреннего массива в качестве индекса массива
foreach ($allWords as $number => $value) {
    $nameIndex[] = $value[0];
}

//меняем индекс на имя первого элемента
$allWordsName = array_combine($nameIndex, $allWords);

//удаляем первые два элемента в масссиве (слово и цифра)
foreach ($allWordsName as $key => $value) {
    $allWordsNew [$key] = array_splice($value, 2);
}




print_r($allWordsNew);







