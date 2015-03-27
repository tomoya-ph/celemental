<?php defined('C5_EXECUTE') or die("Access Denied."); ?>

</div>


<?php Loader::element('footer_required'); ?>

<?php
$c = $this->getCollectionObject();

if (is_object($c)) {
    $isEditMode = ($c->isEditMode()) ? 1 : 0;
}
//error_log(date("Y/m/d D H:i:s ",time())."footer_isEditMode!!=".print_r($isEditMode, true)."\r\n",3,"/var/www/test.confeb.net/web/c56/debug_log.txt");//confeb_debug

//$obj = PageTheme::getSiteTheme();
//$currentThemeName = $obj->getPackageHandle();

if($isEditMode != 1) {
    //error_log(date("Y/m/d D H:i:s ",time())."footer_isEditMode_in!!=".print_r($isEditMode, true)."\r\n",3,"/var/www/test.confeb.net/web/c56/debug_log.txt");//confeb_debug

    ?>


<?php

}

?>
</body>
</html>
