<section id="traffic">
<h2 class="font-poppins font-size-med">Traffic</h2>

<canvas id="trafficChart"></canvas>
</section>

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
                borderColor: "#17c294",
                backgroundColor: "#17c294",
                tension: 0.4,
            },
            {
                label: 'Visitors',
                data: trafficVisitorData,
                borderColor: "#c21745",
                backgroundColor: "#c21745",
                tension: 0.4,
            }
        ]
    };

    const trafficConfig = {
        type: 'line',
        data: trafficData,
        options: {
            responsive: true,
            interaction: {
                intersect: false,
                mode: 'index',
            },
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

