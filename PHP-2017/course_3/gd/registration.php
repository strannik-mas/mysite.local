<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_SESSION['randstr']) {
//        echo $_SESSION['randstr'];
        if ($_POST['answer'] === $_SESSION['randstr'])
            $out = 'Угадал!';
        else
            $out = 'неверно';
    } else
        echo '<h2>Включи графику!</h2>';
}
?>
<!DOCTYPE HTML>
<html>

    <head>
        <meta charset="utf-8" />
        <title>Регистрация</title>
    </head>

    <body>
        <h1>Регистрация</h1>
        <form action="" method="post">
            <div>
                <img src="noise-picture.php">
            </div>
            <div>
                <label>Введите строку</label>
                <input type="text" name="answer" size="6">
            </div>
            <input type="submit" value="Подтвердить">
        </form>
<?php 
        echo '<h2 style="color: red">',$out,'</h2>';
?>
    </body>

</html>