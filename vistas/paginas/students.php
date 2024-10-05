<div class="content-wrapper" style="min-height: 717px;">

    <section class="content-header">

        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">

                    <h1>Administrar estudiantes</h1>

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

                            <button type="button" class="btn btn-success crear-student" data-toggle="modal" data-target="#modal-crear-student">
                                Crear nuevo estudiante
                            </button>

                        </div><br>
                        <!-- /.card-header -->

                        <div class="card-body">

                            <table class="table table-bordered table-striped dt-responsive tablaStudents" width="100%">

                                <thead>

                                    <tr>

                                        <th style="width:10px">#</th>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>Nacimiento</th>
                                        <th>Genero</th>
                                        <th>Grado</th>
                                        <th>Acciones</th>

                                    </tr>

                                </thead>

                                <tbody>

                                    <?php
                                    foreach($students as $key => $value){

                                    
                                    ?>

                                    <tr>

                                        <td><?php echo ($key+1); ?></td>
                                        <td><?php echo $value["nombre"]; ?></td>
                                        <td><?php echo $value["apellido"]; ?></td>
                                        <td><?php echo $value["nacimiento"]; ?></td>
                                        <td><?php echo $value["genero"]; ?></td>
                                        <td><?php echo $value["grado"]; ?></td>

                                        <td>

                                            <div class='btn-group'>

                                                <button class="btn btn-warning btn-sm btnEditarStudent"
                                                    data-toggle="modal" idStudent="<?php echo $value["student_id"]; ?>"
                                                    data-target="#modal-editar-student">
                                                    <i class="fas fa-pencil-alt text-white"></i>
                                                </button>

                                                <button class="btn btn-danger btn-sm eliminarStudent"
                                                    idStudentE="<?php echo $value["student_id"]; ?>">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>

                                            </div>

                                        </td>

                                    </tr>

                                    <?php } ?>

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

<!--=====================================
Modal Crear estudiantes
======================================-->

<div class="modal fade" id="modal-crear-student" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Aquí va el contenido del formulario -->
            <div class="modal-header">
                <h4 class="alert alert-success alert-dismissible">Agregar nuevo estudiante</h4>
            </div>
            <form method="post">

                <div class="form-group has-feedback">
                    <input type="text" class="form-control" name="nombreStudent" placeholder="Nombre" required>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>

                <div class="form-group has-feedback">
                    <input type="email" class="form-control" name="emailStudent" placeholder="Email" required>
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>

                <div class="form-group has-feedback">
                    <input type="text" class="form-control" name="telefonoStudent" placeholder="Teléfono" required>
                    <span class="glyphicon glyphicon-phone form-control-feedback"></span>
                </div>

                <div class="form-group has-feedback">
                    <input type="text" class="form-control" name="direccionStudent" placeholder="Dirección" required>
                    <span class="glyphicon glyphicon-home form-control-feedback"></span>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>

                <?php
                $guardarStudent = new ctrStudents();
                $guardarStudent->ctrGuardarEstudiante();
                ?>

            </form>
        </div>
    </div>
</div>


<!--=====================================
Modal Editar estudiantes
======================================-->
<div class="modal modal-default fade" id="modal-editar-student">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="alert alert-success alert-dismissible">Editar estudiante</h4>
            </div>
            <form method="post">

                <div class="form-group has-feedback">
                    <input type="hidden" id="idStudentE" name="idStudentE">
                    <input type="text" class="form-control" id="nombreE" name="nombreE" placeholder="Nombre" required>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>

                <div class="form-group has-feedback">
                    <input type="email" class="form-control" id="emailE" name="emailE" placeholder="Email" required>
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>

                <div class="form-group has-feedback">
                    <input type="text" class="form-control" id="telefonoE" name="telefonoE" placeholder="Teléfono" required>
                    <span class="glyphicon glyphicon-phone form-control-feedback"></span>
                </div>

                <div class="form-group has-feedback">
                    <input type="text" class="form-control" id="direccionE" name="direccionE" placeholder="Dirección" required>
                    <span class="glyphicon glyphicon-home form-control-feedback"></span>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                </div>

                <?php
                $editarStudent = new ctrStudents();
                $editarStudent->mdlEditarEstudiante();
                ?>

            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
