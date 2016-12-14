<?php
namespace Concrete\Package\GetInstagramBlock\Block\GetInstagram;
defined("C5_EXECUTE") or die("Access Denied.");

use Concrete\Core\Block\BlockController;
use Core;

class Controller extends BlockController
{
    public $helpers = array (
        0 => 'form',
    );
    protected $btExportFileColumns = array (
    );
    public $btFieldsRequired = array('instagramID', 'token');
    protected $btTable = 'btGetInstagram';
    protected $btInterfaceWidth = 400;
    protected $btInterfaceHeight = 500;
    protected $btIgnorePageThemeGridFrameworkContainer = false;
    protected $btCacheBlockRecord = true;
    protected $btCacheBlockOutput = true;
    protected $btCacheBlockOutputOnPost = true;
    protected $btCacheBlockOutputForRegisteredUsers = true;
    protected $btCacheBlockOutputLifetime = 0;
    protected $pkg = false;


    public function getBlockTypeDescription()
    {
        return t("instagram画像を取得します");
    }

    public function getBlockTypeName()
    {
        return t("instagram出力");
    }

    public function view()
    {
        /* ===============================================
        instagram APIからデータ取得
        =============================================== */
        // ユーザネームから固有のuser_IDを取得する。
        define("INSTAGRAM_ACCESS_TOKEN", $this->token);
        // ユーザアカウント名
        $user_account = $this->instagramID;

        // ユーザアカウント名からユーザデータを取得する。
        $user_api_url = 'https://api.instagram.com/v1/users/search?q=' . $user_account . '&access_token=' . INSTAGRAM_ACCESS_TOKEN;
        $user_data = json_decode(@file_get_contents($user_api_url));

        // 取得したデータの中から正しいデータを選出
        foreach ($user_data->data as $user_data) {
            if ($user_account == $user_data->username) {
                $user_id = $user_data->id;
            }
        }

        // 特定ユーザの投稿データを取得する
        // API制限で最新20件まで
        $photos_api_url = 'https://api.instagram.com/v1/users/'.$user_id.'/media/recent?access_token=' . INSTAGRAM_ACCESS_TOKEN;

        $photos_data = json_decode(@file_get_contents($photos_api_url));

        if($this->num > 0){
            $photos_data = array_slice($photos_data->data,0,$this->num);
        }else{
            $photos_data = $photos_data->data;
        }

        $this->set('photos_data', $photos_data);
    }

    public function add(){
        $this->addedit();
    }

    public function edit(){
        $this->addedit();
    }

    public function addedit(){
        $this->set('btFieldsRequired', $this->btFieldsRequired);
    }

     public function validate($args)
    {
        $e = Core::make("helper/validation/error");
        if (in_array("instagramID", $this->btFieldsRequired) && trim($args["instagramID"]) == "") {
            $e->add(t("The %s field is required.", t("instagram ID")));
        }
        if (in_array("token", $this->btFieldsRequired) && trim($args["token"]) == "") {
            $e->add(t("The %s field is required.", t("アクセストークン")));
        }

        if(!intval($args['num'])) {
           $args['num'] = 0;
        }

        return $e;
    }
}