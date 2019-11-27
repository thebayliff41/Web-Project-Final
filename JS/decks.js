function deleteIt(elem) {
    var num = parseInt(elem.id);
    var toDelete = document.getElementById(num + "img");

    toDelete.style = "display: none";
    elem.style = "display: none";
    console.log(toDelete.className);
    var req = new XMLHttpRequest();
    req.onload = function() {
        console.log(this.responseText);
    }
    req.open("GET", "http://47.39.149.56/Web-Project-Final/PHP/delete_card.php?val=" + toDelete.className + "&num=" + parseInt(num+1));
    req.send();
}