<?php
/**
 * Created by PhpStorm.
 * User: fcucino
 * Date: 18/05/18
 * Time: 11.33
 */

require_once '../core/tools.php';
$conn = sqlConnect();

$sql = "SELECT id, name FROM dictionary WHERE link IS NULL";
$queryAll = $conn->query($sql);

if ($queryAll != NULL) {
    while ($row = $queryAll->fetchArray()) {

        $id = intval($row['id']);
        $name = $row['name'];

        // TODO: Si potrebbe altamente ottimizzare concatenando titles e pageids... ma nah
        //                                          urlencode per codificare caratteri != lettere ( " " -> "%20" )
        $json_url = "http://en.wikipedia.org/w/api.php?action=query&format=json&titles=" . urlencode($name);
        $json = file_get_contents($json_url); // Scarica la risposta ottenuta
        $parseJ = json_decode($json, true); // Crea un vero e proprio json
        if (isset($parseJ['query']['pages'][-1])) { // Se non esiste pagina Wikipedia le API rispondono con 'pages' = -1
            $sql = "UPDATE dictionary SET link = '404' WHERE id = $id";
            $query = $conn->query($sql);
            if (!$query) {
                echo json_encode("link to 404 query error");
                http_response_code(400);
                die();
                break;
            }
            continue; // Se il termine cercato non esiste passo alla prossima iterazione
        }
        $pageid = $parseJ['query']['pages'][key($parseJ['query']['pages'])]['pageid']; // Ottiene il 'pageid'

        // Vera e propria API che restituisce informazioni sulla parola cercata
        $json_url = "http://en.wikipedia.org/w/api.php?action=query&format=json&prop=info&inprop=url&pageids=$pageid";
        $json = file_get_contents($json_url);
        $parseJ = json_decode($json, true);
        $canonicalUrl = $parseJ['query']['pages'][$pageid]['canonicalurl']; // Ottengo l'url del termine
        $sql = "UPDATE dictionary SET link = '$canonicalUrl' WHERE id = $id";
        $query = $conn->query($sql);
        if (!$query) {
            echo json_encode("link query error");
            http_response_code(400);
            die();
            break;
        }
    }
}

$conn->close();
