
<?php
require("includes/functions.php");
//declare variables to be used
$FN = $LN = $UN = $PW = $PW_CONF = $FN_ERR = $LN_ERR = $UN_ERR = $PW_ERR = $PW_CONF_ERR = "";

main();

function main() {
    global $FN, $LN, $UN, $PW, $FN_ERR, $LN_ERR, $UN_ERR, $PW_ERR, $PW_CONF, $PW_CONF_ERR;

    //check if the request was sent as post
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        //check that the form was submitted
        if (!isset($_POST['FN']) || !isset($_POST['LN']) || !isset($_POST['UN'])
            || !isset($_POST['PW']) || !isset($_POST['PW_CONF'])) return;

        //retrieve all variables and clean their input
        //to avoid CSS (cross site scripting)
        $FN = sanitize($_POST["FN"]);
        $LN = sanitize($_POST["LN"]);
        $UN = sanitize($_POST["UN"]);
        $PW = sanitize($_POST["PW"]);
        $PW_CONF = sanitize($_POST['PW_CONF']);

        //check for errors in input
        if (empty($FN)) $FN_ERR = "Please enter a first name";
        else if (!preg_match("/^[a-zA-z]*$/", $FN)) $FN_ERR = "Please enter a valid name";

        if (empty($LN)) $LN_ERR = "Please enter a last name";
        else if (!preg_match("/^[a-zA-z]*$/", $LN)) $LN_ERR = "Please enter a valid last name";

        if (empty($UN)) $UN_ERR = "Please enter a user name";
        else if (strlen($UN) < 4) $UN_ERR = "Please enter a user name at least 4 characters";

        if (empty($PW)) $PW_ERR = "Please enter a password";
        else if (strlen($PW) < 5) $PW_ERR = "Please enter a password with at least 5 characters";

        if ($PW !== $PW_CONF) $PW_CONF_ERR = "Error, the passwords did not match";

        //check for any errors
        if (!empty($FN_ERR) || !empty($LN_ERR) || !empty($UN_ERR) || !empty($PW_ERR)
            || !empty($PW_CONF_ERR)) return;

        //try to upload to DB
        $conn = connect();

        $hash = password_hash($PW, PASSWORD_DEFAULT);

        //sql query
        $query = "INSERT INTO user (first_name, last_name, user_name, password) "
            . "VALUES ('" . $FN . "', '" . $LN . "', '"
            . $UN . "', '" . $hash . "' ); ";

        $res = mysqli_query($conn, $query);
        $id = mysqli_query($conn, "SELECT id FROM user WHERE user_name = '{$UN}';")->fetch_row()[0];
        mysqli_close($conn);

        if (!$res) { //check if adding user was successful
            $UN_ERR = "That username is not available";
            return;
        }

        session_start();
        $_SESSION['user_name'] = $UN;
        $_SESSION['id'] = $id;

        //redirect
        header('Location: home.php');
        exit(0);

    }
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset = "utf-8" />

        <link href = "../CSS/signup.css" type="text/css" rel="stylesheet"/>

        <title>Signup!</title>
    </head>

    <body>
      <div class="main">
        <h1>Sign Up</h1>
        <div class = "home-info">
            <img id=symbol src = "../Images/hearthstone-symbol.png">
        </div>
        <form action="<?php htmlentities($_SERVER['PHP_SELF']);?>" method="post"
        name = "signup">
            <div>
                <label>First Name</label>
                <input type="text" name="FN" class="text" value = "<?php print $FN;?>" />
                <label class="err"><?php print $FN_ERR;?></label>
            </div>

            <div>
                <label>Last Name</label>
                <input type="text" name="LN" class="text" value="<?php print $LN; ?>"/>
                <label class="err"><?php print $LN_ERR; ?></label>
            </div>

            <div>
                <label>Username</label>
                <input type="text" name="UN" class="text" value="<?php print $UN;?>"/>
                <label class="err"><?php print $UN_ERR;?></label>
            </div>

            <div>
                <label>Password</label>
                <input type="password" name="PW" class="pw" />
                <label class="err"><?php print $PW_ERR;?></label>
            </div>

            <div>
                <label>Password Confirmation</label>
                <input type="password" name="PW_CONF" class="pw" />
                <label class="err"><?php print $PW_CONF_ERR;?></label>
            </div>
            <div class="sub">
            <input class="submit-button" type="submit" />
          </div>
        </form>
        </div>
    </body>
</html>
