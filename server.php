<?php
session_start();

if (!isset($_SESSION['target_number'])) {
    $_SESSION['target_number'] = rand(1, 100);
}


$response = [
    'message' => 'Make a guess!',
    'game_over' => false,
];

if (isset($_POST['guess'])) {
    $guess = intval($_POST['guess']);
    $target = $_SESSION['target_number'];

    if ($guess === $target) {
        $response['message'] = "Correct! The number was $target.";
        $response['game_over'] = true;
        unset($_SESSION['target_number']);
    } elseif ($guess < $target) {
        $response['message'] = "Too low!";
    } else {
        $response['message'] = "Too high!";
    }
}

header('Content-Type: application/json');
echo json_encode($response);

?>