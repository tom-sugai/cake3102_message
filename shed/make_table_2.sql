drop table details;
drop table orders;

# 注文 orders テーブル
create table orders (
    id int AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL default 0,
    note1 VARCHAR(50),
    note2 VARCHAR(50),
    created DATETIME,
    modified DATETIME,
    FOREIGN KEY user_key (user_id) REFERENCES users (id) 
) CHARSET = utf8mb4;

# 明細 details テーブル
CREATE TABLE details (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    size INT NOT NULL,
    created DATETIME,
    modified DATETIME,
    FOREIGN KEY order_key (order_id) REFERENCES orders (id),
    FOREIGN KEY product_key (product_id) REFERENCES products (id)
) CHARSET = utf8mb4;