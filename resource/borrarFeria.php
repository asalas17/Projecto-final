<div class="modal fade" id="eliminarFeriaModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="eliminarFeriaForm" action="../app/backend/procesar_borrarFeria.php" method="POST">
                <input type="hidden" name="id" id="delete_feria_id">
                <div class="modal-header">
                    <h5 class="modal-title">Eliminar feria</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>¿Estás seguro de eliminar <strong id="delete_feria_nombre"></strong>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="../app/js/borrarFeria.js"></script>