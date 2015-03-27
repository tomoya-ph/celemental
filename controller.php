<?php       


defined('C5_EXECUTE') or die(_("Access Denied."));

class CelementalPackage extends Package
{

	protected $pkgHandle = 'celemental';
	protected $appVersionRequired = '5.6.0';
	protected $pkgVersion = '1.0';


	public function getPackageDescription()
	{
		return t("May your business be Celemental");
	}

	public function getPackageName()
	{
		return t("Celemental");
	}


	public function install()
	{
		$pkg = parent::install();
		// install theme
		PageTheme::add('theme_celemental', $pkg);

		//$lesscache_dir = DIR_BASE.'/files/celemental/themes/theme_celemental';


		//error_log(date("Y/m/d D H:i:s ",time())."is_dir!!=".print_r(is_dir($lesscache_dir), true)."\r\n",3,"/var/www/confeb.test/c56/debug_log.txt");//confeb_debug


		$celemental_file = DIR_BASE . '/files/celemental';


		@mkdir($celemental_file, 0777);

		@chmod($celemental_file, 0777);


		$lesscache_dir = $celemental_file . '/lesscache';

		@mkdir($lesscache_dir, 0777);
		@chmod($lesscache_dir, 0777);


	}

	public function uninstall()
	{
		parent::uninstall();

		$celemental_file = DIR_BASE . '/files/celemental';

		$fh = Loader::helper('file');

		$fh->removeAll($celemental_file);

	}

}
?>