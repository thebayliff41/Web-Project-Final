onmessage = function (e) {
    var req = new XMLHttpRequest();

    req.onload = function () {
        if (req.status != 200) return;

        if (this.responseText == "nli") {
            postMessage("nli");
            return;
        } else if (this.responseText == "no decks") {
            postMessage("no decks");
            return;
        } else if (this.responseText.includes("\n")) { //min is returned, desired result
            postMessage(this.responseText.substr(0, this.responseText.indexOf("\n")));
            return;
        } else if (this.responseText == "duplicate") {
            postMessage("duplicate");
            return;
        } else if (this.responseText == "full") {
            postMessage("full");
            return;
        } else if (this.responseText == "error") {
            postMessage("error");
            return;
        }

        console.log(this.responseText);
    };

    //req.open("GET", "http://localhost:3000/PHP/get_decks.php?add=" + e.data, false);
    req.open("GET", "http://47.39.149.56/Web-Project-Final/PHP/get_decks.php?add=" + e.data, false); //Use when launching
    req.send();
}

