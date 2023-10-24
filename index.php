<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script>
        <?php 
            echo "alert('welcome')"
        ?>
    </script>

</head>
<body>

    <h2>course php</h2>
    
    <?php echo "text" ?>

    <?php
        print "<h4>Title h4<h4>";
        echo "<hr>";
    ?>

    <?php 
        print "Title h4"
    ?>

    <h2 style="color:blue;">blue text</h2>
    <h2 <?php echo 'style="color:blue;"'?>>blue text</h2>


</body>
</html>