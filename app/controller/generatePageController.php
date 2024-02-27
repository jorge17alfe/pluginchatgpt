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
        $this->table_generate = "wp_posts";
        $this->table_admin = "generatepageadmin";
    }

    public function GetGroupPages($table, $column, $since, $total_rows)
    {
        global $wpdb;
        $query = "SELECT $column FROM  $table  WHERE post_author = ".get_current_user_id()." ORDER BY ID DESC LIMIT $since, $total_rows";
        // $query = "SELECT $column FROM  $table  ORDER BY ID ASC LIMIT $since, $total_rows";
        return $wpdb->get_results($query, ARRAY_A);
    }

    public function GetAllPages($since, $total_rows)
    {
        $result = get_posts(
            [
                'post_type'  => 'gptgenerator',
                'orderby'          => "ID",
                'limits' => 3,
                'order'            => 'ASC',
            ]
        );
        $result = $this->GetGroupPages($this->table_generate, "*" ,$since, $total_rows);
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
                $response = $this->db->SelectAllId($wpdb->prefix . $this->table_admin, get_current_user_id());

                $r = new GptController($response[0], $_POST["data"]['title']);

                $result  = $r->ResponseAll();

                $result->content = wpautop($result->content);

                $create_post = $this->BuildingDataPost($result->title, $result->content, "gptgenerator");

                $id = wp_insert_post($create_post);

                $msg = $result;
            }
        } catch (Exception $e) {
            $msg = $e->getMessage();
        }
        return json_encode(["content" =>  $msg, "id" => $id]);
    }


    public function BuildingDataPost($title,  $content, $post_type_name = "post")
    {
        return array(
            "post_title" => $title,
            "post_content" => $content,
            // "post_excerpt" => "Jorge Luis y Ordoñez Morales",
            "post_type" => $post_type_name
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
        $response = $this->db->SelectAllId($wpdb->prefix . $this->table_generate, $atts['id']);
        if (count($response) > 0) {
            return $response[0]["content"];
        } else {
            return "<p style='color:#FD7740;'>There is no data for this consult</p>";
        }
    }
}
