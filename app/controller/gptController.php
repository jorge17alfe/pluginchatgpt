<?php

class GptController
{

    public function GenerateText($response, $input)
    {

        include_once __DIR__ . "/../../vendor/autoload.php";

        $client = OpenAI::client($response[0]["tokenOpenai"]);

        $inputGpt = $this->ArmConsult($input);
        $result = $client->chat()->create([
            'model' => $response[0]["gptversion"],
            'messages' => [
                [
                    'role' => 'user',
                    'content' => $inputGpt
                    // 'content' => $_POST["data"]["content"]
                ],
            ],
        ]);





        return [$result, $inputGpt];



    }

    public function FormatingHtml($result)
    {
        return wpautop($result);
    }

    public function ArmConsult($atts)
    {

        // return "Redactame un articulo completo de {$atts['title']} para una pagina web, con titulo principal envuelto en h1  y subtitulos en al menos 10 secciones envueltos en h3 un link a con src ";
        // return "un poema hacia  {$atts['title']} ";
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
