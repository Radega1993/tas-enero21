<?php

// Include config file
define('BASE_PATH', realpath(dirname(__FILE__)));
require_once BASE_PATH . "/config/db.php";

?>

<?php
include_once BASE_PATH . '/ui/header.php';
?>
<body>
  <?php
  include_once BASE_PATH . '/ui/navbar.php';

  include_once BASE_PATH . '/main/categories.php';

  ?>

  <div class="container">
    <h1 class="text-center">Úlitimos 10 secretos publicados</h1>

      <?php
        $sql = "SELECT p.nick, p.postText, p.created_at, c.name, p.fav FROM post AS p JOIN categoria AS c ON p.categoriaID = c.categoriaID ORDER BY postID DESC LIMIT 10";

        if($q = $conn->query($sql)){
          if($q -> num_rows !== 0){
            while($row = $q->fetch_array()){
              switch (strtolower($row[3])) {
                case 1:
                  $style = "amistad";
                  break;
                case 2:
                  $style = "picante";
                  break;
                case 3:
                  $style = "trabajo";
                  break;
                case 4:
                  $style = "escuela";
                  break;
                case 5:
                  $style = "amor";
                  break;
                case 6:
                  $style = "otros";
                  break;
                default:
                  $style = "";
              }
              ?>
              <blockquote class="quote-box <?php echo strtolower($row[3]) ?> animate__animated animate__bounceInLeft">
                <div>
                  <p class="pull-right">
                    <span class="badge quote-badge"> <?php echo $row[2] ?> </span>
                  </p>
                  <div class="row row-header">
                    <p class="quotation-mark pl-3">
                      “
                    </p>
                    <p class="quote-category span6">
                      <?php echo $row[3] ?>
                    </p>
                  </div>

                </div>
                <div class="row">
                  <p class="span6 quote-text mb-0 pr-5 pl-5 text-responsive">
                    <?php echo $row[1] ?>
                  </p>
                </div>
                <hr>
                <div class="blog-post-actions">
                  <p class="blog-post-bottom quote-author ml-3">
                    By: <?php echo ucfirst($row[0]) ?>
                  </p>
                  <!--
                  <p class="blog-post-bottom pull-right">
                    <span class="badge quote-badge mr-3"><?php echo ucfirst($row[4]) ?> ❤</span> 
                  </p>
                -->
                </div>
              </blockquote>

      <?php
            }

            $q->free();
          } else {
            ?>
            <div class="alert alert-dark text-center" role="alert">
              No hay secretos todavia! <br/>
              Animate a ser el primero <br/>
              <a type="button" class="btn btn-success btn-send pt-2 btn-block" href="tellsecret.php">Contar un secreto</a>
            </div>
            <?php
          }
        }
      ?>
  </div>

</body>
</html>
