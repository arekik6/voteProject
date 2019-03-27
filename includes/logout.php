<?php
session_start();
unset(   $_SESSION['username'], $_SESSION['password'], $_SESSION['role'],$_SESSION['msg']);

header("Location: ../login");
?>