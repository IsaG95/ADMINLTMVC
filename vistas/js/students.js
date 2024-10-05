$(".tablaStudents").DataTable({
	
	"deferRender": true,
	"retrieve": true,
	"processing": true,
	"language": {

		"sProcessing":     "Procesando...",
		"sLengthMenu":     "Mostrar _MENU_ registros",
		"sZeroRecords":    "No se encontraron resultados",
		"sEmptyTable":     "Ningún dato disponible en esta tabla",
		"sInfo":           "Mostrando registros del _START_ al _END_",
		"sInfoEmpty":      "Mostrando registros del 0 al 0",
		"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
		"sInfoPostFix":    "",
		"sSearch":         "Buscar:",
		"sUrl":            "",
		"sInfoThousands":  ",",
		"sLoadingRecords": "Cargando...",
		"oPaginate": {
			"sFirst":    "Primero",
			"sLast":     "Último",
			"sNext":     "Siguiente",
			"sPrevious": "Anterior"
		},
		"oAria": {
			"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
			"sSortDescending": ": Activar para ordenar la columna de manera descendente"
		}

	}

});


/*=============================================
Editar estudiante
=============================================*/

$(".tablaStudents").on("click", ".btnEditarStudent", function(){

	var idStudent = $(this).attr("idStudent");

	var datos = new FormData();
	datos.append("idStudent", idStudent);

	$.ajax({

		url:"ajax/students.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function (respuesta) {

			$("#idStudentE").val(respuesta["id"]);
			$("#nombreE").val(respuesta["nombre"]);
			$("#emailE").val(respuesta["email"]);
			$("#telefonoE").val(respuesta["telefono"]);
			$("#direccionE").val(respuesta["direccion"]);
		}

	})

})


/*=============================================
Eliminar estudiante
=============================================*/

$(document).on("click", ".eliminarStudent", function(){

	var idStudent = $(this).attr("idStudentE");

	swal({
		title: '¿Está seguro de eliminar este estudiante?',
		text: "¡Si no lo está puede cancelar la acción!",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText: 'Sí, eliminar estudiante!'
	}).then(function(result){

		if (result.value) {

			var datos = new FormData();
			datos.append("idStudentE", idStudent);

			$.ajax({

				url: "ajax/students.ajax.php",
				method: "POST",
				data: datos,
				cache: false,
				contentType: false,
				processData: false,
				success:function (respuesta) {

					if (respuesta == "ok") {
						swal({
							type: "success",
							title: "¡CORRECTO!",
							text: "El estudiante ha sido borrado correctamente",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"
						}).then(function (result) {

							if (result.value){
								window.location = "students";
							}

						})
					}

				}

			})

		}

	})

})
