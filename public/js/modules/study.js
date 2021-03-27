$(document).ready(function () {
  $("#tb_study").DataTable({
    width: "auto",
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
      url: getUri + "/study/all",
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
      { data: "paciente.0.id_paciente" },
      {
        data: "paciente.0.nombre",
      },
      { data: "paciente.0.fecha_nacimiento" },
      { data: "estudio.0.modalidad" },
      { data: "estudio.0.nombre" },
      { data: "estudio.0.id_imagen" },
      { data: "id_orden" },
      { data: "id_eps" },
      { data: "autorizacion" },
      {
        data: "id_orden",
        render: function (data, type, row, meta) {
          return (
            '<center><a title="Realizar Estudio" class="archiveRegister icon_a" href="' +
            getUri +
            "/orders/show/" +
            data +
            '" target="_black"><i class="fa fa-folder"></i></a></center>'
          );
        },
      },
    ],
  });
});
