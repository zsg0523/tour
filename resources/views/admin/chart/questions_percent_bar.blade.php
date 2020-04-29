<canvas id="questions_percent_bar" width="200" height="200"></canvas>
<script>
$(function () {

    var config = {
        type: 'bar',
        data: {
            datasets: [
            {
                label: '命中率(%)',
                data: [
                    @foreach ($maps as $question)
                            '{{ $question['percent'] }}',
                    @endforeach 
                ],
                backgroundColor: "pink",
                borderColor: "pink",
                // pointBorderColor: "rgba(75,192,192,1)",
                // pointBackgroundColor: "#fff",
                pointBorderWidth: 1,
                pointHoverRadius: 5,
            }
            ],
            labels: [
                @foreach ($maps as $question)
                   '{{ $question['question'] }}',
                @endforeach   
            ]
        },
        options: {
            maintainAspectRatio: false
        }
    };

    var ctx = document.getElementById('questions_percent_bar').getContext('2d');
    new Chart(ctx, config);

});
</script>