const $ = require('jquery');
var x=1;

$(document).ready(function () {
    $("div.dice-number").text("hi");
    var dice1 = "build/dice/Dice-1.png";
    var dice2 = "build/dice/Dice-2.png";
    var dice3 = "build/dice/Dice-3.png";
    var dice4 = "build/dice/Dice-4.png";
    var dice5 = "build/dice/Dice-5.png";
    var dice6 = "build/dice/Dice-6.png";


    $("#throw").click(function () {
        var num = 0;
        var interval = setInterval(function () {
            num += 1;
            x = Math.floor((Math.random() * 10) + 1) % 6 + 1;
            switch (x) {
                case 1:
                    $("#dice_img").attr("src", dice1);
                    break;
                case 2:
                    $("#dice_img").attr("src", dice2);
                    break;
                case 3:
                    $("#dice_img").attr("src", dice3);
                    break;
                case 4:
                    $("#dice_img").attr("src", dice4);
                    break;
                case 5:
                    $("#dice_img").attr("src", dice5);
                    break;
                case 6:
                    $("#dice_img").attr("src", dice6);
                    break;
                default:
                    $("#dice_img").attr("src", dice1);
            }
            if (num == 30) {
                clearInterval(interval);
                var texts = x;
                $("p.dice-number").text(texts);

                document.getElementById("dice").setAttribute('value',x);
                document.getElementById("diceForm").submit();
            }
        }, 50);

    });
});