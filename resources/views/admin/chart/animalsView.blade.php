<canvas id="doughnut" width="200" height="200"></canvas>
<script>
$(function () {

    var config = {
        type: 'line',
        data: {
            datasets: [{
                label: '动物浏览率',
                data: [
                    @foreach ($sums as $sum)
                        '{{ $sum['sum'] }}',
                    @endforeach
                ],
                backgroundColor: [
                    'rgb(54, 162, 235)',
                ]
            }],
            labels: [
                @foreach ($sums as $sum)
                   '{{ $sum['product_name'] }}',
                @endforeach
            ]
        },
        options: {
            maintainAspectRatio: false,
            
        }
    };

    var ctx = document.getElementById('doughnut').getContext('2d');
    new Chart(ctx, config);
});
</script>