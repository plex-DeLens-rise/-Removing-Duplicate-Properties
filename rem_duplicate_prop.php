<?php
require($_SERVER["DOCUMENT_ROOT"] . '/bitrix/modules/main/include/prolog_before.php');
\Bitrix\Main\Loader::includeModule('iblock'); ///Подключаем модуль информационного блока
$rsProperty = \Bitrix\Iblock\PropertyTable::getList([ ///Выбираем диапазон свойств, если нужно.
    'filter' => [
        '>=ID' => 1622,
        '<=ID' => 3656,
    ],
])->fetchAll();

$el_count = count($rsProperty); ///Количество свойств

for ($i = 0; $i < $el_count; $i++) { ///Перебираем свойства
    for ($j = $i + 1; $j < $el_count; $j++) {
        if ($rsProperty[$i]['NAME'] == $rsProperty[$j]['NAME']) { ///Сравниваем свойства по наименованию
            CIBlockProperty::Delete($rsProperty[$j]['ID']); ///Удаляем дубликат по ID
//            echo '<pre>'; print_r($rsProperty[$j]['ID']); echo '</pre>';
//            echo '<pre>'; print_r($rsProperty[$j]['NAME']); echo '</pre>';
            $count_dblicates++;
        }
    }
}
echo "Скрипт выполнен :" . $count_dblicates . " дубликатов из " . $el_count;
?>
