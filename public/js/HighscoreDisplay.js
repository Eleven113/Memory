class HighscoreDisplay {
    constructor() {
        this.divEasy = document.getElementById("hs_difficulty-easy");
        this.divMedium = document.getElementById("hs_difficulty-medium");
        this.divHard = document.getElementById("hs_difficulty-hard");
        this.div1Player = document.getElementById("hs_numplayers-1");
        this.div2Players = document.getElementById("hs_numplayers-2");
        this.h4 = document.getElementById("caption");
        this.tbody = document.querySelector("tbody");
        this.numplayers = 1;
        this.difficulty = "easy";
        this.events();
    }

    events() {
        this.divEasy.addEventListener("click", function (event) {
            this.difficulty = "easy";
            this.display(event);
        }.bind(this));

        this.divMedium.addEventListener("click", function (event) {
            this.difficulty = "medium";
            this.display(event);
        }.bind(this));

        this.divHard.addEventListener("click", function (event) {
            this.difficulty = "hard";
            this.display(event);
        }.bind(this));

        this.div1Player.addEventListener("click", function (event) {
            this.numplayers = 1;
            this.display(event);
        }.bind(this));

        this.div2Players.addEventListener("click", function (event) {
            this.numplayers = 2;
            this.display(event);
        }.bind(this));

    }

    display(event) {
        let difficulties = {
            "easy": "facile",
            "medium": "moyen",
            "hard": "difficile"
        };
        let numplayers = {
            1: "1 joueur",
            2: "2 joueurs"
        };
        let difficultyDivs = {
            "easy": this.divEasy,
            "medium": this.divMedium,
            "hard": this.divHard
        }
        let numPlayerDivs = {
            "1": this.div1Player,
            "2": this.div2Players
        };
        this.h4.textContent = "Mode " + numplayers[this.numplayers] + " - " + difficulties[this.difficulty];
        for (let div of Object.values(difficultyDivs)) {
            div.className = "hs_menu col-4 text-center";
        }
        for (let div of Object.values(numPlayerDivs)) {
            div.className = "hs_menu col-3 text-center";
        }
        difficultyDivs[this.difficulty].className += " font-weight-bold";
        numPlayerDivs[this.numplayers].className += " font-weight-bold";
        this.getScore(this.difficulty, this.numplayers);
    }

    getScore($numcards, $numplayers) {
        $.get('/Memory/public/index.php/score/getscore/' + $numcards + '/' + $numplayers, function (data) {
            this.tbody = document.querySelector("tbody")
            this.tbody.innerHTML = '';

            if ( data.length > 0 ){
                for (let i = 0; i <= data.length-1; i++) {
                    console.log(i);
                    console.log(data[i]);
                    this.tr = document.createElement('tr');
                    this.tr.innerHTML = '<td>' + data[i].player + '</td><td>' + data[i].try + '</td><td>' + data[i].time + '</td>';
                    this.tbody.append(this.tr);
                }
            } else {
                this.tr = document.createElement('tr');
                this.tr.innerHTML = '<td colspan="100%">' + "Il n'y a pas de score pour ce mode " + '</td>';
                this.tbody.append(this.tr);
            }

        });
    }
}

let highscoreDisplay = new HighscoreDisplay();