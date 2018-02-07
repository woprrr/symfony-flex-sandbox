<h1>XSS ATTACK</h1>

<form action="" method="post">
    <textarea cols="20" rows="5" name="comment" placeholder=" try <script>alert('you are under attack')</script>" ></textarea><br/>
    <input type="submit" value="submit" />
</form>


<?php


if ($_POST) {
  $comment = $_POST['comment'];

  // Fix XSS bad code...
  //$comment = htmlEntities($comment, ENT_QUOTES);

  echo "Your last comment is: $comment";
}
