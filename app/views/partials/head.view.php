<!DOCTYPE html>
<html lang="en" class="h-screen">
<head>
    <meta charset="UTF-8">
    <title><?php echo env('APP_NAME','Mini PHP Framework'); ?></title>
    <link href="/build/css/app.css" rel="stylesheet">
    <script defer src="<?= js('resources/js/app.js') ?>"></script>
</head>
<body class="h-screen bg-gray-50">

    <?php require('nav.view.php'); ?>
