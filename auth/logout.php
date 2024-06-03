<?php

require ("../connect/connect.php");

session_abort();
setcookie("email", "", time() - 3600, "/");
setcookie("id", "", time() - 3600, "/");

header("Location: ../index.php");