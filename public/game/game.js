(function(){
    "use strict";

    var POST_UPDATE = "update";

    // http://stackoverflow.com/questions/133925/javascript-post-request-like-a-form-submit
    // Example:
    //     post('/contact/', {name: 'Johnny Bravo'});
    function post(path, params, method) {
        method = method || "post"; // Set method to post by default if not specified.

        // The rest of this code assumes you are not using a library.
        // It can be made less wordy if you use one.
        var form = document.createElement("form");
        form.setAttribute("method", method);
        form.setAttribute("action", path);

        for(var key in params) {
            if(params.hasOwnProperty(key)) {
                var hiddenField = document.createElement("input");
                hiddenField.setAttribute("type", "hidden");
                hiddenField.setAttribute("name", key);
                hiddenField.setAttribute("value", params[key]);

                form.appendChild(hiddenField);
             }
        }

        document.body.appendChild(form);
        form.submit();
    }

    var remainingPairs = 16;

    var firstCardElement;
    var firstClick = -1;

    var board;
    var time = 0;
    var timerInterval;

    var isMultiplayer;
    var room, username;
    var myRef;
    var started = false;

    var waiting = false;

    var binary = [
        "0000", "0001", "0010", "0011",
        "0100", "0101", "0110", "0111",
        "1000", "1001", "1010", "1011",
        "1100", "1101", "1110", "1111"
    ];

    var hexadecimal = [
        "0", "1", "2", "3",
        "4", "5", "6", "7",
        "8", "9", "A", "B",
        "C", "D", "E", "F"
    ];

    window.onload = function() {
        var body = document.getElementsByTagName("body")[0];
        isMultiplayer = body.dataset.multiplayer === "true";

        board = document.getElementById("board");

        if(isMultiplayer) {
            room = document.getElementById('room').value.trim();
            username = document.getElementById('username').value.trim();

            var opponentBoard = document.getElementById("opponent-board");

            var rootRef = new Firebase("https://jpl-bin-hex.firebaseio.com/");
            var roomRef = rootRef.child(room);
            myRef = roomRef.child(username);
            sendUpdate();
            myRef.onDisconnect().remove();

            roomRef.on('child_removed', function(oldChildSnapshot) {
                var opponentData = dataSnapshot.val()[opponent];
                if(opponentData["remainingPairs"] === 0) {
                    lose(opponentData["username"], opponentData["time"]);
                } else {
                    alert("Opponent has left the game :(");
                    window.location.href = "lobby";
                }
            });

            roomRef.on('value', function(dataSnapshot) {
                if(dataSnapshot.numChildren() === 2) {
                    // Start!
                    if(!started) {
                        started = true;
                        start();
                        sendUpdate();
                        opponentBoard.style.visibility = "visible";
                    }

                    var opponent = "";
                    dataSnapshot.forEach(function(childSnapshot) {
                        if(childSnapshot.name() !== username) {
                            opponent = childSnapshot.name();
                        }
                    });
                    if(opponent !== "") {
                        var opponentData = dataSnapshot.val()[opponent];
                        opponentBoard.innerHTML = opponentData["board"];
                        if(opponentData["remainingPairs"] === 0) {
                            lose(opponentData["username"], opponentData["time"]);
                        }
                    }
                }
            });
        } else {
            start();
        }
    }

    function start() {
        setUpBoard();
        var timer = document.getElementById("timer");
        timerInterval = setInterval(function() {
            time += 1;
            timer.innerHTML = formatHundredth(time);
        }, 10);
    }

    function formatHundredth(number) {
        var stringNumber = "" + number;
        if(number < 10) {
            stringNumber = "0" + stringNumber;
        }
        if(number < 100) {
            stringNumber = "0" + stringNumber;
        }
        return stringNumber.substring(0, stringNumber.length - 2) + "." + stringNumber.substring(stringNumber.length - 2);
    }

    function setUpBoard() {
        var binaryCopy = binary.slice();
        var hexadecimalCopy = hexadecimal.slice();
        for(var i = 0; i < 32; i++) {
            var card = document.createElement("div");
            card.classList.add("card");
            var correctArray;
            if(binaryCopy.length === 0) {
                correctArray = hexadecimalCopy;
            } else if(hexadecimalCopy.length === 0) {
                correctArray = binaryCopy;
            } else {
                if(Math.random() > 0.5) {
                    correctArray = binaryCopy;
                } else {
                    correctArray = hexadecimalCopy;
                }
            }
            if(correctArray === binaryCopy) {
                card.classList.add("binary");
            } else {
                card.classList.add("hexadecimal");
            }
            card.innerHTML = randomRemove(correctArray);

            card.addEventListener("click", cardClick);
            
            board.appendChild(card);
            if(i % 4 === 3) {
                board.appendChild(document.createElement("br"))
            }
        }
        board.style.visibility = "visible";
    }

    function randomRemove(array) {
        var randomIndex = Math.random() * array.length;
        return array.splice(randomIndex, 1)[0];
    }

    function cardClick(event) {
        if(waiting) {
            return;
        }

        var selectedCard = this;

        var index = binary.indexOf(selectedCard.innerHTML);
        if(index === -1) {
            index = hexadecimal.indexOf(selectedCard.innerHTML);
        }

        selectedCard.classList.add("selected");

        if(firstClick === -1) {
            firstClick = index;
            firstCardElement = selectedCard;
        } else {
            selectedCard.classList.remove("selected");
            firstCardElement.classList.remove("selected");
            if(selectedCard !== firstCardElement) {
                if(firstClick === index) {
                    removeCards([selectedCard, firstCardElement]);
                    remainingPairs -= 1;
                } else {
                    waiting = true;
                    selectedCard.classList.add("wrong");
                    firstCardElement.classList.add("wrong");
                    setTimeout(function() {
                        waiting = false;
                        selectedCard.classList.remove("wrong");
                        firstCardElement.classList.remove("wrong");
                        if(isMultiplayer) {
                            sendUpdate();
                        }
                    }, 1000);
                }
            }
            firstClick = -1;
        }

        if(isMultiplayer) {
            sendUpdate();
        }

        if(remainingPairs === 0) {
            win();
        }
    }

    function removeCards(cards) {
        for(var i = 0; i < cards.length; i++) {
            cards[i].style.visibility = "hidden";
        }
    }

    function win() {
        clearInterval(timerInterval);
        post(POST_UPDATE, {
            "multiplayer" : isMultiplayer,
            "win": true,
            "time": time
        });
    }

    function lose(opponentUsername, opponentTime) {
        clearInterval(timerInterval);
        post(POST_UPDATE, {
            "multiplayer" : isMultiplayer,
            "win": false
        });
    }

    function sendUpdate() {
        myRef.set({
            "username": username,
            "board": board.innerHTML, 
            "remainingPairs": remainingPairs,
            "time": time
        });
    }
})();