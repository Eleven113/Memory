class HighscoreDisplay{
    constructor() {
        this.divEasy = document.getElementById("hs_difficulty-easy");
        this.divMedium = document.getElementById("hs_difficulty-medium");
        this.divHard = document.getElementById("hs_difficulty-hard");
        this.h4 = document.getElementById("caption");
        this.tbody = document.querySelector("tbody");
        this.events();

    }

    events(){
        this.divEasy.addEventListener("click", function(event){
            this.display(event);
        }.bind(this));

        this.divMedium.addEventListener("click", function(event){
            this.display(event);
        }.bind(this));

        this.divHard.addEventListener("click", function(event){
            this.display(event);
        }.bind(this));

    }

    display(event){
        this.difficulty = event.target.id.split('-')[1];

        switch (this.difficulty) {
            case "easy":
                this.h4.textContent = "Mode Facile";
                this.divEasy.className = "col-4 text-center font-weight-bold";
                this.divMedium.className = "col-4 text-center";
                this.divHard.className = "col-4 text-center";
                this.getScore(6);
                break;

            case "medium":
                this.h4.textContent = "Mode Moyen";
                this.divEasy.className = "col-4 text-center";
                this.divMedium.className = "col-4 text-center font-weight-bold";
                this.divHard.className = "col-4 text-center";
                this.getScore(12);
                break;

            case "hard":
                this.h4.textContent = "Mode Difficile";
                this.divEasy.className = "col-4 text-center";
                this.divMedium.className = "col-4 text-center";
                this.divHard.className = "col-4 text-center font-weight-bold";
                this.getScore(18);
                break;

            default:
                break;
        }


    }

    getScore($id){
        $.get('/Memory/mooc-symfony4/public/index.php/score/getscore/'+$id, function(data){
            document.querySelector("tbody").innerHTML = '';
            for (let i=0; i <= data.length; i++){
                this.tr = document.createElement('tr');
                this.tr.innerHTML = '<td>' + data[i].player + '</td><td>' + data[i].try + '</td><td>' + data[i].time + '</td>';
                document.querySelector("tbody").append(this.tr);
            }
        });
    }
}

let highscoreDisplay = new HighscoreDisplay();