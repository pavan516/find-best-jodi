<?php

$embed_link = "https://www.youtube.com/embed/MSzEiIbIik8";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>YouTube</title>
    <script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
    <script>
        var full = $(".ytp-fullscreen-button.ytp-button");
        console.log(full);
    </script>
</head>
<body>
    <embed fullscreen src="<?php echo $embed_link ?>?autoplay=1" type="" autoplay>
</body>
</html>