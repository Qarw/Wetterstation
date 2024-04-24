
function parseMeasurementTable(){

}

function loadAllMeasurements(){
    $.get('api/measurements', function (data) {
       console.log(data)
    });
}

function loadFilteredMeasurements(){

}



$(document).ready(function() {
    console.log("in index.js");
    var ctx = document.getElementById('chart').getContext('2d');
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'line',

        // The data for our dataset
        data: {
            labels: ["Montag", "Dienstag", "Mittwoch", "Donnerstag", "Freitag", "Samstag", "Sonntag"],
            datasets: [{
                label: "Temperatur [°C]",
                data: [14, 17, 17, 18, 16, 13, 14],
                borderColor: 'rgb(75, 192, 192)',
                backgroundColor: 'rgb(75, 192, 192)',
                fill: false,
                tension: 0
            }]
        },

        // Configuration options go here
        options: {
            scales: {
                yAxes: [{
                    type: 'linear',
                    position: 'left',
                    ticks: {
                        beginAtZero: true,
                        max: 25
                    }
                }]
            }
        }
    });
})