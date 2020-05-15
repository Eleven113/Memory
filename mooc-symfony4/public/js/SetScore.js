class SetScore {
    constructor($player, $time, $try) {
        this.player = $player;
        this.time = $time;
        this.try = $this;

        this.sendScore($this.player, this.time, this.try);
    }

    sendScore($player, $time, $try){
        this.data = {
            "player" : $player,
            "time" : $time,
            "try" : $try
        }

        $.post('/Memory/mooc-symfony4/public/index.php/score/setscore/')
    }
}
