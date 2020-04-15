<?php


function run(){
     addCssRef("public/css/estilosMain.css");
  if (mw_estaLogueado()){
    renderizar("levantamiento", Array(),"verified_layout.view.tpl");
  }else{
    renderizar("levantamiento",Array());
  }
}


run();
?>
