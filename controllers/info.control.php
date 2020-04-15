<?php


function run(){
     addCssRef("public/css/estilosMain.css");
  if (mw_estaLogueado()){
    renderizar("info", Array(),"verified_layout.view.tpl");
  }else{
    renderizar("info",Array());
  }
}


run();
?>
