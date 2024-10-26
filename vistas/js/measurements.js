$(".tablaMeasurements").DataTable({
	
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
Editar medición
=============================================*/

$(".tablaMeasurements").on("click", ".btnEditarMeasurement", function(){

	var measurementid = $(this).attr("id");

	var datos = new FormData();
	datos.append("measurementid", measurementid);

	$.ajax({

		url:"ajax/measurements.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function (respuesta) {

			$("#measurement_idE").val(respuesta["measurement_id"]);
			$("#student_idE").val(respuesta["student_id"]);
			$("#fechaE").val(respuesta["fecha"]);
			$("#bmiE").val(respuesta["bmi"]);
			$("#pesoE").val(respuesta["peso"]);
			$("#alturaE").val(respuesta["altura"]);
		}

	})

})


/*=============================================
Eliminar medición
=============================================*/

$(document).on("click", ".eliminarMeasurement", function(){

	var measurement_id = $(this).attr("idMeasurementE");

	swal({
		title: '¿Está seguro de eliminar esta medición?',
		text: "¡Si no lo está puede cancelar la acción!",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText: 'Sí, eliminar medición!'
	}).then(function(result){

		if (result.value) {

			var datos = new FormData();
			datos.append("idMeasurementE", measurement_id);

			$.ajax({

				url: "ajax/measurements.ajax.php",
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
							text: "La medición ha sido borrada correctamente",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"
						}).then(function (result) {

							if (result.value){
								window.location = "measurements";
							}

						})
					}

				}

			})

		}

	})

})

