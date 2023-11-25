

document.addEventListener('DOMContentLoaded', function () {
    // Example data in pesos
    var data1 = [1000, 8000, 1500, 2500, 3000];
    var data2 = [100, 1500, 1000, 2000, 2500];

    // Chart initialization
    var ctx = document.getElementById('lineChart').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October',],
            datasets: [
                {
                    label: 'Cebu',
                    data: data1,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1,
                    fill: false,
                },
                {
                    label: 'Danao',
                    data: data2,
                    borderColor: 'rgba(255, 165, 0, 1)',
                    borderWidth: 1,
                    fill: false,
                }
            ]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function (value, index, values) {
                            return '₱' + value.toLocaleString(); // Format as currency
                        }
                    }
                }
            }
            // Customize other chart options as needed
        }
    });
});
