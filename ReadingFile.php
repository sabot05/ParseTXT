<?php

/**
 * Чтение файла
 * @return bool
 */

//1. тестирование Git

$file = fopen("E:\\Study\\temp\\corpus.txt", "r");
$allWords = [];
$allWordsNew = [];

//Убираем лишние пробелы и создаем массив
while ($line = fgets($file)) {
    if (preg_match('/\s/', $line)) {
        $allWords [] = preg_split('/\s/', trim($line));  // массив корпуса

    }
}

foreach ($allWords as $key => $value) {
    $query = array_shift($value);

  array_shift($value);

    foreach ($value as $word) {
        if (strpos($word, "+") !== false) {
            $allWordsNew[$query]["+"][] = trim($word, "+");
        }
        if (strpos($word, "-") !== false) {
            $allWordsNew[$query]["-"][] = trim($word, "-");
        }
    }

}
print_r($allWordsNew);

/*//берем первое значение внутреннего массива и записываем в новый массив
foreach ($allWords as $key => $value) {
    $nameIndex[] = $value[0];
}

//меняем индекс на имя первого элемента

$allWords = array_combine($nameIndex, $allWords);

//удаляем первые два элемента в массиве (слово и цифра)
foreach ($allWords as $key => $value) {
    $allWordsNew [$key] = array_splice($value, 2);
}


print_r($allWordsNew);
*/


