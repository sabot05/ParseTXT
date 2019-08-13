<?php

/**
 * Формирование теcтовых данных методом оptionalWord
 * 1. Запросы:
 * 1) опциональное слово + название города
 * 2) опциональное слово в транслите + название города
 * 3) опциональное слово в морфологии + название города
 * 4) опциональное слово в опечатке + название города
 * 5) опциональное слово в транслите и опечатке + название города + устанавливаем omission = 2
 * 2. Ожидаемый результат:
 * 1) город найден в результате поиска
 * 2) город найден в результате поиска
 * 3) город найден в результате поиска
 * 4) город найден в результате поиска
 * 5) город найден в результате поиска, но omission = 2
 * @return bool
 */
class COptionalWordForeignCityTestRenderer extends CTestRendererBase
{
    use CMorphoProc;
    use CMisspelled;

    function run()
    {
        //убираем из генерации для Some_segment, тест не адаптирован
        if (isset($this->universDB)) {
            return 0;
        }
        $cities = pg_array_query($this->dataIn, "SELECT * FROM inf_foreign_city WHERE name NOT LIKE '% %';");

        foreach ($cities as $cityData) {
            if (isset($this->optWord['city']['adm_div.city'])) {
                foreach ($this->optWord['city']['adm_div.city'] as $optWord) {
                    //если опциональное слово не совпадает с глобальноопциональным
                    if (isset($this->optWord['global'])) {
                        if (!in_array($optWord, $this->optWord['global'])) {

                            $arrayOfWord = $this->getAnyOptWord($optWord);
                            foreach ($arrayOfWord as $key => $value) {
                                if ($key == 'misspelledTranslit') {
                                    foreach ($value as $query) {
                                        $this->checkObj($query . ' ' . $cityData['name'], $cityData, "!=0", ["omission" => 2]);
                                    }
                                } else {
                                    foreach ($value as $query) {
                                        $this->checkObj($query . ' ' . $cityData['name'], $cityData, "!=0");
                                    }
                                }
                            }
                        }
                    } else {
                        $arrayOfWord = $this->getAnyOptWord($optWord);
                        foreach ($arrayOfWord as $key => $value) {
                            if ($key == 'misspelledTranslit') {
                                foreach ($value as $query) {
                                    $this->checkObj($query . ' ' . $cityData['name'], $cityData, "!=0", ["omission" => 2]);
                                }
                            } else {
                                foreach ($value as $query) {
                                    $this->checkObj($query . ' ' . $cityData['name'], $cityData, "!=0");
                                }
                            }
                        }
                    }

                    if (count($this->dataOut) > $this->testCount) {
                        break 2;
                    }
                }
            }
        }
        return count($this->dataOut) > 0;
    }

    /**
     * Формирование набора тестовых кейсов для проверки поиска
     *
     * @param $query - запрос
     * @param $objData - данные для теста
     */
    private function checkObj($query, $objData, $possition, $params = false)
    {
        $this->dataOut[] = $this->formatLine(
            $query,
            $this->dataType,
            $objData['uid'],
            $possition,
            $params,
            $objData['name'] . " uid: " . $objData['uid']
        );
    }
}
