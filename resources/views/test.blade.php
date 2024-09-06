<!DOCTYPE html>
<html>
<head>
    <title>Custom Validation Example</title>
    <!-- Include Bootstrap or your preferred CSS framework -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <form action="{{ route('submit') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="input_field">Input Field:</label>
                <input type="text" name="input_field" id="input_field" class="form-control" value="{{ old('input_field') }}">
                @if ($errors->any())
                    <div class="alert alert-danger mt-2">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <!-- Include Bootstrap JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.4.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>