<section id="pages">

<h2 class="font-poppins font-size-med">Views by Page</h2>

<canvas id="pagesChart"></canvas>

</section>

<script>

    const pageRequestData = <?php
    $pageLabelsArray = [];
    $pageRequestDataArray = [];
    foreach ($top_uris as $key => $value) {
        $pageLabelsArray[] = substr($key, -10);
        $pageRequestDataArray[] = $value;
    }
    echo json_encode($pageRequestDataArray);
    ?>;

    const pageLabels = <?php
    echo json_encode($pageLabelsArray);
    ?>;

    const pageData = {
        labels: pageLabels,
        datasets: [
            {
                label: 'Page',
                data: pageRequestData,
                borderColor: "#17c294",
                backgroundColor: "#17c294",
            }
        ]
    };

    const pageConfig = {
        type: 'bar',
        data: pageData,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Pages'
                }
            }
        },
    };

    // Render the chart
    var pageChart = new Chart(
        document.getElementById('pagesChart'),
        pageConfig
    );
</script>

