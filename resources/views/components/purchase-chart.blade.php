<div class="chart-container" style="position: relative; height: 400px; width: 100%;">
    <canvas id="{{ $id }}"></canvas>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const ctx = document.getElementById('{{ $id }}').getContext('2d');

        // Parse the data for Chart.js
        const chartData = @json($data);

        // Convert formatted amounts to numeric values for the graph
        chartData.datasets.forEach(dataset => {
            dataset.data = dataset.data.map(amount => {
                return amount ? parseFloat(amount.replace(/,/g, '')) : 0;
            });
        });

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: chartData.labels,
                datasets: chartData.datasets.map(dataset => ({
                    label: dataset.label,
                    data: dataset.data,
                    borderColor: dataset.borderColor || 'rgba(75, 192, 192, 1)', // Default color
                    backgroundColor: dataset.backgroundColor || 'rgba(75, 192, 192, 0.2)', // Default color
                    fill: true,
                })),
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
                            title: function (context) {
                                // Display the date as the tooltip title
                                return context[0].label;
                            },
                            label: function (context) {
                                // Format the individual dataset value
                                const value = context.raw; // Get numeric value
                                return `${context.dataset.label}: ` + 
                                    new Intl.NumberFormat('en-US', {
                                        style: 'currency',
                                        currency: 'PKR',
                                    }).format(value);
                            },
                            footer: function (context) {
                                // Gather all dataset values for the same index
                                const index = context[0].dataIndex;
                                const datasets = context[0].chart.data.datasets;

                                const details = datasets.map(dataset => {
                                    const value = dataset.data[index];
                                    return `${dataset.label}: ` + 
                                        new Intl.NumberFormat('en-US', {
                                            style: 'currency',
                                            currency: 'PKR',
                                        }).format(value);
                                });

                                return `\n${details.join('\n')}`; // Return all values
                            },
                        },
                    },
                },
                scales: {
                    x: {
                        type: 'category',
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
