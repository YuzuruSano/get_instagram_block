<?php
namespace Concrete\Package\GetInstagramBlock;
defined('C5_EXECUTE') or die("Access Denied.");

use Package;
use BlockType;
use Loader;
use Database;

class Controller extends Package
{

	protected $pkgHandle = 'get_instagram_block';
	protected $appVersionRequired = '5.7.4';
	protected $pkgVersion = '1.1';
	protected $pkgAutoloaderMapCoreExtensions = true;

	public function getPackageDescription()
	{
		return "インスタグラム表示用ブロック";
	}
	public function getPackageName()
	{
		return "インスタグラム表示ブロック";
	}

	public function install(){
		$pkg = parent::install();
		$db = Database::getActiveConnection();

		BlockType::installBlockType('get_instagram', $pkg);
	}

	public function upgrade()
	{
		$pkg = $this->getByID($this->getPackageID());
		parent::upgrade();
		$db = Database::getActiveConnection();

		$existingBlockType = BlockType::getByHandle('get_instagram');
		if (!$existingBlockType) {
			BlockType::installBlockType('get_instagram', $pkg);
		}
	}

	public function uninstall() {
		parent::uninstall();
		$db = Loader::db();
	}
}
