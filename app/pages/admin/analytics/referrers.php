<section id="referrers">
<h2 class="font-poppins font-size-med">Traffic Sources</h2>

<canvas id="referrerChart"></canvas>

</section>

<script>

    const referrerRequestData = <?php
    $referrerLabelsArray = [];
    $referrerRequestDataArray = [];
    foreach ($top_referrers as $key => $value) {
        if($key !== '') {
        $referrerLabelsArray[] = $key;
        $referrerRequestDataArray[] = $value;
        }
    }
    echo json_encode($referrerRequestDataArray);
    ?>;

    const referrerLabels = <?php
    echo json_encode($referrerLabelsArray);
    ?>;

    const referrerData = {
        labels: referrerLabels,
        datasets: [
            {
                label: 'Referring Domain',
                data: referrerRequestData,
                borderColor: "#17c294",
                backgroundColor: "#17c294",
            }
        ]
    };

    const referrerConfig = {
        type: 'bar',
        data: referrerData,
        options: {
            indexAxis: 'y',
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Traffic Sources'
                }
            }
        },
    };

    // Render the chart
    var referrerChart = new Chart(
        document.getElementById('referrerChart'),
        referrerConfig
    );
</script>