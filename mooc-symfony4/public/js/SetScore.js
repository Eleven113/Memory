class SetScore {
    constructor($player, $time, $try) {
        this.sendScore($player, $time, $try);
    }

    sendScore($player, $time, $try){
        this.data = {
            "player" : $player,
            "time" : $time,
            "try" : $try
        };

        $.post('/Memory/mooc-symfony4/public/index.php/score/setscore/', this.data)
    }
}

let setScore = new SetScore();
