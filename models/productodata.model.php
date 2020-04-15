<?php
    require_once("libs/dao.php");


    function obtenerProductos()
    {
      $sqlstr = "select * from productos;";
      $productos = array();
      $productos = obtenerRegistros($sqlstr);
      return $productos;
    }

    function obtenerProductoXCodigo($cod_producto)
{
    $sqlstr = "select * from productos where cod_producto = '%s';";
    $producto = array();
    $producto = obtenerUnRegistro(
        sprintf($sqlstr, intval($cod_producto))
    );
    return $producto;
}

    function agregarProducto($descripcion,$precio,$cod_tipo)
    {
      $sqlstr = "INSERT INTO `productos` (`descripcion`, `precio`, `cod_tipo`) VALUES ('%s','%d', '%s');";
      $result = ejecutarNonQuery(
        sprintf(
          $sqlstr,
          $descripcion,
          $precio,
          $cod_tipo
          )
      );
      if ($result > 0) {
        return getLastInserId();
    } else {
        return 0;
    }
    }

    function actualizarProducto($descripcion,$precio,$cod_tipo, $cod_producto)
    {
      $sqlUpd = "update productos set descripcion = '%s', precio = %d, cod_tipo = '%s' where cod_producto='%s';";
      $result = ejecutarNonQuery(
        sprintf(
          $sqlUpd,
          $descripcion,
          $precio,
          $cod_tipo,
          $cod_producto
          )
        );
        return $result;
    }

    function eliminarProducto($cod_producto)
    {
      $sqlDlt = "delete from productos where cod_producto=%d;";
      $result = ejecutarNonQuery(
        sprintf(
          $sqlDlt,
          intval($cod_producto)
          )
        );
        return $result;
      }
 ?>
