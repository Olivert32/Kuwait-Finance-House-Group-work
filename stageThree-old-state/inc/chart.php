<div class="box">
    <h2 class="flex">Total number of staff</h2>
    <div class="chart">
        <canvas id="doughnut-chart"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var data = <?php echo $data_json; ?>;

    var labels = ["Admin", "Editor", "Adder", "Uploader"];
    var values = [0, 0, 0, 0];

    console.log(data)

    for (let i = 0; i < data.length; i++) {
        if (data[i]['role'] == "admin") {
            values[0] = values[0] + data[i]['COUNT']
        } else if (data[i]['role'] == "editor") {
            values[1] = values[1] + data[i]['COUNT']
        } else if (data[i]['role'] == "adder") {
            values[2] = values[2] + data[i]['COUNT']
        } else if (data[i]['role'] == "viewer") {
            values[3] = values[3] + data[i]['COUNT']
        }
    }

    new Chart(document.getElementById("doughnut-chart"), {
        type: 'doughnut',
        data: {
            labels: labels,
            datasets: [{
                backgroundColor: ['#FFC8B4', '#B5EAD7', '#F5D5E6', '#FDEBD0'],
                data: values
            }]
        }
    });
</script>