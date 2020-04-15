<?php


function run(){
     addCssRef("public/css/estilosMain.css");
  if (mw_estaLogueado()){
    renderizar("ultra", Array(),"verified_layout.view.tpl");
  }else{
    renderizar("ultra",Array());
  }
}


run();
?>
