<!DOCTYPE html>
<html>

<head>
    <title><?php echo $view['title']; ?></title>

    <?php 
    
    echo $view['header'];
    echo $view['style'];
    echo $view['script'];
    ?>

</head>

<body>
    <?php echo $view['body']; ?>
</body>
<footer>
    <?php echo $view['footer'];  ?>
</footer>

</html>