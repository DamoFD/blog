<h2>Traffic</h2>

<canvas id="trafficChart"></canvas>

<script>
    const DATA_COUNT = 7;
    const NUMBER_CFG = {count: DATA_COUNT, min: -100, max: 100};

    const labels = ['Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];

    const requestData = <?php
    $requestDataArray = [];
    foreach ($last_requests_by_day as $key => $value) {
        $requestDataArray[] = $value;
    }
    echo json_encode($requestDataArray);
    ?>;

    const visitorData = <?php
    // Replace this with the actual data for visitors
    $visitorDataArray = [];
    foreach ($last_visitors_by_day as $key => $value) {
        $visitorDataArray[] = array_sum($value);
    }
    echo json_encode($visitorDataArray);
    ?>;

    const data = {
        labels: labels,
        datasets: [
            {
                label: 'Requests',
                data: requestData,
                borderColor: "red",
                backgroundColor: "red",
            },
            {
                label: 'Visitors',
                data: visitorData,
                borderColor: "blue",
                backgroundColor: "blue",
            }
        ]
    };

    const config = {
        type: 'line',
        data: data,
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
        config
    );
</script>

