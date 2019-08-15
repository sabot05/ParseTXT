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
$minusPlus = ['-' => '', '+' => ''];

//Убираем лишние пробелы и создаем массив
while ($line = fgets($file)) {
    if (preg_match('/\s/', $line)) {
        $allWords [] = preg_split('/\s/', trim($line));  // массив корпуса

    }
}


//берем первое значение внутреннего массива и записываем в новый массив
foreach ($allWords as $key => $value) {
    $nameIndex[] = $value[0];
   }

//меняем индекс на имя первого элемента

$allWords = array_combine($nameIndex, $allWords);

//удаляем первые два элемента в массиве (слово и цифра)
foreach ($allWords as $key => $value) {
    $allWordsNew [$key] = array_splice($value, 2);
   }

//добавляем два индекса МИНУС и ПЛЮС
foreach ($allWordsNew as $key => $value) {
    $allWordsNew[$key] = $minusPlus + $value;
}

print_r($allWordsNew);




