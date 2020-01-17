<?php
/**
 * Created by PhpStorm.
 * User: fcucino
 * Date: 18/05/18
 * Time: 19.10
 */

// Check for bad requests
if (!isset($_GET['word'])) {
    echo 'Not enough parameters';
    http_response_code(400);
    die();
}

require_once '../core/tools.php';
$conn = sqlConnect();

$word = strtolower(disarmData($_GET['word']));
$line = array();

if ($word == "") {
    echo json_encode($line);
    http_response_code(200);
    die();
};

$sql = "SELECT name, def, link FROM dictionary WHERE name LIKE '$word'";
$query = $conn->query($sql);

if ($query != NULL) {

    $row = $query->fetchArray();

    $name = $row['name'];
    $def = $row['def'];
    $link = $row['link'];
    $audio = getAudio($word);

    $line = array(
        'name' => $name,
        'def' => $def,
        'link' => $link,
        'audioFile' => $audio['audioFile'],
        'phoneticSpelling' => $audio['phoneticSpelling']
    );

}

echo json_encode($line);

$conn->close();
