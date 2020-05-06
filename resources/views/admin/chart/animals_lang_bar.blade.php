<canvas id="questions_lang_view_bar" width="200" height="200"></canvas>
<script>
$(function () {

    var config = {
        type: 'bar',
        data: {
            datasets: [
            {
                label: 'View',
                data: [
                    @foreach ($langs as $lang)
                            '{{ $lang->sum }}',
                    @endforeach 
                ],
                backgroundColor: "rgba(76,174,4)",
                borderColor: "rgba(76,174,4)",
                // pointBorderColor: "rgba(75,192,192,1)",
                // pointBackgroundColor: "#fff",
                pointBorderWidth: 1,
                pointHoverRadius: 5,
            }],
            labels: [
                @foreach ($langs as $lang)
                   '{{ $lang->lang }}',
                @endforeach   
            ]
        },
        options: {
            maintainAspectRatio: false
        }
    };

    var ctx = document.getElementById('questions_lang_view_bar').getContext('2d');
    new Chart(ctx, config);

});
</script>