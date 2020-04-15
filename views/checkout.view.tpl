<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clinica Gineco-Obstetrica</title>
</head>
<body>
<section>
  <h1>Pago con PayPal</h1>
  
  <section class="row">
    <section class="col-md-8 col-offset-2">
      <form action="index.php?page=checkout" method="post">
        <fieldset class="row bg-blue-grey">
            <div class="col-md-2"><b>Codigo</b></div>
            <div class="col-md-4"><b>Producto</b></div>
            <div class="col-md-2 right"><b>Precio</b></div>
            <div class="col-md-2 right"><b>Fecha</b></div>
        </fieldset>
        {{foreach items}}
        <fieldset class="row">
            <div class="col-md-2">{{codCarrito}}</div>
            <div class="col-md-4">{{Descripcion}}</div>
            <div class="col-md-2 right">{{precio}}</div>
            <div class="col-md-2 right">{{cantidad}}</div>
        </fieldset>
        {{endfor items}}
        <fieldset class="row right">
          <button type="submit" class="col-md-12 btn-primary" name="btnSubmit" value="submit">
          Pagar
          </button>
        </fieldset>
      </form>
    </section>
  </section>
</section>
</body>
</html>