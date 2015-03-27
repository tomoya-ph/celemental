<?php
defined('C5_EXECUTE') or die('Access denied.');
$this->inc('elements/header-login.php');
Loader::library('authentication/open_id');
$image = date('Ymd') . '.jpg';
?>

<body>

<div class="ccm-ui">
<div id="ccm-toolbar">
    <ul>
        <li class="ccm-logo pull-left"><img id="ccm-logo" src="<?php  echo $this->getThemePath()?>/images/logo_menu.png" width="" height="" alt="concrete5" title="concrete5" /></li>
    </ul>
</div>

<div class="container">
<div class="row">
<div class="col-sm-10 col-sm-offset-1">

</div>
</div>

<style>
    body {
        background: url("<?php  echo $this->getThemePath()?>/images/c5-todaybg/20150317.jpg"); <!--bg_login.png-->
    }
</style>


<!--
<div id="form rounded6">
<div style="position: relative"></div>-->



<div class="login-page">
    <div class="col-sm-6 col-sm-offset-3 login-title">
        <h3><?php echo !$attribute_mode ? t('Sign into your website.') : t('Required Attributes') ?></h3>
    </div>
    <div class="col-sm-6 col-sm-offset-3 login-form">
        <div class="row">
            <div class="visible-xs ccm-authentication-type-select form-group text-center">
<!-- -->
                <label>&nbsp;</label>
            </div>
        </div>
        <div class="row login-row">
            <div class="types col-sm-4 hidden-xs">
            <h4>ELEMENTAL</h4><hr /> 
                <ul class="auth-types"><li>Admin</li><li>concrete5</><li>Facebook</li><li>Twitter</li><li>OtherUser..</li>
<!-- -->
                </ul>
            </div>
            <div class="controls col-sm-8 col-xs-12">

<!-- Q-56login-theme form -->
<h4><?php echo t('Login in to %s', SITE)?></h4><hr />

<!--<div class="ccm-required-attribute-form" style="height:340px;overflow:auto;margin-bottom:20px;">-->
<?php if( $passwordChanged ){ ?>

	<div style="margin-bottom:14px; font-weight:bold"><?php echo t('Password changed.  Please login to continue. ') ?></div>

<?php } ?> 

<?php if($changePasswordForm){ ?>

	<div style="margin-bottom:16px; font-weight:bold"><?php echo t('Enter your new password below.') ?></div>

	<?php if (isset($errorMsg)) { ?>
		<div class="ccm-error" style="margin-bottom:16px;"><?php echo $errorMsg?></div>
	<?php } ?>

	<div class="field-group focused-field">	

	<form method="post" action="<?php echo $this->url( '/login', 'change_password', $uHash )?>"> 

		<div>
		<label for="uPassword"><?php echo t('New Password')?></label><br/>
		<input type="password" name="uPassword" id="uPassword" class="ccm-input-text">
		</div>
		&nbsp;<br>
		<div>
		<label for="uPasswordConfirm"><?php echo t('Confirm Password')?></label><br/>
		<input type="password" name="uPasswordConfirm" id="uPasswordConfirm" class="ccm-input-text">
		</div>

		<div class="ccm-button"><button class="btn btn-primary pull-right">
		<input type="submit" name="submit" id="submit" class="button" value="Login" tabindex="100"/></button>

		</div>
	</form>
	
	</div>

<?php }elseif($validated) { ?>

<h2><?php echo t('Email Address Verified')?></h2>

<p>
<?php echo t('The email address <b>%s</b> has been verified and you are now a fully validated member of this website.', $uEmail)?>
</p>
<p><a href="<?php echo $this->url('/')?>"><?php echo t('Return to Home')?> &gt;</a></p>

<?php } else if (isset($_SESSION['uOpenIDError']) && isset($_SESSION['uOpenIDRequested'])) { ?>

<div class="form rounded6">

<?php switch($_SESSION['uOpenIDError']) {
	case OpenIDAuth::E_REGISTRATION_EMAIL_INCOMPLETE: ?>

		<form method="post" action="<?php echo $this->url('/login', 'complete_openid_email')?>">
			<p><?php echo t('To complete the signup process, you must provide a valid email address.')?></p>
			<label for="uEmail"><?php echo t('Email Address')?></label><br/>
			<?php echo $form->text('uEmail')?>
				
			<div class="ccm-button"><button class="btn btn-primary pull-right">
			<input type="submit" name="submit" id="submit" class="button" value="Login" tabindex="100" /></button>
			</div>
		</form>

	<?php break;
	case OpenIDAuth::E_REGISTRATION_EMAIL_EXISTS:
	
	$ui = UserInfo::getByID($_SESSION['uOpenIDExistingUser']);
	
	?>

		<form method="post" action="<?php echo $this->url('/login', 'do_login')?>">
			<p><?php echo t('The OpenID account returned an email address already registered on this site. To join this OpenID to the existing user account, login below:')?></p>
			<label for="uEmail"><?php echo t('Email Address')?></label><br/>
			<div><strong><?php echo $ui->getUserEmail()?></strong></div>
			<br/>
			
			<div>
			<label for="uName"><?php if (USER_REGISTRATION_WITH_EMAIL_ADDRESS == true) { ?>
				<?php echo t('Email Address')?>
			<?php } else { ?>
				<?php echo t('Username')?>
			<?php } ?></label><br/>
			<input type="text" name="uName" id="uName" <?php echo  (isset($uName)?'value="'.$uName.'"':'');?> class="ccm-input-text">
			</div>			<div>

			<label for="uPassword"><?php echo t('Password')?></label><br/>
			<input type="password" name="uPassword" id="uPassword" class="ccm-input-text">
			</div>

			<div class="ccm-button"><button class="btn btn-primary pull-right">
			<input type="submit" name="submit" id="submit" class="button" value="Login" tabindex="100" /></button>
			</div>
		</form>

	<?php break;

	}
?>

</div>

<?php } else if ($invalidRegistrationFields == true) { ?>

<div class="form rounded6">

	<p><?php echo t('You must provide the following information before you may login.')?></p>
	
<form method="post" action="<?php echo $this->url('/login', 'do_login')?>">
	<?php 
	$attribs = UserAttributeKey::getRegistrationList();
	$af = Loader::helper('form/attribute');
	
	$i = 0;
	foreach($unfilledAttributes as $ak) { 
		if ($i > 0) { 
			print '<br/><br/>';
		}
		print $af->display($ak, $ak->isAttributeKeyRequiredOnRegister());	
		$i++;
	}
	?>
	
	<?php echo $form->hidden('uName', Loader::helper('text')->entities($_POST['uName']))?>
	<?php echo $form->hidden('uPassword', Loader::helper('text')->entities($_POST['uPassword']))?>
	<?php echo $form->hidden('uOpenID', $uOpenID)?>
	<?php echo $form->hidden('completePartialProfile', true)?>

	<div class="ccm-button"><button class="btn btn-primary pull-right">
		<?php echo $form->submit('submit', t('Sign In'))?></button>
		<?php echo $form->hidden('rcID', $rcID); ?>
	</div>
	
</form>
</div>	

<?php } else { ?>

<?php if (isset($intro_msg)) { ?>
<h2><?php echo $intro_msg?></h2>
<?php } ?>

<div class="form rounded6">
<?php if (ENABLE_REGISTRATION == 1) { ?><div style="position: absolute; top: 36px; right: 0px; font-size: 11px"><?php echo t('Not a member?')?> <a href="<?php echo $this->url('/register')?>"><?php echo t('Register here!')?></a></div><?php } ?>

<form method="post" action="<?php echo $this->url('/login', 'do_login')?>">
	<div>
	<label for="uName"><?php if (USER_REGISTRATION_WITH_EMAIL_ADDRESS == true) { ?>
		<?php echo t('Email Address')?>
	<?php } else { ?>
		<?php echo t('Username')?>
	<?php } ?></label><br/>
	<input type="text" name="uName" id="uName" <?php echo  (isset($uName)?'value="'.$uName.'"':'');?> class="ccm-input-text">
	</div>
	<br>
	<div>
	<label for="uPassword"><?php echo t('Password')?></label><br/>
	<input type="password" name="uPassword" id="uPassword" class="ccm-input-text">
	</div>

	
	<?php if (OpenIDAuth::isEnabled()) { ?>
		<div>
		<label for="uOpenID"><?php echo t('Or login using an OpenID')?>:</label><br/>
		<input type="text" name="uOpenID" id="uOpenID" <?php echo  (isset($uOpenID)?'value="'.$uOpenID.'"':'');?> class="ccm-input-openid">
		</div>

	<?php } ?>

	<?php if (isset($locales) && is_array($locales) && count($locales) > 0) { ?>
		<div>
		<br/>
		<label for="USER_LOCALE"><?php echo t('Language')?></label><br/>
		<?php echo $form->select('USER_LOCALE', $locales)?>
		</div>
		<br/>
	<?php } ?>
<!--
	<div style="padding: 12px;"><?php echo $form->checkbox('uMaintainLogin', 1)?> <label for="uMaintainLogin"><?php echo t('Remember Me')?></label></div>
-->	
	<div class="ccm-button"><button class="btn btn-primary pull-right">
		<input type="submit" name="submit" id="submit" class="btn btn-primary pull-right" value="Login" tabindex="100" style=""/></button>
	</div>
	<div class="ccm-spacer">&nbsp;</div>

<!--
<?php $rcID = isset($_REQUEST['rcID']) ? Loader::helper('text')->entities($_REQUEST['rcID']) : $rcID; ?>
<input type="hidden" name="rcID" value="<?php echo $rcID?>" />

<?php $u = new User(); if($u->isLoggedIn()) { $ui = UserInfo::getByID($u->getUserID()); echo $ui->getAttribute('shop_pages_url'); } ?>
<?php $u = new User(); $u->getByUserID($uID); $groupName = Group::getByName('Name_Of_Your_Group'); $u->enterGroup($groupName); ?>

-->
	<?php $rcID = isset($_REQUEST['rcID']) ? Loader::helper('text')->entities($_REQUEST['rcID']) : $rcID; ?>
	<input type="hidden" name="rcID" value="<?php $u = new User(); $u->getByUserID($uID); $groupName = Group::getByName('Name_Of_Your_Group'); $u->enterGroup($groupName); ?>" />
	
</form>
</div>
<!-- //Forget Password form 
<div class="form rounded6">
<h3 style="margin-top:32px"><?php echo t('Forgot Your Password?')?></h3>
<p><?php echo t("If you've forgotten your password, enter your email address below. We will reset it to a new password, and send the new one to you.")?></p>

<a name="forgot_password"></a>
<form method="post" action="<?php echo $this->url('/login', 'forgot_password')?>">	
	<label for="uEmail"><?php echo t('Email Address')?></label><br/>
	<input type="hidden" name="rcID" value="<?php echo $rcID?>" />
	<input type="text" name="uEmail" value="" class="ccm-input-text" >

	<div class="ccm-button"><button class="btn btn-primary pull-right">
	<input type="submit" name="submit" id="submit" class="button" value="Get Password" tabindex="100" /></button>
	</div>	
</form>

</div>
-->

<?php } ?>

<!--</div>-->

<!--
                    <form action="<?php echo View::action('fill_attributes') ?>" method="POST">
                        <div data-handle="required_attributes"
                             class="authentication-type authentication-type-required-attributes">
                            <div class="ccm-required-attribute-form" style="height:340px;overflow:auto;margin-bottom:20px;">
/** */
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary pull-right"><?php echo t('Submit') ?></button>
                            </div>

                        </div>
                    </form>
-->
<!--
                        <div data-handle="<?php echo $auth->getAuthenticationTypeHandle() ?>"
                             class="authentication-type authentication-type-<?php echo $auth->getAuthenticationTypeHandle() ?>">
                            <?php $auth->renderForm($authTypeElement ?: 'form', $authTypeParams ?: array()) ?>
                        </div>
-->
            </div>
        </div>
    </div>


    <div class="background-credit" style="display:none">
        <?php echo t('Photo Credit:') ?>
        <a href="#" style="pull-right"></a>
    </div>


    <script type="text/javascript">
        (function ($) {
            "use strict";

            var forms = $('div.controls').find('div.authentication-type').hide(),
                select = $('div.ccm-authentication-type-select > select');
            var types = $('ul.auth-types > li').each(function () {
                var me = $(this),
                    form = forms.filter('[data-handle="' + me.data('handle') + '"]');
                me.click(function () {
                    select.val(me.data('handle'));
                    if (typeof Concrete !== 'undefined') {
                        Concrete.event.fire('AuthenticationTypeSelected', me.data('handle'));
                    }

                    if (form.hasClass('active')) return;
                    types.removeClass('active');
                    me.addClass('active');
                    if (forms.filter('.active').length) {
                        forms.stop().filter('.active').removeClass('active').fadeOut(250, function () {
                            form.addClass('active').fadeIn(250);
                        });
                    } else {
                        form.addClass('active').show();
                    }
                });
            });

            select.change(function() {
                types.filter('[data-handle="' + $(this).val() + '"]').click();
            });
            types.first().click();

            var title = $('.login-title').find('span');
            title.css({
                lineHeight: '1000px',
                fontSize: 10
            });

            setTimeout(function() {
                var start_height = title.parent().height(), size = 10, last;
                while (title.parent().height() === start_height) {
                    last = size++;
                    title.css('font-size', size);
                }
                title.css({
                    fontSize: last,
                    lineHeight: ''
                });
                var fade_div = $('<div/>').css({
                    position: 'absolute',
                    top: 0,
                    left: 0,
                    width: '100%'
                }).prependTo('body').height(title.offset().top + title.outerHeight() + 50);

                fade_div.hide()
                    .append(
                    $('<img/>')
                        .css({ width: '100%', height: '100%' })
                        .attr('src', '<?php echo DIR_REL ?>/concrete/images/login_fade.png'))
                    .fadeIn();
            }, 0);


            <?php if(Config::get('concrete.white_label.background_image') !== 'none') { ?>
            $(function () {
                var shown = false, info;
                $.getJSON('<?php echo BASE_URL . DIR_REL . '/' . DISPATCHER_FILENAME . '/tools/required/dashboard/get_image_data' ?>', { image: '<?php echo $image ?>' }, function (data) {
                    if (shown) {
                        $('div.background-credit').fadeIn().children().attr('href', data.link).text(data.author.join());
                    } else {
                        info = data;
                    }
                });
                $(window).on('backstretch.show', function() {
                    shown = true;

                    if (info) {
                        $('div.background-credit').fadeIn().children().attr('href', info.link).text(info.author.join());
                    }

                });
                $.backstretch("<?php echo Config::get('concrete.urls.background_feed') . '/' . $image ?>", {
                    fade: 500
                });
            });
            <?php } ?>
            $('ul.nav.nav-tabs > li > a').on('click', function () {
                var me = $(this);
                if (me.parent().hasClass('active')) return false;
                $('ul.nav.nav-tabs > li.active').removeClass('active');
                var at = me.attr('data-authType');
                me.parent().addClass('active');
                $('div.authTypes > div').hide().filter('[data-authType="' + at + '"]').show();
                return false;
            });
        })(jQuery);
    </script>

</div>

</div>
</div>


<script type="text/javascript" src="<?php  echo $this->getThemePath()?>/js/backstretch.js"></script>
<script type="text/javascript" src="<?php  echo $this->getThemePath()?>/js/underscore.js"></script>
<script type="text/javascript" src="<?php  echo $this->getThemePath()?>/js/events.js"></script>
<script type="text/javascript" src="<?php  echo $this->getThemePath()?>/js/legacy.js"></script>
<script type="text/javascript" src="<?php  echo $this->getThemePath()?>/js/bootstrap/alert.js"></script>
<script type="text/javascript" src="<?php  echo $this->getThemePath()?>/js/bootstrap/transition.js"></script>

</body>
</html>
