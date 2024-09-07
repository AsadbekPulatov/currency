<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Chart js</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 10px;
        }

        canvas {
            width: 70% !important;
            height: 600px !important;
        }
    </style>
</head>
<body>
<canvas id="myChart"></canvas>
<form action="/" method="get">
    <hr>
    <div class="container">
        <div class="row row-cols-5">
            @foreach($arr_codes as $key => $item)
                <div class="col">
                    <label for="n{{$key}}">
                        @if ($selected_codes == null)
                            <input id="n{{$key}}" type="checkbox" name="codes[]" value="{{ $item }}">
                        @else
                            <input id="n{{$key}}" @if(in_array($item, $selected_codes)) checked @endif type="checkbox"
                                   name="codes[]" value="{{ $item }}">
                        @endif
                        {{ $item }}
                    </label>
                </div>
            @endforeach
        </div>
    </div>
    <hr>
    <button type="submit" class="btn btn-info w-50" style="margin-left: 50%">Filter</button>
</form>
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
        }
    });
</script>
</html>
