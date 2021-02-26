# Thông tin về Tác giả
Mã sinh viên: D20212
Họ tên: Trần Huỳnh Anh
Mã sinh viên: D20213
Họ tên: Nguyễn Thanh Tùng

# Hướng dẫn cách sử dụng dự án

## Step 0: Set up môi trường
PHP v7.4
Composer v2.0

## Step 1: Clone source dự án
Thực thi câu lệnh sau:
```
git clone <link đường dẫn github>
https://github.com/nttungmonkey/sellphone-ecommerce.git

## Step 2: Khởi tạo, kết nối database
Hiệu chỉnh file .env, nếu không có file .env thì copy file .env.example về
Nếu chưa có key thì thực hiện câu lệnh php artisan generate:key
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sellphone-ecommerce
DB_USERNAME=admin
DB_PASSWORD=t7kZ@Uz=!nRYDS3z
```

## Step 3: Tạo database, thực hiện migrate
- Tạo database sellphone-ecommerce, chuẩn bảng mã `utf8mb4_unicode_ci`
- Thực thi câu lệnh khởi tạo cấu trúc bảng
```
php artisan migrate
```

## Step 4: tạo dữ liệu mẫu
- Thực thi câu lệnh
```
php artisan db:seed
```

## Step 5: tạo domain ảo
- Tạo domain ảo với phonetn.com

## Step 6: thông tin tài khoản truy cập hệ thống
Tài khoản Admin:
admin / 123456

Tài khoản Khách hàng:
customer / 123456
...


