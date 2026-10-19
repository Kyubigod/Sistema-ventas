<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Categoria</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>
</head>
<body>
    <x-navbar />

    <h1 class="text-center mt-3">Categoria</h1>

    <div class="container mt-4">
        <div class="row">
            <div class="col">
                <x-createCategoria />
            </div>
            <div class="col">
                
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-lg-8 offset-lg-2">
                <table class="table table-bordered">
                    <thead class="table-info">
                        <tr>
                            <th>id</th>
                            <th>Categoria</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categorias as $i)
                        <tr>
                            <td>{{ $i->id }}</td>
                            <td>{{ $i->categoria }}</td>
                            <td>
                                <form action="{{ route('categoria.update', $i->id) }}" method="POST" class="d-inline-block me-1">
                                    @csrf
                                    @method('PUT')
                                    <input type="text" name="categoria" value="{{ $i->categoria }}" required>
                                    <button type="submit" class="btn btn-warning">Actualizar</button>
                                </form>

                                <form action="{{ route('categoria.delete', $i->id) }}" method="POST" class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>