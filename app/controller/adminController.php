<?php

require_once plugin_dir_path(__DIR__) . "model/generatePageModel.php";

class AdminController
{
    private $status = '';
    private $db;
    private $table_admin = "generatepageadmin";

    public function __construct()
    {
        $this->db = new GeneratePageModel;
    }

    public function Active()
    {
        $a = new GeneratePageModel;
        $a->Active();
    }
    public function Desactive()
    {
        flush_rewrite_rules();
    }

    public function CreateMenu($urlFile)
    {
        add_menu_page(
            'Chat GPT',
            'Chat gpt',
            'manage_options',
            $urlFile,
            null,
            plugin_dir_url(__FILE__) . '../../public/assets/img/icon.png',
            '1'
        );
    }

    public function SaveDataUserAdmin()
    {
        global $wpdb;

        $db = new GeneratePageModel;
        $table_admin = $wpdb->prefix . $this->table_admin;
        $list = $db->SelectAllId($table_admin, $_POST["data"]["id"]);

        if (count($list) === 1) {

            $wpdb->update($table_admin, $_POST["data"], ['id' => $_POST["data"]["id"]]);
            $list = $db->SelectAllId($table_admin, $_POST["data"]["id"]);
            return json_encode($list[0]);;
        } else {
            $wpdb->insert($table_admin, $_POST["data"]);
            return json_encode("Correct Register ");
        }
    }

    public function GetDataUserAdmin()
    {
        global $wpdb;
        $db = new GeneratePageModel;
        $table_admin = $wpdb->prefix . $this->table_admin;
        $list = $db->SelectAllId($table_admin, get_current_user_id());
        // if (count($list) === 1) {
            $msg=  $list[0];

        // }else{
        //     $msg= "There's not user register";
        // }

       return json_encode($msg);
    }
}
