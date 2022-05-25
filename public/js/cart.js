'use strict'

let reservationTime = document.getElementsByClassName("reservation-time");

let minutes;
let seconds;
let timeSeconds = new Array();

for (let i = 0 ; i<reservationTime.length ; i++) {
    timeSeconds[i] = reservationTime[i].innerText;
    let timerSeconds = setTimeout(function timer() {
        timeSeconds[i]--;
        minutes = Math.floor(timeSeconds[i]/60);
        seconds = timeSeconds[i] - 60*minutes;
        if (seconds < 10) {
            seconds = "0" + seconds;
        }
        reservationTime[i].innerText = minutes + ":" + seconds;
        if (timeSeconds[i] > 0) {
            timerSeconds = setTimeout(timer, 1000);
        }
        
    }, 1000)
}



