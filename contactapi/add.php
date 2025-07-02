<?php
   require 'connect.php';
    // get the posted data
    $postdata = file_get_contents("php://input");
    if (isset($postdata) && !empty($postdata)) {
        // extract the data
        $request = json_decode($postdata);

        // validate
        if (trim($request->data->firstName) === '' || trim($request->data->lastName) === '' ||
         trim($request->data->emailAddress) === ''|| trim($request->data->phone) === ''||
         trim($request->data->status) === ''|| trim($request->data->dob) === '') 
         {
            return http_response_code(400);
        }

        // store
        $firstName = mysqli_real_escape_string($conn, trim($request->data->firstName));
        $lastName = mysqli_real_escape_string($conn, trim($request->data->lastName));
        $emailAddress = mysqli_real_escape_string($conn, trim($request->data->emailAddress));
        $phone = mysqli_real_escape_string($conn, trim($request->data->phone));
        $status = mysqli_real_escape_string($conn, trim($request->data->status));
        $dob = mysqli_real_escape_string($conn, trim($request->data->dob));
        $imageName = mysqli_real_escape_string($conn, trim($request->data->imageName));

        $origimg = str_replace('\\', '/', $imageName);
        $new = basename($origimg);

        // store the data

        $sql = "INSERT INTO `contacts`(`contactID`,`firstName`,`lastName`, `emailAddress`, `phone`, `status`, `dob`, `imageName`) VALUES (null,'{$firstName}','{$lastName}','{$emailAddress}','{$phone}','{$status}','{$dob}', '{$new}')";

        if(mysqli_query($con,$sql))
         {
            http_response_code(201);
    $contact = [
      'firstName' => $firstName,
      'lastName' => $lastName,
      'emailAddress' => $emailAddress,
      'phone' => $phone,
      'status' => $status,
      'dob' => $dob,
      'imageName' => $new,
      'contactID'    => mysqli_insert_id($con)
    ];    
    echo json_encode(['data'=>$contact]);
        }
    } else {
        http_response_code(422);
    }
?>