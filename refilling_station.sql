CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `create_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `customers` (
  `customer_Id` int(11) AUTO_INCREMENT PRIMARY KEY,
  `customer_Name` varchar(55) DEFAULT NULL,
  `customer_Contact` varchar(15) DEFAULT NULL,
  `shipping_Address` varchar(155) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `employees` (
  `employee_Id` int(11) AUTO_INCREMENT PRIMARY KEY,
  `employee_Name` varchar(55) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `products` (
  `product_Id` int(11) AUTO_INCREMENT PRIMARY KEY,
  `product_Name` varchar(55) DEFAULT NULL,
  `price` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `orders` (
  `order_Id` int(11) AUTO_INCREMENT PRIMARY KEY,
  `customer_Id` int(11) DEFAULT NULL,
  `product_Id` int(11) DEFAULT NULL,
  `employee_Id` int(11) DEFAULT NULL,
  `order_Date` date DEFAULT NULL,
  `order_Status` enum('Delivered','Pending') DEFAULT NULL,
  `product_Quantity` int(11) DEFAULT NULL,
   FOREIGN KEY (customer_Id) REFERENCES customers(customer_Id) ON DELETE SET NULL ON UPDATE CASCADE,
   FOREIGN KEY (employee_Id) REFERENCES employees(employee_Id) ON DELETE SET NULL ON UPDATE CASCADE,
   FOREIGN KEY (product_Id) REFERENCES products(product_Id) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


