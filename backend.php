<?php
$conn = new mysqli("localhost", "root", "root", "2427224_db");
if ($conn->connect_error) {
    die("Not connected" . $conn->connect_error);
}
$api = 'https://api.openweathermap.org/data/2.5/weather?q=Sunderland&appid=eb3bf2e68c62102f7c9bc8d8a3266f53';
$data_json = file_get_contents($api);
$data = json_decode($data_json, true);
if ($data) {
    $description = $data['weather'][0]['description'];
    $temperature = $data['main']['temp'];
    $speed = $data['wind']['speed'];
    $timestamp = date('Y-m-d H:i:s');
    $sql = "INSERT INTO weather (weather_description, weather_temperature, weather_wind, weather_when) 
            VALUES ('$description', '$temperature', '$speed', '$timestamp')";
    if ($conn->query($sql) === TRUE) {
        $sql_select = "SELECT * FROM weather ORDER BY weather_when DESC LIMIT 1";
        $result_select = $conn->query($sql_select);
        if ($result_select->num_rows > 0) {
            $row = $result_select->fetch_assoc();
            header('Content-Type: application/json');
            echo json_encode($row);
        } else {
            echo json_encode(array('error' => 'There is no any weather data'));
        }
    } else {
        echo json_encode(array('error' => 'Error Data is not Inserted : ' . $conn->error));
    }
} else {
    echo json_encode(array('error' => 'Error We cannot get the data From API'));
}
$conn->close();
?>
