<div class="box">
    <h2 class="flex">Total Number of Document</h2>
    <div class="chart">
        <canvas id="doughnut-chart"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var data = <?php echo $data_json; ?>;

    var labels = ["High", "Mid", "Low"];
    var values = [0, 0, 0];

    console.log(data)

    for (let i = 0; i < data.length; i++) {
        if (data[i]['level'] == "high") {
            values[0] = values[0] + data[i]['COUNT']
        } else if (data[i]['level'] == "mid") {
            values[1] = values[1] + data[i]['COUNT']
        } else if (data[i]['level'] == "low") {
            values[2] = values[2] + data[i]['COUNT']
        }
    }

    new Chart(document.getElementById("doughnut-chart"), {
        type: 'doughnut',
        data: {
            labels: labels,
            datasets: [{
                backgroundColor: ['#FFC8B4', '#B5EAD7', '#F5D5E6'],
                data: values
            }]
        }
    });
</script>