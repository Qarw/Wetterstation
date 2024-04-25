$(document).ready(function() {
    function getTemperature() {
        $.ajax({
            url: './lastTemperaturesApi.php',
            dataType: 'json',
            success: function(data) {
                const temperatures = data.map(entry => entry.temperature);
                const rain = data.map(entry => entry.rain);
                const time = data.map(entry => entry.time);
                updateChart(temperatures, rain, time);
            }

        });
    }

    function updateChart(temperatures, rain, time) {
        var ctx = document.getElementById('chart').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: time,
                datasets: [{
                    label: "Temperatur [°C]",
                    data: temperatures,
                    borderColor: 'rgb(75, 192, 192)',
                    backgroundColor: 'rgb(75, 192, 192)',
                    fill: false,
                    tension: 0
                },
                    {
                        label: "Regenmenge [mm]",
                        data: rain,
                        borderColor: 'rgb(192, 75, 192)',
                        backgroundColor: 'rgb(192, 75, 192)',
                        fill: false,
                        tension: 0
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        type: 'linear',
                        position: 'left',
                        ticks: {
                            beginAtZero: true,
                            max: 40
                        }
                    }]
                }
            }
        });
    }

    getTemperature();
});
