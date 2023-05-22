<section id="languages">
<h2 class="font-poppins font-size-med">Languages</h2>

<canvas id="languageChart"></canvas>

</section>

<script>

    const languageRequestData = <?php
    $languageLabelsArray = [];
    $languageRequestDataArray = [];
    foreach ($top_languages as $key => $value) {
        $languageLabelsArray[] = $key;
        $languageRequestDataArray[] = $value;
    }
    echo json_encode($languageRequestDataArray);
    ?>;

    const languageLabels = <?php
    echo json_encode($languageLabelsArray);
    ?>;

    const languageData = {
        labels: languageLabels,
        datasets: [
            {
                label: 'Language',
                data: languageRequestData,
                borderColor: "#17c294",
                backgroundColor: "#17c294",
            }
        ]
    };

    const languageConfig = {
        type: 'bar',
        data: languageData,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Language'
                }
            }
        },
    };

    // Render the chart
    var languageChart = new Chart(
        document.getElementById('languageChart'),
        languageConfig
    );
</script>

