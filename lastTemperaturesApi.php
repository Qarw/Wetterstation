<?php
require_once("models/Measurement.php");

$temperaturesData = Measurement::getLatestTemperatures();

echo json_encode($temperaturesData);
?>
