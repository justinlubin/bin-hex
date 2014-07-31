<!DOCTYPE html>

<html lang="en-US">
    <head>
        <meta charset="UTF-8" />
        <title>Bin::Hex Multiplayer Game</title>
        <link rel="stylesheet" href="game.css" />
        <script type='text/javascript' src='https://cdn.firebase.com/js/client/1.0.17/firebase.js'></script>
        <script src="game.js"></script>
    </head>
    <body data-multiplayer="true">
        <div id="timer-wrapper">Time: <span id="timer">0.00</span>s</div>
        <div id="board"></div>
        <div id="opponent-board"></div>

        <input type="hidden" id="room" value="{{ $room }}" />
        <input type="hidden" id="username" value="{{ $username }}" />
    </body>
</html>