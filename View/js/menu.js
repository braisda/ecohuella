var notifications;

function checkCards() {
    card1 = $("#card1");
    card2 = $("#card2");
    card3 = $("#card3");
    if (getCookie("userRole") == "basico") {
        card1.attr("style", "display: block; height: 16rem; width: 28rem");
        card2.attr("style", "display: block");
        card3.attr("style", "display: block");
    } else {
        card1.attr("style", "display: none");
        card2.attr("style", "display: none");
        card3.attr("style", "display: none");
    }
}