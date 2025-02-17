# Giới Thiệu

Dự án này là làm theo kênh [của Hiếu Tutorial with live project](https://youtube.com/playlist?list=PLWTu87GngvNwRxrFZ_wbxfvHHed14H5RC&si=1sXmTl2WHD_ElVrx) và được cãi tiến và thay đổi đi bớt code cho phù hợp!

## 💻Languages and Tools

### Languages:

| HTML                                                                                                                                        | CSS                                                                                                                                     | JS                                                                                                                                                | PHP                                                                                                                                   | MySQL                                                                                                                                                 |
| ------------------------------------------------------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------------------------------------------------- | ------------------------------------------------------------------------------------------------------------------------------------------------- | ------------------------------------------------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------------------------------------------------------------- |
| <img src="https://github.com/devicons/devicon/blob/master/icons/html5/html5-original.svg" title="HTML"  alt="HTML" width="55" height="55"/> | <img src="https://github.com/devicons/devicon/blob/master/icons/css3/css3-original.svg" title="CSS"  alt="CSS" width="55" height="55"/> | <img src="https://github.com/devicons/devicon/blob/master/icons/javascript/javascript-original.svg" title="JS"  alt="JS" width="55" height="55"/> | <img src="https://github.com/devicons/devicon/blob/master/icons/php/php-original.svg" title="php"  alt="php" width="55" height="55"/> | <img src="https://github.com/devicons/devicon/blob/master/icons/mysql/mysql-original-wordmark.svg" title="mysql" alt="mysql" width="55" height="55"/> |

### Framework

| Bootstrap                                                                                                                                                                    |
| ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| <img src="https://github.com/devicons/devicon/blob/master/icons/bootstrap/bootstrap-original.svg" title="bootstrap"  alt="bootstrap" width="55" height="55" align="center"/> |

### Technology

| Docker                                                                                                                                            | Git                                                                                                                                   |
| ------------------------------------------------------------------------------------------------------------------------------------------------- | ------------------------------------------------------------------------------------------------------------------------------------- |
| <img src="https://github.com/devicons/devicon/blob/master/icons/docker/docker-original.svg" title="docker"  alt="docker" width="55" height="55"/> | <img src="https://github.com/devicons/devicon/blob/master/icons/git/git-original.svg" title="git"  alt="git" width="55" height="55"/> |

# Cách chạy chương trình

## Cách 1: Chạy bằng `Docker`

**Step 1:** Tải folder `.rar` hoặc `git clone` về máy. Chú ý nhớ đường dẫn (path)!

<img alt="image" src="./img/pic1.png" width="800">

**Step 2:** Open `terminal` của `vscode` hoặc `Window PowerShell` của máy có sẵn. Trỏ đúng vị trí chứa thư mục bằng lệnh cd như sau:

```bash
cd `path`

```

Ví dụ trong máy tôi: path = `E:\Code\WebsiteMVC` file `Dockerfile` nằm trong folder WebsiteMVC. => cd `E:\Code\WebsiteMVC`

<img alt="image" src="./img/pic2.png" width="800">

**Step 3:** Nhập câu lệnh này vào để khởi tạo image + run container

```bash
docker-compose up -d
```

<img alt="image" src="./img/pic3.png" width="800">

Để check xem trong docker đã tạo ra 2 image thì dùng lệnh:

```bash
docker ps
```

<img alt="image" src="./img/pic4.png" width="800">

Hoặc tải Docker Desktop về sẽ coi được image với container dễ dàng hơn như 2 hình dưới đây:

Check Images

<img alt="image" src="./img/pic5.png" width="800">

Check Containers

<img alt="image" src="./img/pic6.png" width="800">

**Step 4:** Khi thấy container đã chạy thì mình vào 1 browser nhập vào `localhost`.

_Trang chủ_

<img alt="image" src="./img/pic7.png" width="800">

Tài khoản login vào website để mua sắm thử:

```bash
Tài khoản: dongoc@gmail.com
Password: 123
```

_Trang cho admin_: Nhập `localhost/admin`

```bash
Tài khoản: glassadmin
Password: 123
```

<img alt="image" src="./img/pic8.png" width="800">

<br>

<img alt="image" src="./img/pic9.png" width="800">

### Lưu ý:

Trang admin có thể bị lỗi `Cannot modify header information - headers already sent by (output started at ...` thì làm theo các bước sau:

_Step 1:_ Open `Docker Desktop` >> nhấn vào container php-1

<img alt="image" src="./img/pic10.png" width="800">

_Step 2:_ Nhấn vào `Files`

<img alt="image" src="./img/pic11.png" width="800">

_Step 3:_ Nhấn lướt xuống tìm Folder `var` >> `www` >> `html` >> `admin`

<img alt="image" src="./img/pic12.png" width="800">

_Step 4:_ Kiểm tra File `header.php` nằm trong Folder `inc` và File `login.php`. Xem dòng:

Đây là sai! Vì có 1 khoảng cách trước

```bash

 <?php
    //Code
?>
```

Đây là sai! Vì có 1 dòng trắng phía trước

```bash

<?php
    //Code
?>
```

Đây là đúng!

```bash
<?php
    //Code
?>
```

## Cách 2: Chạy bằng [Xampp](https://www.apachefriends.org/download.html) vào kênh youtube mà tôi làm theo sẽ có hướng dẫn chạy bằng xampp. Rồi bạn import file `init.sql` vào trong `http://localhost/phpmyadmin`.

# Xem cơ sở dữ liệu

Có thể dùng extension `MySQL By Weijan Chen` của `vscode` như tôi liên kết với hệ thống để coi CSDL hoặc dùng `MySQL Workbench` hoặc dùng `adminer` một `Image` quản lý MySQL trên [Docker Hub](https://hub.docker.com/_/adminer).

**1. Extension MySQL**

_Tải về:_
<img alt="image" src="./img/pic13.png" width="800">

_Thông tin kết nối:_

Password có thể sửa ở trong file `docker-compose.yml`

<img alt="image" src="./img/pic14.png" width="800">

## Lưu ý:

Trong File `docker-compose.yml` tôi có đoạn:

```bash
- mysql_data:/var/lib/mysql

volumes:
  mysql_data:
```

<img alt="image" src="./img/pic15.png" width="800">

Giúp lưu giữ lại data ở phiên làm việc trước đó, khi bạn cập nhật File `docker-compose.yml` rồi phải dùng lệnh:

```bash
docker compose down
docker compose build --no-cache
docker compose up -d
```

nếu không sẽ chạy data lại từ đầu như trong File `init.sql` đã được setup trước!

Và muốn tạo 1 file back up .sql khi đã cập nhật thêm dữ liệu thì có thể dùng lệnh:

```bash
docker exec -i <mysql-container-name> mysqldump -u root -p --default-character-set=utf8mb4 -p<password-container> <name-database> > <filename>.sql
```

Muốn cập nhật lại bằng file back up .sql thì dùng lệnh:

```bash
docker exec -i <mysql-container-name> mysql -u root -p --default-character-set=utf8mb4 -p<password-container> <name-database> < <filename>.sql
```

# Tổng hợp lệnh Docker

Có thể dùng `docker-compose` hoặc `docker compose`.

1. `Build image`

-   Build image

```bash
docker compose build
```

-   Build lại image

```bash
docker compose build --no-cache
```

2. Tạo `build image` và `run container` cùng:

```bash
docker-compose up -d
```

3. Lệnh `stop` và `start` container:

-   **Stop container**

```bash
docker-compose stop
```

-   **Start container**

```bash
docker-compose start
```

4. Lệnh `remove` container:

-   Xóa mỗi container:

```bash
docker-compose down
```

-   Xóa container và volumes:

```bash
docker-compose down -v
```

5. Lệnh `export/import` với `Database` bằng File `.sql`:

-   **Export Database**

```bash
docker exec -i <mysql-container-name> mysqldump -u root -p --default-character-set=utf8mb4 -p<password-container> <name-database> > <filename>.sql
```

_Ví dụ:_

```bash
docker exec -i website-db-1 mysqldump -u root -p --default-character-set=utf8mb4 -p123 WEBSITE > backup.sql
```

-   **Import Database**

```bash
docker exec -i <mysql-container-name> mysql -u root -p --default-character-set=utf8mb4 -p<password-container> <name-database> < <filename>.sql
```

_Ví dụ:_

```bash
docker exec -i website-db-1 mysql -u root -p --default-character-set=utf8mb4 -p123 WEBSITE < backup.sql
```
