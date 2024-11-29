<?php
// Thiết lập kết nối đến cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fruit_shop";

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Kiểm tra xem form đã được gửi hay chưa
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lấy dữ liệu từ form và bảo vệ chống SQL Injection
    $name = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $subject = $conn->real_escape_string($_POST['subject']);
    $message = $conn->real_escape_string($_POST['message']);
   

    // Câu lệnh SQL để chèn dữ liệu vào bảng
    $sql = "INSERT INTO contacts (username, email, phone, subject, message) 
            VALUES ('$username', '$email', '$phone', '$subject', '$message')";

    // Thực thi câu lệnh SQL
    if ($conn->query($sql) === TRUE) {
        echo "Dữ liệu đã được lưu thành công!";
    } else {
        echo "Lỗi: " . $conn->error;
    }

    // Đóng kết nối
    $conn->close();
}
?>
