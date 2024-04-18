<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <title>Админ панель</title>
</head>

<body>
    <x-adminheader></x-adminheader>
    <div class="container">
        <div class="dropdown">
            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                Dropdown link
            </a>

            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="/admin?status=1">Новая</a></li>
                <li><a class="dropdown-item" href="/admin?status=2">Подтверждено</a></li>
                <li><a class="dropdown-item" href="/admin?status=3">Отклонено</a></li>
            </ul>
        </div>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach ($products as $product)
                <div class="col">
                    <div class="card">
                        <img src="/storage/product/{{ $product->photo }}" class="card-img-top"
                            alt="{{ $product->photo }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->title }}</h5>
                            <p class="card-text">{{ $product->description }}</p>
                            <p class="card-text">{{ $product->cost }}</p>
                            <a href="/admin/delete/{{ $product->id }}" class="btn btn-danger">Удалить</a>
                            <a href="/admin/edit/{{ $product->id }}" class="btn btn-warning">Редактировать</a>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
        {{ $products->links('pagination::bootstrap-5') }}
    </div>
    <x-alerts></x-alerts>
</body>

</html>
