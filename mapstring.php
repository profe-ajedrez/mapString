<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
$raw = "BOLETA DE HONORARIOS
ELECTRONICA

GUILLERMO ANDRES REYES VALDES

N°3
RUT: 13.238.801−6
GIRO(S): SERVICIOS DE HEROICIDAD,
Apolo XII 1460 Villa/Pob. Donde Mueren los Valientes , MAIPU
TELEFONO: 7783972
Fecha: 28 de Febrero de 2019
Señor(es): SERVICIOS Y TECNOLOGIA LIMITADA
Domicilio: GRAN AVENIDA JOSE MIGUEL CARRERA 5018, OF.208, SAN
MIGUEL

Rut: 77.574.330− 1

Por atención profesional:
PROGRAMACION COMPUTACIONAL
Total Honorarios $:
10 % Impto. Retenido:
Total:

333.333
333.333
33.333
300.000

Fecha / Hora Emisión: 28/02/2019 15:25

1323880100003EA54C26
Res. Ex. N° 83 de 30/08/2004
Verifique este documento en www.sii.cl
El contribuyente para el cual está destinada esta boleta, es el encargado de retener el 10%.
11201905242156";

/*
system("pdftotext TMBCOT_ConsultaBoletaPdf.pdf a.txt", $a);


var_dump($a);
die;
*/
//function parseEntity($raw, $dataMap, $checkCase = false)


$dataMap = array(
    "nombre-apellido" => array("inicio" => "ELECTRONICA",  "fin" => "N°"),
    "numero-boleta"   => array("inicio" => "N°",           "fin" => "RUT"),
    "rut-emisor"      => array("inicio" => "RUT:",         "fin" => "GIRO"),
    "giro"            => array("inicio" => "GIRO(S):",     "fin" => "/tele/i"),
    "telefono"        => array("inicio" => "TELEFONO:",    "fin" => "Fecha"),
    "fecha"           => array("inicio" => "Fecha:",       "fin" => "Señ"),
    "referido"        => array("inicio" => "Señor(es):",   "fin" => "Domi"),
    "domicilio"       => array("inicio" => "Domicilio:",   "fin" => "Rut"),
    "rut-referido"    => array("inicio" => "Rut:",         "fin" => "Po"),
    "servicio"        => array("inicio" => "/profesional\:/", "fin" => "/Total/"),
    "montos"          => array("inicio" => "Total:",       "fin" => "Fecha"),
    "fecha-emision"   => array("inicio" => "Emisión:",     "fin" => "\n\n"),
    "id"              => array("inicio" => "\n\n",         "fin" => "Res")
);

echo '<pre>';
$response = mapString($raw, $dataMap, "inicio", "fin");

var_dump($response);

echo '</pre>';



/**
 * mapString
 * 
 * Usando un mapa de datos construye un arreglo de datos extraidos de un string.
 * 
 * @param string $raw        Es el string desde el cual extraer los datos.
 * @param array  $dataMap    Es un arreglo en forma de mapa de datos que indica cuales son, y desde donde extraer los datos.
 * @param string $ini        Es la etiqueta que indica el marcador inicial de donde extraer datos.
 * @param string $fin        Es la etiqueta que indica el marcador final de donde extraer datos.
 * 
 * @return array             Es el arreglo asociativo construido con los datos extraidos de la cadena $raw, y el log del funcionamiento de esta función.
 *                           Tiene la estructura :
 *                                     ["dataMapped"]["etiqueta1"] = "dato1"...
 *                                     ["log"       ]["etiequeta1"]["indiceInicial"] = integer
 *                                                                 ["indiceFinal"  ] = integer
 *                                                                 ["rawData"      ] = string...
 * 
 * Ejemplo :
 * 
 * $raw = "
 * BOLETA DE HONORARIOS
 * ELECTRONICA
 *
 * GUILLERMO ANDRES REYES VALDES
 *
 * N°3
 * RUT: 13.238.801−6
 * GIRO(S): SERVICIOS DE HEROICIDAD,
 * Apolo XII 1460 Villa/Pob. Donde Mueren los Valientes , MAIPU
 * TELEFONO: 7783972
 * Fecha: 28 de Febrero de 2019
 * Señor(es): SERVICIOS Y TECNOLOGIA LIMITADA
 * Domicilio: GRAN AVENIDA JOSE MIGUEL CARRERA 5018, OF.208, SAN MIGUEL
 *
 * Rut: 77.574.330− 1
 * 
 * Por atención profesional:
 * PROGRAMACION COMPUTACIONAL
 *
 * Total Honorarios $:
 * 10 % Impto. Retenido:
 * Total:
 * 
 * 333.333
 * 333.333
 * 33.333
 * 300.000
 *
 * Fecha / Hora Emisión: 28/02/2019 15:25
 * 
 * 1323880100003EA54C26
Res. Ex. N° 83 de 30/08/2004
Verifique este documento en www.sii.cl
El contribuyente para el cual está destinada esta boleta, es el encargado de retener el 10%.
11201905242156
";
 * $dataMap = array(
 *   "nombre-apellido" => array("inicio" => "ELECTRONICA",     "fin" => "N°"),
 *   "numero-boleta"   => array("inicio" => "N°",              "fin" => "RUT"),
 *   "rut-emisor"      => array("inicio" => "RUT:",            "fin" => "GIRO"),
 *   "giro"            => array("inicio" => "GIRO(S):",        "fin" => ","),
 *   "telefono"        => array("inicio" => "TELEFONO:",       "fin" => "Fecha"),
 *   "fecha"           => array("inicio" => "Fecha:",          "fin" => "Señ"),
 *   "referido"        => array("inicio" => "Señor(es):",      "fin" => "Domi"),
 *   "domicilio"       => array("inicio" => "Domicilio:",      "fin" => "Rut"),
 *   "rut-referido"    => array("inicio" => "Rut:",            "fin" => "Po"),
 *   "servicio"        => array("inicio" => "/profesional\:/", "fin" => "/Total/"),
 *   "montos"          => array("inicio" => "Total:",          "fin" => "Fecha"),
 *   "fecha-emision"   => array("inicio" => "Emisión:",        "fin" => "\n\n"),
 *   "id"              => array("inicio" => "\n\n",            "fin" => "Res")
 * );
 * 
 * $response = mapString($raw, $dataMap, "inicio", "fin")
 * 
 * var_dump($response);
 * 
 * El contenido de response será:
 $response = array(
    'dataMapped' => array(
        'nombre-apellido' => 'GUILLERMO ANDRES REYES VALDES',
        'numero-boleta'   => '3',
        'rut-emisor'      => '13.238.801−6',
        'giro'            => 'SERVICIOS DE HEROICIDAD',
        'telefono'        => '7783972',
        'fecha'           => '28 de Febrero de 2019',
        'referido'        => 'SERVICIOS Y TECNOLOGIA LIMITADA',
        'domicilio'       => 'GRAN AVENIDA JOSE MIGUEL CARRERA 5018, OF.208, SAN MIGUEL',
        'rut-referido'    => '77.574.330− 1',
        'servicio'        => 'PROGRAMACION COMPUTACIONAL',
        'montos'          => '333.333 333.333 33.333 300.000',
        'fecha-emision'   => '28/02/2019 15:2',
        'id'              => '1323880100003EA54C26'
    ),
   'log'         => array(
        'nombre-apellido' => array (
            'indiceInicial' => 32,
            'indiceFinal'   => 32,
            'rawData'       => 'GUILLERMO ANDRES REYES VALDES'
        ),
        'numero-boleta'   => array (
            'indiceInicial' => 4,
            'indiceFinal'   => 1,
            'rawData'       => '3'
        ),
        'rut-emisor'      => array (
            'indiceInicial' =>  5,
            'indiceFinal'   => 15,
            'rawData'       => '13.238.801−6'
        ),
        'giro'            => array (
            'indiceInicial' =>  9,
            'indiceFinal'   => 61,
            'rawData'       => 'SERVICIOS DE HEROICIDAD'
        ),
        'telefono'        => array (
            'indiceInicial' => 65,
            'indiceFinal'   =>  8,
            'rawData'       => '7783972'
        ),
        'fecha'           => array (
            'indiceInicial' =>  7,
            'indiceFinal'   => 22,
            'rawData'       => '28 de Febrero de 2019'
        ),
        'referido'        => array (
            'indiceInicial' => 12,
            'indiceFinal'   => 32,
            'rawData'       => 'SERVICIOS Y TECNOLOGIA LIMITADA'
        'domicilio'       => array (
            'indiceInicial' => 11,
            'indiceFinal'   => 59,
            'rawData'       => 'GRAN AVENIDA JOSE MIGUEL CARRERA 5018, OF.208, SAN MIGUEL'
        ),
        'rut-referido'    => array (
            'indiceInicial' =>  5,
            'indiceFinal'   => 17,
            'rawData'       => '77.574.330− 1',
        ),
        'servicio'        => array (
            'indiceInicial' => 28,
            'indiceFinal'   => 26,
            'rawData'       => 'PROGRAMACION COMPUTACIONAL'
        ),
        'montos'          => array (
            'indiceInicial' => 49,
            'indiceFinal'   => 33,
            'rawData'       => '333.333\n333.333\n33.333\n300.000'
        ),
        'fecha-emision'   => array (
            'indiceInicial' => 23,
            'indiceFinal'   => 16,
            'rawData'       => '28/02/2019 15:2'
        'id'              => array (
            'indiceInicial' =>  3,
            'indiceFinal'   => 20,
            'rawData'       => '1323880100003EA54C26'
        )    
   ) 
)
    
 * 
 */
function mapString($raw, $dataMap, $ini = "inicio", $fin = "fin", $cualIni = "cual-ini", $cualFin = "cual-fin", $whenRegExpWhichOne = 0)
{
    $response = array();
    $response["dataMapped"] = array();
    $response["log"]        = array();


    foreach ($dataMap as $dataTag => $keys) {
        $posIni  = -1;
        $posFin  = -1;
        $rawData = "";
        $offset  = 0;
        if (isRegexp($keys[ $ini ])) {

            $whenRegExpWhichOne = (array_key_exists($cualIni, $keys) ? $keys[ $cualIni ] : $whenRegExpWhichOne);
            $matches = pregIndexOf($raw, $keys[ $ini ], $whenRegExpWhichOne);

            if ($matches === false) {
                $posIni = false;
            } else {
                $posIni     = $matches["pos"];
                $lengthIni  = $matches["length"];
            }
        } else {
            $posIni    = strpos($raw, $keys[ $ini ]);
            $lengthIni = strlen($keys[ $ini ]);
        }

        if ($posIni !== false) {
            if (isRegexp($keys[ $fin ])) {
                $whenRegExpWhichOne = (array_key_exists($cualFin, $keys) ? $keys[ $cualFin ] : $whenRegExpWhichOne);
                $matches = pregIndexOf($raw, $keys[ $fin ], $whenRegExpWhichOne);
                if ($matches === false) {
                    $posFin = false;
                } else {
                    $posFin    = $matches["pos"];
                    $lengthFin = $matches["length"];
                }
            } else {
                $posFin    = strpos($raw, $keys[ $fin ]);
                $lengthFin = strlen($keys[ $fin ]);
            }

            if ($posFin !== false) {
                $rawData = substr($raw, $posIni + $lengthIni, $posFin - ($posIni + $lengthIni));
                $response["dataMapped"][ $dataTag ] = trim($rawData);
                $raw = substr($raw, $posFin);
            }
        }
        $response["log"][ $dataTag ] = array(
            "indiceInicial" => $posIni,
            "indiceFinal"   => $posFin,
            "rawData"       => $rawData
        );
    }
    return $response;
}




/**
 * pregIndexOf
 *
 * Usa regexp para encontrar la posición de un patron de busqueda dado
 *
 * @param  string $hayStack  la cadena donde buscar el patron
 * @param  string $needle    el patron regexp  buscar
 * @param  int    $whenRegExpWhichOne indica cual de los matches devolver. Si -1, devuelve el último.
 * @return mixed             Si se encontró el patron, se devuelve un valor integer indicando su posición en la cadena. Si no se encuentra, devuelve false.
 */
function pregIndexOf($hayStack, $needle, $whenRegExpWhichOne = 0)
{
    if ($whenRegExpWhichOne != 0) {
        preg_match_all($needle, $hayStack, $matches, PREG_OFFSET_CAPTURE);
        if ($whenRegExpWhichOne == -1) {
            $whenRegExpWhichOne = sizeof($matches) -1;
        }
        if (is_array($matches)) {
            if (array_key_exists($whenRegExpWhichOne, $matches)) {
                if (array_key_exists(1, $matches[$whenRegExpWhichOne])) {
                    return array("length" => strlen($matches[$whenRegExpWhichOne][0][0]), "pos" => $matches[$whenRegExpWhichOne][0][1]);
                }
            }
        }
    } else {
        preg_match($needle, $hayStack, $matches, PREG_OFFSET_CAPTURE);
        if (is_array($matches)) {
            if (array_key_exists(0, $matches)) {
                if (array_key_exists(1, $matches[0])) {
                    return array("length" => strlen($matches[0][0]), "pos" => $matches[0][1]);
                }
            }
        }
    }

    return false;
}
/**
 * isRegexp
 *
 * Comprueba si el parametro es una regexp valida
 *
 * @param  string  $string
 * @return boolean true si parámetro es una regexp valida
 */
function isRegexp($string)
{
    return !(@preg_match($string, null) === false);
}

