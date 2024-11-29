<?php
session_start();


    // Lấy dữ liệu từ form đăng nhập
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Kết nối đến cơ sở dữ liệu
    $conn = new mysqli("localhost", "root", "", "fruit_shop");

    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }

    // Truy vấn thông tin người dùng
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Kiểm tra mật khẩu
        if (password_verify($password, $user['password'])) {
            // Lưu thông tin người dùng vào session
            $_SESSION['username'] = $user['username'];
            echo "Đăng nhập thành công! Chuyển đến trang shop...";
            header("location: shop.html"); // Chuyển đến trang shop
            exit();
        } else {
            echo "Sai mật khẩu!";
        }
    } else {
        echo "Tên đăng nhập không tồn tại!";
    }

    $conn->close();

?>