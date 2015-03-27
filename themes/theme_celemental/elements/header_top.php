<?php defined('C5_EXECUTE') or die("Access Denied."); ?>
<!DOCTYPE html>
<html lang="<?php echo LANGUAGE?>">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
<?php
    $html = Loader::helper('html');
    //error_log(date("Y/m/d D H:i:s ",time())."pkgHandle!!=".print_r($pkgHandle, true)."\r\n",3,"/var/www/test.confeb.net/web/c56/debug_log.txt");//confeb_debug

    //$this->addHeaderItem($html->javascript('jquery.js'), 'celemental')
    //
//error_log(date("Y/m/d D H:i:s ",time())."c!!=".print_r($c, true)."\r\n",3,"/var/www/test.confeb.net/web/c56/debug_log.txt");//confeb_debug


if (is_object($c)) {
    $isEditMode = ($c->isEditMode()) ? "true" : "false";
}
/*
$obj = PageTheme::getSiteTheme();
$currentThemeName = $obj->getPackageHandle();
*/

$currentThemeName = 'celemental';

if($isEditMode != "true") {
    ?>
<?php
}
?>
    <?php  Loader::element('header_required',null,$currentThemeName); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo $this->getThemePath()?>/css/bootstrap-modified.css">

    <?php
    require DIR_BASE.'/packages/'.$currentThemeName.'/themes/theme_'.$currentThemeName.'/less.php/Cache.php';
    //require DIR_BASE.'/packages/celemental/themes/theme_celemental/less.php/Less.php';
    Less_Cache::$cache_dir = DIR_BASE.'/files/'.$currentThemeName.'/lesscache';

    $files = array();
    $files[DIR_BASE.'/packages/'.$currentThemeName.'/themes/theme_'.$currentThemeName.'/css/main.less'] = $this->getThemePath().'/css/';

    $css_file_name = Less_Cache::Get( $files );
    echo '<link rel="stylesheet" type="text/css" href="'.DIR_REL.'/files/'.$currentThemeName.'/lesscache/'.$css_file_name.'">';
    echo '<link rel="stylesheet" type="text/css" href="'.$this->getThemePath().'/css/font-awesome.css">';
    ?>
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" media="screen" type="text/css" href="<?php echo $this->getStyleSheet('main.css')?>" />
    <link rel="stylesheet" media="screen" type="text/css" href="<?php echo $this->getStyleSheet('typography.css')?>" />
</head>
<body>


