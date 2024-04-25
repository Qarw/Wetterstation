<div class="row">
    <div class="col-md-4">
        <div class="form-group required <?= $model->hasError('temperature') ? 'has-error' : ''; ?>">
            <label class="control-label">Temperatur *</label>
            <input type="text" class="form-control" name="temperature" value="<?= $model->getTemperature() ?>">

            <?php if ($model->hasError('temperature')): ?>
                <div class="help-block"><?= $model->getError('temperature') ?></div>
            <?php endif; ?>
        </div>
    </div>
    <div class="col-md-1"></div>
    <div class="col-md-3">
        <div class="form-group required <?= $model->hasError('rain') ? 'has-error' : ''; ?>">
            <label class="control-label">Regen *</label>
            <input type="text" class="form-control" name="rain" value="<?= $model->getRain() ?>">

            <?php if ($model->hasError('rain')): ?>
                <div class="help-block"><?= $model->getError('rain') ?></div>
            <?php endif; ?>
        </div>
    </div>
    <div class="col-md-1"></div>
    <div class="col-md-3">
        <select class="form-control" name="station_id" style="width: 200px" id="stationName">
            <?php
            require_once 'models/Station.php';
            $station = Station::getAll();
            foreach($station as $s):
                echo '<option value="' . $s->getID() . '">' . $s->getName() . '</option>';
            endforeach;
            ?>
        </select>
    </div>
</div>
