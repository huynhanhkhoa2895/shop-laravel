CREATE TABLE `product` (
	`id` int NOT NULL AUTO_INCREMENT,
	`category_id` int NOT NULL,
	`brand_id` int NOT NULL,
	`sku` varchar(255) NOT NULL,
	`name` varchar(255) NOT NULL,
	`price` DECIMAL NOT NULL,
	`route` varchar(255) NOT NULL,
	`created_at` DATETIME NOT NULL,
	`updated_at` DATETIME NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `category` (
	`id` int NOT NULL AUTO_INCREMENT,
	`name` varchar(255) NOT NULL,
	`route` varchar(255) NOT NULL,
	`created_at` DATETIME NOT NULL,
	`updated_at` DATETIME NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `brand` (
	`id` int NOT NULL AUTO_INCREMENT,
	`name` varchar(255) NOT NULL,
	`logo` varchar(255) NOT NULL,
	`route` varchar(255) NOT NULL,
	`created_at` DATETIME NOT NULL,
	`updated_at` DATETIME NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `image` (
	`id` int NOT NULL AUTO_INCREMENT,
	`product_id` int NOT NULL,
	`name` varchar(255) NOT NULL,
	`status` int NOT NULL DEFAULT '1',
	PRIMARY KEY (`id`)
);

CREATE TABLE `option` (
	`id` int NOT NULL AUTO_INCREMENT,
	`type` varchar(255) NOT NULL,
	`name` varchar(255) NOT NULL,
	`status` tinyint NOT NULL DEFAULT '1',
	`created_at` DATETIME NOT NULL,
	`updated_at` DATETIME NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `option_product` (
	`id` int NOT NULL AUTO_INCREMENT,
	`option_id` int NOT NULL,
	`product_id` int NOT NULL,
	`value` varchar(255) NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `option_value` (
	`id` int NOT NULL AUTO_INCREMENT,
	`value` varchar(255) NOT NULL,
	`option_id` int NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `customer` (
	`id` int NOT NULL AUTO_INCREMENT,
	`name` varchar(255) NOT NULL,
	`email` varchar(255) NOT NULL,
	`phone` varchar(255) NOT NULL,
	`password` varchar(255) NOT NULL,
	`address` varchar(255) NOT NULL,
	`img` varchar(255) NOT NULL,
	`created_at` DATETIME NOT NULL,
	`updated_at` DATETIME NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `order` (
	`id` int NOT NULL AUTO_INCREMENT,
	`customer_id` int NOT NULL,
	`ship_id` int NOT NULL,
	`total` DECIMAL NOT NULL,
	`status` tinyint NOT NULL DEFAULT '1',
	`created_at` DATETIME NOT NULL,
	`updated_at` DATETIME NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `order_detail` (
	`id` int NOT NULL AUTO_INCREMENT,
	`product_id` int NOT NULL,
	`order_id` int NOT NULL,
	`qty` int NOT NULL,
	`price` DECIMAL NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `ship` (
	`id` int NOT NULL AUTO_INCREMENT,
	`customer_id` int NOT NULL,
	`address` varchar(255) NOT NULL,
	`phone` varchar(255) NOT NULL,
	`state` varchar(255) NOT NULL,
	`created_at` DATETIME NOT NULL,
	`updated_at` DATETIME NOT NULL,
	PRIMARY KEY (`id`)
);

ALTER TABLE `product` ADD CONSTRAINT `product_fk0` FOREIGN KEY (`category_id`) REFERENCES `category`(`id`);

ALTER TABLE `product` ADD CONSTRAINT `product_fk1` FOREIGN KEY (`brand_id`) REFERENCES `brand`(`id`);

ALTER TABLE `image` ADD CONSTRAINT `image_fk0` FOREIGN KEY (`product_id`) REFERENCES `product`(`id`);

ALTER TABLE `option_product` ADD CONSTRAINT `option_product_fk0` FOREIGN KEY (`option_id`) REFERENCES `option`(`id`);

ALTER TABLE `option_product` ADD CONSTRAINT `option_product_fk1` FOREIGN KEY (`product_id`) REFERENCES `product`(`id`);

ALTER TABLE `option_value` ADD CONSTRAINT `option_value_fk0` FOREIGN KEY (`option_id`) REFERENCES `option`(`id`);

ALTER TABLE `order` ADD CONSTRAINT `order_fk0` FOREIGN KEY (`customer_id`) REFERENCES `customer`(`id`);

ALTER TABLE `order` ADD CONSTRAINT `order_fk1` FOREIGN KEY (`ship_id`) REFERENCES `ship`(`id`);

ALTER TABLE `order_detail` ADD CONSTRAINT `order_detail_fk0` FOREIGN KEY (`product_id`) REFERENCES `product`(`id`);

ALTER TABLE `order_detail` ADD CONSTRAINT `order_detail_fk1` FOREIGN KEY (`order_id`) REFERENCES `order`(`id`);

ALTER TABLE `ship` ADD CONSTRAINT `ship_fk0` FOREIGN KEY (`customer_id`) REFERENCES `customer`(`id`);

