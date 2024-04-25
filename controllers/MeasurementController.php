<?php

require_once('Controller.php');
require_once('models/Station.php');
require_once('models/Measurement.php');

class MeasurementController extends Controller
{
    /**
     * @param $route array, e.g. [measurement, view]
     */
    public function handleRequest($route)
    {
        $operation = sizeof($route) > 1 ? $route[1] : 'index';
        $id = isset($_GET['id']) ? $_GET['id'] : 0;
        if ($operation == 'index') {
            $this->actionIndex();
        }elseif ($operation == 'view') {
            $this->actionView($id);
        }elseif ($operation == 'create') {
            $this->actionCreate();
        } elseif ($operation == 'update') {
            $this->actionUpdate($id);
        } elseif ($operation == 'delete') {
            $this->actionDelete($id);
        } else {
            Controller::showError("Page not found", "Page for operation " . $operation . " was not found!");
        }
    }

    public function actionCreate()
    {
        $model = new Measurement();

        if (!empty($_POST)) {
            $model->setTemperature($this->getDataOrNull('temperature'));
            $model->setRain($this->getDataOrNull('rain'));
            $model->setStation($this->getDataOrNull('station'));

            if ($model->save()) {
                $this->redirect('measurement/index');
                return;
            }
        }

        $this->render('measurement/create', $model);
    }

    public function actionIndex()
    {
        $model = Measurement::getAll();
        $this->render('measurement/index', $model);
    }

    public function actionView($id)
    {
        $model = Measurement::get($id);
        $this->render('measurement/view', $model);
    }

    public function actionUpdate($id)
    {
        $stations = Station::getAll();

        $model = Measurement::get($id);

        if (!empty($_POST)) {
            $model->setTime($this->getDataOrNull('time'));
            $model->setTemperature($this->getDataOrNull('temperature'));
            $model->setRain($this->getDataOrNull('rain'));
            $model->setStationId($this->getDataOrNull('station_id'));

            if ($model->save()) {
                $this->redirect('measurement/view&id=' . $model->getId());
                return;
            }
        }

        $this->render('measurement/update', ['model' => $model, 'stations' => $stations]);
    }

    public function actionDelete($id)
    {
        if (!empty($_POST)) {
            Measurement::delete($id);
            $this->redirect('home/index');
            return;
        }

        $this->render('measurement/delete', Measurement::get($id));
    }

}
