<div class="modal fade" id="m_usuarios">
    <div class="modal-dialog">
        <form action="{{ route('reportes.usuarios') }}" method="get" target="_blank" id="formUsuarios"
            class="modal-content  bg-sucess">
            <div class="modal-header">
                <h4 class="modal-title">Lista de usuarios</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Filtro:</label>
                            <select class="form-control" name="filtro" id="filtro">
                                <option value="todos">Todos</option>
                                <option value="role">Tipo</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Seleccione:</label>
                            <select class="form-control" name="role" id="role">
                                <option value="todos">Todos</option>
                                <option value="ADMINISTRADOR">ADMINISTRADOR</option>
                                <option value="AUXILIAR">AUXILIAR</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-info" id="btnUsuarios">Generar reporte</button>
            </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
