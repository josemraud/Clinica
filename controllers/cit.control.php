<?php


function run(){
     addCssRef("public/css/estilosMain.css");
  if (mw_estaLogueado()){
    renderizar("citologia", Array(),"verified_layout.view.tpl");
  }else{
    renderizar("citologia",Array());
  }
}


run();
?>
