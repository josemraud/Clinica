<?php


function run(){
     addCssRef("public/css/estilosMain.css");
  if (mw_estaLogueado()){
    renderizar("home", Array(),"verified_layout.view.tpl");
  }else{
    renderizar("home",Array());
  }
}


run();
?>
