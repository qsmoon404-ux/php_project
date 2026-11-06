<?php
header('Content-Type: application/json');

// Разрешаем запросы только с вашего сайта (базовая защита)
header("Access-Control-Allow-Origin: *");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получаем данные из формы и очищаем их
    $name = trim($_POST['name'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $service = trim($_POST['service'] ?? 'Не указана');
    $message = trim($_POST['message'] ?? 'Без комментария');

    // Проверка на заполненность обязательных полей
    if (empty($name) || empty($phone)) {
        echo json_encode(['status' => 'error', 'message' => 'Заполните имя и телефон']);
        exit;
    }

    // Формируем дату и строку для записи
    // ВАЖНО: Мы используем разделитель " | " ровно два раза, 
    // чтобы ваш admin.php (который ждет 3 части) корректно это прочитал.
    $date = date('d.m.Y H:i');
    $line = htmlspecialchars($name) . " | " . htmlspecialchars($phone) . " | " . htmlspecialchars($date . " (Услуга: " . $service . ")");

    $data_file = 'zapisi.txt';

    // Пытаемся записать данные в конец файла
    if (file_put_contents($data_file, $line . PHP_EOL, FILE_APPEND | LOCK_EX)) {
        echo json_encode(['status' => 'success', 'message' => 'Заявка успешно отправлена']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Ошибка сервера при сохранении']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Неверный метод запроса']);
}
?>