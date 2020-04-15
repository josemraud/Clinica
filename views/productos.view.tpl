
<head>
  <link rel="stylesheet" href="public/css/estilosDash.css"/>

</head>
<section>
  <h1>Sistema Interno de Clínica Gineco-Obstétrica</h1>
  <h2>Gestión de Productos</h2>
  <h3 style="text-align:center;">{{descripcion}}</h3>
</section>
<section>
  <div>

    <table style="margin-left:auto; margin-right:auto;"class="blueTable" class="col-10 col-offset-1">
  <thead>
    <tr>
      <th>Código</th>
      <th>Producto</th>
      <th>Precio</th>
      <th>Codigo de Tipo</th>
      <th>
        <a href="index.php?page=producto&mode=INS" class="btn">
          Agregar
        </a>
      </th>
    </tr>
  </thead>
  <tbody>
    {{foreach productos}}
    <tr>
      <td>{{cod_producto}}</td>
      <td>{{descripcion}}</td>
      <td>{{precio}}</td>
      <td>{{cod_tipo}}</td>
      <td style ="text-align:center;">
        <form action="index.php" method="GET">
          <input name="page" value="producto" type="hidden"/>
          <input name="mode" value="UPD" type="hidden"/>
          <input name="cod_producto" value="{{cod_producto}}" type="hidden"/>
          <button type="submit">Editar</button>
        </form>

        <form action="index.php" method="GET">
          <input name="page" value="producto" type="hidden" />
          <input name="mode" value="DSP" type="hidden" />
          <input name="cod_producto" value="{{cod_producto}}" type="hidden" />
            <input name="cod_producto" value="{{cod_producto}}" type="hidden" />
          <button type="submit">Visualizar</button>
        </form>

        <form action="index.php" method="GET">
          <input name="page" value="producto" type="hidden" />
          <input name="mode" value="DEL" type="hidden" />
          <input name="cod_producto" value="{{cod_producto}}" type="hidden" />
            <input name="cod_producto" value="{{cod_producto}}" type="hidden" />
          <button type="submit">Eliminar</button>
        </form>
      </td>
    </tr>
    {{endfor productos}}
  </tbody>
</table>

  </div>
</section>
