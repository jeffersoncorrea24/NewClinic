$(document).ready(function () {
  $("#gestionar_citas").click(function () {
    $("#contenido").load("app/view/requerimientos.php");
  });

  $("#administracion_citas").click(function () {
    $("#contenido").load("app/view/administracion_citas.php");
  });
});
