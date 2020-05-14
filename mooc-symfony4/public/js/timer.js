class Timer {
    constructor() {
        console.log("timer chargé");
        this.spanTimer = document.getElementById('gameinfo_time-numb');
        this.time = parseInt(this.spanTimer.textContent);
        this.startTimer();
    }

    startTimer(){
        this.timer = setInterval(() => {
            this.time = this.time + 1;
            this.min = Math.floor(this.time / 60);
            if (this.min.toString().length === 1) {
                this.min = "0" + this.min.toString()
            }
            this.sec = this.time % 60;
            if (this.sec.toString().length === 1) {
                this.sec = "0" + this.sec.toString()
            }
            this.spanTimer.textContent = this.min + ':' + this.sec;
        }, 1000)
    }
}

let timer = new Timer();