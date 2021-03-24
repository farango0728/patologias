$(document).ready(function () {
  $("#tb_courses").DataTable({
    lengthMenu: [25, 50, 75, 100],
    language: {
      sProcessing: "Procesando...",
      sLengthMenu: "Registros por pagina: _MENU_ ",
      sZeroRecords: "No se encontraron resultados",
      sEmptyTable: "Ningún dato disponible en esta tabla",
      sInfo:
        "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
      sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
      sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
      sInfoPostFix: "",
      sSearch: "Buscar:",
      sUrl: "",
      sInfoThousands: ",",
      sLoadingRecords: "Cargando...",
      paginate: {
        first: "Primera",
        last: "Ultima",
        next: "Siguiente <i class='fa fa-angle-right'></i>",
        previous: "<i class='fa fa-angle-left'></i> Anterior",
      },
      oAria: {
        sSortAscending:
          ": Activar para ordenar la columna de manera ascendente",
        sSortDescending:
          ": Activar para ordenar la columna de manera descendente",
      },
    },
    ajax: {
      url: getUri + "/orders/all",
      dataSrc: "",
    },
    dom: "Blfrtip",
    buttons: [
      {
        extend: "excel",
        title: "Ordenes",
        text:
          'Exportar información en excel <i class="fa fa-file-excel-o"></i>',
        className: "btn btn-info",
      },
    ],
    columns: [
      { data: "idOrder" },
      { data: "idPatient" },
      { data: "patients" },
      { data: "idEps" },
      { data: "eps" },
      { data: "numberAuthorization" },
      { data: "idModality" },
      { data: "modality" },
      { data: "active" },
    ],
  });
});

$("form").keypress(function (e) {
  if (e.which == 13) {
    return false;
  }
});

$(".addcourse").on("click", function (event) {
  event.preventDefault();
  $("#courseCreateForm")[0].reset();
  $("#courseCreateForm").attr("action", $(this).attr("data-href"));
  $("#input_codigo").prop("readonly", false);
  $("select#id_programa").attr("disabled", false);
  $("#courseCreateModal").modal("show");
});

$("#courseCreateForm").on("submit", function (event) {
  event.preventDefault();
  $("select#id_programa").attr("disabled", false);
  var userForm = $(this).serialize();
  $.post($(this).attr("action"), userForm)
    .done(function (response) {
      if (response.message == 1) {
        table.row.add(response.course).draw(false);
        toastr.success("Accion completada correctamente.", "Estupendo!!!", {
          timeOut: 3000,
        });
        $("#courseCreateModal").modal("hide");
      } else if (response.message == 2) {
        console.log(_td);
        table.row(_td.parents("tr")).data(response.course);
        toastr.success("Accion completada correctamente.", "Estupendo!!!", {
          timeOut: 3000,
        });
        $("#courseCreateModal").modal("hide");
      } else {
        toastr.error(
          "No sé pudo registrar correctamente, " + response.alerta,
          "Error!!",
          { timeOut: 3000 }
        );
      }
    })
    .fail(function (response) {
      toastr.error(response.responseText, "Error!!", { timeOut: 3000 });
    });
});
