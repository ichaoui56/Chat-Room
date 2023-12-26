<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./assets/css/tailwind.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <link href="https://unpkg.com/movement.css/movement.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="./assets/pictures/avito.png" />
    <title><?= ucfirst($page) ?></title>





</head>
<style>
    #contact-form, #overlay {
        display: none;
    }
    /* Add your additional CSS styling here */
</style>
<body>

    <main>
        <?php include_once 'views/' . $page . '_view.php'; ?>
    </main>

    <footer></footer>


</body>
</html>