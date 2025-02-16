CREATE DATABASE IF NOT EXISTS WEBSITE;
USE WEBSITE;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE IF NOT EXISTS `tbl_admin` (
    `id` int(11) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `name` varchar(255) NOT NULL,
    `email` varchar(150) NOT NULL,
    `username` varchar(255) NOT NULL,
    `password` varchar(255) NOT NULL,
    `level` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=2;

CREATE TABLE IF NOT EXISTS `tbl_blog` (
    `id` int(11) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `title` varchar(255) NOT NULL,
    `description` mediumtext NOT NULL,
    `content` text NOT NULL,
    `category_post` int(11) NOT NULL,
    `image` varchar(255) NOT NULL,
    `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=5;

CREATE TABLE IF NOT EXISTS `tbl_brand` (
    `brandId` int(11) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `brandName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=8;

CREATE TABLE IF NOT EXISTS `tbl_cart` (
    `cartId` int(11) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `productId` int(11) UNSIGNED NOT NULL,
    `sessionId` varchar(255) NOT NULL,
    `productName` varchar(255) NOT NULL,
    `price` varchar(255) NOT NULL,
    `quantity` int(11) NOT NULL,
    `image` varchar(255) NOT NULL,
    `buy` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=26;

CREATE TABLE IF NOT EXISTS `tbl_category` (
    `catId` int(11) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `catName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=17;

CREATE TABLE IF NOT EXISTS `tbl_comment` (
    `id` int(11) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `userName` varchar(255) NOT NULL,
    `content` text NOT NULL,
    `productId` int(11) UNSIGNED NOT NULL,
    `blogId` int(11) UNSIGNED NOT NULL,
    `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS `tbl_compare` (
    `id` int(11) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `customerId` int(11) UNSIGNED NOT NULL,
    `productId` int(11) UNSIGNED NOT NULL,
    `productName` varchar(255) NOT NULL,
    `price` varchar(255) NOT NULL,
    `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS `tbl_customer` (
    `id` int(11) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `name` varchar(255) NOT NULL,
    `address` varchar(255) NOT NULL,
    `city` varchar(50) NOT NULL,
    `country` varchar(50) NOT NULL,
    `zipcode` varchar(30) DEFAULT NULL,
    `phone` varchar(20) NOT NULL,
    `email` varchar(50) NOT NULL,
    `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=2;

CREATE TABLE IF NOT EXISTS `tbl_order` (
    `orderId` int(11) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `productId` int(11) UNSIGNED NOT NULL,
    `productName` varchar(255) NOT NULL,
    `customerId` int(11) UNSIGNED NOT NULL,
    `price` varchar(255) NOT NULL,
    `quantity` int(11) NOT NULL,
    `image` varchar(255) NOT NULL,
    `date` timestamp NOT NULL DEFAULT current_timestamp(),
    `order_code` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=4;

CREATE TABLE IF NOT EXISTS `tbl_placed` (
    `placedId` int(11) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `order_code` varchar(20) NOT NULL,
    `status` int(11) NOT NULL,
    `customerId` int(11) UNSIGNED NOT NULL,
    `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `tbl_post_category` (
    `id` int(11) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `title` varchar(255) NOT NULL,
    `description` text NOT NULL,
    `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=5;

CREATE TABLE IF NOT EXISTS `tbl_product` (
    `productId` int(11) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `productName` tinytext NOT NULL,
    `catId` int(11) UNSIGNED NOT NULL,
    `brandId` int(11) UNSIGNED NOT NULL,
    `description` text NOT NULL,
    `price` varchar(225) NOT NULL,
    `type` int(11) NOT NULL,
    `image` varchar(255) NOT NULL,
    `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=5;

CREATE TABLE `tbl_purchase_history` (
    `id` int(11) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `order_code` int(11) NOT NULL,
    `customerId` int(11) UNSIGNED NOT NULL,
    `productName` varchar(255) NOT NULL,
    `quantity` int(11) NOT NULL,
    `totalPrice` varchar(255) NOT NULL,
    `image` varchar(255) NOT NULL,
    `date_received` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `tbl_rating` (
    `id` int(11) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `rating` int(11) NOT NULL,
    `productId` int(11) UNSIGNED NOT NULL,
    `customerId` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `tbl_slider` (
    `sliderId` int(11) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `sliderName` varchar(255) NOT NULL,
    `type` int(11) NOT NULL,
    `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=5;

CREATE TABLE IF NOT EXISTS `tbl_statistic` (
    `id` int(11) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `revenue` varchar(50) NOT NULL,
    `_order` int(11) NOT NULL,
    `quantity` int(11) NOT NULL,
    `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci AUTO_INCREMENT=5;

CREATE TABLE IF NOT EXISTS `tbl_warehouse` (
    `id` int(11) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `productId` int(11) UNSIGNED NOT NULL,
    `quantity` varchar(255) NOT NULL,
    `date_of_entry` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS `tbl_wishlist` (
    `id` int(11) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `productId` int(11) UNSIGNED NOT NULL,
    `productName` varchar(255) NOT NULL,
    `customerId` int(11) UNSIGNED NOT NULL,
    `price` varchar(255) NOT NULL,
    `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `tbl_admin` (`id`, `name`, `email`, `username`, `password`, `level`) VALUES
(1, 'Glass', 'helloworld@gmail.com', 'glassadmin', '202cb962ac59075b964b07152d234b70', 0);

INSERT INTO `tbl_brand` (`brandId`, `brandName`) VALUES
(1, 'Apple'),
(2, 'Samsung'),
(3, 'Microsoft'),
(4, 'Sony'),
(5, 'Adidas'),
(6, 'Nike'),
(7, 'Puma'),
(8, 'Honda'),
(9, 'Toyota'),
(10, 'Ford'),
(11, 'Nestlé'),
(12, 'Coca-Cola'),
(13, 'Pepsi'),
(14, 'LG'),
(15, 'Dell'),
(16, 'HP'),
(17, 'Lenovo'),
(18, 'Chanel'),
(19, 'Gucci'),
(20, 'Rolex');

INSERT INTO `tbl_category` (`catId`, `catName`) VALUES
(1, 'Fruit'),
(2, 'Software'),
(3, 'Electronics'),
(4, 'Clothing'),
(5, 'Books'),
(6, 'Furniture'),
(7, 'Home Appliances'),
(8, 'Beauty &amp; Personal Care'),
(9, 'Toys &amp; Games'),
(10, 'Sports &amp; Outdoors'),
(11, 'Automotive'),
(12, 'Groceries'),
(13, 'Health &amp; Wellness'),
(14, 'Jewelry &amp; Accessories'),
(15, 'Office Supplies');

INSERT INTO `tbl_customer` (`id`, `name`, `address`, `city`, `country`, `zipcode`, `phone`, `email`, `password`) VALUES
(1, 'Glass', '100 Gò Dầu', 'HCM', 'AF', NULL, '0902193810', 'dongoc@gmail.com', '202cb962ac59075b964b07152d234b70');

INSERT INTO `tbl_product` (`productId`, `productName`, `catId`, `brandId`, `description`, `price`, `type`, `image`, `quantity`) VALUES
(1, 'iPhone 15', 3, 1, 'Smartphone cao cấp của Apple', '999', 1, '38f3dc9b5f.jpg', 50),
(2, 'MacBook Pro', 3, 1, 'Laptop hiệu năng cao của Apple', '1999', 1, '76e7848f05.jpg', 30),
(3, 'Galaxy S23', 3, 2, 'Smartphone cao cấp của Samsung', '899', 1, '92a1b5c7d9.jpg', 40),
(4, 'Surface Laptop 5', 3, 3, 'Laptop của Microsoft với thiết kế sang trọng', '1299', 1, 'afc1e6734d.jpg', 20),
(5, 'PlayStation 5', 3, 4, 'Máy chơi game thế hệ mới của Sony', '499', 1, 'd3b5a9f68c.jpg', 25),
(6, 'Nike Air Max', 4, 6, 'Giày thể thao phong cách của Nike', '150', 1, 'f1e4c2a8d7.jpg', 100),
(7, 'Adidas Ultraboost', 4, 5, 'Giày chạy bộ cao cấp của Adidas', '180', 0, 'b7a6d9e5c4.jpg', 90),
(8, 'Honda Civic', 11, 8, 'Xe hơi tiết kiệm nhiên liệu', '25000', 1, '3e5d1b8a9c.jpg', 10),
(9, 'Toyota Camry', 11, 9, 'Dòng xe sedan phổ biến của Toyota', '27000', 0, 'e9c3d5a8b7.jpg', 12),
(10, 'Nestlé Chocolate', 12, 11, 'Socola chất lượng cao của Nestlé', '5', 1, 'a5b6c7d8e9.jpg', 200),
(11, 'Coca-Cola 1L', 12, 12, 'Nước ngọt có gas phổ biến', '2', 0, 'c1d2e3f4a5.jpg', 300),
(12, 'Rolex Submariner', 14, 20, 'Đồng hồ sang trọng của Rolex', '10000', 1, 'f5e6d7c8b9.jpg', 5),
(13, 'Gucci Handbag', 14, 19, 'Túi xách thời trang cao cấp', '2500', 1, 'd8c9b7a6e5.jpg', 15),
(14, 'Office Desk', 6, 15, 'Bàn làm việc gỗ chất lượng cao', '200', 0, 'e4a5c6d7f8.jpg', 20),
(15, 'Lenovo ThinkPad X1', 3, 17, 'Laptop doanh nhân bền bỉ', '1500', 1, 'c9d8a7e6b5.jpg', 25),
(16, 'HP Pavilion', 3, 16, 'Laptop văn phòng hiệu suất tốt', '750', 1, 'd3f5a9e7c8.jpg', 35),
(17, 'LG Smart TV 55\"', 3, 14, 'Tivi thông minh 4K của LG', '600', 1, 'b5a7c9d8e6.jpg', 20),
(18, 'Microsoft Office 365', 2, 3, 'Bộ phần mềm văn phòng', '99', 0, 'a9c7d6e8b5.jpg', 100),
(19, 'Dell XPS 13', 3, 15, 'Laptop siêu mỏng hiệu năng cao', '1400', 1, 'd7c9a5b6e8.jpg', 20),
(20, 'Puma Running Shoes', 4, 7, 'Giày chạy bộ thể thao', '120', 1, 'e9c8d7a5b6.jpg', 80),
(21, 'Chanel No. 5', 8, 18, 'Nước hoa sang trọng của Chanel', '200', 0, 'c5d8a7e9b6.jpg', 50),
(22, 'Sony Headphones WH-1000XM4', 3, 4, 'Tai nghe chống ồn cao cấp', '350', 1, 'b7c5d9a6e8.jpg', 60),
(23, 'Ford Ranger', 11, 10, 'Xe bán tải bền bỉ của Ford', '30000', 1, 'e5d7c9a8b6.jpg', 8),
(24, 'Pepsi 1.5L', 12, 13, 'Nước ngọt Pepsi chai lớn', '2', 0, 'c7d8a5e9b6.jpg', 250),
(25, 'Wooden Bookshelf', 6, 15, 'Kệ sách gỗ chắc chắn', '150', 0, 'd5a9c8e7b6.jpg', 30),
(26, 'Samsung Galaxy Watch 6', 3, 2, 'Đồng hồ thông minh đa năng', '350', 1, 'b9d7a5e8c6.jpg', 40),
(27, 'Gaming Chair', 6, 15, 'Ghế chơi game thoải mái', '180', 0, 'c8d9a7e5b6.jpg', 20),
(28, 'Leather Wallet', 14, 19, 'Ví da cao cấp của Gucci', '500', 0, 'd7c5a9e8b6.jpg', 50),
(29, 'Electric Kettle', 7, 14, 'Ấm đun nước điện tiện lợi', '45', 0, 'e6d9c8a7b5.jpg', 80),
(30, 'Basketball', 10, 6, 'Bóng rổ chính hãng Nike', '30', 0, 'b8a7d9e6c5.jpg', 100);

INSERT INTO `tbl_slider` (`sliderId`, `sliderName`, `type`, `image`) VALUES
(1, 'silder_1', 1, 'd7fb5ec85a.jpg'),
(2, 'slider_2', 0, '76a3491408.jpg'),
(3, 'slider_3', 1, 'fc8b079db1.jpg'),
(4, 'slider_4', 1, 'e64f2381d9.jpg');

INSERT INTO `tbl_statistic` (`id`, `revenue`, `_order`, `quantity`, `date`) VALUES
(1, '4500', 50, 100, '2025-01-20'),
(2, '5000', 43, 150, '2025-01-21'),
(3, '6000', 18, 100, '2025-01-22'),
(4, '8000', 57, 150, '2025-01-23');

COMMIT;