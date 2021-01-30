<?php

// Include config file
require_once "../config/db.php";

$url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

$url_components = parse_url($url);
parse_str($url_components['query'], $params);

$myCategory = $params['categoria'];
$page = $params['page'];

$sqlcat = "SELECT name FROM categoria WHERE categoriaID='$myCategory'";
$query = $conn->query($sqlcat);
$row = $query->fetch_row();
$value = $row[0] ?? false;

$result = "SELECT count(*) AS total FROM post WHERE categoriaID='$myCategory'";
$queryTotal = $conn->query($result);
$data = $queryTotal->fetch_assoc();
$total = floor($data['total']/10);
?>

<?php
include_once '../ui/header.php';
?>
<body>
  <?php
  include_once '../ui/navbar.php';

  include_once 'categories.php';

  ?>

  <div class="container">
    <h1 class="text-center">Secretos de <?php echo $value; ?> </h1>

      <?php
        if ($page == 0) {
          $sql = "SELECT nick, postText, created_at, fav FROM post WHERE categoriaID='$myCategory' ORDER BY postID DESC LIMIT 10";
        } else {
          $sql = "SELECT nick, postText, created_at, fav FROM post WHERE categoriaID='$myCategory' ORDER BY postID DESC LIMIT 10 OFFSET ".($page)* 10;
        }
        if($q = $conn->query($sql)){
          if($q -> num_rows !== 0){
            while($row = $q->fetch_array()){
              switch ($myCategory) {
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
              <blockquote class="quote-box <?php echo $style ?> animate__animated animate__fadeInUp">
                <div>
                  <p class="pull-right">
                    <span class="badge quote-badge"> <?php echo $row[2] ?> </span>
                  </p>
                  <div class="row row-header">
                    <p class="quotation-mark pl-3">
                      “
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
                    <span class="badge quote-badge mr-3"><?php echo ucfirst($row[3]) ?> ❤</span> 
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
  <?php
    if ($data['total'] > 0) {
  ?>
  <nav aria-label="Page navigation example" class="animate__animated animate__fadeInUp">
    <ul class="pagination justify-content-center animate__animated animate__fadeInUp">
      <?php
      if ($page != 0) {
      ?>
        <li class="page-item">
          <a class="page-link" href="categorySecret.php?categoria=<?php echo $myCategory ?>&page=<?php echo $page - 1 ?>" tabindex="-1">Previous</a>
        </li>
      <?php
      }
      ?>
      <?php
      for ($i = 0; $i <= $total; $i++) {
        ?>
        <li class="page-item"><a class="page-link" href="categorySecret.php?categoria=<?php echo $myCategory ?>&page=<?php echo $i ?>"><?php echo $i ?></a></li>
        <?php
      }
      ?>
      <?php
      if ($page != $total) {
      ?>
        <li class="page-item">
          <a class="page-link" href="categorySecret.php?categoria=<?php echo $myCategory ?>&page=<?php echo $page + 1 ?>">Next</a>
        </li>
      <?php
      }
      ?>
    </ul>
  </nav>
  <?php

  }
  ?>

</body>
</html>
