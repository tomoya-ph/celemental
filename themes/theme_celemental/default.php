<?php
defined('C5_EXECUTE') or die("Access Denied.");
$this->inc('elements/header.php'); ?>

<main>
<?php
$a = new Area('Main');
$a->display($c);
?>

<?php
$a = new Area('Page Footer');
$a->display($c);
?>

</main>

<?php  $this->inc('elements/footer.php'); ?>
