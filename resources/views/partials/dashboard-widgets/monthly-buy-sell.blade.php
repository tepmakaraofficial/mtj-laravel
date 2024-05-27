<div class="card mb-2">
    <canvas id="monthly-buy-sell"></canvas>
</div>
<script type="module">
    $(document).ready(function(){
        const labels = [
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
        ];

        const data = {
            labels: labels,
            datasets: [
                {
                label: 'SELL',
                data: [1,2,3,4,5,6],
                borderColor: 'red',
                backgroundColor: 'rgba(156, 15, 8, 0.3)',
                borderWidth: 2,
                borderRadius: Number.MAX_VALUE,
                borderSkipped: false,
                },
                {
                label: 'BUY',
                data: [1,-22,3,4,5,6],
                borderColor: 'green',
                backgroundColor: 'rgba(11, 135, 4, 0.3)',
                borderWidth: 2,
                borderRadius: 5,
                borderSkipped: false,
                }
            ]
        };

        const config = {
            type: 'bar',
            data: data,
            options: {
                responsive: true,
                plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Monthly BUY/SELL'
                }
                }
            },
        };

        new Chart(
            document.getElementById('monthly-buy-sell'),
            config
        );
    });
</script>