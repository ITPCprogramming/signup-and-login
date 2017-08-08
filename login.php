<?php
require "includes/db.php";
$data = $_POST;
if(isset($data["submit"])) {
    $errors = array();
    $user = R::findOne("users", "Login = ?", array($data["Login"]));
    if($user) {
    if(password_verify($data["password"], $user->password)){
    $_SESSION["logged_user"] = $user;
        echo '<div style="color: green;">'."Вы авторизованы! Можете перейти на <a href=Logged.php>главную</a> страницу ".'</div><hr>';
    }else{
        $errors[] = "Пароль не правильно введен";
    }
    }else {
        $errors[] = "Пользователь с таким логином не найден";
    }
    if(!empty($errors)){
        echo '<div style="color: red;">'.array_shift($errors).'</div><hr>';
    }
}
?>
<form action="login.php" method="POST">
    <p><input type="text" name="Login" placeholder="Введите логин"></p>
    <p><input type="password" name="password" placeholder="Введите пароль"></p>
    <button type="submit" name="submit" >Подтвердить</button>
</form>

    