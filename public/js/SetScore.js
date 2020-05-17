class SetScore {
    constructor(player, time, tries, difficulty, numplayers) {
        this.player = player;
        this.time = time;
        this.try = tries;
        this.difficulty = difficulty;
        this.numplayers = numplayers;
        this.sendScore(this.player, this.time, this.try, this.difficulty, this.numplayers);
    }

    sendScore(player, time, tries, difficulty, numplayers){
        this.data = {
            "player" : player,
            "time" : time,
            "try" : tries,
            "difficulty" : difficulty,
            "numplayers" : numplayers
        };
        $.post('/Memory/public/index.php/score/setscore/', this.data, function(){})
    }
}

