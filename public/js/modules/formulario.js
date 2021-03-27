$("form").keypress(function (e) {
  if (e.which == 13) {
    return false;
  }
});

$("#P4").change(function () {
  const volumenAgua = document.getElementById("P3").value;
  const volumenTotal = document.getElementById("P4").value;

  const porcentaje = volumenAgua / volumenTotal;
  document.getElementById("porcentaje").value = porcentaje.toFixed(1);
});
