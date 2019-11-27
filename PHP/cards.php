<?php
    session_start();
    require('includes/functions.php');

    $result = $navlink = '';

    if (isset($_SESSION['user_name'], $_SESSION['id'])) {
        $navlink="<a href=\"signout.php\">Sign Out</a>";
        $main = '<a href="home.php">Home</a>';
    } else {
        $navlink = "<a href=\"login.php\">Sign In</a>";
        $main = '<a href="login.php">Home</a>';
    }
?>


<!DOCTYPE html>
<html>
    <head>
        <title>Card Lookup</title>
        <meta charset="utf-8" />
        <link href = "../CSS/cards.css" type="text/css" rel="stylesheet"/>
        <script src="../JS/cards.js"></script>
    </head>

    <nav>
      <ul>
        <li>HearthStats</li>
        <li> <?php print $main;?></li>
        <li> <a href="decks.php">My Decks</a></li>
        <li> <a href="cards.php">Cards</a></li>
        <li> <?php print $navlink;?></li>
      </ul>
    </nav>

    <body>
      <div class="main">
        <h1>Search cards</h1>
        <div id="modal">
            <div id="modal-content">
                <form method="get" name="createDeck" action="javascript:createDeck();">
                    <label>Class:</label>
                    <select id="class">
                        <option value="druid">Druid</option>
                        <option value="hunter">Hunter</option>
                        <option value="mage">Mage</option>
                        <option value="paladin">Paladin</option>
                        <option value="priest">Priest</option>
                        <option value="rogue">Rogue</option>
                        <option value="shaman">Shaman</option>
                        <option value="warlock">Warlock</option>
                        <option value="warrior">Warrior</option>
                    </select>

                    <label>Format:</label>
                    <select id="format">
                        <option value="standard">Standard</option>
                        <option value="wild">Wild</option>
                    </select>
                    <input class="submit-button" type="submit" value="Create Deck!">
                </form>
            </div>
        </div>

        <form method="get" name="searching" action="javascript:submit();" >
            <label>Search</label> <!-- Make label value change based on the option selected -->
            <input type="text" id="search" name="search" value="<?php if (isset($_GET['search'])) print $_GET['search'];?>" />

            <select id="type">
                <option value="name">Name</option>
                <option value="set">Set</option>
                <option value="class">Class</option>
                <option value="race">Race</option>
                <option value="quality">Quality</option>
                <option value="type">Type</option>
                <option value="faction">Faction</option>
            </select>

            <input class="submit-button" type="submit" value="Submit">
        </form>

       </div>
        <div id="result"></div>
    </body>
</html>
