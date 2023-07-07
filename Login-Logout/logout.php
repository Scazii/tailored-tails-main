<?php
if (isset($_COOKIE["user"])) {
    setcookie("user", "", time() - 3600, "/");
}

$redirectUrl = "../Login-Logout/loginpage.html#";
header("Location: " . $redirectUrl);
exit();
?>
