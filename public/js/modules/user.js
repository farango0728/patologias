$(document).ready(function () {
  $("#tb_user").DataTable({
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
      url: getUri + "/users/all",
      dataSrc: "",
    },
    dom: "Blfrtip",
    buttons: [
      {
        extend: "excel",
        title: "Usuarios",
        text:
          'Exportar información en excel <i class="fa fa-file-excel-o"></i>',
        className: "btn btn-info",
      },
    ],
    columns: [
      {
        data: "id",
      },
      { data: "nombre" },
      { data: "apellido" },
      { data: "email" },
      { data: "telefono" },
      { data: "active" },
      {
        data: "id",
        render: function (data, type, row, meta) {
          return '<a title="Realizar Estudio" class="archiveRegister icon_a" href="#" target="_black"><i class="fa fa-folder"></i></a>&nbsp;<a title="Eliminar orden" class="archiveRegister icon_a" href="#" target="_black"><i class="fa fa-trash text-danger"></i></a>&nbsp;<a title="Editar orden" class="archiveRegister icon_a" href="#" target="_black"><i class="fa fa-pencil text-sucess"></i</a>';
        },
      },
    ],
  });
});
