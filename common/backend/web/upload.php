<?php
ini_set('display_errors', 1);
// проходим файл
$file = 'organizations_upload.csv';
$handle = fopen($file, 'r');

if ($handle == false) {
    echo 'Файл для загрузки не найден. Убедитесь, что он лежит в папке ' . __DIR__ . ' и назывется ' . $file;
    exit();
}

$mysqli = new mysqli("localhost", "testing", "ouhy7869Etydf", "testing_business");
if ($mysqli->connect_errno) {
    echo "Не удалось подключиться к MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    exit();
}

$mysqli->set_charset('utf8');

while ($row = fgetcsv($handle, 0, ';', '"')) {
    $zip = 0;
    $new_flag = true;
    list($name, $address, $zip, $email, $f, $i, $o, $phone, $site) = $row;
    if (!$name) continue;
    // проверяем есть ли в базе такие строки
    $zip = trim($zip);
    $part_name = preg_replace("/[^0-9]/", '', $name);
    if ($part_name < 1) {
        $part_name = str_replace(array('Муниципальное бюджетное общеобразовательное учреждение', 'муниципальное бюджетное общеобразовательное учреждение', 'МУНИЦИПАЛЬНОЕ БЮДЖЕТНОЕ ОБЩЕОБРАЗОВАТЕЛЬНОЕ УЧРЕЖДЕНИЕ', 'МБОУ'), ' ', $name);
        $part_name = str_replace(array('Структурное подразделение', 'структурное подразделение', 'СТРУКТУРНОЕ ПОДРАЗДЕЛЕНИЕ'), ' ', $part_name);
        $part_name = str_replace(array('Структурное подразделение', 'структурное подразделение', 'МАОУ', 'ГБОУ', 'АНО', 'Государственное бюджетное общеобразовательное учреждение', 'государственное бюджетное общеобразовательное учреждение', 'ГОСУДАРСТВЕННОЕ БЮДЖЕТНОЕ ОБЩЕОБРАЗОВАТЕЛЬНОЕ УЧРЕЖДЕНИЕ'), ' ', $part_name);
        $part_name = str_replace(array('РТ', 'Республики Татарстан', 'района'), ' ', $part_name);
        $part_name = str_replace(array('"', '«', '»', ' '), '%', $part_name);
        $part_name = trim(rtrim($part_name, ' \t\n\r\0\x0B'), ' \t\n\r\0\x0B');
        $part_name = substr($part_name, 2);
    }
    $organization = $mysqli->query('SELECT * FROM organization WHERE (zip = ' . $zip . ' AND address like "%' . preg_replace("/[^0-9]/", '', $address) . '%") AND name like "%' . $part_name . '%"');
    //echo 'SELECT * FROM organization WHERE (zip = ' . $zip . ' AND address like "%' . preg_replace("/[^0-9]/", '', $address) . '%") AND name like "%' . $part_name . '%"<br>';
    if (is_object($organization)) {
        if ($organization->num_rows > 0) continue;

        while ($value = $organization->fetch_object()) {
            $new_flag = false;
            if (mb_stripos($name, $value->name) !== false) {
                $exists .= $name . ', ';
                break;
            }
            $address = str_replace('г.', '', $address);
            $value->address = str_replace('г.', '', $value->address);
            $address = str_replace(' ', '', $address);
            $value->address = str_replace(' ', '', $value->address);

            if (mb_stripos($value->address, $address) !== false) break;
            $new_flag = true;
        }
        $organization->free();
    } else $new_flag = true;
    // если новый, загружаем
    if ($new_flag === true) {
        echo $name . ' ' . $address . ' ' . $zip . '<br>';
        if (!($stmt = $mysqli->prepare("INSERT INTO organization (zip, type_id, name, address, phone) VALUES (?, ?, ?, ?, ?)"))) {
            echo "Не удалось подготовить запрос: (" . $mysqli->errno . ") " . $mysqli->error;
        }
        $type_id = 2;
        $stmt->bind_param('iisss', $zip, $type_id, $name, $address, $phone);
        if (!$stmt->execute()) {
            echo "Не удалось выполнить запрос: (" . $stmt->errno . ") " . $stmt->error;
        }
    }
}

//echo $exists;


fclose($handle);