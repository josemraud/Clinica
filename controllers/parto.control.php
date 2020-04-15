<?php


function run(){
     addCssRef("public/css/estilosMain.css");
  if (mw_estaLogueado()){
    renderizar("parto", Array(),"verified_layout.view.tpl");
  }else{
    renderizar("parto",Array());
  }
}


run();
?>
