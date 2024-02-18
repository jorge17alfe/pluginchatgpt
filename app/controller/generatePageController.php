<?php

require_once plugin_dir_path(__DIR__) . "model/generatePageModel.php";
require_once plugin_dir_path(__DIR__) . "controller/gptController.php";

class GeneratePageController
{


    private $db;
    private $table_generate;
    private $table_admin;

    public function __construct()
    {
        $this->db = new GeneratePageModel;
        $this->table_generate = "generatepage";
        $this->table_admin = "generatepageadmin";
    }

    // public function GetAll($table, $column, $since, $total_rows)
    // {
    //     global $wpdb;
    //     $query = "SELECT * FROM $table";
    //     return $wpdb->get_results($query, ARRAY_A);
    // }

    public function GetGroupPages($table, $column, $since, $total_rows)
    {
        global $wpdb;
        $query = "SELECT $column FROM $table ORDER BY id ASC LIMIT $since, $total_rows";
        return $wpdb->get_results($query, ARRAY_A);
    }

    public function GetAllPages($since, $total_rows)
    {
        global $wpdb;
        // return json_encode($_GET);
        $result = $this->GetGroupPages($wpdb->prefix . $this->table_generate, "*", $since, $total_rows);
        return json_encode($result);
    }


    public function SaveCreatePageIA()
    {

        if (!file_exists(__DIR__ . "/../../vendor/autoload.php")) {
            return json_encode(["content" =>  "eject dependencias [composer install]", "id" => 0]);
        }


        try {
            if ($_POST["action"] == "save_create_page_IA") {

                global $wpdb;
                $response = $this->db->Select($wpdb->prefix . $this->table_admin, 0);



                $gpt = new GptController;

                [$result, $inputGpt] = $gpt->GenerateText($response, $_POST["data"]);

                $content = $gpt->FormatingHtml($result->choices[0]->message->content);

                $printId = $this->GetLateRow($wpdb->prefix . $this->table_generate);

                $data = $this->BuildingData($printId, $_POST["data"]['title'], $inputGpt, $content);

                $this->db->insert($wpdb->prefix . $this->table_generate, $data);


                $ty = [
                    "post_title" => $_POST["data"]['title'],
                    "post_content" => $content,
                    // "post_excerpt" => "Jorge Luis y Ordoñez Morales",
                    "post_type" => "gptgenerator"
                ];

                wp_insert_post($ty);


                return json_encode(["content" => $content, "id" => ($printId + 1)]);
            }
        } catch (Exception $e) {
            return json_encode(["content" =>  $e->getMessage(), "id" => 3]);
        }
    }

    public function BuildingData($printId, $title, $inputGpt, $content)
    {
        return array(
            "shortCode" => "[CHATCONSULT id='" . ($printId + 1) . "']",
            "title" => $title,
            // "consult" => $_POST["data"]["content"],//come imput frontend
            "consult" => $inputGpt,
            "content" => $content
        );
    }

    public function GetLateRow($table)
    {
        global $wpdb;
        $query = "SELECT id FROM {$table} ORDER BY id DESC limit 1";
        $getId =  $wpdb->get_results($query, ARRAY_A);
        return ($getId[0]["id"]);
    }

    public function GetShortCode($atts)
    {

        global $wpdb;
        $response = $this->db->Select($wpdb->prefix . $this->table_generate, $atts['id']);
        if (count($response) > 0) {
            return $response[0]["content"];
        } else {
            return "<p style='color:#FD7740;'>There is no data for this consult</p>";
        }
    }
}
