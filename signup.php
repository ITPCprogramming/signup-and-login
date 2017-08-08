<?php
    require "includes/db.php";
    $data = $_POST;
if(isset($data["submit"])){
    $errors = array();
    if(($data["Login"]) == ""){
        $errors[] = "Ведите логин";
    }
    if($data["password"] == "" or $data["password"] == " "){
        $errors[] = "Введите пароль";
    }
    if($data["password_2"] != $data["password"]){
        $errors[] = "Пароли не совпадают";
    }
    if(R::count("users", "Login = ?", array($data["Login"])) > 0){
    $errors[] = "Пользователь с таким логином уже существует";
    }
    if(!isset($data["check"])){
        $errors[] = "Вы должны согласиться с пользовательским соглашением";
    }
    if(empty($errors) ) {
        $user = R::dispense("users");
        $user->login = $data["Login"];
        $user->password = password_hash($data["password"], PASSWORD_DEFAULT);
        R::store($user);
        echo '<div style="color: green;">'."Вы успешно зарегестрированы!<br>Перейдите по <a href=Logged.php>ссылке</a>!".'</div><hr>';
    } else if(!empty($errors)) {
        echo '<div style="color: red;">'.array_shift($errors).'</div><hr>';
    }
}

?>
<form action="signup.php" method="POST">
    <p><input type="text" name="Login" placeholder="Введите логин"></p>
    <p><input type="password" name="password" placeholder="Введите пароль"></p>
    <p><input type="password" name="password_2" placeholder="Введите пароль еще раз"></p>
    <p><input type="checkbox" name="check"><label>Я согласен с пользовательским соглашением</label></p>
    <button type="submit" name="submit" >Подтвердить</button>
</form>