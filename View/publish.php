<?php
require_once("./Controller/post.php");

$new = createPost("Nouveau post", "ceci est mon premier test", "./assets/uploads");

?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post</title>
</head>
<body>
    <p><?php echo $new?>  </p>
</body>
</html>