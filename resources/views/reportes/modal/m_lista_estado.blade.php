<div class="modal fade" id="m_lista_estado">
    <div class="modal-dialog">
        <form action="{{ route('reportes.lista_estado') }}" method="get" target="_blank" class="modal-content  bg-sucess"
            id="formlista_estado">
            <div class="modal-header">
                <h4 class="modal-title">Lista de Estado de Libros</h4>
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
                                <option value="area">Áreas</option>
                                <option value="estado">Estado</option>
                                <option value="portal">Portal Web</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Seleccione:</label>
                            <select class="form-control" name="area" id="area">
                                <option value="todos">Todos</option>
                                @foreach ($areas as $value)
                                    <option value="{{ $value->id }}">{{ $value->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Seleccione:</label>
                            <select class="form-control" name="estado" id="estado">
                                <option value="todos">Todos</option>
                                <option value="NUEVO">NUEVO</option>
                                <option value="BUENO">BUENO</option>
                                <option value="REGULAR">REGULAR</option>
                                <option value="MALO">MALO</option>
                                <option value="MALO EN USO">MALO EN USO</option>
                                <option value="MALO EN DESUSO">MALO EN DESUSO</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Seleccione:</label>
                            <select class="form-control" name="portal" id="portal">
                                <option value="todos">Todos</option>
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
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
                <button type="submit" class="btn btn-info" id="btnlista_estado">Generar reporte</button>
            </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
