const API_key = "eb3bf2e68c62102f7c9bc8d8a3266f53";
const cityNameElement = document.getElementById("cityName");
const weatherIconElement = document.getElementById("weather-icon");
const apiUrl = "https://api.openweathermap.org/data/2.5/weather?q=Sunderland&appid=" + API_key;
fetch(apiUrl)
    .then(response => response.json())
    .then(data => {
        cityNameElement.textContent = data.name;
        const iconCode = data.weather[0].icon;
        weatherIconElement.src = `https://openweathermap.org/img/wn/${iconCode}.png`;
    })
    .catch(error => {
        console.error("Error fetching weather data:", error);
    });
document.addEventListener('DOMContentLoaded', function() {
    fetch('backend.php')
      .then(response => response.json())
      .then(data => {
        const description = data.weather_description;
        const temperature = data.weather_temperature;
        const temp = Math.round(temperature - 273.15);
        const windSpeed = data.weather_wind;
        const timestamp = data.weather_when;
        document.getElementById('description').innerText ="The weather is: "+ description;
        document.getElementById('temperature').innerText = "Temperature is: "+ temp + "C";
        document.getElementById('windSpeed').innerText = "Wind Speed is: " + windSpeed;
        document.getElementById('timestamp').innerText = "Current Time is: " +timestamp;
      })
      .catch(error => {
        console.error('Error fetching data:', error);
      });
});
