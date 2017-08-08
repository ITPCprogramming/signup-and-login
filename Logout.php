<?php
    header("Location:/index.php");
    require "includes/db.php";
    unset($_SESSION["logged_user"]);