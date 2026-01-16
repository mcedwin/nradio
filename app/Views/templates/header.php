<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title><?php echo $meta->title ?></title>
    <meta name="description" content="<?php echo $meta->description ?>" />
    <link rel="stylesheet" href="<?php echo base_url('/sys/assets/lib/bootstrap533/css/bootstrap.min.css') ?>" />
    <link rel="stylesheet" href="<?php echo base_url('/sys/assets/lib/fontawesome6/css/all.min.css') ?>" />
    <link href="<?php echo base_url('sys/assets/css/sidebar.menu.css') ?>" rel="stylesheet" media="all">
    <link href="<?php echo base_url('sys/assets/lib/perfectScrollbar/perfect-scrollbar.css') ?>" rel="stylesheet" media="all">
    <?php echo $css ?? '' ?>
    <link href="<?php echo base_url('sys/assets/css/style.css') ?>" rel="stylesheet" media="all">

    <!--  Essential META Tags -->
    <meta property="og:title" content="<?php echo $meta->title ?>">
    <meta property="og:type" content="article" />
    <meta property="og:image" content="<?php echo $meta->image ?>">
    <meta property="og:url" content="<?php echo $meta->url ?>">

    <!--  Non-Essential, But Recommended -->
    <meta property="og:description" content="<?php echo $meta->description ?>">
    <meta property="og:site_name" content="<?php echo $meta->site_name ?>">

</head>

<body>
