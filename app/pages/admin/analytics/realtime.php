<section id="realtime">
<h2 class="font-poppins font-size-med">Real Time</h2>

<canvas id="realtimeChart"></canvas>

</section>

<script>
    const realTimeLabels = ["2 AM", "3 AM", "4 AM", "5 AM", "6 AM", "7 AM", "8 AM", "9 AM", "10 AM", "11 AM", "12 PM", "1 PM", "2 PM", "3 PM", "4 PM", "5 PM", "6 PM", "7 PM", "8 PM", "9 PM", "10 PM", "11 PM", "12 AM", "1 AM"];

    const realTimeRequestData = <?php
    $realTimeRequestDataArray = [];
    foreach ($last_requests_by_daytime as $key => $value) {
        $realTimeRequestDataArray[] = $value;
    }
    echo json_encode($realTimeRequestDataArray);
    ?>;

    const realTimeVisitorData = <?php
    $realTimeVisitorDataArray = [];
    foreach ($last_visitors_by_daytime as $key => $value) {
        $realTimeVisitorDataArray[] = count($value);
    }
    echo json_encode($realTimeVisitorDataArray);
    ?>;

    const realTimeData = {
        labels: realTimeLabels,
        datasets: [
            {
                label: 'Requests',
                data: realTimeRequestData,
                borderColor: "#17c294",
                backgroundColor: "#17c294",
                tension: 0.4,
            },
            {
                label: 'Visitors',
                data: realTimeVisitorData,
                borderColor: "#c21745",
                backgroundColor: "#c21745",
            }
        ]
    };

    const realTimeConfig = {
        type: 'line',
        data: realTimeData,
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
        document.getElementById('realtimeChart'),
        realTimeConfig
    );
</script>


