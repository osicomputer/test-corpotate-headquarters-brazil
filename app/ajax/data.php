<?php

// Obtener los datos del gráfico
$labels = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio"];
$data = [10, 20, 30, 40, 50, 60];

// Convertir los datos a JSON
$response = json_encode([
  "labels" => $labels,
  "data" => $data
]);

// Enviar la respuesta JSON
header('Content-Type: application/json');
echo $response;

?>