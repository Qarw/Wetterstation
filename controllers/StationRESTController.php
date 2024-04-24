<?php

require_once('RESTController.php');
require_once('models/Station.php');

class StationRESTController extends RESTController {
    public function handleRequest()
    {
        switch ($this->method) {
            case 'GET':
                $this->handleGETRequest();
                break;
            case 'POST':
                $this->handlePOSTRequest();
                break;
            case 'PUT':
                $this->handlePUTRequest();
                break;
            case 'DELETE':
                $this->handleDELETERequest();
                break;
            default:
                $this->response('Method Not Allowed', 405);
                break;
        }
    }

    public function handleGETRequest() {
        if ($this->verb == null && sizeof($this->args) == 0) {
            $model = Station::getAll();
            $this->response($model);
        } else if ($this->verb == null && sizeof($this->args) == 1) {
            $model = Station::get($this->args[0]);

            if ($model == null) {
                $this->response('Not found', 404);
            } else {
                $this->response($model);
            }
        } else if ($this->verb == 'search' && sizeof($this->args) == 1) {
            $model = Station::getAll($this->args[0]);
            $this->response($model);
        } else {
            $this->response('Bad request', 400);
        }
    }

    public function handlePOSTRequest() {
        $model = new Station();
        $model->setName($this->getDataOrNull('name'));
        $model->setAltitude($this->getDataOrNull('altitude'));
        $model->setLocation($this->getDataOrNull('location'));

        if ($model->save()) {
            $this->response('Created', 201);
        } else {
            $this->response($model->getErrors(), 400);
        }
    }

    public function handlePUTRequest()
    {

        if ($this->verb == null && sizeof($this->args) == 1) {

            $model = Station::get($this->args[0]);

            if ($model == null) {
                $this->response('Not found', 404);
            } else {
                $model->setName($this->getDataOrNull('name'));
                $model->setAltitude($this->getDataOrNull('altitude'));
                $model->setLocation($this->getDataOrNull('location'));

                if ($model->save()) {
                    $this->response('OK');
                } else {
                    $this->response($model->getErrors(), 400);
                }
            }

        } else {
            $this->response('Not found', 404);
        }

    }

    public function handleDELETERequest() {

        if ($this->verb == null && sizeof($this->args) == 1) {

            Station::delete($this->args[0]);
            $this->response('OK');
        } else {
            $this->response('Not found', 404);
        }

    }

}