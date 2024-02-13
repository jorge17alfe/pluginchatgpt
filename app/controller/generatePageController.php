<?php

require_once plugin_dir_path(__DIR__) . "model/generatePageModel.php";

class GeneratePageController
{

            
    private $db;
    private $table_generate;
    private $table_admin;

    public function __construct()
    {
        $this->db = new GeneratePageModel;
        $this->table_generate= "generatepage";
        $this->table_admin= "generatepageadmin";
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
        $result = $this->GetGroupPages($wpdb->prefix.$this->table_generate, "*", $since, $total_rows);
        return json_encode($result);
    }


    public function SaveCreatePageIA()
    {

        include_once __DIR__ . "/../lib/vendor/autoload.php";
        if ($_POST["action"] == "save_create_page_IA") {
            
            global $wpdb;
            $response = $this->db->Select($wpdb->prefix.$this->table_admin, 0);
            $client = OpenAI::client($response[0]["tokenOpenai"]);
            $getResponseChatgpt = $this->ArmConsult($_POST["data"]);

            $result = $client->chat()->create([
                'model' => $response[0]["chatgptversion"],
                'messages' => [
                    [
                        'role' => 'user',
                        'content' => $getResponseChatgpt
                        // 'content' => $_POST["data"]["content"]
                    ],
                ],
            ]);

            $content = wpautop($result->choices[0]->message->content);

            $query = "SELECT id FROM {$wpdb->prefix}{$this->table_generate} ORDER BY id DESC limit 1";
            $getId =  $wpdb->get_results($query, ARRAY_A);
            $printId = ($getId[0]["id"]);

            $data = [
                "shortCode" => "[CHATCONSULT id='" . ($printId+1) . "']",
                "title" => $_POST["data"]['title'],
                // "consult" => $_POST["data"]["content"],//come imput frontend
                "consult" => $getResponseChatgpt,
                "content" => $content
            ];

            $wpdb->insert($wpdb->prefix.$this->table_generate, $data);
       

            return json_encode(["content" => $content, "id" => ($printId + 1)]);
        }
    }


   

    public function GetShortCode($atts)
    {

        global $wpdb;
        $response = $this->db->Select($wpdb->prefix.$this->table_generate , $atts['id']);
        if (count($response) > 0) {
            return $response[0]["content"];
        } else {
            return "<p style='color:#FD7740;'>There is no data for this consult</p>";
        }
    }


    public function ArmConsult($atts)
    {

        return "un poema hacia  {$atts['title']} ";
        return "Redactame un articulo completo de {$atts['title']} para una pagina web, con titulo principal envuelto en h1  y subtitulos en al menos 10 secciones envueltos en h3 un link a con src ";
        return
            "   Crea un texto de  pagina web con un titulo pegadizo de {$atts['title']} envuelto en h1. 
            Un subtitulo con una descripcion de entre 2 y 3 líneas envuelto en h3. 
            Haz un top 10 de {$atts['title']} enumerados envueltos en <b>, con una descripcion de al menos 3 líneas. 
            una seccion con titulo envuelto en h3  hablando de porque estos articulos que comprarán en tu tienda son los mejores y deben de comprarlos.
            A continuacion elabora una seccion con un subtitulo con cada elemento del top 10 y un texto de 150 a 180 palabras hablado de su historia.
            Y una sección de parrafo envuelto en negrita  hablando de los buenos resultados que darian.
            
            ";
    }
}
