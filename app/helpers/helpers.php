<?php

function returnFormate($message, $data, $query, $error=false) {
    $value = ($data == null || is_array($data) || is_object($data)) ? 'User' : $data;
    if($query == 'update_query') {
        $msg = $value.' user data update successfully !!';
    }
    else if($query == 'insert_query') {
        $msg = $value.' user insert successfully !!';
    }
    else if($query == 'fetch_query') {
        $msg = $value.' data fetch successfully !!';
    }
    else if($query == 'delete_query') {
        $msg = $value.' data delete successfully !!';
    }
    else {
        $msg = 'Error Found !!';
    }

    if($message == 'success_msg') {
        $status = 'SUCCESS';
    }
    else {
        $status = 'ERROR';
    }

    $response['status'] = $status;
    $response['data'] = $data;
    $response['msg'] = $msg;
    $response['error_code'] = $error;

    if($error)
        return json_encode($response, JSON_FORCE_OBJECT);
    return json_encode($response);
}