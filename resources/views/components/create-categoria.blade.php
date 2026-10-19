<button type="button" class="btn btn-primary" onclick="abrirModal()">
    Nueva Categoria
</button>

<div class="modal fade" id="modalCategoria" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('categoria.create') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Registrar Categoría</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nombre de la Categoría</label>
                        <input name="categoria" type="text" class="form-control" placeholder="Ingresa el nombre de la categoría" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function abrirModal() {
        var myModal = new bootstrap.Modal(document.getElementById('modalCategoria'));
        myModal.show();
    }
</script>