document.addEventListener('DOMContentLoaded', () => {

    const chartElement =
        document.getElementById('salesChart');

    if (!chartElement) {
        return;
    }

    const salesData =
        window.salesData || [0, 0, 0, 0, 0, 0];

    new Chart(chartElement, {

        type: 'bar',

        data: {

            labels: [
                'Jan',
                'Feb',
                'Mar',
                'Apr',
                'Mei',
                'Jun'
            ],

            datasets: [{

                label: 'Penjualan',

                data: salesData,

                backgroundColor: [
                    '#BDBDBD',
                    '#000000',
                    '#000000',
                    '#D9D9D9',
                    '#D9D9D9',
                    '#BDBDBD'
                ],

                borderRadius: 12,

                borderSkipped: false

            }]

        },

        options: {

            responsive: true,

            maintainAspectRatio: false,

            plugins: {

                legend: {
                    display: false
                }

            },

            scales: {

                x: {

                    grid: {
                        display: false
                    }

                },

                y: {

                    beginAtZero: true,

                    ticks: {
                        precision: 0
                    },

                    grid: {
                        color: '#EEEEEE'
                    }

                }

            }

        }

    });

});