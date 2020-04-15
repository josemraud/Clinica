<?php

require_once "models/productodata.model.php";

function run(){
  $viewdata = array();
  $viewdata["productos"] = obtenerProductos();
  $viewdata["descripcion"] = "productos";

  renderizar("productos", $viewdata);
}

run();
?>
