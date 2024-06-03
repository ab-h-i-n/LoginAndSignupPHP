<?php
if (isset($_COOKIE['id'])) {
    header("Location: ./home.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up or Login</title>
</head>

<style>
    .hidden {
        display: none;
    }
</style>

<body>

    <form id="signup" class="" action="./auth/signup.php" method="post">
        <input name="name" type="name" placeholder="Enter name" required>
        <br><br>
        <input name="email" type="email" placeholder="Enter email" required>
        <br><br>
        <input name="password" type="password" placeholder="Enter password" required>
        <br><br>
        <button name="submit" type="submit">Sign Up</button>
        <br><br>

    </form>

    <form id="login" class="hidden" action="./auth/login.php" method="get">
        <input name="email" type="email" placeholder="Enter email" required>
        <br><br>
        <input name="password" type="password" placeholder="Enter password" required>
        <br><br>
        <button name="submit" type="submit">Login</button>
    </form>
    <br><br>
    <a href="#">Sign Up</a>

    <script>
        const a = document.querySelector('a');
        const isSignedUp = window.localStorage.getItem('isSignedUp');
        console.log(isSignedUp);
        a.addEventListener('click', () => {
            window.localStorage.setItem('isSignedUp', isSignedUp ? "" : "true");
            location.reload();
        });

        if (isSignedUp) {
            //show login
            document.getElementById('signup').classList.add('hidden');
            document.getElementById('login').classList.remove('hidden');
            window.localStorage.setItem();
            a.innerText = 'Sign Up';
        } else {
            //show signup
            document.getElementById('signup').classList.remove('hidden');
            document.getElementById('login').classList.add('hidden');
            a.innerText = 'Login';
        }
    </script>

</body>

</html>