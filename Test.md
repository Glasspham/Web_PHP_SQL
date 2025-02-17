# 🚀 Hướng Dẫn Sử Dụng

## 📌 Mục Lục
1. [Giới thiệu](#giới-thiệu)
2. [Công nghệ sử dụng](#💻-công-nghệ-sử-dụng)
3. [Cách chạy chương trình](#cách-chạy-chương-trình)
   - [Chạy bằng Docker](#cách-1-chạy-bằng-docker)
   - [Chạy bằng XAMPP](#cách-2-chạy-bằng-xampp)
4. [Xem cơ sở dữ liệu](#xem-cơ-sở-dữ-liệu)
5. [Tổng hợp lệnh Docker](#tổng-hợp-lệnh-docker)

---

## 📖 Giới Thiệu

Dự án này được thực hiện dựa trên kênh [Hiếu Tutorial with Live Project](https://youtube.com/playlist?list=PLWTu87GngvNwRxrFZ_wbxfvHHed14H5RC&si=1sXmTl2WHD_ElVrx) và đã được cải tiến để phù hợp hơn.

---

## 💻 Công Nghệ Sử Dụng

### Ngôn ngữ lập trình:

| HTML | CSS | JS | PHP | MySQL |
|------|-----|----|-----|-------|
| ![](https://github.com/devicons/devicon/blob/master/icons/html5/html5-original.svg) | ![](https://github.com/devicons/devicon/blob/master/icons/css3/css3-original.svg) | ![](https://github.com/devicons/devicon/blob/master/icons/javascript/javascript-original.svg) | ![](https://github.com/devicons/devicon/blob/master/icons/php/php-original.svg) | ![](https://github.com/devicons/devicon/blob/master/icons/mysql/mysql-original-wordmark.svg) |

### Framework:

| Bootstrap |
|-----------|
| ![](https://github.com/devicons/devicon/blob/master/icons/bootstrap/bootstrap-original.svg) |

### Công nghệ khác:

| Docker | Git |
|--------|-----|
| ![](https://github.com/devicons/devicon/blob/master/icons/docker/docker-original.svg) | ![](https://github.com/devicons/devicon/blob/master/icons/git/git-original.svg) |

---

## 📌 Cách Chạy Chương Trình

### Cách 1: Chạy bằng Docker

**Bước 1:** Clone dự án hoặc tải file `.rar` về máy
```sh
git clone https://github.com/your-repo/project.git
```

**Bước 2:** Truy cập vào thư mục chứa project
```sh
cd path/to/project
```

**Bước 3:** Chạy Docker Compose
```sh
docker-compose up -d
```

**Bước 4:** Kiểm tra container có chạy không
```sh
docker ps
```

**Bước 5:** Mở trình duyệt và truy cập:
- Trang chủ: [http://localhost](http://localhost)
- Trang admin: [http://localhost/admin](http://localhost/admin)

Tài khoản đăng nhập:
```sh
Người dùng: dongoc@gmail.com
Mật khẩu: 123

Admin: glassadmin
Mật khẩu: 123
```

### Cách 2: Chạy bằng XAMPP

- Cài đặt XAMPP từ [Apache Friends](https://www.apachefriends.org/download.html).
- Chạy Apache và MySQL.
- Import file `init.sql` vào `http://localhost/phpmyadmin`.
- Mở trình duyệt và truy cập `http://localhost`.

---

## 🗃 Xem Cơ Sở Dữ Liệu

Có thể dùng một trong các cách sau để quản lý CSDL:

### 1. Dùng Extension `MySQL By Weijan Chen` trên VSCode

**Cấu hình kết nối:**
```sh
Host: localhost
User: root
Password: 123
Database: your_database
```

### 2. Dùng MySQL Workbench

### 3. Dùng Adminer (trên Docker)
```sh
docker run --name myadmin -d --link mysql:db -p 8080:8080 adminer
```
Sau đó vào `http://localhost:8080`.

---

## 🛠 Tổng Hợp Lệnh Docker

### 1. Xây dựng và chạy container
```sh
docker-compose up -d
```

### 2. Dừng và khởi động lại container
```sh
docker-compose stop
docker-compose start
```

### 3. Xóa container
```sh
docker-compose down
```

### 4. Export Database
```sh
docker exec -i <mysql-container-name> mysqldump -u root -p<password> <database> > backup.sql
```

### 5. Import Database
```sh
docker exec -i <mysql-container-name> mysql -u root -p<password> <database> < backup.sql
```

---

📌 **Lưu ý:** Nếu cập nhật `docker-compose.yml`, cần chạy lệnh sau để áp dụng thay đổi:
```sh
docker-compose down
docker-compose build --no-cache
docker-compose up -d
```

---

## 📢 Kết Luận
README này giúp bạn cài đặt và chạy dự án dễ dàng hơn. Nếu có vấn đề, hãy mở issue trên GitHub hoặc liên hệ trực tiếp!

🚀 **Chúc bạn thành công!**