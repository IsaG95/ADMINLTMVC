<div class="content-wrapper" style="min-height: 717px;">

    <section class="content-header">

        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">

                    <h1>Administrar mediciones</h1>

                </div>

            </div>
        </div><!-- /.container-fluid -->

    </section>

                     
    <section class="content">

    

        <div class="container-fluid">

            <div class="row">

                <div class="col-12">

                    <!-- Default box -->
                    <div class="card card-info card-outline">

                    

                        <div class="card-header">

                            <button type="button" class="btn btn-success crear-medicion" data-toggle="modal"
                                data-target="#modal-crear-medicion">
                                crear nuevo usuario
                            </button><br>

                        </div><br>

                      
                        <!-- /.card-header -->

                        <div class="card-body">

                            <table class="table table-bordered table-striped dt-responsive tablaMediciones" width="100%">

                                <thead>

                                    <tr>

                                        <th style="width:10px">#</th>
                                        <th>Estudiante</th>
                                        <th>Fecha</th>
                                        <th>Peso</th>
                                        <th>Altura</th>
                                        <th>BMI</th>
                                        <th>Acciones</th>

                                    </tr>

                                </thead>

                                <tbody>

                                    <?php  
                                    foreach($mediciones as $key => $value){

                                        // Obtener nombre del estudiante basado en student_id
                                        $item = "student_id";
                                        $valor = $value["student_id"];
                                        $estudiante = ctrStudents::ctrMostrarEstudiantes($item, $valor);
                                    ?>

                                    

                                    <tr>

                                        <td><?php echo ($key + 1) ?></td>
                                        <td><?php echo $value["student_id"]?></td>
                                        <td><?php echo $value["fecha"] ?></td>
                                        <td><?php echo $value["peso"] . " kg" ?></td>
                                        <td><?php echo $value["altura"] . " m" ?></td>
                                        <td><?php echo $value["bmi"] ?></td>

                                        <td>

                                            <div class='btn-group'>

                                                <button class="btn btn-warning btn-sm btnEditarMeasurement"
                                                    data-toggle="modal" idMedicion="<?php echo $value["measurement_id"] ?>"
                                                    data-target="#modal-editar-medicion">
                                                    <i class="fas fa-pencil-alt text-white"></i>
                                                </button>

                                                <button class="btn btn-danger btn-sm eliminarMedicion"
                                                    idMedicionE="<?php echo $value["measurement_id"] ?>">
                                                    <i class=" fas fa-trash-alt"></i>
                                                </button>

                                            </div>

                                        </td>

                                    </tr>

                                    <?php 
                                    }
                                    ?>

                                </tbody>

                            </table>

                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">

                        </div>
                        <!-- /.card-footer-->

                    </div>
                    <!-- /.card -->

                </div>

            </div>

        </div>

    </section>

</div>


<!-- Modal para crear medición -->
<div class="modal modal-default fade" id="modal-crear-medicion">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="alert alert-success alert-dismissible ">Agregar nueva medición</h4>
            </div>
            <form method="post">

            <div class="form-group">
                    <input type="number" class="form-control" name="student_id" placeholder="student_id" required>
                </div>

                <div class="form-group">
                    <input type="date" class="form-control" name="fecha" placeholder="Fecha" required>
                </div>

                <div class="form-group">
                    <input type="number" step="0.01" class="form-control" name="peso" placeholder="Peso (kg)" required>
                </div>

                <div class="form-group">
                    <input type="number" step="0.01" class="form-control" name="altura" placeholder="Altura (m)" required>
                </div>

                <div class="form-group">
                    <input type="number" step="0.01" class="form-control" name="bmi" placeholder="BMI" required>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>

                <?php 
                $guardarMedicion = new ctrMeasurements();
                $guardarMedicion->ctrGuardarMediciones();
                ?>

            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- Modal para editar medición -->
<div class="modal modal-default fade" id="modal-editar-medicion">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="alert alert-success alert-dismissible ">Editar medición</h4>
            </div>
            <form method="post">

                <input type="hidden" id="measurement_id" name="measurement_id">

                <div class="form-group">
                    <input type="date" class="form-control" id="fecha" name="fecha" placeholder="Fecha" required>
                </div>

                <div class="form-group">
                    <input type="number" step="0.01" class="form-control" id="peso" name="peso" placeholder="Peso (kg)" required>
                </div>

                <div class="form-group">
                    <input type="number" step="0.01" class="form-control" id="altura" name="altura" placeholder="Altura (m)" required>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Editar</button>
                </div>

                <?php 
                $editarMedicion = new ctrMeasurements();
                $editarMedicion->ctrEditarMediciones();
                ?>

            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
