<?php
require_once("models/Measurement.php");

// Holen der letzten 7 Temperaturen aus der Datenbank
$temperaturesData = Measurement::getLatestTemperatures();

// Konvertierung der letzten 7 Temperaturen in das JSON-Format
echo json_encode($temperaturesData);
?>
