<?php

  // Include config file
  $path = $_SERVER['DOCUMENT_ROOT'] . "/config/db.php";
  require_once $path;

  $sql = "SELECT * FROM categoria";

  if($q = $conn->query($sql)){
    if($q -> num_rows !== 0){
      ?>
      <div class="container-fluid mt-5">
        <div class="row">
          <h2 class="h2mt-7 mx-auto">Categorias</h2>
        </div>
        <div class="row justify-content-center">

          <?php
          while($row = $q->fetch_array()){
            ?>
            <a class="buton-a" href="/main/categorySecret.php?categoria=<?php echo $row[0]?>&page=0">
              <div class="button ml-3 mt-2">
                <?php echo $row[1] ?>
              </div>
            </a>

            <?php
          }
          ?>

        </div>
        <hr/>
      </div>
      <?php
      $q->free();
    }
  }

?>
