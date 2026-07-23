<?php
// Подключаем PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once 'PHPMailer/Exception.php';
require_once 'PHPMailer/PHPMailer.php';
require_once 'PHPMailer/SMTP.php';

$subject = 'Заявка на скупку техники {$domain} #' . time();
$name = htmlspecialchars($_POST['name']);
$phone = htmlspecialchars($_POST['phone']);
$to = 'scrum360@yandex.ru, info@utiltehnika.ru'; // '

$message = '
<html>
    <head>
        <title>'.$subject.'</title>
    </head>
    <body>
        <table>
            <tr>
                <td><b>Имя:</b></td>
                <td>'.$name.'</td>
            </tr>
            <tr>
                <td><b>Телефон:</b></td>
                <td>'.$phone.'</td>
            </tr>
        </table>
    </body>
</html>';

$mail = new PHPMailer(true);

try {
    // Настройки SMTP
    $mail->isSMTP();                                          // Используем SMTP
    $mail->Host       = 'smtp.beget.com';                     // Сервер SMTP (для Yandex)
    $mail->SMTPAuth   = true;                                 // Включаем авторизацию
    $mail->Username   = 'sale@etekh.ru';               // Твой email (отправитель)
    $mail->Password   = 'YK4&nv1AbB59';                  // Пароль или пароль приложения
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;          // SSL шифрование (или 'tls')
    $mail->Port       = 465;                                  // Порт (465 для SSL, 587 для TLS)
    
    // Отправитель и получатели
    $mail->setFrom('sale@etekh.ru', 'Студия Скрам360');

    $mail->addAddress('enyukhin@scrum360.ru');
    
    // Контент письма
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $message;
    $mail->AltBody = "Имя: $name\nТелефон: $phone"; // Текстовая версия для почтовых клиентов без HTML
    
    // Отправка
    $mail->send();
    
    // Успешная отправка
    echo json_encode(['status' => 'success', 'message' => 'Письмо отправлено']);
    
} catch (Exception $e) {
    // Ошибка отправки
    echo json_encode(['status' => 'error', 'message' => 'Ошибка: ' . $mail->ErrorInfo]);
}
?>
