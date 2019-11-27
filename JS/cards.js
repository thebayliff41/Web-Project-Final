var index = 0;

window.onclick = function(e) {
    //if the user clicks out of the modal window then remoe it
    if (e.target == document.getElementById("modal")) {
        document.getElementById("modal").style = "none";
    }
}

/**
 * Submits the main form of the page
 */
function submit() {
    var resdiv = document.getElementById("result");
    var searchType = document.getElementById("type").value;

    var url = "/cards/";

    //update url based on the option the user wants to search
    switch (searchType) {
        case "name":
            url += "search/";
            break;
        case "set":
            url += "sets/";
            break;
        case "class":
            url += "classes/"
            break;
        case "race":
            url += "races/"
            break;
        case "quality":
            url += "qualities/"
            break;
        case "type":
            url += "types/"
            break;
        case "faction":
            url += "factions/"
            break;
    }

    if (resdiv.hasChildNodes()) { //remove images if already there/
        //delete each node
        Array.from(document.getElementsByClassName("results")).forEach(element => {
            resdiv.removeChild(element);
        });
    }

    var name = document.getElementById('search').value;

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onload = function () { //when result is processed
        if (this.status == 404) { //the url can't get results
            alert("error, enter a more detailed search");
            return;
        }

        var arr = JSON.parse(this.responseText);

        Array.from(arr).forEach(element => {
            //these card sets don't have images included 
            if (element["cardSet"] == "Rastakhan's Rumble" || element["cardSet"] == "The Boomsday Project" || element["cardSet"] == "Rise of Shadows") {
                return;
            }

            //image exists
            var results = document.getElementById("result");
            var div = document.createElement("div");
            div.setAttribute("id", "results");
            div.setAttribute("class", "results");
            results.appendChild(div);

            var image = document.createElement("img");
            image.setAttribute("src", element["img"]);
            div.appendChild(image);

            div.innerHTML += "</br>";

            var button = document.createElement("button");
            button.innerHTML = "Add to Deck";
            button.setAttribute("class", "add");

            button.addEventListener("click", function () {

                //worker checks for index of next available place in deck
                var w = new Worker("../JS/deck_worker.js");

                w.postMessage(element['cardId']); //add card to deck

                w.onmessage = function (e) {
                    if (e.data == "nli") { //not logged in
                        alert("You must be logged in to create decks");
                        w.terminate();
                        return;
                    } else if (e.data == "duplicate") { //duplicate data in deck
                        alert("more than 2 duplicates aren't allowed in a deck");
                        w.terminate();
                        return;
                    } else if (e.data == "full") {
                        alert("Your deck is currently full");
                        w.terminate();
                        return;
                    } else if (e.data == "error") {
                        alert("Error with querying");
                        w.terminate();
                        return;
                    } else if (e.data == "no decks") { //user has no decks
                        alert("You don't have any decks");
                        w.terminate();

                        document.getElementById("modal").style.display = "block";

                        return;
                    }

                    //normal execution, user has deck, was able to add card to deck
                    index = e.data; //update index of next available space to add
                    w.terminate();
                };
            });
            div.appendChild(button);
        });
    }
    xmlhttp.open("GET", "https://omgvamp-hearthstone-v1.p.rapidapi.com" + url + name + "?collectible=1");

    //api needs 2 headers to be identified in order to use it
    xmlhttp.setRequestHeader("X-RapidAPI-Host", "omgvamp-hearthstone-v1.p.rapidapi.com");
    xmlhttp.setRequestHeader("X-RapidAPI-Key", "515a0871e5mshd0993dfb00e17f7p10d5ecjsneb6f413631ca");

    xmlhttp.send();
}

/**
 * Calls to the serer to create the deck
 */
function createDeck() {
    var cl = document.getElementById("class").value.toUpperCase();
    var format = document.getElementById("format").value.toUpperCase();

    //remove the modal window
    document.getElementById("modal").style = "none";

    var req = new XMLHttpRequest();

    req.onload = function() {
        if (this.responseText == "error") {
            alert("Error, your deck couldn't be added");
        } else if (this.responseText == "nli") {
            alert("You must be logged in to create a deck");
        }
    }

    req.open("GET", "http://47.39.149.56/Web-Project-Final/PHP/create_deck.php?class=" + cl + "&format=" + format);
    //http.open("GET", "localhost:3000/PHP/create_deck.php?class=" + cl + "&format=" + format);
    req.send();

}