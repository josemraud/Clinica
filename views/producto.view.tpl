
<head>
  <link rel="stylesheet" href="public/css/estilosDash.css"/>

</head>
<h1>Trabajando con: {{modedsc}}</h1>
<hr>
<div class="row">
  <form class="col-6 col-offset-3" method="post" action="index.php?page=producto&mode={{mode}}&cod_producto={{cod_producto}}">
    <input type="hidden" name="cod_producto" value={{cod_producto}}/>
    <input type="hidden" name="mst_token" value={{mst_token}} />
    <input type="hidden" name="btnConfirmar" value="confirmar" />
    <section>

    <fieldset>
      <legend>Datos del Producto</legend>
      <div class="row">
        <label for="descripcion" class="col-sm-12 col-md-4">Descripción</label>
        <input type="text" maxlength="50" placeholder="Nombre del producto"
        name="descripcion" id="descripcion" value="{{descripcion}}" class="col-sm-12 col-md-8" {{readonly}} {{isdeleting}}/>
      </div>


      <div class="row">
        <label for="precio" class="col-sm-12 col-md-4">Precio</label>
        <input type="number" maxlength="12" placeholder="Precio del Producto"
        name="precio" id="precio" value="{{precio}}" class="col-sm-12 col-md-8" {{readonly}} {{isdeleting}}/>
      </div>
    </fieldset>
{{ifnot readonly}}
    <fieldset>
      <button type="submit" id="btnConfirmar">Confirmar</button>
      &nbsp;
      <button type="submit" id="btnCancelar"><a href="index.php?page=productos">Cancelar</a></button>

    </fieldset>
  {{endifnot readonly}}
  </form>

  {{if haserrors}}
<section class="alert">
      <ol>
        {{foreach errors}}
        <li>{{this}}</li>
        {{endfor errors}}
      </ol>
</section>
{{endif haserrors}}

</div>

<script>
$().ready(
  function(){
    {{ifnot readonly}}
    $("#btnCancelar").click(function(e){
        e.preventDefault();
        e.stopPropagation();
        window.location.assign("index.php?page=productos");
    });
    $("#btnConfirmar").click(function (e) {
      e.preventDefault();
      e.stopPropagation();
      /* validar en el cliente aqui */
      document.forms[0].submit();
    });
    {{endifnot readonly}}
  }
);
</script>
