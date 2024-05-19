<div class="container">
    <div class="row">
        <h2>Vorarlbergerische Wetterstation</h2>
    </div>
    <div class="row">
        <p class="form-inline">
            <select class="form-control" name="stationId" style="width: 200px" id="stationName">
                <?php

                require_once 'models/Station.php';
                $station = Station::getAll();
                foreach($station as $s):
                    echo '<option value="' . $s->getID() . '">' . $s->getName() . '</option>';
                endforeach;


                ?>
            </select>
            <script>
                function reloadPage() {
                    var selectedItem = document.getElementById("stationName");
                    location.href = "http://localhost/Wetterstation/?station=" + (selectedItem.selectedIndex + 1 );
                }
            </script>
            <button id="btnSearch" onclick="reloadPage()" name ="suchen" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span> Messwerte anzeigen</button>
            <a class="btn btn-default" href="index.php?r=station/index"><span class="glyphicon glyphicon-pencil"></span> Messstationen bearbeiten</a>
            <a class="btn btn-default" href="index.php?r=measurement/index"><span class="glyphicon glyphicon-pencil"></span> Messwerte bearbeiten</a>



            <canvas id="chart" width="400" height="100"></canvas>

        <br/>

        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>Zeitpunkt</th>
                <th>Temperatur [C°]</th>
                <th>Regenmenge [ml]</th>
                <th></th>
            </tr>
            </thead>
            <tbody id="measurements"></tbody>
            <?php

            require_once 'models/Measurement.php';
            //messwerte dynamisch anzeigen lassen
            $currentStation = $_GET['station'] ?? "1";
            $measurements = Measurement::getAllByStation($currentStation);
            $reversedMeasurements = array_reverse($measurements);

            foreach ($reversedMeasurements as $m) {
                echo "<tr>";
                echo "<td>" . $m->getTime() . "</td>";
                echo "<td>" . $m->getTemperature() . "</td>";
                echo "<td>" . $m->getRain() . "</td>";
                echo "<td>" . $m->getId() . "</td>";
                echo "</tr>";
            }

            function exportfile(){
                $currentStation = $_GET['station'] ?? "1";
                $currentNameOfStation = Station::get($currentStation);
                $measurements = Measurement::getAllByStation($currentStation);


                $file = fopen("output.txt", "w");
                $content = "Zeit;Temperatur;Regen;Stations ID";
                foreach ($measurements as $m){
                    $content = $content . "\n" . $m->getTime() . ";" . $m->getTemperature() . ";" . $m->getRain() . ";" . $m->getId();
                }
                fwrite($file, $content);
                fclose($file);
            }
            exportfile();
            ?>

            </tbody>
        </table>


    </div>
</div> <!-- /container -->
