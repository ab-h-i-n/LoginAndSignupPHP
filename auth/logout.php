<?php

require ("../connect/connect.php");

session_abort();
setcookie("id", "", time() - 3600, "/");
header("Location: ../index.php");