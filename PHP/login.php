<?php
session_start();
require("includes/functions.php");

$user = $pass = $user_err = $pass_err = '';

//user already logged in
if (isset($_SESSION['id'], $_SESSION['user_name'])) {
    header('Location: home.php');
    exit(0);
}

//call main function
main();

function main() {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') return;
    if (!isset($_POST['user']) || !isset($_POST['pass'])) return;

    global $user, $pass, $user_err, $pass_err;

    //clean inputs
    $user = sanitize($_POST['user']);
    $pass = sanitize($_POST['pass']);

    $conn = connect();

    $query = "SELECT id, password FROM user WHERE user_name = '$user';";

    $res = mysqli_query($conn, $query);

    mysqli_close($conn);

    if ($res->num_rows === 0) { //couldn't find username
        $user_err = "Error, invalid username";
        return;
    }

    $obj = $res->fetch_row();

    if (!password_verify($pass, $obj->password)) { //password doesn't match
        $pass_err = "invalid password";
        return;
    }

    //set session variables
    $_SESSION['user_name'] = $user;
    $_SESSION['id'] = $obj[0];
    //print "id = " . $obj[0];

    header('Location: home.php');
    exit(0);

}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <link href = "../CSS/login.css" type="text/css" rel="stylesheet"/>
        <meta charset="utf-8" />
    </head>

    <body>
      <div class="main">
        <h1>Sign Up</h1>
        <div class = "home-info">
            <img id=symbol src = "../Images/hearthstone-symbol.png">
        </div>
        <form action="<?php sanitize($_SERVER['PHP_SELF']);?>" method="post" name="login">
            <div>
                <label>Username:</label>
                <input type="text" name="user" class="text" value="<?php print $user;?>" />
                <label class="err"><?php print $user_err;?></label>
            </div>

            <div>
                <label>Password</label>
                <input type="password" name="pass" class="pass" />
                <label class="err"><?php print $pass_err; ?></label>
            </div>
          <div class="sub">
            <input class="submit-button" type="submit" />
          </div>
        </form>
      </div>
    </body>
</html>
