class NewgamePlayerdisplay {
    constructor(){
        this.divPlayer2 = document.getElementById('player2');
        this.select = document.getElementById('newgame_playernumb');
        this.event();
    }

    displayDiv(){
        this.selectValue = parseInt(this.select.options[this.select.selectedIndex].value);
        console.log(this.selectValue);

        if ( this.selectValue === 2) {
            this.divPlayer2.className = "form-group mt-3";
        }
        else {
            this.divPlayer2.className = "d-none form-group mt-3"
        }
    }

    event(){
        this.select.addEventListener("change", this.displayDiv.bind(this));
    }
}

let newgamePlayerdisplay = new NewgamePlayerdisplay();