<?php defined('C5_EXECUTE') or die("Access Denied.");

//$dsh = Loader::helper('concrete/dashboard');

//$page = Page::getCurrentPage();

//$request = Request::get();

//$page = Page::getCurrentPage();

//error_log(date("Y/m/d D H:i:s ",time())."SCRIPT_NAME!!=".print_r($_SERVER["SCRIPT_NAME"], true)."\r\n",3,"/var/www/test.confeb.net/web/c56/debug_log.txt");//confeb_debug


//error_log(date("Y/m/d D H:i:s ",time())."QUERY_STRING!!=".print_r($_SERVER["QUERY_STRING"], true)."\r\n",3,"/var/www/test.confeb.net/web/c56/debug_log.txt");//confeb_debug


//error_log(date("Y/m/d D H:i:s ",time())."request_this!!=".print_r($request, true)."\r\n",3,"/var/www/test.confeb.net/web/c56/debug_log.txt");//confeb_debug

//$path = $request->getRequestCollectionPath();

//error_log(date("Y/m/d D H:i:s ",time())."pathpath_this!!=".print_r($path, true)."\r\n",3,"/var/www/test.confeb.net/web/c56/debug_log.txt");//confeb_debug


//error_log(date("Y/m/d D H:i:s ",time())."page_this!!=".print_r($page, true)."\r\n",3,"/var/www/test.confeb.net/web/c56/debug_log.txt");//confeb_debug

//error_log(date("Y/m/d D H:i:s ",time())."ConcreteDashboardHelper!!=".print_r($dsh, true)."\r\n",3,"/var/www/test.confeb.net/web/c56/debug_log.txt");//confeb_debug

//error_log(date("Y/m/d D H:i:s ",time())."ConcreteDashboardHelper!!=".print_r($dsh->inDashboard($page), true)."\r\n",3,"/var/www/test.confeb.net/web/c56/debug_log.txt");//confeb_debug

$this->inc('elements/header_top.php');
?>
<div class="ccm-page">
<header>
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-xs-6">
                <?php
                    $a = new GlobalArea('Site Name');
                    $a->display();

                    ?>
            </div>
            <div class="<?php if ($displayThirdColumn) { ?>col-sm-5 col-xs-6<?php } else { ?>col-md-8 col-xs-6<?php } ?>">
                <?php
                $a = new GlobalArea('Header Nav');
                $a->display();
                ?>
            </div>

        </div>
    </div>
</header>