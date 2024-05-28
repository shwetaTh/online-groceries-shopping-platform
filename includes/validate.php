<?php
function getUser($conn, $contact){
    $sql="SELECT * FROM login WHERE contact=?";
    $stmt=mysqli_prepare($conn, $sql);
    if ($stmt===false) {
        echo mysqli_error($conn);
    }else{
        mysqli_stmt_bind_param($stmt, "s", $contact);
        if (mysqli_stmt_execute($stmt)) {
            $result=mysqli_stmt_get_result($stmt);
            return mysqli_fetch_array($result, MYSQLI_ASSOC);
        }
    }
}
function validatePhoneNumber($phone_number) {
    $pattern = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
    return preg_match($pattern, $phone_number) === 1;
}

function getProduct($conn, $id){
    $sql="SELECT * FROM prodcuts WHERE product_id=?";
    $stmt=mysqli_prepare($conn, $sql);
    if ($stmt===false) {
        echo mysqli_error($conn);
    }else{
        mysqli_stmt_bind_param($stmt, "i", $id);
        if (mysqli_stmt_execute($stmt)) {
            $result=mysqli_stmt_get_result($stmt);
            return mysqli_fetch_array($result, MYSQLI_ASSOC);
        }
    }
}
function getAdmin($conn, $contact){
    $sql="SELECT * FROM admin WHERE email=?";
    $stmt=mysqli_prepare($conn, $sql);
    if ($stmt===false) {
        echo mysqli_error($conn);
    }else{
        mysqli_stmt_bind_param($stmt, "s", $contact);
        if (mysqli_stmt_execute($stmt)) {
            $result=mysqli_stmt_get_result($stmt);
            return mysqli_fetch_array($result, MYSQLI_ASSOC);
        }
    }
}
function validateEmail($email) {
    $pattern = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
    return preg_match($pattern, $email) === 1;
}
?>

