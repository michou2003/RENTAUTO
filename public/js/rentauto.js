var DriverView = document.querySelector('#boolchauftrue');

DriverView.addEventListener('click', function () {
    if (DriverView.checked == true) {
        document.getElementById('radioBox').style.display = "block";
    }
})

var DriverNone = document.querySelector('#boolchauffalse');

DriverNone.addEventListener('click', function () {
    if (DriverNone.checked == true) {
        document.getElementById('radioBox').style.display = "none";
    }
})


var AvanceView = document.querySelector('#boolavancetrue');

AvanceView.addEventListener('click', function () {
    if (AvanceView.checked == true) {
        document.getElementById('avanceBox').style.display = "block";
    }
})

var AvanceNone = document.querySelector('#boolavancefalse');

AvanceNone.addEventListener('click', function () {
    if (AvanceNone.checked == true) {
        document.getElementById('avanceBox').style.display = "none";
    }
})