<?
    $subject = 'Заявка с сайта 1eco-rus.ru';
    $name = htmlspecialchars($_POST['name']);
    $phone = htmlspecialchars($_POST['phone']);
    $to = 'enyukhin@scrum360.ru';
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
    $headers  = "Content-type: text/html; charset=utf-8 \r\n"; //Кодировка письма
    $headers .= "From: 
1-ЭКО <no-reply@1eco-rus.ru>\r\n"; //Наименование и почта отправителя
    mail($to, $subject, $message, $headers); //Отправка письма с помощью функции mail
