<?php $title = "erreur 404" ?>
<?php header("HTTP/1.0 404 Not Found"); ?>
<?php ob_start(); ?>

<h1>Erreur 404</h1>
<div><?= $errorMessage ?></div>

<?php $content = ob_get_clean(); ?>

<?php require "template.php"; ?>