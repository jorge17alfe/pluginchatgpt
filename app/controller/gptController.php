<?php
include_once __DIR__ . "/../../vendor/autoload.php";

class GptController
{

    public $inputgpt;
    public $response;
    // public $result;



    public function __construct($response, $input)
    {
        $this->inputgpt = $input;
        $this->response = $response;
    }

    public function GenerateText($input)
    {

        try {


            $client = OpenAI::client($this->response["tokenOpenai"]);

            $result = $client->chat()->create([
                'model' => $this->response["gptversion"],
                'messages' => [
                    [
                        'role' => 'user',
                        'content' => $input
                        // 'content' => $_POST["data"]["content"]
                    ],
                ],
            ]);

            return $result->choices[0]->message->content;
        } catch (Exception $e) {
            return  [$e->getMessage(), 6];
        }
    }

    // public function GenerateTextGpt4($input)
    // {
    //     $client = OpenAI::client($this->response["tokenOpenai"]);
    //     $stream = $client->completions()->createStreamed([
    //         'model' => 'gpt-3.5-turbo-instruct',
    //         'prompt' => 'Hi',
    //         'max_tokens' => 10,
    //     ]);

    // foreach($stream as $response){
    //     $response->choices[0]->text;
    // }
    // // 1. iteration => 'I'
    // // 2. iteration => ' am'
    // // 3. iteration => ' very'
    // // 4. iteration => ' excited'
    // // ...

    //     return $result['choices'][0]['text'];
    // }

    public function CreateImage($request)
    {
        $client = OpenAI::client($this->response["tokenOpenai"]);
        // $query = $request->image;
        // $size = $request->size;
        $query = $request;
        $size = "512x512";

        $response = $client->images()->create([
            'prompt' => $query,
            'n' => 1,
            'size' => $size,
            'response_format' => 'url',
        ]);

        return $response->data[0]->url; // 1589478378

    }

    public function ArmConsult($title)
    {


        return array(
            // $title,
            "Vamos a redactar un articulo paso a paso para una web de {$title} con diferentes secciones del articulo principal de {$title}.\n Para empezar: dame un titulo envuelto en etiqueta h1",
            "A continuacion quiero una lista con un subtitulo envuelto en una etiqueta h2 de lo mas importante que se pueda decir de {$title} ",
            "Hablame de cada punto de la lista dada en un bloque de 7 u 8 lineas de {$title}",
            "y para finalizar un bloque de conclusion de {$title} y porque es importante para el mundo."

        );
        // return $consult;

        // // return "Redactame un articulo completo de {$consult} para una pagina web, con titulo principal envuelto en h1  y subtitulos en al menos 10 secciones envueltos en h3 un link a con src ";
        // // return "un poema hacia  {$consult} ";
        // return
        //     "   Crea un texto de  pagina web con un titulo pegadizo de {$consult} envuelto en h1. 
        //     Un subtitulo con una descripcion de entre 2 y 3 líneas envuelto en h3. 
        //     Haz un top 10 de {$consult} enumerados envueltos en <b>, con una descripcion de al menos 3 líneas. 
        //     una seccion con titulo envuelto en h3  hablando de porque estos articulos que comprarán en tu tienda son los mejores y deben de comprarlos.
        //     A continuacion elabora una seccion con un subtitulo con cada elemento del top 10 y un texto de 150 a 180 palabras hablado de su historia.
        //     Y una sección de parrafo envuelto en negrita  hablando de los buenos resultados que darian.

        //     ";
    }

    public function ResponseAll()
    {
        $consult = $this->ArmConsult($this->inputgpt);
        $title = $this->GenerateText($consult[0]);
        // $res = '';
        // unset($consult[0]);
        // foreach ($consult as $v) {
        $res = ' ';
        $image = ' ';
        if(isset($consult[1]))$res .= $this->GenerateText($consult[1])."\n";
        if(isset($consult[2]))$res .= $this->GenerateText($consult[2])."\n";
        if(isset($consult[3]))$res .= $this->GenerateText($consult[3])."\n";
        $image = $this->CreateImage($title);
        // }

        return [$title . "<img src='" . $image . "'>" . $res, $this->inputgpt];
        // return [$title, $this->inputgpt];
    }
}
