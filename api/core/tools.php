<?php
/**
 * Created by PhpStorm.
 * User: fcucino
 * Date: 11/05/18
 * Time: 12.31
 */

/**
 * Istanzia un oggetto connessione al db
 * @return Object connessione
 */
function sqlConnect()
{
    $filenameDB = "../glossaryDB.sqlite3";

    if (file_exists($filenameDB)) {
        try {
            // connect to your database
            $conn = new SQLite3($filenameDB);
        } catch (Exception $e) {
            // sqlite3 throws an exception when it is unable to connect
            http_response_code(500); //Internal Server Error
            die();
        }
    } else {
        http_response_code(500); //Internal Server Error
        die();
    }

    return $conn;
}

/**
 * Converte eventuali caratteri speciali per prevenire SQL Injection
 * @param string $data stringa da elaborare
 * @return string stringa elaborata
 */
function disarmData($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data = htmlentities($data);
    $data = str_replace("'", "''", $data);
    return $data;
}

/**
 * Formatta in modo leggibile un array per json
 * @param array $array array da formattare
 * @return string array formattato leggibile
 */
function writeJson($array)
{
    $json = json_encode($array, JSON_PRETTY_PRINT);
    return $json;
}

/**
 * Ottiene un link al file audio di una data parola chiamando le API di Oxford Dictionaries
 * N.B. Profilo free massimo 60 richieste al minutos
 * @param $word string termine da applicare alla ricerca
 * @return array
 */
function getAudio($word)
{
    error_reporting(E_ERROR | E_PARSE); // Nasconde errori e warning

    // Create a stream
    $opts = array(
        'http' => array(
            'method' => "GET",
            'header' => "Accept: application/json\r\n" . // Headers
                "app_id: 7dfec479\r\n" . // API Key
                "app_key: a48a60b0f8100d9c89dd09a60cc3faef\r\n" // API Key
        )
    );
    $context = stream_context_create($opts);

    // Open the file using the HTTP headers set above
    $file = file_get_contents("https://od-api.oxforddictionaries.com/api/v1/entries/en/$word/regions=gb", false, $context);
    // Potrebbe essere NULL se il termine non è trovato
    $parseJ = json_decode($file, true);

    $audioFile = $parseJ['results'][0]['lexicalEntries'][0]['pronunciations'][0]['audioFile'];
    $phoneticSpelling = $parseJ['results'][0]['lexicalEntries'][0]['pronunciations'][0]['phoneticSpelling'];

    return array(
        'audioFile' => $audioFile,
        'phoneticSpelling' => $phoneticSpelling
    );
}