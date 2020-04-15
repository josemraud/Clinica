<?php


function run(){
     addCssRef("public/css/estilosMain.css");
  if (mw_estaLogueado()){
    renderizar("enfermedades", Array(),"verified_layout.view.tpl");
  }else{
    renderizar("enfermedades",Array());
  }
}


run();
?>
