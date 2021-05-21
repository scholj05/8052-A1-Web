let api_url = "http://ec2-54-175-14-144.compute-1.amazonaws.com/api/reading/read.php"
//let db_path = '/home/ubuntu/SubWriter/pm_reading.sqlite'
let day_data = new Array();
let week_data = new Array();
let xhr;

function requestData() {
    xhr = new XMLHttpRequest();
    xhr.onreadystatechange = processJSON;
    xhr.open("GET", api_url, true);
    xhr.send();
}

function processJSON(data, status) {
    
    if (xhr.readyState == 4 && xhr.status == 200) {
        $('#status').html('Received readings!')
        .attr('class', 'alert alert-success');
        let allData = JSON.parse(xhr.responseText);
        day_data = allData["day"];
        week_data = allData["week"];
        console.log(day_data);
        console.log(week_data);

        $('#value1').html(day_data[day_data.length - 1].pm25);
        $('#value2').html(day_data[day_data.length - 1].pm10);
        $('#message').html(day_data[day_data.length - 1].date);
        

        drawChart(day_data, "pmChartDay");
        drawChart(week_data, "pmChartWeek");
    }
    else {
        $('#status').html('Failed to receieve readings')
        .attr('class', 'alert alert-warning');
    }
}

function drawChart(data, canvasID) {
    let ctx = document.getElementById(canvasID).getContext("2d");


    let PM10s = [];
    let PM25s = [];
    let timestamps = [];

    data.map((entry) => {
        PM10s.push(entry.pm10);
        PM25s.push(entry.pm25);
        timestamps.push(entry.date);
    });

    let chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: timestamps,
            datasets: [
                {
                    label: 'PM 10',
                    backgroundColor: 'rgba(255, 99, 132, 0.5)',
                    borderColor: 'rgba(255, 99, 132, 0.5)',
                    data: PM10s
                }, {
                    label: 'PM 2.5',
                    backgroundColor: 'rgba(100, 99, 255, 0.5)',
                    borderColor: 'rgba(100, 99, 255, 0.5)',
                    data: PM25s
                }]
        },
        options: {
            legend: {
                position: 'bottom',
            }
        }
    });
}

$(document).ready(function () {
    requestData();
    drawChart(day_data, "pmChartDay");
    drawChart(week_data, "pmChartWeek");
});