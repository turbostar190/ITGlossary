<?php
/**
 * Created by PhpStorm.
 * User: fcucino
 * Date: 11/05/18
 * Time: 11.21
 */

// Check for bad requests
if (!isset($_GET['req'])) {
    echo 'Not enough parameters';
    http_response_code(400);
    die();
}

require_once '../core/tools.php';
$conn = sqlConnect();

$req = strtolower(disarmData($_GET['req']));
$lines = array();

if ($req == "") {
    echo json_encode($lines);
    http_response_code(200);
    die();
};

$sql = "SELECT name FROM dictionary WHERE name LIKE '$req%' ORDER BY name LIMIT 10";
$query = $conn->query($sql);

if ($query != NULL) {
    while ($row = $query->fetchArray()) {

        $name = $row['name'];

        $line = array(
            'name' => $name
        );

        array_push($lines, $line);

    }
}

echo json_encode($lines);

$conn->close();
