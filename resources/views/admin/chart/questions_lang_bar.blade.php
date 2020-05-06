<canvas id="animal_lang_view_bar" width="200" height="200"></canvas>
<script>
$(function () {

    var config = {
        type: 'bar',
        data: {
            datasets: [
            {
                label: 'total',
                data: [
                    @foreach ($questions as $question)
                            '{{ $question->total }}',
                    @endforeach 
                ],
                backgroundColor: "yellow",
                borderColor: "yellow",
                // pointBorderColor: "rgba(75,192,192,1)",
                // pointBackgroundColor: "#fff",
                pointBorderWidth: 1,
                pointHoverRadius: 5,
            },
            {
                label: 'true',
                data: [
                    @foreach ($questions as $question)
                            '{{ $question->true_total }}',
                    @endforeach 
                ],
                backgroundColor: "rgba(76,174,4)",
                borderColor: "rgba(76,174,4)",
                // pointBorderColor: "rgba(75,192,192,1)",
                // pointBackgroundColor: "#fff",
                pointBorderWidth: 1,
                pointHoverRadius: 5,
            },
            {
                label: 'false',
                data: [
                    @foreach ($questions as $question)
                            '{{ $question->false_total }}',
                    @endforeach 
                ],
                backgroundColor: "rgba(255,56,49)",
                borderColor: "rgba(255,56,49)",
                // pointBorderColor: "rgba(75,192,192,1)",
                // pointBackgroundColor: "#fff",
                pointBorderWidth: 1,
                pointHoverRadius: 5,
            }
            ],
            labels: [
                @foreach ($questions as $question)
                   '{{ $question->lang }}',
                @endforeach   
            ]
        },
        options: {
            maintainAspectRatio: false
        }
    };

    var ctx = document.getElementById('animal_lang_view_bar').getContext('2d');
    new Chart(ctx, config);

});
</script>