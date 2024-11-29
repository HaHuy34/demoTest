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

    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Mã hóa mật khẩu
    $email = $_POST['email'];
    $created_at = date('Y-m-d H:i:s');  // Lấy thời gian hiện tại

    // Chèn dữ liệu vào bảng 'users'
    $sql = "INSERT INTO users (username, password, email,created_at) 
                VALUES ('$username', '$password', '$email', '$created_at')";

    if ($conn->query($sql) === TRUE) {
        // Sau khi thành công, chuyển hướng đến signin.php
        header("Location: shop.html");
        exit();  // Dừng chương trình ngay sau khi chuyển hướng
    } else {
        echo "Lỗi: " . $sql . "<br>" . $conn->error;
    }
    
// Đóng kết nối
$conn->close();
?>