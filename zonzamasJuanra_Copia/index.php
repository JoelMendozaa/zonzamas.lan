<?php

    require_once "general.php";




    echo Plantilla::header("CIFP Zonzamas");


?>


  
<div class="container col-xxl-8 px-4 py-5">
    <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
      <div class="col-10 col-sm-8 col-lg-6">
        <img src="./img/Imagen.gif" class="d-block mx-lg-auto img-fluid" alt="Gif" loading="lazy">
      </div>
      <div class="col-lg-6">
        <h1 class="display-5 fw-bold text-body-emphasis lh-1 mb-3">CIFP ZONZAMAS</h1>
        <p class="lead">Centro de formación profesional</p>
        <div class="d-grid gap-2 d-md-flex justify-content-md-start">
          <button type="button" class="btn btn-outline-secondary btn-lg px-4"><a href="./index.php">Home</a></button>
          <button type="button" class="btn btn-outline-secondary btn-lg px-4"><a href="./biblioteca.php">Biblioteca</a></button>
        </div>
      </div>
    </div>
  </div>


<?php

    echo Plantilla::footer();

?>