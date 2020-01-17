<?php
/**
 * Created by PhpStorm.
 * User: fcucino
 * Date: 12/05/18
 * Time: 9.35
 */

require_once '../core/tools.php';
$conn = sqlConnect();

$line = array();

$sql = "SELECT Count(id) AS cont FROM dictionary";
$query = $conn->query($sql);
$row = $query->fetchArray();
$countElem = intval($row['cont']); // Numero di elementi

if ($countElem != NULL) {

    $randomId = rand(1, $countElem); // $countElem incluso
    $sql = "SELECT * FROM dictionary WHERE id = $randomId";
    $query = $conn->query($sql);

    $row = $query->fetchArray();

    $id = intval($row['id']);
    $name = $row['name'];
    $def = $row['def'];
    $link = $row['link'];
    $audio = getAudio($name);

    $line = array(
        'id' => $id,
        'name' => $name,
        'def' => $def,
        'link' => $link,
        'audioFile' => $audio['audioFile'],
        'phoneticSpelling' => $audio['phoneticSpelling']
    );

}

echo json_encode($line);

$conn->close();
