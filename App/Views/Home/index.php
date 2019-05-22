<html>
    
    <head>
        <title>Home->Index</title>
    </head>
    <body>
        <h1>Welcome <?php echo htmlspecialchars($name);?></h1>
        <p>Hello from Home index view</p>
        <ul>
            <?php foreach ($colours as $colora) { ?>
            <li><?php echo htmlspecialchars($color)?></li>
            <?php } ?>
        </ul>
    </body>
    
</html>