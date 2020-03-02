<?php
/**
 * Returns the list of cars.
 */

// require 'connect.php';

// $cars = [];
// $sql = "SELECT id, model, price FROM cars";

// if ($result = mysqli_query($con, $sql)) {
//     $cr = 0;
//     while ($row = mysqli_fetch_assoc($result)) {
//         $cars[$cr]['id'] = $row['id'];
//         $cars[$cr]['model'] = $row['model'];
//         $cars[$cr]['price'] = $row['price'];
//         $cr++;
//     }

//     echo json_encode(['data' => $cars]);
// } else {
//     http_response_code(404);
// }

require 'connect.php';

$bookings = [];
$sql = "SELECT id, first_name, last_name, appointment, duration, remark FROM bookings";

if ($result = mysqli_query($con, $sql)) {
    $cr = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $bookings[$cr]['id'] = $row['id'];
        $bookings[$cr]['first_name'] = $row['first_name'];
        $bookings[$cr]['last_name'] = $row['last_name'];
        $bookings[$cr]['appointment'] = $row['appointment'];
        $bookings[$cr]['duration'] = $row['duration'];
        $bookings[$cr]['remark'] = $row['remark'];
        $cr++;
    }

    echo json_encode(['data' => $bookings]);
} else {
    http_response_code(404);
}
