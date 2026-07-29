<div class="modal fade" id="m_lista_solicitudes">
    <div class="modal-dialog">
        <form action="{{ route('reportes.lista_solicitudes') }}" method="get" target="_blank"
            class="modal-content  bg-sucess" id="formlista_solicitudes">
            <div class="modal-header">
                <h4 class="modal-title">Lista de solicitudes</h4>
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
                                <option value="fecha">Rango de fechas</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Fecha inicio:</label>
                            <input type="date" name="fecha_ini" id="fecha_ini" value="{{ date('Y-m-d') }}"
                                class="form-control">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Fecha fin:</label>
                            <input type="date" name="fecha_fin" id="fecha_fin" value="{{ date('Y-m-d') }}"
                                class="form-control">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <select name="tipo_reporte" id="tipo_reporte" class="form-control">
                            <option value="pdf">PDF</option>
                            <option value="excel">EXCEL</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-info" id="btnlista_solicitudes">Generar reporte</button>
            </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
