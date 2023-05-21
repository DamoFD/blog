<h2>Traffic</h2>

<canvas id="trafficChart"></canvas>

<script>

    const trafficRequestData = <?php
    $trafficRequestDataArray = [];
    foreach ($last_requests_by_weekday as $key => $value) {
        $trafficLabelsArray[] = $key;
        $trafficRequestDataArray[] = $value;
    }
    echo json_encode($trafficRequestDataArray);
    ?>;

    const trafficVisitorData = <?php
    $trafficVisitorDataArray = [];
    foreach ($last_visitors_by_weekday as $key => $value) {
        $trafficVisitorDataArray[] = array_sum($value);
    }
    echo json_encode($trafficVisitorDataArray);
    ?>;

    const trafficLabels = <?php
    echo json_encode($trafficLabelsArray)
    ?>;

    const trafficData = {
        labels: trafficLabels,
        datasets: [
            {
                label: 'Requests',
                data: trafficRequestData,
                borderColor: "red",
                backgroundColor: "red",
            },
            {
                label: 'Visitors',
                data: trafficVisitorData,
                borderColor: "blue",
                backgroundColor: "blue",
            }
        ]
    };

    const trafficConfig = {
        type: 'line',
        data: trafficData,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Traffic'
                }
            }
        },
    };

    // Render the chart
    var trafficChart = new Chart(
        document.getElementById('trafficChart'),
        trafficConfig
    );
</script>

