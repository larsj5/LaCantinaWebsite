var selectTime = document.getElementById("time");
var startTime = 20 * 60; // Convert start time to minutes
var endTime = 23 * 60 + 30; // Convert end time to minutes
var increment = 15; // Time increment in minutes

for (var i = startTime; i <= endTime; i += increment) {
    var hours = Math.floor(i / 60);
    var minutes = i % 60;
    var timeFormatted = ("0" + hours).slice(-2) + ":" + ("0" + minutes).slice(-2);
    var option = document.createElement("option");
    option.text = timeFormatted;
    option.value = timeFormatted;
    selectTime.appendChild(option);
}