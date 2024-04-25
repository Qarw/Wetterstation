<div class="container">
    <div class="row">
        <h2>Messdaten</h2>
    </div>
    <div class="row">
        <p class="form-inline">
            <a href="index.php?r=measurement/create" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> Erstellen</a>
            <a class="btn btn-default" href="index.php?r=home/index">Startseite</a>
        </p>

        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>Zeit</th>
                <th>Temperatur</th>
                <th>Regen [mm]</th>
                <th>Station</th>
            </tr>
            </thead>
            <tbody id="credentials">
            <?php

            require_once './models/Station.php';

            $counter = 0;

            foreach ($model as $m) {

                //$station = Station::get($m->getStationId());

                echo '<tr>';
                echo '<td>' . $m->getTime() . '</td>';
                echo '<td>' . $m->getTemperature() . '</td>';
                echo '<td>' . $m->getRain() . '</td>';
                echo '<td>' . $m->getStation()->getName() . '</td>';
                echo '<td>';
                echo '<a class="btn btn-info" href="index.php?r=measurement/view&id=' . $m->getId() . '"><span class="glyphicon glyphicon-eye-open"></span></a>';
                echo '&nbsp;';
                echo '<a class="btn btn-primary" href="index.php?r=measurement/update&id=' . $m->getId() . '"><span class="glyphicon glyphicon-pencil"></span></a>';
                echo '&nbsp;';
                echo '<a class="btn btn-danger" href="index.php?r=measurement/delete&id=' . $m->getId() . '"><span class="glyphicon glyphicon-remove"></span></a>';
                echo '</td>';
                echo '</tr>';

            }
            ?>
            </tbody>
        </table>
    </div>
</div> <!-- /container -->

