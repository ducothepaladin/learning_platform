const disableCanvas = document.getElementById('disable-canvas');
const body = document.querySelector('body');
const setBtn = document.getElementById('punishment-set');

let check = puni? true: false;


function disableHandle () {
    
    if(check) {
        disableCanvas.style.display = "none";
        body.style.overflowY = "scroll";
    } else {
        disableCanvas.style.display = "block";
        body.style.overflowY = "hidden";
    }
}

disableHandle();