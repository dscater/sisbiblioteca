 <!-- Info boxes -->
 <div class="row">
    <!-- /.col -->
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-list-alt"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Libros</span>
                <span class="info-box-number">{{$libros}}</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->

    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
            <span class="info-box-icon bg-orange elevation-1"><i class="fas fa-list"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Préstamos</span>
                <span class="info-box-number">{{count($prestamos)}}</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->

    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
            <span class="info-box-icon bg-blue elevation-1"><i class="fas fa-list"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Solicitudes</span>
                <span class="info-box-number">{{$c_solicituds}}</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->

    <!-- fix for small devices only -->
    <div class="clearfix hidden-md-up"></div>
 </div>