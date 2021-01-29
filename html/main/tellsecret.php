<?php

// Include config file
require_once "../config/db.php";

$nick = $category = $message = "";
$fav = 0;
$category_err = $message_err = "";
$create_at = date("Y-m-d H:i:s");



if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(empty(trim($_POST["nick"]))){
      $nick = "Anonimo";
    } else{
      $nick = $conn->real_escape_string($_POST["nick"]);
    }

    if(empty(trim($_POST["category"]))){
      $category_err = "Please select a category";
    }else{
      $category = trim($_POST["category"]);
    }

    if(empty(trim($_POST["message"]))){
      $message_err = "Please tell a secret";
    }else{
      $message = trim($_POST["message"]);
    }

    if(empty($category_err) && empty($message_err)){
      $sql = "INSERT INTO `post` (nick, postText, categoriaID, fav, created_at) VALUES ('$nick','$message', '$category', '$fav', '$create_at')";
      $q = $conn->query($sql);
      if($q){
        echo'<script type="text/javascript">
              alert("Secreto guardado!");
              window.location.href="../index.php";
              </script>';
       } else {
         echo "<div class='form alert alert-danger text-center h2mt-7'>
               <h3>Error.</h3><br/>
               </div>";
       }
    mysqli_close($conn);
    }
}


?>
<?php
include_once '../ui/header.php';
?>
<body>

  <?php
  include_once '../../html/ui/navbar.php';
  ?>

  <section class="pt-5 pb-5 mt-0 align-items-center d-flex bg-dark bg-style">
    <div class="row mx-auto">
      <div class="mx-auto">
        <div class="card mt-2 mx-auto p-4 bg-light animate__animated animate__jackInTheBox">
          <div class="card-body bg-light">
            <div class="container">
              <form id="contact-form" action="tellsecret.php" method="post" autocomplete="off">
                <div class="controls">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="form_name">
                          Nick
                        </label>
                        <input id="form_name" type="text" maxlength="15" onkeyup="countCharNick(this)" name="nick" class="form-control" placeholder="Please enter a nick (optional)">
                        <div id="charNumNick"></div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group"> <label for="form_need">Please specify category *</label>
                        <select id="form_need" name="category" class="form-control" required="required" data-error="Please specify your category.">
                          <option value="" selected disabled>--Select Your category--</option>
                          <?php
                            $sqlcat = "SELECT * FROM categoria";

                            if($cat = $conn->query($sqlcat)){
                              if($cat -> num_rows !== 0){
                                while($row = $cat->fetch_array()){
                                  ?>
                                  <option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>
                                  <?php
                                }
                                $cat->free();
                              }
                            }
                          ?>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="form_message">Message *</label>
                        <textarea id="form_message" onkeyup="countChar(this)" name="message" class="form-control" placeholder="Write your secret here." rows="4" required="required" data-error="Please, leave us a message." maxlength="255"></textarea>
                        <div id="charNum"></div>
                      </div>
                    </div>
                    <div class="col-md-12 mx-auto">
                      <button type="submit" class="btn btn-success btn-send pt-2 btn-block ">Send your Secret</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</body>
</html>
