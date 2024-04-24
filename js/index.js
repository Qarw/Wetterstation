$(document).ready(function() {
    function getTemperature() {
        $.ajax({
            url: './lastTemperaturesApi.php', // Änderung der URL zur API
            dataType: 'json',
            success: function(data) {
                const temperatures = data.map(entry => entry.temperature); // Annahme: data enthält ein Array von Objekten mit Temperaturdaten
                updateChart(temperatures);
                console.log("in index.js");
            },
            error: function(xhr, status, error) {
                console.error('Error fetching temperature:', error);
                console.log('XHR status:', xhr.status);
                console.log('XHR response:', xhr.responseText);
            }
        });
    }

    function updateChart(temperatures) {
        var ctx = document.getElementById('chart').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ["Montag", "Dienstag", "Mittwoch", "Donnerstag", "Freitag", "Samstag", "Sonntag"],
                datasets: [{
                    label: "Temperatur [°C]",
                    data: temperatures, // Stelle sicher, dass temperatures ein Array mit den Temperaturdaten für jeden Tag ist
                    borderColor: 'rgb(75, 192, 192)',
                    backgroundColor: 'rgb(75, 192, 192)',
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
                            max: 25
                        }
                    }]
                }
            }
        });
    }

    getTemperature();
});
