<?php


function run(){
     addCssRef("public/css/estilosMain.css");
  if (mw_estaLogueado()){
    renderizar("histerectomia", Array(),"verified_layout.view.tpl");
  }else{
    renderizar("histerectomia",Array());
  }
}


run();
?>
