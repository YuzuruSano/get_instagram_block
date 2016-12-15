<?php
namespace Concrete\Package\GetInstagramBlock;
defined('C5_EXECUTE') or die("Access Denied.");

use Package;
use BlockType;

class Controller extends Package
{

	protected $pkgHandle = 'get_instagram_block';
	protected $appVersionRequired = '5.7.4';
	protected $pkgVersion = '1.1.1';
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
		BlockType::installBlockType('get_instagram', $pkg);
	}

	public function upgrade()
	{
		$pkg = $this->getByID($this->getPackageID());
		parent::upgrade();

		$existingBlockType = BlockType::getByHandle('get_instagram');
		if (!$existingBlockType) {
			BlockType::installBlockType('get_instagram', $pkg);
		}
	}
}
