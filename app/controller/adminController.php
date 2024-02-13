<?php

require_once plugin_dir_path(__DIR__) . "model/chatgptModel.php";

class AdminController
{
    private $status ='';

    public function __construct()
    {
        $this->status= 0;
    }
    public function Active()
    {
        $a = new chatgptModel;
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

    public function SaveDataUserAdminchatgpt()
    {
        global $wpdb;

        $db = new chatgptModel;
        $table_chatgpt = "{$wpdb->prefix}chatgpt";
        $list = $db->Select($table_chatgpt, $this->status);

        if (count($list)===1) {

            $wpdb->update($table_chatgpt, $_POST["data"], ['id' => $_POST["data"]["id"]]);
            $list = $db->Select($table_chatgpt, $this->status);
            return json_encode($list[0]);;
        } else {
            $wpdb->insert($table_chatgpt, $_POST["data"]);
            return json_encode("there is not data");
        }
    }

    public function GetDataUserAdminchatgpt()
    {
        global $wpdb;
        $db = new chatgptModel;
        $table_chatgpt = "{$wpdb->prefix}chatgpt";
        $list = $db->Select($table_chatgpt, $this->status);
        // if(empty($list)){
        //     return json_encode();
        // }
        return json_encode($list[0]);
    }
}
