<?php

class Console
{

    public function __construct($arg)
    {
        $this->create_controller($arg);
    }
    public function function1($arg)
    {
        $fh = fopen($arg[2] . ".controller.php", 'w') or die("Se produjo un error al crear el archivo");

        $texto = <<<_END
            <?php

            class Console{

                public function __construct(\$arg)
                {
                    //write your code
                   echo "\$arg  ". "$arg[3]";
                }

            }

            new Console(\$argv[1] ?? "hola");
          _END;

        fwrite($fh, $texto) or die("No se pudo escribir en el archivo");

        fclose($fh);

        echo "Se ha escrito sin problemas";
    }
    public function create_controller($arg)
    {

        $a["-a"] = $this->function1($arg);
        $a["-b"] = function () {
            global $arg;
            var_dump($arg[1]);
        };
        $a["-c"] = function () {
            global $arg;
            var_dump($arg[1]);
        };
        $a["-d"] = function () {
            global $arg;
            var_dump($arg[1]);
        };

        print_r($a[$arg[1]]);
    }
}

new Console($argv);
