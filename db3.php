<?php
$servername = "localhost"; // Địa chỉ máy chủ MySQL
$username = "root";        // Tên người dùng MySQL
$password = "";            // Mật khẩu MySQL (mặc định là rỗng nếu chưa thay đổi)
$dbname = "fruit_shop";    // Tên cơ sở dữ liệu bạn muốn kết nối tới

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Kiểm tra xem form đã được gửi hay chưa
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lấy dữ liệu từ form và bảo vệ tránh SQL injection
    $username = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $address = $conn->real_escape_string($_POST['address']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $saysomething = $conn->real_escape_string($_POST['saysomething']);
    
    // Câu lệnh SQL để chèn dữ liệu vào bảng
    $sql = "INSERT INTO orders (username, email, address, phone, saysomething) 
            VALUES ('$username', '$email', '$address', '$phone', '$saysomething')";

    if ($conn->query($sql) === TRUE) {
        echo "Dữ liệu đã được lưu thành công!";

        
    } else {
        echo "Lỗi: " . $conn->error;
    }
    header("Location: shop.html");
    exit();  // Dừng chương trình ngay sau khi chuyển hướng
    // Đóng kết nối
    $conn->close();
}
?>
