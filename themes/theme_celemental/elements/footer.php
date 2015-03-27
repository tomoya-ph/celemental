<?php

defined('C5_EXECUTE') or die("Access Denied.");


?>

<footer id="footer-theme">

    <section>
    <div class="container">
        <div class="row">
            <div class="col-sm-9">
                <?php     echo SITE?>
            </div>
            <div class="col-sm-3">
                <span class="powered-by"><a href="http://www.concrete5.org" title="<?php echo t('concrete5 - open source content management system for PHP and MySQL')?>"><?php echo t('concrete5 - open source CMS')?></a></span>
                &copy; <?php echo date('Y')?> <a href="<?php echo DIR_REL?>/"><?php echo h(SITE)?></a>.
                &nbsp;&nbsp;
                <?php echo t('All rights reserved.')?>
            </div>
        </div>
    </div>
    </section>

</footer>

<footer id="concrete5-brand">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <span><?php echo t('Built with <a href="http://www.concrete5.org" class="concrete5">concrete5</a> CMS.')?></span>
                <span class="pull-right">
                    			<?php
                                $u = new User();
                                if ($u->isRegistered()) { ?>
                                    <?php
                                    if (Config::get("ENABLE_USER_PROFILES")) {
                                        $userName = '<a href="' . $this->url('/profile') . '">' . $u->getUserName() . '</a>';
                                    } else {
                                        $userName = $u->getUserName();
                                    }
                                    ?>
                                    <span class="sign-in"><?php echo t('Currently logged in as <b>%s</b>.', $userName)?> <a href="<?php echo $this->url('/login', 'logout')?>"><?php echo t('Sign Out')?></a></span>
                                <?php } else { ?>
                                    <span class="sign-in"><a href="<?php echo $this->url('/login')?>"><?php echo t('Sign In to Edit this Site')?></a></span>
                                <?php } ?>
                </span>
            </div>
        </div>
    </div>
</footer>


<?php
$this->inc('elements/footer_bottom.php');


