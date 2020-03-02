<?php
require 'connect.php';

// Get the posted data.
$postdata = file_get_contents("php://input");

if (isset($postdata) && !empty($postdata)) {
    // Extract the data.
    $request = json_decode($postdata);

    // var_dump($request);exit();

    // Validate.
    if (trim($request->data->fname) === '') {
        return http_response_code(400);
    }

    // Sanitize.
    $fname = mysqli_real_escape_string($con, trim($request->data->fname));
    $lname = mysqli_real_escape_string($con, trim($request->data->lname));
    $appointment = mysqli_real_escape_string($con, trim($request->data->appointment));
    $duration = mysqli_real_escape_string($con, (float) $request->data->duration);
    $remark = mysqli_real_escape_string($con, trim($request->data->remark));

    // Store.
    $sql = "INSERT INTO `bookings`(`id`,`first_name`,`last_name`, `appointment`,`duration`,`remark`) VALUES (null,'{$fname}','{$lname}','{$appointment}','{$duration}','{$remark}')";

    // var_dump($sql);exit();

    if (mysqli_query($con, $sql)) {
        http_response_code(201);
        $booking = [
            'first_name' => $fname,
            'last_name' => $lname,
            'appointment' => $appointment,
            'duration' => $duration,
            'remark' => $remark,
            'id' => mysqli_insert_id($con),
        ];
        echo json_encode(['data' => $booking]);
    } else {
        http_response_code(422);
    }
}
