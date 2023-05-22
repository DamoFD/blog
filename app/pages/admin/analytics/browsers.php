<section id="browsers">
<h2 class="font-poppins font-size-med">Browsers</h2>

<canvas id="browsersChart"></canvas>

</section>

<script>

    const browserRequestData = <?php
    $browserLabelsArray = [];
    $browserRequestDataArray = [];
    foreach ($top_browsers as $key => $value) {
        $browserLabelsArray[] = $key;
        $browserRequestDataArray[] = $value;
    }
    echo json_encode($browserRequestDataArray);
    ?>;

    const browserLabels = <?php
    echo json_encode($browserLabelsArray);
    ?>;

    const browserData = {
        labels: browserLabels,
        datasets: [
            {
                label: 'Browser',
                data: browserRequestData,
                borderColor: "#17c294",
                backgroundColor: "#17c294",
            }
        ]
    };

    const browserConfig = {
        type: 'bar',
        data: browserData,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Browser'
                }
            }
        },
    };

    // Render the chart
    var browserChart = new Chart(
        document.getElementById('browsersChart'),
        browserConfig
    );
</script>

