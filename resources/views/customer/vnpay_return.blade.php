<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kết quả thanh toán</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2>Kết quả thanh toán VNPay</h2>
        @if (isset($error))
            <div class="alert alert-danger">
                {{ $error }}
            </div>
        @else
            <div class="alert alert-success">
                Thanh toán thành công
            </div>
            <ul class="list-group">
                @foreach ($inputData as $key => $value)
                    <li class="list-group-item"><strong>{{ $key }}:</strong> {{ $value }}</li>
                @endforeach
            </ul>
        @endif
    </div>
</body>

</html>
