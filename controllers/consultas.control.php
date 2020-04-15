<?php


function run(){
     addCssRef("public/css/estilosMain.css");
  if (mw_estaLogueado()){
    renderizar("consultas", Array(),"verified_layout.view.tpl");
  }else{
    renderizar("consultas",Array());
  }
}


run();
?>
