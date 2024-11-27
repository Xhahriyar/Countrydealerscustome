<div class="chart-container" style="position: relative; height: 400px; width: 100%;">
    <canvas id="{{ $id }}"></canvas>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const ctx = document.getElementById('{{ $id }}').getContext('2d');
        
        // Parse the data for Chart.js
        const chartData = @json($data);
        
        // Convert formatted amounts to numeric values for the graph
        const numericAmounts = chartData.datasets[0].data.map(amount => parseFloat(amount.replace(/,/g, '')));

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: chartData.labels,
                datasets: [{
                    label: chartData.datasets[0].label,
                    data: numericAmounts,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                }],
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        labels: {
                            generateLabels: function (chart) {
                                return chart.data.datasets.map((dataset, i) => ({
                                    text: dataset.label,
                                    datasetIndex: i,
                                    fillStyle: 'transparent',
                                    hidden: !chart.isDatasetVisible(i),
                                }));
                            },
                            color: 'black',
                        },
                    },
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                const value = context.raw; // Get numeric value
                                return new Intl.NumberFormat('en-US', {
                                    style: 'currency',
                                    currency: 'PKR',
                                }).format(value); // Format as currency
                            },
                        },
                    },
                },
                scales: {
                    x: {
                        type: 'time',
                        time: {
                            unit: 'day',
                        },
                        title: {
                            display: true,
                            text: 'Date',
                        },
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Amount',
                        },
                        beginAtZero: true,
                        ticks: {
                            callback: function (value) {
                                return new Intl.NumberFormat('en-US').format(value);
                            },
                        },
                    },
                },
            },
        });
    });
</script>
