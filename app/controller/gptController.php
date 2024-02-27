<?php
if (file_exists(__DIR__ . "/../../vendor/autoload.php")) {
    include_once __DIR__ . "/../../vendor/autoload.php";
}

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
                'max_tokens' => 2000,

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
        $content = wpautop($response->data[0]->url);
        return $content; // 1589478378

    }

    public function ArmConsult($title)
    {


        // return array(
        //     /*title*/
        //     "Vamos a redactar un articulo en español paso a paso para una web de {$title} con diferentes secciones del articulo principal de {$title}.\n Para empezar: dame un titulo envuelto en etiqueta h1",

        //     "Quiero un subtitulo pegadizo profesional y familiar de " . $title,
        //     "A continuacion quiero una lista con un subtitulo envuelto en una etiqueta h2 de lo mas importante que se pueda decir de {$title} ",
        //     "Hablame de cada punto de la lista dada en un bloque de 7 u 8 lineas de {$title}",
        //     "y para finalizar un bloque de conclusion de {$title} y porque es importante para el mundo."

        // );

        // return "Redactame un articulo completo de {$title} para una pagina web, con titulo principal envuelto en h1  y subtitulos en al menos 10 secciones envueltos en h3 un link a con src ";
        // return "un poema hacia  {$title} ";
        return
            [
                "Vamos a redactar un articulo en español paso a paso para una web de {$title} con diferentes secciones del articulo principal de {$title}.\n Para empezar: dame un titulo envuelto en etiqueta h1",
                "   Crea un texto de  pagina web sin titulo principal que ya lo edito yo:
            Un subtitulo con una descripcion de entre 2 y 3 líneas envuelto en h3. 
            Haz un top 10 de {$title} enumerados envueltos en <b>, con una descripcion de al menos 3 líneas. 
            una seccion con titulo envuelto en h3  hablando de porque estos articulos que comprarán en tu tienda son los mejores y deben de comprarlos.
            A continuacion elabora una seccion con un subtitulo con cada elemento del top 10 y un texto de 150 a 180 palabras hablado de su historia.
            Y una sección de parrafo envuelto en negrita  hablando de los buenos resultados que darian.
            "
            ];
    }

    public function ResponseAll()
    {
        $obj =  new \stdClass;
        $consult = $this->ArmConsult($this->inputgpt);

        $obj->title = $this->GenerateText($consult[0]);
        $obj->content = $this->GenerateText($consult[1]);
        // $obj->subtitle[] = $this->GenerateText($consult[1]);


        // $result_create = 'klhljlksdjsalkd ';
        // if(isset($consult[1]))$obj->content[0] = $this->GenerateText($consult[1]);
        // // if(isset($consult[2]))$obj->content[1] = $this->GenerateText($consult[2]);
        // if (isset($consult[3])) $obj->content[] = $this->GenerateText($consult[3]);
        // if (isset($consult[4])) $obj->content[] = $this->GenerateText($consult[4]);
        // // $image = $this->CreateImage($title);


        return $obj;
    }
}
