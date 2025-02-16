# Giới Thiệu

Dự án này là làm theo kênh [của Hiếu Tutorial with live project](https://youtube.com/playlist?list=PLWTu87GngvNwRxrFZ_wbxfvHHed14H5RC&si=1sXmTl2WHD_ElVrx) và được cãi tiến và thay đổi đi bớt code cho phù hợp!

## 💻Languages and Tools 

### Languages:

| HTML | CSS | JS | PHP | MySQL |
|----------|----------|----------|----------|----------|
| <img src="https://github.com/devicons/devicon/blob/master/icons/html5/html5-original.svg" title="HTML"  alt="HTML" width="55" height="55"/> | <img src="https://github.com/devicons/devicon/blob/master/icons/css3/css3-original.svg" title="CSS"  alt="CSS" width="55" height="55"/> | <img src="https://github.com/devicons/devicon/blob/master/icons/javascript/javascript-original.svg" title="JS"  alt="JS" width="55" height="55"/> | <img src="https://github.com/devicons/devicon/blob/master/icons/php/php-original.svg" title="php"  alt="php" width="55" height="55"/> | <img src="https://github.com/devicons/devicon/blob/master/icons/mysql/mysql-original-wordmark.svg" title="mysql" alt="mysql" width="55" height="55"/> |

### Framework

| Bootstrap |
|----------|
| <img src="https://github.com/devicons/devicon/blob/master/icons/bootstrap/bootstrap-original-wordmark.svg" title="bootstrap"  alt="bootstrap" width="55" height="55"/> |

### Technology

| Docker | Git |
|----------|----------|
| <img src="https://github.com/devicons/devicon/blob/master/icons/docker/docker-original-wordmark.svg" title="docker"  alt="docker" width="55" height="55"/> | <img src="https://github.com/devicons/devicon/blob/master/icons/git/git-original.svg" title="git"  alt="git" width="55" height="55"/> | 

# Cách chạy chương trình

## Cách 1: Chạy bằng `Docker`

**Step 1:** Tải folder `.rar` hoặc git clone về máy. Chú ý nhớ đường dẫn (path)!

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

**Step 4:** Khi thấy container đã chạy thì mình vào 1 browser nhập vào localhost sẽ ra web.

_Trang chủ_

<img alt="image" src="./img/pic7.png" width="800">

_Trang cho admin_

```bash
Tài khoản: glassadmin
Password: 123
```
<img alt="image" src="./img/pic8.png" width="800">
<br>
<br>
<img alt="image" src="./img/pic9.png" width="800">

# Xem cơ sở dữ liệu

Có thể dùng extension `MySQL By Weijan Chen` của `vscode` như tôi liên kết với hệ thống để coi CSDL hoặc dùng `MySQL Workbench` hoặc dùng `adminer` một `Image` quản lý MySQL trên [Docker Hub](https://hub.docker.com/_/adminer).

**1. Extension MySQL**

_Tải về:_
<img alt="image" src="./img/pic10.png" width="800">

_Thông tin kết nối:_

Password có thể sửa ở trong file `docker-compose.yml`

<img alt="image" src="./img/pic11.png" width="800">

## Cách 2: Chạy bằng [Xampp](https://www.apachefriends.org/download.html) vào kênh youtube mà tôi làm theo sẽ có hướng dẫn chạy bằng xampp. Rồi bạn import file `init.sql` vào trong `http://localhost/phpmyadmin`.