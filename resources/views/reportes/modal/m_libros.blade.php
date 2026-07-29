<div class="modal fade" id="m_libros">
    <div class="modal-dialog">
        <form action="{{ route('reportes.libros') }}" method="get" target="_blank" id="formlibros"
            class="modal-content  bg-sucess">
            <div class="modal-header">
                <h4 class="modal-title">Lista de libros</h4>
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
                                <option value="autor">Autor</option>
                                <option value="editorial">Editorial</option>
                                <option value="lugar">Lugar</option>
                                <option value="anio">Año</option>
                                <option value="ubicacion">Ubicación</option>
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
                            <select class="form-control" name="autor" id="autor">
                                <option value="todos">Todos</option>
                                @foreach ($autors as $value)
                                    <option value="{{ $value->id }}">{{ $value->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Seleccione:</label>
                            <select class="form-control" name="editorial" id="editorial">
                                <option value="todos">Todos</option>
                                @foreach ($editorials as $value)
                                    <option value="{{ $value->id }}">{{ $value->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Seleccione:</label>
                            <select class="form-control" name="lugar" id="lugar">
                                <option value="todos">Todos</option>
                                @foreach ($lugars as $value)
                                    <option value="{{ $value->id }}">{{ $value->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Seleccione:</label>
                            <select class="form-control" name="anio" id="anio">
                                <option value="todos">Todos</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Seleccione:</label>
                            <select class="form-control" name="ubicacion" id="ubicacion">
                                <option value="todos">Todos</option>
                                @foreach ($ubicacions as $value)
                                    <option value="{{ $value->id }}">{{ $value->estante }} -
                                        {{ $value->balda }}
                                    </option>
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
                <button type="submit" class="btn btn-info" id="btnlibros">Generar reporte</button>
            </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
