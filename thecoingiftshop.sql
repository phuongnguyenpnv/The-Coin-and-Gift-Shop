DROP DATABASE thecoingiftshop;
CREATE DATABASE thecoingiftshop;
-- USE thecoingiftshhop;

CREATE TABLE IF NOT EXISTS register(
	admin_id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	username varchar(255) NOT NULL,
    email varchar(255) NOT NULL,
    password varchar(255) NOT NULL
);

CREATE TABLE customers(
	cus_id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(255) NOT NULL,
    lastname VARCHAR(255) NOT NULL,
    street_address VARCHAR(255) NOT NULL,
    city VARCHAR(255) NOT NULL,
    state VARCHAR(255) NOT NULL,
    zip VARCHAR(255) NOT NULL,
    birth_day datetime NOT NULL,
    phone varchar(11) NOT NULL,
    email varchar(100) NOT NULL,
    cus_level VARCHAR(100) NOT NULL
)ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE IF NOT EXISTS different_address(
	diff_add_id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(255)NOT NULL,
    lastname VARCHAR(255) NOT NULL,
    street_address VARCHAR(255) NOT NULL,
    city VARCHAR(255) NOT NULL,
    state VARCHAR(255) NOT NULL,
    zip VARCHAR(255) NOT NULL,
    phone varchar(11) NOT NULL,
    email varchar(100) NOT NULL
)ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
drop table category;
CREATE TABLE IF NOT EXISTS category (
	category_id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    category_detail_id int(11) NOT NULL,
    pro_detail_id int(11) NOT NULL
    )ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
    
INSERT INTO category (category_detail_id, pro_detail_id)
VALUES 
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5);

CREATE TABLE IF NOT EXISTS category_detail (
  category_detail_id int(11) NOT NULL AUTO_INCREMENT,
  category_name varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  Category_content text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (category_detail_id)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO category_detail (category_name, Category_content)
VALUES 
("Artisan Jewelry", "Our collection of artisan jewelry features pieces hand-made from glass and various stones in beautiful finishes such as burnished bronze or brushed metals. Many of these pieces represent powerful themes to represent the passions of the artist. These passions are present in every single minute detail of every necklace, bracelet, ring, and earring. The pieces themselves range from simple to complex, but each has an equally powerful statement to make."),
("Gold", "We pride ourselves on the growing catalogue of gold pieces we have to offer! From 10KT to 24KT, every piece has a story to tell and a surprise in store. These pieces often feature precious gems such as diamonds, emeralds, and sapphires in varying designs. Or, if you’d rather skip the flashy stuff, we have plain gold chains, charms, pendants, and more. We bought all of these pieces from Valley locals who came into our physical location in Harrisonburg, Virginia, to see what we have to offer."),
("Other","Our “Other” collection showcases the bread and butter of gold jewelry – gold itself! These pieces aren’t mounted with precious stones such as diamonds or pearls, which are beautiful but not always necessary. This category includes gold bands, pendants, chains, bracelets, and even earrings where the design is the focus. There are also pins, pendants, earrings, and rings featuring cameos in this category. Precious gems are pretty, but a well-designed solid 14KT gold piece can outshine the clearest, most beautiful diamonds. Want to try something on? Want to see it in person? Each of our pieces are also available in our physical store to see in person, so stop by and say hi sometime!"),
("Silver","Silver Jewelry"),
("With gemstones","Gold Jewelry with gemstones");

drop table product_relationship_image;
CREATE TABLE IF NOT EXISTS product_relationship_image (
	product_rela_id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    product_detail_id int(11) NOT NULL,
    image_id int(11) NOT NULL
    )ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
    
INSERT INTO product_relationship_image (product_detail_id, image_id)
VALUES 
(1, 1),
(1, 2),
(1, 3),
(2, 4),
(2, 5),
(2, 6),
(2, 7),
(3, 8),
(3, 9),
(3, 10),
(4, 11),
(4, 12),
(4, 13),
(5, 14),
(5, 15),
(5, 16);
drop table image;
CREATE TABLE IF NOT EXISTS image (
	image_id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    image_link varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    content varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
)ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- SELECT image.image_id
-- FROM image
-- INNER JOIN product_relationship_image ON product_relationship_image.image_id =image.image_id;
-- INNER JOIN product_relationship_image ON product_relationship_image.image_id =image.image_id;
drop table image;
INSERT INTO image (image_link, content)
VALUES
("JJP846-1.jpg", ""),
("JJP846-2.jpg", ""),
("JJP846-3.jpg", ""),
("JJP839-1.jpg", ""),
("JJP839-2.jpg", ""),
("JJP839-3.jpg", ""),
("JJP839-4.jpg", ""),
("JJP655-2.jpg", ""),
("JJP655-1.jpg", ""),
("JJP655-3.jpg", ""),
("JJP847-1.jpg", ""),
("JJP847-2.jpg", ""),
("JJP847-3.jpg", ""),
("JJP840-1.jpg", ""),
("JJP840-2.jpg", ""),
("JJP840-3.jpg", ""),
("img_lights.jpg", "Slide"),
("img_forest.jpg", "Slide"),
("img_mountain.jpg", "Slide"),
("img_mountains.jpg", "Slide"),
("img_snowtops.jpg", "Slide");

drop TABLE products_detail;
CREATE TABLE products_detail(
	pro_detail_id INT(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    pro_name VARCHAR(255) NOT NULL,
    cost_price decimal(15,2) DEFAULT '0.00',
    price decimal(15,2) NOT NULL DEFAULT '0.00',
    quantity INT(11) NOT NULL,
    comments VARCHAR(500) NOT NULL,
	image varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    sku VARCHAR(50) NOT NULL
)ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO products_detail (pro_name, cost_price, price, quantity, sku, image, comments)
VALUES
("Coral Drop Earrings", 0, 38, 10, "JJP846", "JJP846-1.jpg", "These intricate earrings are molded with a floral pattern and filigreed beads that dangle below. They were inspired by fashion houses designing jewelry between WWI and WW2. Burnished bronze metal finish." ),
("Gemstone Garden Multi Strand Necklace", 0, 54, 15, "JJP839", "JJP839-1.jpg", "This layered cascade necklace radiates the earthy vibe of Summer and Autumn. Six strands of varied chain styles have dozens of different beaded crystal stations, including octagon prisms, Swarovski faceted teardrops, lanterns, faceted ovals and fireball pave beads. The burnished bronze finish complements the color palette of golden topaz, opal leaf, olivine green, amethyst and champagne. Size:28″ long w 4″ extender to adjust for wearing at different lengths."),
("Special Love Mementos Necklace", 60, 50, 13, "JJP655", "JJP655-1.jpg", "Paris inspired, french heart, a swallow, ivory rose and lily pearl are suspended from the chain made with copper rose crystals. Notice the Swarovski crystals and seed pearl accents. Metal is finish in burnsih bronze."),
("Steer Skull Conchito Earrings", 0, 28, 2, "JJP847", "JJP847-1.jpg", "Steer skulls have been delicately molded to accurately represent a steer. It rests upon a layered medallion. A subtle country feel polished and refined. Burnished silver metal finish."),
("Stunning Somerset Garnet Statement Necklace", 100, 75, 7, "JJP840", "JJP840-1.jpg", "Graceful brackets of metal tracery are mounted with garlands of crystal and pearls. Square cut and marquise stones accent the design of mainly round multi level settings. Has a substantial, deluxe feel, with completely fluid movement. Flat vintage figure 8 chain has finished ornamental ends. Metal teardrops create a sassy fringe. Vintage bronze metal finish");

CREATE TABLE promotions(
	promotions_id INT(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    product_id INT(11) NOT NULL,
    date_start DATETIME NOT NULL,
    date_end DATETIME NOT NULL,
    new_price decimal(15,4) NOT NULL DEFAULT '0.0000'
    -- FOREIGN KEY (product_id) REFERENCES products (product_id)
)ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE IF NOT EXISTS transactions (
  transactions_id bigint(20) NOT NULL AUTO_INCREMENT,
  transactions_status tinyint(4) NOT NULL DEFAULT '0',
  cus_id int(11) NOT NULL DEFAULT '0',
  cus_name varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  cus_email varchar(50) COLLATE utf8_bin NOT NULL,
  cus_phone varchar(20) COLLATE utf8_bin NOT NULL,
  amount decimal(15,4) NOT NULL DEFAULT '0.0000',
  payment varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  payment_info text COLLATE utf8_bin NOT NULL,
  message varchar(255) COLLATE utf8_bin NOT NULL,
  security varchar(16) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  created int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (transactions_id)
 --  FOREIGN KEY (cus_id) REFERENCES customers (cus_id)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin ;

CREATE TABLE IF NOT EXISTS employees(
	id INT(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    name VARCHAr(255) NOT NULL,
    identtify_card_num INT(11) NOT NULL,
    title VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    salary INT(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE IF NOT EXISTS shippers(
	id INT(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    name VARCHAR(255) NOT NULL,
    phone_1 INT(11) NOT NULL,
    phone_2 INT(11) NOT NULL
)ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


CREATE TABLE IF NOT EXISTS orders(
	order_id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    transactions_id bigint(20) NOT NULL,
    status varchar(50) NOT NULL
);

CREATE TABLE IF NOT EXISTS orders_detail(
	order_detail_id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    product_id int(11) NOT NULL,
	quantity int(11) NOT NULL,
    price decimal(15,4) NOT NULL DEFAULT '0.0000'
);
drop table blog_content;
CREATE TABLE IF NOT EXISTS blog_content (
	blog_content_id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    blog_title varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    blog_image varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    blog_content varchar(1000) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
)ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO blog_content (blog_title, blog_image, blog_content)
VALUES
("Our-Service.jpg","Our Services", "The Coin & Gift Shop is a coin dealer that buys and sells scrap gold, silver, jewelry, and precious metals. Whether you are looking to buy precious metals at incredibly low prices or make some quick cash by selling your own unwanted gold or silver, we are always happy to serve you.\n The Coin & Gift Shop specializes in buying and selling rare coins, jewelry, and bullion. We carry gold, silver and copper coins. Additionally, we are authorized dealers for PCGS (Professional Coin Grading Service) and NGC (Numismatic Guaranty Corporation). Stop by today to view our inventory.\nThe Coin & Gift Shop are experts with digitizing and selling coins and jewelry for online venues such as auctions and Ebay."),
("Our-Service.jpg","Our Products", "We have been proudly serving the greater Harrisonburg community since 1993. Backed by more than 50 years of experience in the gold and silver buying and selling field, our team excels in finding the very best deals for all."),
("Our-Service.jpg","Jewelry and Gift Online Shop", "Interested in a boutique bracelet or a diamond ring?\n Browse our selection of jewelry and buy with a few clicks!\nShipping is Free!"),
("Our-Service.jpg","", ""),
("Our-Service.jpg","", ""),
("Our-Service.jpg","", "");

select * from blog_content;

SELECT image.image_id, image.image_link FROM image, product_relationship_image
where image.image_id = product_relationship_image.image_id
and  product_relationship_image.product_detail_id =1;