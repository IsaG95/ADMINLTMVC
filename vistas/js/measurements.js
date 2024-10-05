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

	var idMeasurement = $(this).attr("idMeasurement");

	var datos = new FormData();
	datos.append("idMeasurement", idMeasurement);

	$.ajax({

		url:"ajax/measurements.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function (respuesta) {

			$("#idMeasurementE").val(respuesta["id"]);
			$("#weightE").val(respuesta["weight"]);
			$("#heightE").val(respuesta["height"]);
			$("#bmiE").val(respuesta["bmi"]);
			$("#fat_percentageE").val(respuesta["fat_percentage"]);
		}

	})

})


/*=============================================
Eliminar medición
=============================================*/

$(document).on("click", ".eliminarMeasurement", function(){

	var idMeasurement = $(this).attr("idMeasurementE");

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
			datos.append("idMeasurementE", idMeasurement);

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

