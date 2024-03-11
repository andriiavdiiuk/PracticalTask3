CREATE TABLE IF NOT EXISTS users
(
    user_id  INT UNSIGNED NOT NULL AUTO_INCREMENT,
    firstname VARCHAR(50),
    lastname VARCHAR(50),
    email VARCHAR(255) UNIQUE ,
    password VARCHAR(64) NOT NULL ,
    PRIMARY KEY(user_id)

);

CREATE TABLE IF NOT EXISTS adverts
(
    advert_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    user_id  INT UNSIGNED NOT NULL,
    title VARCHAR(256),
    description TEXT,
    status BOOL,
    price INT UNSIGNED,
    publication_date DATETIME,
    PRIMARY KEY(advert_id),
    CONSTRAINT FOREIGN KEY (user_id)
        REFERENCES users(user_id)
);

CREATE TABLE IF NOT EXISTS categories
(
    category_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    category_name varchar(30),
    category_description varchar(100),
    PRIMARY KEY (category_id)
);

CREATE TABLE IF NOT EXISTS advertCategories
(
    advert_id INT UNSIGNED NOT NULL,
    category_id INT UNSIGNED NOT NULL,
    PRIMARY KEY (advert_id,category_id),
    CONSTRAINT
        FOREIGN KEY (advert_id) REFERENCES adverts(advert_id)
            ON DELETE CASCADE,
    CONSTRAINT
        FOREIGN KEY (category_id) REFERENCES categories(category_id)
            ON DELETE CASCADE
);

