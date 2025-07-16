-- Legacy MySQL 4.x style schema for RetroShop
CREATE TABLE IF NOT EXISTS products (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    price DECIMAL(8,2) NOT NULL,
    image VARCHAR(255)
);

INSERT INTO products (name, description, price, image) VALUES
('Vintage Console', 'A classic game console from the 80s.', 199.99, '/assets/img/console.png'),
('Retro T-Shirt', 'Limited edition RetroShop t-shirt.', 29.99, '/assets/img/tshirt.png'),
('Old School Mouse', 'Ball mouse, PS/2 connector.', 14.50, '/assets/img/mouse.png'); 