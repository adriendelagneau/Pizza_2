<?php ob_start(); ?>
<h1>Tableau de bord user :<?php echo $_SESSION["userName"] ?></h1>
<div id="tdb2">

    <div><a href="indexAdmin.php?action=infosUser">gerrer vos infos</a></div>
    <div><a href="indexAdmin.php?action=orderList">historique de vos commandes </a></div>

</div>
<?php $content = ob_get_clean(); ?>
<?php require 'templates/template.php'; ?>