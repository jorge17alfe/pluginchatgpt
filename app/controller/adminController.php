<?php

require_once plugin_dir_path(__DIR__) . "model/generatePageModel.php";

class AdminController
{
    private $status ='';
    private $db;
    private $table_generate ;

    public function __construct()
    {
        $this->status= 0;
        $this->table_generate = "generatepageadmin";
        $this->db = new GeneratePageModel;
    }

    public function Active()
    {
        $a = new GeneratePageModel;
        $a->Active();
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
        $table_generate = $wpdb->prefix.$this->table_generate;
        $list = $db->Select($table_generate, $this->status);

        if (count($list)===1) {

            $wpdb->update($table_generate, $_POST["data"], ['id' => $_POST["data"]["id"]]);
            $list = $db->Select($table_generate, $this->status);
            return json_encode($list[0]);;
        } else {
            $wpdb->insert($table_generate, $_POST["data"]);
            return json_encode("there is not data");
        }
    }

    public function GetDataUserAdmin()
    {
        global $wpdb;
        $db = new GeneratePageModel;
        $table_generate = $wpdb->prefix.$this->table_generate;
        $list = $db->Select($table_generate, $this->status);
        return json_encode($list[0]);
    }
}
