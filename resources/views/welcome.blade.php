<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Chart js</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 10px;
        }

        canvas {
            width: 100% !important;
            height: 600px !important;
        }
    </style>
</head>
<body>
<canvas id="myChart"></canvas>
</body>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('myChart');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($labels),
            datasets: [
                @foreach($data as $key => $item)
                    {
                        label: @json($key),
                        data: @json($item),
                        borderWidth: 1,
                        borderColor: @json($color[$key])
                    },
                @endforeach
            ],
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                legend: {
                    position: 'right'
                }
            }
        }
    });
</script>
</html>
