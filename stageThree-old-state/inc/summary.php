<div class="box">
    <h2 class="flex">Summary All Time</h2>
    <div class="chart">
        <canvas id="doughnut-chart"></canvas>
    </div>
    <h2>Summary Monthly</h2>
    <div class="grid-2-3">
        <?php foreach ($summarys as $summary) { ?>
            <div class="box summary">
                <div>
                    <p>action: </p>
                    <p><?= $summary['action'] ?></p>
                </div>
                <div>
                    <p>date: </p>
                    <p><?= $summary['DATE'] ?></p>
                </div>
                <div>
                    <p>count: </p>
                    <p><?= $summary['COUNT'] ?></p>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var data = <?php echo $data_json; ?>;

    var labels = ["Delete", "Edit", "Upload", "Registerd", "Approved"];
    var values = [0, 0, 0, 0, 0];

    for (let i = 0; i < data.length; i++) {
        if (data[i]['action'] == "delete") {
            values[0] = values[0] + data[i]['COUNT']
        } else if (data[i]['action'] == "edit") {
            values[1] = values[1] + data[i]['COUNT']
        } else if (data[i]['action'] == "upload") {
            values[2] = values[2] + data[i]['COUNT']
        } else if (data[i]['action'] == "user registered") {
            values[3] = values[3] + data[i]['COUNT']
        } else if (data[i]['action'] == "user approved") {
            values[4] = values[4] + data[i]['COUNT']
        }
    }

    

    new Chart(document.getElementById("doughnut-chart"), {
        type: 'doughnut',
        data: {
            labels: labels,
            datasets: [{
                backgroundColor: ['#FFC8B4', '#B5EAD7', '#F5D5E6', "#FFE0B2", "#C6D8AF"],
                data: values
            }]
        }
    });
</script>