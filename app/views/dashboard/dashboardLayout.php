<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .sidebar {
            position: fixed;
            left:  0;
            top:  0;
            width: 300px;
            height:  100vh;
            background-color:rgb(92, 92, 92);
        }
        .main_container{
            padding-left: 320px;
        }
    </style>

</head>
<body>
    <div class="sidebar">
        <?php require __DIR__."/../partials/sidebar.php"?>
    </div>
    <div class="main_container">
        <main>
            <h1>
                Hi! <?= $userName ?>
            </h1>
            <?= $content ?>
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>