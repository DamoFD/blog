<section id="os">
<h2 class="font-poppins font-size-med">Operating Systems</h2>

<canvas id="osChart"></canvas>

</section>

<script>

    const osRequestData = <?php
    $osLabelsArray = [];
    $osRequestDataArray = [];
    foreach ($top_oss as $key => $value) {
        $osLabelsArray[] = $key;
        $osRequestDataArray[] = $value;
    }
    echo json_encode($osRequestDataArray);
    ?>;

    const osLabels = <?php
    echo json_encode($osLabelsArray);
    ?>;

    const osData = {
        labels: osLabels,
        datasets: [
            {
                label: 'Operating System',
                data: osRequestData,
                borderColor: "#17c294",
                backgroundColor: "#17c294",
            }
        ]
    };

    const osConfig = {
        type: 'bar',
        data: osData,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Operating System'
                }
            }
        },
    };

    // Render the chart
    var osChart = new Chart(
        document.getElementById('osChart'),
        osConfig
    );
</script>

