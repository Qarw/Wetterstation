<?php

require_once('controllers/RESTController.php');

// entry point for the rest api
// e.g. http://localhost/php42/api.php?r=measurement/view&id=25
// select route: measurement/view&id=25 -> controller=measurement, action=view, id=25
$route = isset($_GET['r']) ? explode('/', trim($_GET['r'], '/')) : ['measurement'];
$controller = sizeof($route) > 0 ? $route[0] : 'measurement';

if ($controller == 'measurement') {
    require_once('controllers/MeasurementRESTController');

    try{
        (new MeasurementRESTController()) ->handleRequest();
    } catch (Exception $e) {
       RESTController::responseHelper($e->getMessage(), $e->getCode());
    }
} else {
        RESTController::responseHelper('REST-Controller "' . $controller . '" not found', '404');
}

?>