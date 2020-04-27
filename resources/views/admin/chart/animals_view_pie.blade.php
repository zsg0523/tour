<canvas id="animal_view_pie" width="200" height="200"></canvas>
<script>
$(function () {

    var config = {
        type: 'pie',
        data: {
            datasets: [{
                data: [
                    @foreach ($sums as $sum)
                        '{{ $sum->sum }}',
                    @endforeach
                ],
                backgroundColor: [
                    'rgba(76,174,4)',
                    'yellow',
                    'rgba(0,139,204)',
                    'rgba(255,56,49)',
                    'rgba(153,50,204)',
                ]
            }],
            labels: [
                @foreach ($sums as $sum)
                   '{{ $sum->product_name }}',
                @endforeach
            ]
        },
        options: {
            maintainAspectRatio: false
        }
    };

    var ctx = document.getElementById('animal_view_pie').getContext('2d');
    new Chart(ctx, config);

});
</script>