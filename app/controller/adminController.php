<?php

require_once plugin_dir_path(__DIR__) . "model/chatgptModel.php";

class AdminController
{
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
        // $list = $db->Select($table_chatgpt, 0);

        // if ($_POST) {

        //     $wpdb->update($table_chatgpt, $_POST["data"], ['id' => $_POST["data"]["id"]]);
        //     $list = $db->Select($table_chatgpt, 0);
        //     return json_encode($list[0]);;
        // } else {
            $wpdb->insert($table_chatgpt, $_POST["data"]);
            return json_encode("there is not data");
        // }
    }
    public function GetDataUserAdminchatgpt()
    {
        $db = new chatgptModel;
        if ($_GET) {
            global $wpdb;
            $table_chatgpt = "{$wpdb->prefix}chatgpt";
            $list = $db->Select($table_chatgpt, 0);
            return json_encode($list[0]);;
        }
    }
  
 

  


 
}
