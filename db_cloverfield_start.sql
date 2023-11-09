/*
SQLyog Ultimate v12.12 (64 bit)
MySQL - 5.7.26 : Database - db_cloverfield
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `clo_admin` */

DROP TABLE IF EXISTS `clo_admin`;

CREATE TABLE `clo_admin` (
  `idx` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `admin_username` varchar(50) NOT NULL DEFAULT '',
  `admin_password` varchar(32) NOT NULL DEFAULT '',
  `admin_name` varchar(50) NOT NULL DEFAULT '',
  `admin_email` varchar(50) NOT NULL DEFAULT '',
  `admin_level` char(20) NOT NULL DEFAULT 'ad',
  `admin_level_name` varchar(20) NOT NULL DEFAULT 'Admin',
  `memo` varchar(255) NOT NULL DEFAULT '',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `clo_admin` */

insert  into `clo_admin`(`idx`,`admin_username`,`admin_password`,`admin_name`,`admin_email`,`admin_level`,`admin_level_name`,`memo`,`active`,`created`) values (5,'Cloverfield','4aea0f8f3c5c95f9a640ac8f3e0fc639','Rob Cloverfield','webshopgoeroe@gmail.com','sa','Super Admin','',1,'2021-11-27 16:16:58');

/*Table structure for table `clo_admin_memo` */

DROP TABLE IF EXISTS `clo_admin_memo`;

CREATE TABLE `clo_admin_memo` (
  `idx` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `admin_idx` varchar(100) NOT NULL DEFAULT '',
  `admin_memo` text NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `clo_admin_memo` */

insert  into `clo_admin_memo`(`idx`,`admin_idx`,`admin_memo`,`created`) values (3,'5','Dit is een normale admin memo.','2021-11-27 15:02:30');

/*Table structure for table `clo_admin_memo_super` */

DROP TABLE IF EXISTS `clo_admin_memo_super`;

CREATE TABLE `clo_admin_memo_super` (
  `idx` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `admin_idx` varchar(100) NOT NULL DEFAULT '',
  `admin_memo` text NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `clo_admin_memo_super` */

insert  into `clo_admin_memo_super`(`idx`,`admin_idx`,`admin_memo`,`created`) values (3,'Rob Cloverfield','En dit is een super admin memo.','2021-11-27 15:01:58'),(4,'','Dit is een z.g. Memo','2021-11-30 21:36:12');

/*Table structure for table `clo_banners` */

DROP TABLE IF EXISTS `clo_banners`;

CREATE TABLE `clo_banners` (
  `idx` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `bind_id` int(10) unsigned NOT NULL DEFAULT '0',
  `banner_type` varchar(50) NOT NULL DEFAULT '',
  `banner_name` varchar(100) NOT NULL DEFAULT '',
  `banner_url` varchar(100) NOT NULL DEFAULT '',
  `banner_txt_nl` varchar(255) NOT NULL DEFAULT '',
  `banner_txt_en` varchar(255) NOT NULL DEFAULT '',
  `banner_txt_de` varchar(255) NOT NULL DEFAULT '',
  `banner_txt_fr` varchar(255) NOT NULL DEFAULT '',
  `banner_image` varchar(50) NOT NULL DEFAULT '',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int(5) NOT NULL DEFAULT '1000',
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `clo_banners` */

insert  into `clo_banners`(`idx`,`bind_id`,`banner_type`,`banner_name`,`banner_url`,`banner_txt_nl`,`banner_txt_en`,`banner_txt_de`,`banner_txt_fr`,`banner_image`,`active`,`sort_order`) values (1,7,'categorie','Leuk','page-login.php','De EVO shop een verademing.','Engels','Duits','Frans','3_slide_3.jpg',1,0),(2,0,'homepage','Ook mooi','index.php','Shop Software die werkt.','Engels','Duits','Frans','2_slide_2.jpg',1,1),(3,0,'homepage','Prachtig','index.php','Eenvoudig te bedienen.','Engels','Duits','Frans','1_slide_1.jpg',1,2);

/*Table structure for table `clo_categories` */

DROP TABLE IF EXISTS `clo_categories`;

CREATE TABLE `clo_categories` (
  `idx` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent` int(10) NOT NULL DEFAULT '0',
  `category_name_nl` varchar(100) NOT NULL DEFAULT '',
  `category_name_en` varchar(100) NOT NULL DEFAULT '',
  `category_name_de` varchar(100) NOT NULL DEFAULT '',
  `category_name_fr` varchar(100) NOT NULL DEFAULT '',
  `category_note` varchar(255) NOT NULL DEFAULT '',
  `category_keywords` varchar(255) NOT NULL DEFAULT '',
  `category_image` varchar(50) NOT NULL DEFAULT '',
  `sort_order` int(5) NOT NULL DEFAULT '1000',
  `active` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`idx`),
  KEY `id` (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8;

/*Data for the table `clo_categories` */

insert  into `clo_categories`(`idx`,`parent`,`category_name_nl`,`category_name_en`,`category_name_de`,`category_name_fr`,`category_note`,`category_keywords`,`category_image`,`sort_order`,`active`) values (7,0,'Armbanden','Bracelets','Armbander','Bracelets','Armbanden','armbanden, sieraden','7_armband.jpg',0,1),(39,0,'Koeienparade','Cow parade','Kuhe Parade','Vaches Defile','De grootste tentoonstelling van de wereld.','koeienparade','39_cow.jpg',1,1),(40,0,'Klokken','Clocks','Clocks','Horloges','Trendy designklokken.','klokken','40_klok.jpg',4,1),(41,0,'Wanddekoraties','Decorations','Wandschmuck','Decorations Murales','Van schilderij tot zeefdruk.','wanddekoraties','41_wand.jpg',5,1),(42,0,'Spiegels','Mirrors','Spiegel','Miroirs','Van klassiek tot modern','spiegels','42_spiegel.jpg',3,1),(52,0,'Slechte Beren','Bad Bears','Arme Bär','Ours Mauvais','Slechte beertjes','slechte, beren','52_deedee.jpg',2,1);

/*Table structure for table `clo_config` */

DROP TABLE IF EXISTS `clo_config`;

CREATE TABLE `clo_config` (
  `config_id` varchar(50) NOT NULL DEFAULT '',
  `config_value` text NOT NULL,
  PRIMARY KEY (`config_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `clo_config` */

insert  into `clo_config`(`config_id`,`config_value`) values ('allow_action','0'),('allow_banners','1'),('allow_best_viewed','1'),('allow_best_viewed_nr','3'),('allow_cats','0'),('allow_cross_selling','1'),('allow_featured','1'),('allow_featured_nr','3'),('allow_news','1'),('allow_news_nr','3'),('allow_new_products','1'),('allow_new_products_nr','3'),('allow_register','0'),('allow_social','1'),('allow_vouchers','1'),('currency','&euro;'),('currency_iso','Euro'),('dashboard_orders','10'),('featured_products','3'),('fee_cutting','1'),('fee_foreign_delivery','12.50'),('fee_formula',''),('fee_insurance','2.50'),('image_big_height','500'),('image_big_width','500'),('image_convert','0'),('image_thumb_height','100'),('image_thumb_width','100'),('minimum_buy','0'),('minimum_buy_amount',''),('minimum_ship','0'),('minimum_ship_amount',''),('mollie_api_key',''),('msp_base_url',''),('msp_merchant_account',''),('msp_secure_code',''),('msp_shopname',''),('msp_site_id',''),('order_id_initial','10'),('order_id_start','Clo-'),('pager_limit','3'),('path_abs',''),('path_url','http://localhost/cloverfield/'),('products_per_page','10'),('promo_discount_min','0'),('promo_discount_rate','0'),('promo_discount_type','1'),('shop_address','Cloverfieldstraat 2021'),('shop_bank_bic','BIC 123456789'),('shop_bank_iban','IBAN 0000 0000'),('shop_bank_name','Mijn Bank'),('shop_city','Cloverfield'),('shop_closed','0'),('shop_country','Nederland'),('shop_delivery','Snelle levering'),('shop_fax','300 1234 1234'),('shop_kvk','KVK 123456789'),('shop_mobile','06 1234 1234'),('shop_name','Cloverfield Webshop'),('shop_phone','300 1234 1234'),('shop_tax_nr','BTW 123456789'),('shop_zip','12345 NL'),('site_description','De Beste Shop'),('site_email_god','chilm@planet.nl'),('site_email_info','chilm@planet.nl'),('site_email_sales','chilm@planet.nl'),('site_google',''),('site_keywords','cloverfield, shop, shopsoftware'),('site_start','10-11-2021'),('site_title','Cloverfield Webshop'),('social_facebook','facebook.com'),('social_google','https://www.google.com'),('social_google_plus',''),('social_instagram',''),('social_linkedin',''),('social_pinterest',''),('social_twitter','twitter.com'),('social_youtube','youtube.com'),('stock_manage','1'),('stock_warning','0'),('tax_included','1'),('tax_percent','21'),('text_address','Cloverfield\r\nCloverfieldstraat 2021\r\n12345 NL'),('text_dashboard_remarks','Welcome at the Cloverfield Webshop'),('text_shop_footer','Cloverfield'),('text_sidebar','<h4><i class=\"fa fa-info-circle\"></i>\r\n</h4>\r\n<a href=\"https://www.multisafepay.com/nl/fast-checkout-rekening/uw-online-fast-checkout-rekening.html\" title=\"Veilig betalen\" target=\"_blank\"><img src=\"layout/ideal.jpg\" width=\"158\" alt=\"Betalen met Ideal\" title=\"Betalen met Ideal\"></a><br>     \r\n'),('text_software_footer','&copy;Cloverfield - Shopsoftware'),('text_software_license','&copy;Cloverfield');

/*Table structure for table `clo_config_super` */

DROP TABLE IF EXISTS `clo_config_super`;

CREATE TABLE `clo_config_super` (
  `config_id` varchar(50) NOT NULL DEFAULT '',
  `config_value` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`config_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `clo_config_super` */

insert  into `clo_config_super`(`config_id`,`config_value`) values ('allow_consumer','1'),('allow_returns','1'),('shop_closed','0'),('shop_languages','1'),('shop_language_de','1'),('shop_language_en','1'),('shop_language_fr','1'),('test_mail','0'),('text_dashboard_remarks','Dit is een interne Opmerking.');

/*Table structure for table `clo_countries` */

DROP TABLE IF EXISTS `clo_countries`;

CREATE TABLE `clo_countries` (
  `idx` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `zone` int(10) unsigned NOT NULL DEFAULT '0',
  `country_name` varchar(80) NOT NULL DEFAULT '',
  `country_iso` char(2) NOT NULL DEFAULT '',
  `country_iso3` char(3) NOT NULL,
  `delivery_fee` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `tax` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `active` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

/*Data for the table `clo_countries` */

insert  into `clo_countries`(`idx`,`zone`,`country_name`,`country_iso`,`country_iso3`,`delivery_fee`,`tax`,`active`) values (1,2,'Nederland','NL','NLD','4.50','0.21','1'),(2,0,'Belgie','BE','BEL','6.50','0.21','1'),(3,0,'France','FR','FRA','6.50','0.21','1'),(4,0,'Deutschland','DE','DEU','6.50','0.21','1'),(5,0,'Italia','IT','ITA','6.50','0.21','1'),(6,0,'Luxembourg','LU','LUX','6.50','0.21','1'),(7,0,'Portugese','PT','PRT','6.50','0.21','1'),(8,0,'Espagne','ES','ESP','6.50','0.21','1'),(9,0,'Sverige','SE','SWE','6.50','0.21','1'),(10,0,'United Kingdom','GB','GBR','6.50','0.21','1');

/*Table structure for table `clo_customers` */

DROP TABLE IF EXISTS `clo_customers`;

CREATE TABLE `clo_customers` (
  `idx` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL DEFAULT '',
  `username` varchar(50) NOT NULL DEFAULT '',
  `password` varchar(50) NOT NULL DEFAULT '',
  `registered` tinyint(1) NOT NULL DEFAULT '1',
  `saluation` varchar(5) NOT NULL DEFAULT '',
  `firstname` varchar(25) NOT NULL DEFAULT '',
  `surname` varchar(50) NOT NULL DEFAULT '',
  `companyname` varchar(50) NOT NULL DEFAULT '',
  `invoice_street` varchar(50) NOT NULL DEFAULT '',
  `invoice_street_nr` varchar(25) NOT NULL DEFAULT '',
  `invoice_zip` varchar(10) NOT NULL DEFAULT '',
  `invoice_city` varchar(50) NOT NULL DEFAULT '',
  `invoice_country` varchar(50) NOT NULL DEFAULT 'Nederland',
  `deliver_street` varchar(50) NOT NULL DEFAULT '',
  `deliver_street_nr` varchar(50) NOT NULL DEFAULT '',
  `deliver_zip` varchar(50) NOT NULL DEFAULT '',
  `deliver_city` varchar(50) NOT NULL DEFAULT '',
  `deliver_country` varchar(50) NOT NULL DEFAULT 'Nederland',
  `website` varchar(50) NOT NULL DEFAULT '',
  `bank_name` varchar(50) NOT NULL DEFAULT '',
  `bank_nr` varchar(50) NOT NULL DEFAULT '',
  `tax_nr` varchar(50) NOT NULL DEFAULT '',
  `commerce_nr` varchar(50) NOT NULL DEFAULT '',
  `phone` varchar(50) NOT NULL DEFAULT '',
  `active` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `see_prices` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `discount` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `discount_type` varchar(5) NOT NULL DEFAULT 'P',
  `payment_method` varchar(50) NOT NULL DEFAULT 'Vooruitbetaling',
  `newsletter` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `remarks` varchar(255) NOT NULL DEFAULT '',
  `created` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`idx`),
  KEY `id` (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

/*Data for the table `clo_customers` */

insert  into `clo_customers`(`idx`,`email`,`username`,`password`,`registered`,`saluation`,`firstname`,`surname`,`companyname`,`invoice_street`,`invoice_street_nr`,`invoice_zip`,`invoice_city`,`invoice_country`,`deliver_street`,`deliver_street_nr`,`deliver_zip`,`deliver_city`,`deliver_country`,`website`,`bank_name`,`bank_nr`,`tax_nr`,`commerce_nr`,`phone`,`active`,`see_prices`,`discount`,`discount_type`,`payment_method`,`newsletter`,`remarks`,`created`) values (10,'clo@email.cloverfield','clo@email.cloverfield','',0,'Hr.','Clo','Cloverfield','','Cloverstreet','50','1234CL','Clover','Nederland','Cloverstreet','50','1231 TP','Clover','Nederland','','','','','','0600000000',1,1,'0.00','P','Vooruitbetaling',1,'','2021-12-10'),(11,'clo@ver.field','clo@ver.field','780312c67c03a60eef66be87f2779a5d',1,'Hr.','Do','Clo Cloverfield','','Cloverstreet','50','1234CL','Clovercity','Nederland','Cloverstreet','50','1234CL','Clovercity','Nederland','','','','','','0600000000',1,1,'0.00','P','Vooruitbetaling',1,'','2021-12-16');

/*Table structure for table `clo_customers_reset` */

DROP TABLE IF EXISTS `clo_customers_reset`;

CREATE TABLE `clo_customers_reset` (
  `idx` bigint(20) NOT NULL AUTO_INCREMENT,
  `email` varchar(220) NOT NULL DEFAULT '',
  `new_password` varchar(220) NOT NULL DEFAULT '',
  `activation_code` varchar(50) NOT NULL DEFAULT '',
  `ip_address` varchar(50) NOT NULL DEFAULT '',
  `created` date NOT NULL DEFAULT '0000-00-00',
  `visited` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idx`),
  FULLTEXT KEY `idx_search` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `clo_customers_reset` */

/*Table structure for table `clo_faq` */

DROP TABLE IF EXISTS `clo_faq`;

CREATE TABLE `clo_faq` (
  `idx` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `faq_question_nl` text NOT NULL,
  `faq_question_en` text NOT NULL,
  `faq_question_de` text NOT NULL,
  `faq_question_fr` text NOT NULL,
  `faq_answer_nl` text NOT NULL,
  `faq_answer_en` text NOT NULL,
  `faq_answer_de` text NOT NULL,
  `faq_answer_fr` text NOT NULL,
  `sort_order` int(11) unsigned NOT NULL DEFAULT '1000',
  `active` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `clo_faq` */

insert  into `clo_faq`(`idx`,`faq_question_nl`,`faq_question_en`,`faq_question_de`,`faq_question_fr`,`faq_answer_nl`,`faq_answer_en`,`faq_answer_de`,`faq_answer_fr`,`sort_order`,`active`) values (1,'Kan ik bij jullie ook met creditcard betalen?','','','','Jazeker, wanneer u via iDEAL afrekend kunt u uw creditcard gebruiken.','','','',1,1),(2,'Moet ik verzendkosten betalen?','','','','Uw bestelling wordt in principe gratis verzonden bij een aankoopbedrag vanaf ï¿½ 500,00.\r\n\r\nVoorwaarde is wel dat het pakket aan de richtlijnen van post.nl doet en binnen Nederland wordt verzonden.\r\nVerzenden buiten Nederland (Belgie en Duitsland) ï¿½ 7,95\r\n\r\nAfmeting: 140 x 59 x 59 cm. Gewicht maximaal 30 kilo.\r\n\r\nValt<strong> </strong>uw bestelling buiten deze maat of moet het met een pallet worden verzonden zoals bijvoorbeeld filterzand dan nemen wij eerst contact met u op en hebben wij zeker een goede en goedkope verzendmogelijkheid voor u.\r\n\r\nNeemt u bij twijfel contact met ons op en wij kunnen u direct vertellen hoe het gewenste artikel verzonden kan worden.','','','',2,1),(3,'Dit is een vraag?','','','','En dan is dit het antwoord.','','','',0,1);

/*Table structure for table `clo_options_connect` */

DROP TABLE IF EXISTS `clo_options_connect`;

CREATE TABLE `clo_options_connect` (
  `idx` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_idx` int(10) unsigned NOT NULL,
  `option_idx` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idx`),
  KEY `opt_idx` (`option_idx`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

/*Data for the table `clo_options_connect` */

insert  into `clo_options_connect`(`idx`,`product_idx`,`option_idx`) values (1,1,2),(2,2,2),(4,8,5),(5,9,5),(6,3,2),(7,4,4),(8,5,4),(9,6,4),(10,10,1),(11,11,1),(12,12,1),(13,13,3),(14,14,3),(15,15,3),(16,7,5),(17,10,4),(18,0,4),(19,0,1),(20,0,1),(21,0,1),(22,0,1),(23,0,1),(24,0,1),(25,0,1),(26,0,1),(27,0,1),(28,0,1),(29,30,1),(30,35,2);

/*Table structure for table `clo_options_names` */

DROP TABLE IF EXISTS `clo_options_names`;

CREATE TABLE `clo_options_names` (
  `idx` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name_internal` text NOT NULL,
  `name_external_nl` text NOT NULL,
  `name_external_en` text NOT NULL,
  `name_external_de` text NOT NULL,
  `name_external_fr` text NOT NULL,
  `sort_order` int(5) unsigned NOT NULL DEFAULT '1000',
  PRIMARY KEY (`idx`),
  UNIQUE KEY `id` (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `clo_options_names` */

insert  into `clo_options_names`(`idx`,`name_internal`,`name_external_nl`,`name_external_en`,`name_external_de`,`name_external_fr`,`sort_order`) values (1,'spiegels','Doorsnede','Section','Abschnitt','Section',0),(2,'klokken','Materiaal','Material','Material','Matériel',3),(3,'lijsten','Uitvoering','Execution','Ausführung','Réalisation',4),(4,'koeien','Materiaal','Material','Material','Matériel',1),(5,'badtaste','Afmeting','Size','Größe','Taille',2);

/*Table structure for table `clo_options_values` */

DROP TABLE IF EXISTS `clo_options_values`;

CREATE TABLE `clo_options_values` (
  `idx` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `names_idx` int(10) unsigned NOT NULL,
  `option_name_nl` varchar(255) NOT NULL,
  `option_value_nl` text NOT NULL,
  `option_value_en` text NOT NULL,
  `option_value_de` text NOT NULL,
  `option_value_fr` text NOT NULL,
  `option_price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `option_what` char(1) NOT NULL DEFAULT '+',
  PRIMARY KEY (`idx`),
  KEY `opt_idx` (`option_name_nl`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

/*Data for the table `clo_options_values` */

insert  into `clo_options_values`(`idx`,`names_idx`,`option_name_nl`,`option_value_nl`,`option_value_en`,`option_value_de`,`option_value_fr`,`option_price`,`option_what`) values (2,1,'spiegels','15 cm. groter','15 cm. bigger','15 cm. mehr','15 cm. plus','15.00','+'),(3,1,'spiegels','25 cm. groter','25 cm. bigger','25 cm. mehr','25 cm. plus','25.00','+'),(5,2,'klokken','RVS achterplaat','RVS backing','RVS','RVS','23.00','+'),(6,2,'klokken','Houten achterplaat','Wood','Holz','Bois','40.00','+'),(7,2,'klokken','Glazen achterplaat','Glass','Glas','Verre','15.50','+'),(9,3,'lijsten','Niet doorgeschilderd','Painted','Gemalt','Peint','15.00','+'),(11,4,'koeien','Houten body','Wooden Body','Holzkörper','Corps en bois','0.00','+'),(12,4,'koeien','RVS body','RVS Body','RVS körper','Corps en RVS','20.00','+'),(13,4,'koeien','Gipsen body','Plaster Body','Pflasterkörper','Corps de plâtre','0.00','+'),(15,5,'badtaste','35 cm. hoog','35 cm. Height','35 cm. Hoch','35 cm. élevé','5.35','+'),(16,5,'badtaste','45 cm. hoog','45 cm. Height','45 cm. Hoch','45 cm. élevé','12.50','+'),(17,5,'badtaste','65 cm. hoog','65 cm. Height','65 cm. Hoch','65 cm. élevé','25.00','+'),(18,5,'badtaste','90 cm. hoog','90 cm. Height','90 cm. Hoch','90 cm. élevé','45.00','+');

/*Table structure for table `clo_orders_a` */

DROP TABLE IF EXISTS `clo_orders_a`;

CREATE TABLE `clo_orders_a` (
  `idx` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `session_id` varchar(50) NOT NULL DEFAULT '',
  `item_id` int(10) unsigned NOT NULL DEFAULT '0',
  `price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `quantity` int(10) unsigned NOT NULL DEFAULT '0',
  `millimeter` int(10) NOT NULL DEFAULT '0',
  `price_cuts` decimal(10,2) NOT NULL DEFAULT '0.00',
  `price_total` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `product_discount` varchar(10) NOT NULL DEFAULT '',
  `product_option` varchar(255) NOT NULL DEFAULT '',
  `ship_name` varchar(255) NOT NULL DEFAULT '',
  `ship_price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `pay_name` varchar(255) NOT NULL DEFAULT '',
  `pay_price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `fee_insurance` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `created` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`idx`),
  KEY `username` (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `clo_orders_a` */

/*Table structure for table `clo_orders_b` */

DROP TABLE IF EXISTS `clo_orders_b`;

CREATE TABLE `clo_orders_b` (
  `idx` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `session_id` varchar(80) NOT NULL DEFAULT '',
  `customer_email` varchar(50) NOT NULL,
  `item_id` int(10) unsigned NOT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `quantity` int(10) unsigned NOT NULL,
  `millimeter` int(10) NOT NULL DEFAULT '0',
  `price_cuts` int(10) NOT NULL DEFAULT '0',
  `price_total` decimal(10,2) NOT NULL DEFAULT '0.00',
  `product_discount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `product_discount_type` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `product_option` varchar(255) NOT NULL DEFAULT '',
  `order_time` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 PACK_KEYS=0;

/*Data for the table `clo_orders_b` */

insert  into `clo_orders_b`(`idx`,`session_id`,`customer_email`,`item_id`,`price`,`quantity`,`millimeter`,`price_cuts`,`price_total`,`product_discount`,`product_discount_type`,`product_option`,`order_time`) values (5,'h9am7v1eo7rq82kt40rpdca752','clo@ver.field',16,'4.95',1,0,0,'4.95','0.00',1,'','23:17:38');

/*Table structure for table `clo_orders_c` */

DROP TABLE IF EXISTS `clo_orders_c`;

CREATE TABLE `clo_orders_c` (
  `order_idx` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` int(10) unsigned NOT NULL,
  `order_number` varchar(50) NOT NULL DEFAULT '',
  `mollie_order_id` varchar(50) NOT NULL DEFAULT '',
  `surname` varchar(50) NOT NULL DEFAULT '',
  `username` varchar(50) NOT NULL DEFAULT '',
  `session_id` varchar(50) NOT NULL DEFAULT '',
  `order_tax` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `order_total` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `order_fee` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `store_discount` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `store_discount_type` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `order_grand_total` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `order_payment_name` varchar(100) NOT NULL DEFAULT '',
  `order_payment_price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `order_shipping_name` varchar(100) NOT NULL DEFAULT '',
  `order_shipping_price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `order_fee_insurance` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `order_foreign_price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `order_remarks_admin` text NOT NULL,
  `order_remarks` text NOT NULL,
  `order_mailbody` blob NOT NULL,
  `order_paystatus` varchar(20) NOT NULL DEFAULT 'Check',
  `order_status` varchar(20) NOT NULL DEFAULT 'New',
  `order_delivered` date NOT NULL,
  `order_date` date NOT NULL,
  `order_time` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`order_idx`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 PACK_KEYS=0;

/*Data for the table `clo_orders_c` */

insert  into `clo_orders_c`(`order_idx`,`customer_id`,`order_number`,`mollie_order_id`,`surname`,`username`,`session_id`,`order_tax`,`order_total`,`order_fee`,`store_discount`,`store_discount_type`,`order_grand_total`,`order_payment_name`,`order_payment_price`,`order_shipping_name`,`order_shipping_price`,`order_fee_insurance`,`order_foreign_price`,`order_remarks_admin`,`order_remarks`,`order_mailbody`,`order_paystatus`,`order_status`,`order_delivered`,`order_date`,`order_time`) values (8,10,'Clo-10-8','','Clo Cloverfield','clo@ver.field','h9am7v1eo7rq82kt40rpdca752','0.86','4.95','0.00','0.00',1,'4.95','Bij afhalen','0.00','Afhalen','0.00','0.00','0.00','','Nice website.','<!DOCTYPE html>\r                    <meta http-equiv=\"content-type\" content=\"utf-8\">\r                \r                    <html lang=\"en-NL\">\r                \r                    <head>\r                \r                      <title>Your order at: Cloverfield Shop</title>\r                \r                      <style>\r                        body {\r                          margin-top:  20px;\r                          margin-left: 0px;\r                        }\r                \r                        body, div, td {\r                          color:       #333333;\r                          font-family: Tahoma, Verdana, Arial;\r                          font-size :  14px;\r                        } \r                \r                        a {\r                          color:           #4285F4;\r                          font-weight:     bolder;\r                          text-decoration: none; \r                          letter-spacing:  1px;\r                        }		    \r                \r                        a:hover {\r                          color: #4285F4;\r                        }\r                \r                        hr {\r                          color:      #999999;\r                          border:     none;\r                          border-top: 1px dashed #999999;\r                          height:     1px;\r                        }\r                \r                        h1, h2, h3 {\r                          color:         #4285F4;\r                          font-family:  \"Lucida Sans Unicode\", \"Lucida Grande\", sans-serif;\r                          font-size:     17px;\r                          font-weight:   bold;\r                          margin-top:    0px;\r                          margin-bottom: 0px;\r                        }\r                \r                        b {\r                          color:       #4285F4;\r                          font-family: Tahoma, Verdana, Arial;\r                        }\r                \r                        .black {\r                          color:       #333333;\r                          font-weight: bold;\r                          font-family: Tahoma, Verdana, Arial;\r                        }\r                      </style>\r                \r                    </head>\r                \r                    <body bgcolor=\"#FFFFFF\">\r                \r                      <table width=\"800\" border=\"0\" cellspacing=\"0\" cellpadding=\"3\">\r                          <tr>\r                            <td></td>\r                            <td colspan=\"3\">\r                              <hr>\r                              <h2>Uw order bij Cloverfield Shop</h2>\r                              <hr>\r                            </td>\r                          </tr>\r                          \r                          <tr>\r                            <td></td>\r                            <td>Datum:</td>\r                            <td></td>\r                            <td>16-12-2021 | 22:12</td>\r                          </tr>\r                \r                          <tr>\r                            <td></td>\r                            <td>Onderwerp:</td>\r                            <td></td>\r                            <td>Bestelling: Cloverfield Shop</td>\r                          </tr>\r                \r                          <tr>\r                            <td></td>\r                            <td>Factuur #:</td>\r                            <td></td>\r                            <td><b>Clo-10-8</b></td>\r                          </tr>\r                \r                          <tr>\r                            <td></td>\r                            <td>Naam:</td>\r                            <td></td>\r                            <td>Hr. Clo Cloverfield</td>\r                          </tr>\r                \r                          <tr>\r                            <td></td>\r                            <td>Straat:</td>\r                            <td></td>\r                            <td>Cloverstreet 50</td>\r                          </tr>\r                \r                          <tr>\r                            <td></td>\r                            <td>Postcode:</td>\r                            <td></td>\r                            <td>1234CL</td>\r                          </tr>\r                \r                          <tr>\r                            <td></td>\r                            <td>Plaats:</td>\r                            <td></td>\r                            <td>Clovercity</td>\r                          </tr>\r                \r                          <tr>\r                            <td></td>\r                            <td>Land:</td>\r                            <td></td>\r                            <td>Nederland</td>\r                          </tr>\r                \r                          <tr>\r                            <td></td>\r                            <td>Telefoon:</td>\r                            <td></td>\r                            <td><b>0600000000</b></td>\r                          </tr>\r                \r                          <tr>\r                            <td></td>\r                            <td>E-mail:</td>\r                            <td></td>\r                            <td><a href=\"mailto:clo@ver.field\">clo@ver.field &raquo;</a></td>\r                          </tr>\r                \r                          <tr>\r                            <td></td>\r                            <td>Hoe heeft u ons gevonden?:</td>\r                            <td></td>\r                            <td><b>Van horen zeggen</b></td>\r                          </tr>					\r                \r                          <tr>\r                            <td></td>\r                            <td colspan=\"3\" align=\"center\">\r                              <hr>\r                            </td>\r                          </tr>\r                \r                          <tr>\r                            <td></td>\r                            <td valign=\"top\"><b>Opmerkingen:</b></td>\r                            <td></td>\r                            <td valign=\"top\">Nice website.</td>\r                          </tr>\r                \r                          <tr>\r                            <td></td>\r                            <td colspan=\"3\" align=\"center\">\r                              <hr>\r                            </td>\r                          </tr>\r                \r                          <tr>\r                            <td></td>\r                            <td><b>Aflevering:</b></td>\r                            <td></td>\r                            <td>Afhalen</td>\r                          </tr>\r                \r                          <tr>\r                            <td></td>\r                            <td><b>Betaling:</b></td>\r                            <td></td>\r                            <td>Bij afhalen</td>\r                          </tr>\r                \r                          <tr>\r                            <td></td>\r                            <td><b>Prijs:</b></td>\r                            <td></td>\r                            <td>Alle prijzen zijn inclusief 21% B.t.w.</td>\r                          </tr>          \r                \r                          <tr>\r                            <td></td>\r                            <td colspan=\"3\" align=\"center\">\r                              <hr>\r                            </td>\r                          </tr>\r                \r                          <tr>\r                            <td></td>\r                            <td colspan=\"3\">\r                              <h2>Uw bestelling:</h2>\r                            </td>\r                          </tr>\r                \r                          <tr>\r                            <td></td>\r                            <td colspan=\"3\" align=\"center\">\r                              <hr>\r                            </td>\r                          </tr>\r                          \r                \r                            <tr>\r                              <td></td>\r                              <td colspan=\"3\">\r                              \r                                <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"1\">\r                                  <tr>\r                                    <td width=\"100\"><b>Artikelnummer:</b></td> \r                                    <td width=\"10\">&nbsp;</td>\r                                    <td>armba1</td>\r                                  </tr>\r              \r                                  <tr>\r                                    <td><b>Titel:</b></td> \r                                    <td width=\"20\">&nbsp;</td>\r                                    <td>Armband Roze Infinity Love.</td>\r                                  </tr>										 \r                                <tr>\r                                          <td><b>Aantal:</b></td> \r                                          <td width=\"20\">&nbsp;</td>\r                                          <td>1</td>\r                                        </tr>\r                        \r                                        <tr>\r                                          <td><b>Prijs:</b></td> \r                                          <td width=\"20\">&nbsp;</td>\r                                          <td><b class=\"black\">&euro; 4,95</b> Per eenheid.</td>\r                                        </tr>								\r                                        <tr>\r                                            <td><b>Verpakking:</b></td> \r                                            <td width=\"20\">&nbsp;</td>\r                                            <td>Stuk van 1 Aantal.</td>\r                                          </tr>\r                                          <tr>\r                                          <td><b>Subtotaal:</b></td> \r                                          <td width=\"20\">&nbsp;</td>\r                                          <td><b class=\"black\">&euro; 4,95</b></td>\r                                        </tr>\r                    \r                                        <tr>\r                                          <td colspan=\"3\"><br><hr></td> \r                                        </tr>								\r                                      </table>\r                    \r                                    </td>\r                                </tr>\r                                <tr>\r                                      <td></td>\r                                      <td colspan=\"3\">\r                                        <h2>Kosten:</h2>\r                                      </td>\r                                    </tr>\r                          \r                                    <tr>\r                                      <td></td>\r                                      <td colspan=\"3\" align=\"center\">\r                                        <hr>\r                                      </td>\r                                    </tr>\r                          \r                                    <tr>\r                                      <td></td>\r                                        <td colspan=\"3\">\r                          \r                                          <table width=\"*\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">\r                                            <tr>\r                                              <td width=\"150\"><b>Subtotaal:</b></td>\r                                              <td align=\"center\" width=\"20\" ><b>&euro;</b></td>\r                                              <td align=\"right\"><b>4,95</b></td>\r                                            </tr>\r                        \r                                            <tr>\r                                              <td>Verzendkosten:</td>\r                                              <td align=\"center\">&euro;</td>\r                                              <td align=\"right\">0,00</td>\r                                            </tr>\r                        \r                                            <tr>\r                                              <td>Betaalkosten:</td>\r                                              <td align=\"center\">&euro;</td>\r                                              <td align=\"right\">0,00</td>\r                                            </tr>\r                                            <tr>\r                                      <td colspan=\"3\" align=\"center\">\r                                        <hr>\r                                      </td>\r                                    </tr>\r                  \r                                    <tr>\r                                        <td><b>Subtotaal:</b></td>\r                                        <td align=\"center\"><b>&euro;</b></td>\r                                        <td align=\"right\"><b>4,95</b></td>\r                                    </tr>\r                  \r                                    <tr>\r                                        <td>B.t.w. 21%</td>\r                                        <td align=\"center\">&euro;</td>\r                                        <td align=\"right\">0,86</td>\r                                    </tr>\r                  \r                                    <tr>\r                                        <td colspan=\"3\" align=\"center\">\r                                          <hr>\r                                        </td>\r                                    </tr>\r                  \r                                    <tr>\r                                        <td><span class=\"black\">Totaal:</span></td>\r                                        <td align=\"center\"><span class=\"black\">&euro;</span></td>\r                                        <td align=\"right\"><span class=\"black\">4,95</span></td>\r                                    </tr>\r                  \r                                  </table>\r                  \r                                </td>\r                            </tr>\r                  \r                            <tr>\r                                <td></td>\r                                <td colspan=\"3\" align=\"center\">\r                                  <hr>\r                                  <br>\r                                  Cloverfield Shop - Cloverfieldstraat 2021 - 12345 NL - Cloverfield - Nederland - T: 300 1234 1234<br>\r                                  E: <a href=\"mailto:websitegoeroe@gmail.com\">websitegoeroe@gmail.com</a> - W: <a href=\"http://localhost/cloverfield/\">http://localhost/cloverfield/</a><br>\r                                  Mijn Bank - BIC 123456789 - IBAN 0000 0000<br>\r                                  <br>\r                                  <hr>\r                                </td>\r                            </tr>\r                  \r                        </table>\r                \r                    </body>\r                \r                    </html>','Check','New','0000-00-00','2021-12-16','23:17:38'),(9,11,'Clo-10-9','','Seegers','chilm@planet.nl','bosqluo2o127sormb31eopi14g','1.89','10.90','0.00','0.00',1,'10.90','Bij afhalen','0.00','Afhalen','0.00','0.00','0.00','','Mooi','<!DOCTYPE html>\r                    <meta http-equiv=\"content-type\" content=\"utf-8\">\r                \r                    <html lang=\"en-NL\">\r                \r                    <head>\r                \r                      <title>Your order at: Cloverfield Shop</title>\r                \r                      <style>\r                        body {\r                          margin-top:  20px;\r                          margin-left: 0px;\r                        }\r                \r                        body, div, td {\r                          color:       #333333;\r                          font-family: Tahoma, Verdana, Arial;\r                          font-size :  14px;\r                        } \r                \r                        a {\r                          color:           #4285F4;\r                          font-weight:     bolder;\r                          text-decoration: none; \r                          letter-spacing:  1px;\r                        }		    \r                \r                        a:hover {\r                          color: #4285F4;\r                        }\r                \r                        hr {\r                          color:      #999999;\r                          border:     none;\r                          border-top: 1px dashed #999999;\r                          height:     1px;\r                        }\r                \r                        h1, h2, h3 {\r                          color:         #4285F4;\r                          font-family:  \"Lucida Sans Unicode\", \"Lucida Grande\", sans-serif;\r                          font-size:     17px;\r                          font-weight:   bold;\r                          margin-top:    0px;\r                          margin-bottom: 0px;\r                        }\r                \r                        b {\r                          color:       #4285F4;\r                          font-family: Tahoma, Verdana, Arial;\r                        }\r                \r                        .black {\r                          color:       #333333;\r                          font-weight: bold;\r                          font-family: Tahoma, Verdana, Arial;\r                        }\r                      </style>\r                \r                    </head>\r                \r                    <body bgcolor=\"#FFFFFF\">\r                \r                      <table width=\"800\" border=\"0\" cellspacing=\"0\" cellpadding=\"3\">\r                          <tr>\r                            <td></td>\r                            <td colspan=\"3\">\r                              <hr>\r                              <h2>Uw order bij Cloverfield Shop</h2>\r                              <hr>\r                            </td>\r                          </tr>\r                          \r                          <tr>\r                            <td></td>\r                            <td>Datum:</td>\r                            <td></td>\r                            <td>29-12-2021 | 17:12</td>\r                          </tr>\r                \r                          <tr>\r                            <td></td>\r                            <td>Onderwerp:</td>\r                            <td></td>\r                            <td>Bestelling: Cloverfield Shop</td>\r                          </tr>\r                \r                          <tr>\r                            <td></td>\r                            <td>Factuur #:</td>\r                            <td></td>\r                            <td><b>Clo-10-9</b></td>\r                          </tr>\r                \r                          <tr>\r                            <td></td>\r                            <td>Naam:</td>\r                            <td></td>\r                            <td>Hr. Seegers</td>\r                          </tr>\r                \r                          <tr>\r                            <td></td>\r                            <td>Straat:</td>\r                            <td></td>\r                            <td>Vrijheid 92</td>\r                          </tr>\r                \r                          <tr>\r                            <td></td>\r                            <td>Postcode:</td>\r                            <td></td>\r                            <td>1231 TP</td>\r                          </tr>\r                \r                          <tr>\r                            <td></td>\r                            <td>Plaats:</td>\r                            <td></td>\r                            <td>Loosdrecht</td>\r                          </tr>\r                \r                          <tr>\r                            <td></td>\r                            <td>Land:</td>\r                            <td></td>\r                            <td>Nederland</td>\r                          </tr>\r                \r                          <tr>\r                            <td></td>\r                            <td>Telefoon:</td>\r                            <td></td>\r                            <td><b>0600983422</b></td>\r                          </tr>\r                \r                          <tr>\r                            <td></td>\r                            <td>E-mail:</td>\r                            <td></td>\r                            <td><a href=\"mailto:chilm@planet.nl\">chilm@planet.nl &raquo;</a></td>\r                          </tr>\r                \r                          <tr>\r                            <td></td>\r                            <td>Hoe heeft u ons gevonden?:</td>\r                            <td></td>\r                            <td><b>Via een kennis</b></td>\r                          </tr>					\r                \r                          <tr>\r                            <td></td>\r                            <td colspan=\"3\" align=\"center\">\r                              <hr>\r                            </td>\r                          </tr>\r                \r                          <tr>\r                            <td></td>\r                            <td valign=\"top\"><b>Opmerkingen:</b></td>\r                            <td></td>\r                            <td valign=\"top\">Mooi</td>\r                          </tr>\r                \r                          <tr>\r                            <td></td>\r                            <td colspan=\"3\" align=\"center\">\r                              <hr>\r                            </td>\r                          </tr>\r                \r                          <tr>\r                            <td></td>\r                            <td><b>Aflevering:</b></td>\r                            <td></td>\r                            <td>Afhalen</td>\r                          </tr>\r                \r                          <tr>\r                            <td></td>\r                            <td><b>Betaling:</b></td>\r                            <td></td>\r                            <td>Bij afhalen</td>\r                          </tr>\r                \r                          <tr>\r                            <td></td>\r                            <td><b>Prijs:</b></td>\r                            <td></td>\r                            <td>Alle prijzen zijn inclusief 21% B.t.w.</td>\r                          </tr>          \r                \r                          <tr>\r                            <td></td>\r                            <td colspan=\"3\" align=\"center\">\r                              <hr>\r                            </td>\r                          </tr>\r                \r                          <tr>\r                            <td></td>\r                            <td colspan=\"3\">\r                              <h2>Uw bestelling:</h2>\r                            </td>\r                          </tr>\r                \r                          <tr>\r                            <td></td>\r                            <td colspan=\"3\" align=\"center\">\r                              <hr>\r                            </td>\r                          </tr>\r                          \r                \r                            <tr>\r                              <td></td>\r                              <td colspan=\"3\">\r                              \r                                <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"1\">\r                                  <tr>\r                                    <td width=\"100\"><b>Artikelnummer:</b></td> \r                                    <td width=\"10\">&nbsp;</td>\r                                    <td>armba2</td>\r                                  </tr>\r              \r                                  <tr>\r                                    <td><b>Titel:</b></td> \r                                    <td width=\"20\">&nbsp;</td>\r                                    <td>Armband Blauw Infinity Love.</td>\r                                  </tr>										 \r                                <tr>\r                                          <td><b>Aantal:</b></td> \r                                          <td width=\"20\">&nbsp;</td>\r                                          <td>1</td>\r                                        </tr>\r                        \r                                        <tr>\r                                          <td><b>Prijs:</b></td> \r                                          <td width=\"20\">&nbsp;</td>\r                                          <td><b class=\"black\">&euro; 5,95</b> Per eenheid.</td>\r                                        </tr>								\r                                        <tr>\r                                            <td><b>Verpakking:</b></td> \r                                            <td width=\"20\">&nbsp;</td>\r                                            <td>Stuk van 1 Aantal.</td>\r                                          </tr>\r                                          <tr>\r                                          <td><b>Subtotaal:</b></td> \r                                          <td width=\"20\">&nbsp;</td>\r                                          <td><b class=\"black\">&euro; 5,95</b></td>\r                                        </tr>\r                    \r                                        <tr>\r                                          <td colspan=\"3\"><br><hr></td> \r                                        </tr>								\r                                      </table>\r                    \r                                    </td>\r                                </tr>\r                                \r                \r                            <tr>\r                              <td></td>\r                              <td colspan=\"3\">\r                              \r                                <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"1\">\r                                  <tr>\r                                    <td width=\"100\"><b>Artikelnummer:</b></td> \r                                    <td width=\"10\">&nbsp;</td>\r                                    <td>armba1</td>\r                                  </tr>\r              \r                                  <tr>\r                                    <td><b>Titel:</b></td> \r                                    <td width=\"20\">&nbsp;</td>\r                                    <td>Armband Roze Infinity Love.</td>\r                                  </tr>										 \r                                <tr>\r                                          <td><b>Aantal:</b></td> \r                                          <td width=\"20\">&nbsp;</td>\r                                          <td>1</td>\r                                        </tr>\r                        \r                                        <tr>\r                                          <td><b>Prijs:</b></td> \r                                          <td width=\"20\">&nbsp;</td>\r                                          <td><b class=\"black\">&euro; 4,95</b> Per eenheid.</td>\r                                        </tr>								\r                                        <tr>\r                                            <td><b>Verpakking:</b></td> \r                                            <td width=\"20\">&nbsp;</td>\r                                            <td>Stuk van 1 Aantal.</td>\r                                          </tr>\r                                          <tr>\r                                          <td><b>Subtotaal:</b></td> \r                                          <td width=\"20\">&nbsp;</td>\r                                          <td><b class=\"black\">&euro; 4,95</b></td>\r                                        </tr>\r                    \r                                        <tr>\r                                          <td colspan=\"3\"><br><hr></td> \r                                        </tr>								\r                                      </table>\r                    \r                                    </td>\r                                </tr>\r                                <tr>\r                                      <td></td>\r                                      <td colspan=\"3\">\r                                        <h2>Kosten:</h2>\r                                      </td>\r                                    </tr>\r                          \r                                    <tr>\r                                      <td></td>\r                                      <td colspan=\"3\" align=\"center\">\r                                        <hr>\r                                      </td>\r                                    </tr>\r                          \r                                    <tr>\r                                      <td></td>\r                                        <td colspan=\"3\">\r                          \r                                          <table width=\"*\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">\r                                            <tr>\r                                              <td width=\"150\"><b>Subtotaal:</b></td>\r                                              <td align=\"center\" width=\"20\" ><b>&euro;</b></td>\r                                              <td align=\"right\"><b>10,90</b></td>\r                                            </tr>\r                        \r                                            <tr>\r                                              <td>Verzendkosten:</td>\r                                              <td align=\"center\">&euro;</td>\r                                              <td align=\"right\">0,00</td>\r                                            </tr>\r                        \r                                            <tr>\r                                              <td>Betaalkosten:</td>\r                                              <td align=\"center\">&euro;</td>\r                                              <td align=\"right\">0,00</td>\r                                            </tr>\r                                            <tr>\r                                      <td colspan=\"3\" align=\"center\">\r                                        <hr>\r                                      </td>\r                                    </tr>\r                  \r                                    <tr>\r                                        <td><b>Subtotaal:</b></td>\r                                        <td align=\"center\"><b>&euro;</b></td>\r                                        <td align=\"right\"><b>10,90</b></td>\r                                    </tr>\r                  \r                                    <tr>\r                                        <td>B.t.w. 21%</td>\r                                        <td align=\"center\">&euro;</td>\r                                        <td align=\"right\">1,89</td>\r                                    </tr>\r                  \r                                    <tr>\r                                        <td colspan=\"3\" align=\"center\">\r                                          <hr>\r                                        </td>\r                                    </tr>\r                  \r                                    <tr>\r                                        <td><span class=\"black\">Totaal:</span></td>\r                                        <td align=\"center\"><span class=\"black\">&euro;</span></td>\r                                        <td align=\"right\"><span class=\"black\">10,90</span></td>\r                                    </tr>\r                  \r                                  </table>\r                  \r                                </td>\r                            </tr>\r                  \r                            <tr>\r                                <td></td>\r                                <td colspan=\"3\" align=\"center\">\r                                  <hr>\r                                  <br>\r                                  Cloverfield Shop - Cloverfieldstraat 2021 - 12345 NL - Cloverfield - Nederland - T: 300 1234 1234<br>\r                                  E: <a href=\"mailto:websitegoeroe@gmail.com\">websitegoeroe@gmail.com</a> - W: <a href=\"http://localhost/cloverfield/\">http://localhost/cloverfield/</a><br>\r                                  Mijn Bank - BIC 123456789 - IBAN 0000 0000<br>\r                                  <br>\r                                  <hr>\r                                </td>\r                            </tr>\r                  \r                        </table>\r                \r                    </body>\r                \r                    </html>','Check','New','0000-00-00','2021-12-29','18:15:34');

/*Table structure for table `clo_payments` */

DROP TABLE IF EXISTS `clo_payments`;

CREATE TABLE `clo_payments` (
  `idx` int(2) unsigned NOT NULL AUTO_INCREMENT,
  `pay_name_nl` text NOT NULL,
  `pay_name_en` text NOT NULL,
  `pay_name_de` text NOT NULL,
  `pay_name_fr` text NOT NULL,
  `pay_text_nl` text NOT NULL,
  `pay_text_en` text NOT NULL,
  `pay_text_de` text NOT NULL,
  `pay_text_fr` text NOT NULL,
  `pay_config` varchar(255) NOT NULL DEFAULT '',
  `pay_price` decimal(10,2) unsigned NOT NULL,
  `sort_order` int(5) NOT NULL DEFAULT '1000',
  `active` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

/*Data for the table `clo_payments` */

insert  into `clo_payments`(`idx`,`pay_name_nl`,`pay_name_en`,`pay_name_de`,`pay_name_fr`,`pay_text_nl`,`pay_text_en`,`pay_text_de`,`pay_text_fr`,`pay_config`,`pay_price`,`sort_order`,`active`) values (1,'Telefonisch overmaken','Phone Transfer','Telefon Transfer','Transfert de Téléphone','Geen kosten.','Free','Kostenlos','Gratuit','','0.00',3,1),(4,'Zelf eerst overboeken per bank ','Money Transfer','Geldüberweisung','Transfert d\'argent','U ontvangt betalingsinstructies.','Wait for instructions','Warten Sie auf die Anweisungen','Attendez les instructions','','2.50',6,1),(5,'IDeal VISA Mastercard BanContact','IDeal VISA Mastercard BanContact','IDeal VISA Mastercard BanContact','IDeal VISA Mastercard BanContact','Veilig betalen.','Safe payment.','Sicher bezahlen.','Paiement sécurisé.','ideal','2.50',4,1),(6,'Bij afhalen','At Pick-Up','Bei Pick-Upp','A Pick-Up','Geen kosten.','Free','Kostenlos','Gratuit','','0.00',0,1),(7,'iDEAL','iDEAL','iDEAL','iDEAL','Online betalen via uw eigen bank.','Online payment through your own banking system.','Online-Bezahlung über Ihre eigene Bank.','Le paiement en ligne par le biais de votre propre banque.','mollie_ideal','0.00',5,1),(8,'Creditcard','Creditcard','Creditcard','Creditcard','','','','','mollie_creditcard','0.00',2,0),(9,'Mister Cash','Mister Cash','Mister Cash','Mister Cash','','','','','mollie_mistercash','0.00',7,0),(10,'Sofort','Sofort','Sofort','Sofort','','','','','mollie_sofort','0.00',8,0),(11,'Bank transfer','Bank transfer','Bank transfer','Bank transfer','','','','','mollie_banktransfer','0.00',9,0),(12,'Direct debit','Direct debit','Direct debit','Direct debit','','','','','mollie_directdebit','0.00',10,0),(13,'Belfius','Belfius','Belfius','Belfius','','','','','mollie_belfius','0.00',1,0),(14,'Paypal','Paypal','Paypal','Paypal','','','','','mollie_paypal','0.00',11,0),(15,'Bitcoin','Bitcoin','Bitcoin','Bitcoin','','','','','mollie_bitcoin','0.00',12,0),(16,'Podium cadeaukaart','Podium cadeaukaart','Podium cadeaukaart','Podium cadeaukaart','','','','','mollie_podiumcadeaukaart','0.00',13,0),(17,'Paysafecard','Paysafecard','Paysafecard','Paysafecard','','','','','mollie_paysafecard','0.00',14,0);

/*Table structure for table `clo_products` */

DROP TABLE IF EXISTS `clo_products`;

CREATE TABLE `clo_products` (
  `idx` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cat_id` int(5) unsigned NOT NULL DEFAULT '0',
  `sort_order` int(5) unsigned NOT NULL DEFAULT '1000',
  `product_number` varchar(25) NOT NULL DEFAULT '',
  `price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `price_discount` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `product_title_nl` varchar(255) NOT NULL DEFAULT '',
  `product_title_en` varchar(255) NOT NULL DEFAULT '',
  `product_title_de` varchar(255) NOT NULL DEFAULT '',
  `product_title_fr` varchar(255) NOT NULL DEFAULT '',
  `product_note_nl` text,
  `product_note_en` text,
  `product_note_de` text,
  `product_note_fr` text,
  `product_body_nl` blob,
  `product_body_en` blob,
  `product_body_de` blob,
  `product_body_fr` blob,
  `product_technical_nl` text,
  `product_technical_en` text,
  `product_technical_de` text,
  `product_technical_fr` text,
  `product_unit` varchar(50) DEFAULT '1',
  `keywords` varchar(255) DEFAULT '',
  `options` varchar(255) DEFAULT '',
  `weight` varchar(10) DEFAULT '',
  `stock` int(10) DEFAULT '5',
  `stock_warning` int(10) unsigned DEFAULT '10',
  `manufacturer` varchar(25) DEFAULT '',
  `offer` tinyint(1) unsigned DEFAULT '0',
  `related` varchar(255) DEFAULT '',
  `meter` int(1) unsigned DEFAULT '0',
  `active` tinyint(1) unsigned DEFAULT '1',
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`idx`),
  KEY `id` (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

/*Data for the table `clo_products` */

insert  into `clo_products`(`idx`,`cat_id`,`sort_order`,`product_number`,`price`,`price_discount`,`product_title_nl`,`product_title_en`,`product_title_de`,`product_title_fr`,`product_note_nl`,`product_note_en`,`product_note_de`,`product_note_fr`,`product_body_nl`,`product_body_en`,`product_body_de`,`product_body_fr`,`product_technical_nl`,`product_technical_en`,`product_technical_de`,`product_technical_fr`,`product_unit`,`keywords`,`options`,`weight`,`stock`,`stock_warning`,`manufacturer`,`offer`,`related`,`meter`,`active`,`created`) values (1,40,1000,'gla26','20.00','10.00','Glazen klok 26 cm ','Product Titel Engels','Product Titel Duits','Product Titel Frans','Glazen klok 26 cm ','Product Note Engels','Product Note Duits','Product Note Frans','<p>Een prachtige glazen klok &quot;Retro&quot; van glas met een doorsnede van 26 cm. Originele in Nederland gemaakte klok, dus kwaliteit aan de muur.</p>\r\n','Uitgebreide omschrijving in het Engels.','Uitgebreide omschrijving in het Duits.','Uitgebreide omschrijving in het Frans.','Nederlands meer info.','English more info.','Deutsch Mehr Info.','Francais Plus d\'infos.','1','klok, glas','','',9982,10,'Cloverplant',1,'2;3',0,1,'2021-11-15 00:00:00'),(2,40,1000,'sta38','32.50','0.00','Stationsklok 38 cm.','Product Titel Engels','Product Titel Duits','Product Titel Frans','Stationsklok 38 cm.','Product Note Engels','Product Note Duits','Product Note Frans','<p>Een prachtige z.g. &quot;Stationsklok&quot; van glas en Aluminium met een doorsnede van 326 cm. Originele in Nederland gemaakte klok, dus kwaliteit aan de muur.</p>\r\n','Uitgebreide omschrijving in het Engels.','Uitgebreide omschrijving in het Duits.','Uitgebreide omschrijving in het Frans.','Nederlands meer info.','English more info.','Deutsch Mehr Info.','Francais Plus d\'infos.','1','stationsklok, vintage','','',10000,10,'Cloverplant',0,'1;3',0,1,'2021-11-15 00:00:00'),(3,40,1000,'mod45','68.95','0.00','Moderne strakke klok 45 cm.','Product Titel Engels','Product Titel Duits','Product Titel Frans','Moderne strakke klok 45 cm doorsnee','Product Note Engels','Product Note Duits','Product Note Frans','<p>Moderne strakke klok 45 cm doorsnee, smalle spijlen als de tijdsaanduiding rechtstreeks op de muur.</p>\r\n','Uitgebreide omschrijving in het Engels.','Uitgebreide omschrijving in het Duits.','Uitgebreide omschrijving in het Frans.','Nederlands meer info.','English more info.','Deutsch Mehr Info.','Francais Plus d\'infos.','1','klok, modern, strak','','',10000,10,'Cloverplant',0,'1,2',0,1,'2021-11-15 00:00:00'),(4,39,1000,'cowopat','59.95','50.00','CowoPatra','Product Titel Engels','Product Titel Duits','Product Titel Frans','Cow Parade, `s werelds meest succesvolle publieke kunstevenement!','Product Note Engels','Product Note Duits','Product Note Frans','<p>Na de handbeschilderde koeien op ware grootte, tentoongesteld over de gehele wereld en daarna geveild voor het goede doel, is de Cow Parade nu ook verkrijgbaar in schaalmodellen van verschillende formaten - large/xxl, medium en mini - en in vele designs, waarmee de Cow Parade toegankelijke en betaalbare kunst is geworden.</p>\r\n','Uitgebreide omschrijving in het Engels.','Uitgebreide omschrijving in het Duits.','Uitgebreide omschrijving in het Frans.','Nederlands meer info.','English more info.','Deutsch Mehr Info.','Francais Plus d\'infos.','1','cowopatra, koe','','',9976,10,'Cloverplant',0,'5;6',0,1,'2021-11-15 00:00:00'),(5,39,1000,'tulpnl','57.95','0.00','Tulpen uit Holland','Product Titel Engels','Product Titel Duits','Product Titel Frans','Tulpen en koeien hollandser kan het niet.','Product Note Engels','Product Note Duits','Product Note Frans','<p>De vertrouwde koe, maar dan in een exclusief kunstzinnig jasje, een uniek cadeau voor dat ene plekje in huis.</p>\r\n','Uitgebreide omschrijving in het Engels.','Uitgebreide omschrijving in het Duits.','Uitgebreide omschrijving in het Frans.','Nederlands meer info.','English more info.','Deutsch Mehr Info.','Francais Plus d\'infos.','1','tulpen, koe, art','','',10000,10,'Cloverplant',0,'4;6',0,1,'2021-11-15 00:00:00'),(6,39,1000,'cowindia','72.50','0.00','De Indiase koe','Product Titel Engels','Product Titel Duits','Product Titel Frans','De Indiase koe een iconisch beeld.','Product Note Engels','Product Note Duits','Product Note Frans','<p>De koeien op de site zijn alleen large en xxl modellen<br />\r\nvoor mini en medium modellen moet u onze&nbsp;winkel in Loosdrecht bezoeken.<br />\r\ndeze zijn te klein en te breekbaar om te verzenden.</p>\r\n','Uitgebreide omschrijving in het Engels.','Uitgebreide omschrijving in het Duits.','Uitgebreide omschrijving in het Frans.','Nederlands meer info.','English more info.','Deutsch Mehr Info.','Francais Plus d\'infos.','1','mystiek, kunst','','',9999,10,'Cloverplant',0,'4;5',0,1,'2021-11-15 00:00:00'),(7,52,1000,'beardd','18.50','0.00','Beertje Dee Dee','Product Titel Engels','Product Titel Duits','Product Titel Frans','Bad taste bears','Product Note Engels','Product Note Duits','Product Note Frans','<p>Bad taste bears zijn beertjes die verzameld worden<br />\r\nDe beertjes zijn ongeveer 7 cm en worden met de hand geschilderd.</p>\r\n','Uitgebreide omschrijving in het Engels.','Uitgebreide omschrijving in het Duits.','Uitgebreide omschrijving in het Frans.','Nederlands meer info.','English more info.','Deutsch Mehr Info.','Francais Plus d\'infos.','1','bad, bear, taste','','',9999,10,'Cloverplant',0,'8;9',0,1,'2021-11-15 00:00:00'),(8,52,1000,'bearter','18.50','17.50','Moeder Theresa','Product Titel Engels','Product Titel Duits','Product Titel Frans','Bad taste bears','Product Note Engels','Product Note Duits','Product Note Frans','<p>Als beertjes uit de collectie gaan noemen ze dat met pensioen.<br />\r\n( to be retired) de prijs van het beertje stijgt dan gelijk in prijs ook bij de winkelier)</p>\r\n','Uitgebreide omschrijving in het Engels.','Uitgebreide omschrijving in het Duits.','Uitgebreide omschrijving in het Frans.','Nederlands meer info.','English more info.','Deutsch Mehr Info.','Francais Plus d\'infos.','1','bad, bear, taste','','',10000,10,'Cloverplant',0,'7;9',0,1,'2021-11-15 00:00:00'),(9,52,1000,'bearval','18.50','0.00','Beertje Valentino','Product Titel Engels','Product Titel Duits','Product Titel Frans','Bad taste bears','Product Note Engels','Product Note Duits','Product Note Frans','<p>Omdat deze beertjes dan in waarde stijgen, kijk op Ebay .com<br />\r\nLimited Edition bears aangeduid met LE voor de naam zijn in oplage van 4000 stuks<br />\r\nDeze zijn altijd al duurder in aankoop, maar nog exclusiever.<br />\r\nHet kan dus zomaar zijn dat wij nog beertjes hebben die allang retired zijn.<br />\r\nkijk daarom ook onder die groepjes staat de prijs er naast dan heb je grote kans dat wij deze nog kunnen leveren.</p>\r\n','Uitgebreide omschrijving in het Engels.','Uitgebreide omschrijving in het Duits.','Uitgebreide omschrijving in het Frans.','Nederlands meer info.','English more info.','Deutsch Mehr Info.','Francais Plus d\'infos.','1','bad, bear, taste','','',10000,10,'Cloverplant',0,'8;7',0,1,'2021-11-15 00:00:00'),(10,42,1000,'spiegou','105.95','100.00','Spiegel rond Gouden rand','Product Titel Engels','Product Titel Duits','Product Titel Frans','Decoratieve ronde spiegel 85 cm.','Product Note Engels','Product Note Duits','Product Note Frans','<p>Ronde facet&nbsp;spiegel goudkleurig diameter 85 cm.</p>\r\n','Uitgebreide omschrijving in het Engels.','Uitgebreide omschrijving in het Duits.','Uitgebreide omschrijving in het Frans.','Nederlands meer info.','English more info.','Deutsch Mehr Info.','Francais Plus d\'infos.','1','spiegel','','',9895,10,'Cloverplant',0,'11;12',0,1,'2021-11-15 00:00:00'),(11,42,1000,'spiezil','247.50','0.00','Spiegel rond Zilveren rand','Product Titel Engels','Product Titel Duits','Product Titel Frans','Schitterende chique spiegel 120 cm.','Product Note Engels','Product Note Duits','Product Note Frans','<p>Ronde spiegel Zilverkleurig, z.g. &nbsp;facetspiegel diameter 120 cm.</p>\r\n','Uitgebreide omschrijving in het Engels.','Uitgebreide omschrijving in het Duits.','Uitgebreide omschrijving in het Frans.','Nederlands meer info.','English more info.','Deutsch Mehr Info.','Francais Plus d\'infos.','1','spiegel','','',9998,10,'Cloverplant',0,'10;12',0,1,'2021-11-15 00:00:00'),(12,42,1000,'spievier','165.95','0.00','Vierkante spiegel','Product Titel Engels','Product Titel Duits','Product Titel Frans','Aparte vierkante spiegel','Product Note Engels','Product Note Duits','Product Note Frans','<p>Lijst zwart, sculp facetgeslepen spiegel basismaat 60 x 90 cm.</p>\r\n','Uitgebreide omschrijving in het Engels.','Uitgebreide omschrijving in het Duits.','Uitgebreide omschrijving in het Frans.','Nederlands meer info.','English more info.','Deutsch Mehr Info.','Francais Plus d\'infos.','1','spiegel','','',10000,10,'Cloverplant',0,'10;11',0,1,'2021-11-15 00:00:00'),(13,41,1000,'whitewol','199.95','0.00','White Wolves','Product Titel Engels','Product Titel Duits','Product Titel Frans','Doorgeschilderd White Wolves','Product Note Engels','Product Note Duits','Product Note Frans','<p>Doorgeschilderde inlijsting (Airbrushed)<br />\r\nSize: 105x75 cm<br />\r\nArt.nr: whitewol<br />\r\nTitle: White Wolves</p>\r\n','Uitgebreide omschrijving in het Engels.','Uitgebreide omschrijving in het Duits.','Uitgebreide omschrijving in het Frans.','Nederlands meer info.','English more info.','Deutsch Mehr Info.','Francais Plus d\'infos.','1','doorgeschilderd, lijst','','',10000,10,'Cloverplant',0,'14;15',0,1,'2021-11-15 00:00:00'),(14,41,1000,'onstea','110.95','100.00','Ons Team','Product Titel Engels','Product Titel Duits','Product Titel Frans','Doorgeschilderde lijst Ons Team','Product Note Engels','Product Note Duits','Product Note Frans','<p>Doorgeschilderde inlijsting (Airbrushed) 65x55 cm.<br />\r\nArt.nr: onstea<br />\r\nTitle: Our Team</p>\r\n','Uitgebreide omschrijving in het Engels.','Uitgebreide omschrijving in het Duits.','Uitgebreide omschrijving in het Frans.','Nederlands meer info.','English more info.','Deutsch Mehr Info.','Francais Plus d\'infos.','1','doorgeschilderd, lijst','','',9999,10,'Cloverplant',1,'13;15',0,1,'2021-11-15 00:00:00'),(15,41,1000,'river','148.95','0.00','Side of the River Thames','Product Titel Engels','Product Titel Duits','Product Titel Frans','Doorgeschilderde lijst','Product Note Engels','Product Note Duits','Product Note Frans','<p>Doorgeschilderde inlijsting (Airbrushed) 60x50 cm<br />\r\nArt.nr: river<br />\r\nTitle: Side of the River Thames.</p>\r\n','Uitgebreide omschrijving in het Engels.','Uitgebreide omschrijving in het Duits.','Uitgebreide omschrijving in het Frans.','Nederlands meer info.','English more info.','Deutsch Mehr Info.','Francais Plus d\'infos.','1','doorgeschilderd, lijst','','',10000,10,'Cloverplant',0,'13;14',0,1,'2021-11-15 00:00:00'),(16,7,1000,'armba1','5.95','4.95','Armband Roze Infinity Love','Product Titel Engels','Product Titel Duits','Product Titel Frans','Armband Infinity Love','Product Note Engels','Product Note Duits','Product Note Frans','<p>Infinity love armband met strass een parel erg mooie uitstraling leuk kado voor zus, vriendin, dochter noem maar op.<br />\r\n<br />\r\nLengte ongeveer 22 cm.</p>\r\n','<p>Uitgebreide omschrijving in het Engels.</p>\r\n','Uitgebreide omschrijving in het Duits.\r\n','<p>Uitgebreide omschrijving in het Frans.</p>\r\n','Nederlands meer info.','English more info.','Deutsch Mehr Info.','Francais Plus d\'infos.','1','armband, sieraden','','',9994,10,'Cloverplant',0,'17;18',0,1,'2021-11-15 00:00:00'),(17,7,1000,'armba2','5.95','0.00','Armband Blauw Infinity Love','Product Titel Engels','Product Titel Duits','Product Titel Frans','Armband Blauw Infinity Love','Product Note Engels','Product Note Duits','Product Note Frans','<p>Infinity love armband met strass een parel erg mooie uitstraling leuk kado voor zus, vriendin, dochter noem maar op.<br />\r\n<br />\r\nLengte ongeveer 22 cm.</p>\r\n','Uitgebreide omschrijving in het Engels.','Uitgebreide omschrijving in het Duits.','Uitgebreide omschrijving in het Frans.','Nederlands meer info.','English more info.','Deutsch Mehr Info.','Francais Plus d\'infos.','1','armband, sieraden','','',9999,10,'Cloverplant',0,'16;18',0,1,'2021-11-15 00:00:00'),(18,7,1000,'armba3','5.95','4.95','Armband Groen Infinity Love','Product Titel Engels','Product Titel Duits','Product Titel Frans','Armband Groen Infinity Love','Product Note Engels','Product Note Duits','Product Note Frans','<p>Infinity love armband met strass een parel erg mooie uitstraling leuk kado voor zus, vriendin, dochter noem maar op.<br />\r\n<br />\r\nLengte ongeveer 22 cm.</p>\r\n','Uitgebreide omschrijving in het Engels.','Uitgebreide omschrijving in het Duits.','Uitgebreide omschrijving in het Frans.','Nederlands meer info.','English more info.','Deutsch Mehr Info.','Francais Plus d\'infos.','1','armband, sieraden','','',9999,10,'Cloverplant',1,'16;17',0,1,'2021-11-15 00:00:00');

/*Table structure for table `clo_products_docs` */

DROP TABLE IF EXISTS `clo_products_docs`;

CREATE TABLE `clo_products_docs` (
  `idx` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_product` int(10) unsigned NOT NULL,
  `doc_name` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`idx`),
  KEY `id` (`id_product`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

/*Data for the table `clo_products_docs` */

insert  into `clo_products_docs`(`idx`,`id_product`,`doc_name`) values (1,1,'1_test.pdf'),(2,2,'2_test.pdf'),(3,3,'3_test.pdf'),(4,4,'4_test.pdf'),(5,5,'5_test.pdf'),(6,6,'6_test.pdf'),(7,7,'7_test.pdf'),(8,8,'8_test.pdf'),(9,9,'9_test.pdf'),(10,10,'10_test.pdf'),(11,11,'11_test.pdf'),(12,12,'12_test.pdf'),(13,13,'13_test.pdf'),(14,14,'14_test.pdf'),(15,15,'15_test.pdf'),(19,16,'16_test.pdf'),(20,17,'17_test.pdf'),(21,18,'18_test.pdf');

/*Table structure for table `clo_products_images` */

DROP TABLE IF EXISTS `clo_products_images`;

CREATE TABLE `clo_products_images` (
  `idx` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_product` int(10) unsigned NOT NULL,
  `image_name` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`idx`),
  KEY `id` (`id_product`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

/*Data for the table `clo_products_images` */

insert  into `clo_products_images`(`idx`,`id_product`,`image_name`) values (1,7,'7_730-deedee.jpg'),(2,8,'8_120-deedee.jpg'),(3,9,'9_410-deedee.jpg'),(4,4,'4_219-cow.jpg'),(5,5,'5_287-cow.jpg'),(6,6,'6_273-cow.jpg'),(7,10,'10_441-spiegel.jpg'),(8,11,'11_303-spiegel.jpg'),(9,12,'12_348-spiegel.jpg'),(10,1,'1_121-klok.jpg'),(11,3,'3_227-klok.jpg'),(12,2,'2_278-klok.jpg'),(13,13,'13_217-wand.jpg'),(14,14,'14_692-wand.jpg'),(15,15,'15_288-wand.jpg'),(16,16,'16_420-armband.jpg'),(17,17,'17_986-armband.jpg'),(18,18,'18_424-armband.jpg');

/*Table structure for table `clo_ret_images` */

DROP TABLE IF EXISTS `clo_ret_images`;

CREATE TABLE `clo_ret_images` (
  `idx` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `retour_image` varchar(255) NOT NULL DEFAULT '',
  `ticket_id` varchar(50) NOT NULL DEFAULT '',
  `visible` tinyint(1) NOT NULL DEFAULT '1',
  `created` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`idx`),
  KEY `id` (`idx`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `clo_ret_images` */

/*Table structure for table `clo_ret_items` */

DROP TABLE IF EXISTS `clo_ret_items`;

CREATE TABLE `clo_ret_items` (
  `idx` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ticket_id` varchar(50) NOT NULL DEFAULT '',
  `number` int(10) NOT NULL,
  `sku` varchar(50) NOT NULL DEFAULT '',
  `invoice` varchar(50) NOT NULL DEFAULT '',
  `created` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`idx`),
  KEY `id` (`ticket_id`),
  KEY `id1` (`idx`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `clo_ret_items` */

/*Table structure for table `clo_ret_mails` */

DROP TABLE IF EXISTS `clo_ret_mails`;

CREATE TABLE `clo_ret_mails` (
  `idx` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ticket_id` varchar(50) NOT NULL,
  `mail` blob NOT NULL,
  `created` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`idx`),
  KEY `id` (`ticket_id`),
  KEY `id1` (`idx`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `clo_ret_mails` */

/*Table structure for table `clo_ret_tickets` */

DROP TABLE IF EXISTS `clo_ret_tickets`;

CREATE TABLE `clo_ret_tickets` (
  `idx` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `companyname` varchar(100) NOT NULL DEFAULT '',
  `ticket_id` varchar(30) NOT NULL DEFAULT '',
  `saluation` varchar(20) NOT NULL DEFAULT '',
  `firstname` varchar(50) NOT NULL DEFAULT '',
  `surname` varchar(50) NOT NULL DEFAULT '',
  `invoice_street` varchar(50) NOT NULL DEFAULT '',
  `invoice_street_nr` varchar(20) NOT NULL DEFAULT '',
  `invoice_zip` varchar(20) NOT NULL DEFAULT '',
  `invoice_city` varchar(50) NOT NULL DEFAULT '',
  `invoice_country` varchar(30) NOT NULL DEFAULT '',
  `email` varchar(30) NOT NULL DEFAULT '',
  `phone` varchar(30) NOT NULL DEFAULT '',
  `employee` varchar(50) NOT NULL DEFAULT '',
  `remarks` text NOT NULL,
  `remarks_shop` text NOT NULL,
  `reported` varchar(30) NOT NULL DEFAULT '',
  `progress` varchar(30) NOT NULL DEFAULT '',
  `mailbody` blob NOT NULL,
  `changed` date NOT NULL DEFAULT '0000-00-00',
  `created` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`idx`),
  KEY `postcode` (`invoice_zip`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `clo_ret_tickets` */

/*Table structure for table `clo_shipping` */

DROP TABLE IF EXISTS `clo_shipping`;

CREATE TABLE `clo_shipping` (
  `idx` int(2) unsigned NOT NULL AUTO_INCREMENT,
  `ship_name_nl` text,
  `ship_name_en` text,
  `ship_name_de` text,
  `ship_name_fr` text,
  `ship_text_nl` text,
  `ship_text_en` text,
  `ship_text_de` text,
  `ship_text_fr` text,
  `ship_config` varchar(255) NOT NULL DEFAULT '',
  `ship_price` decimal(10,2) unsigned NOT NULL,
  `sort_order` int(5) NOT NULL DEFAULT '1000',
  `client` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `active` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

/*Data for the table `clo_shipping` */

insert  into `clo_shipping`(`idx`,`ship_name_nl`,`ship_name_en`,`ship_name_de`,`ship_name_fr`,`ship_text_nl`,`ship_text_en`,`ship_text_de`,`ship_text_fr`,`ship_config`,`ship_price`,`sort_order`,`client`,`active`) values (1,'Afhalen','Pick-Up EN','Pick-Up DE','Pick-Up FR','Geen kosten NL','Geen kosten EN','Geen kosten DE','Geen kosten FR','','0.00',0,1,1),(5,'Verzenden binnen Nederland.','Shipping within the Netherlands.','Versand in die Niederlande.','Expédition dans les Pays-Bas.','Kosten','','','','','2.95',2,1,1),(6,'Verzenden binnen Europa (Pakket).','Shipping within Europe.','Versand in Europa.','Expédition dans l`Europe.','Op nacalculatie.','','','','','7.95',3,1,1),(8,'Levering onder Rembours ','COD','Nachnahme','Paiement à la livraison','','','','','','14.90',4,1,0),(9,'Gratis verzending','Free','Kostenlos','Gratuit','Geen Kosten','','','','','0.00',1,0,0),(17,'ship_name_nl','ship_name_en','ship_name_de','ship_name_fr','ship_text_nl','ship_text_en','ship_text_de','ship_text_fr','ship_config','200.00',5,1,0);

/*Table structure for table `clo_text` */

DROP TABLE IF EXISTS `clo_text`;

CREATE TABLE `clo_text` (
  `idx` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sort_order` int(5) unsigned NOT NULL DEFAULT '1000',
  `text_menu` varchar(20) NOT NULL DEFAULT 'Links',
  `text_item` varchar(20) NOT NULL DEFAULT 'Algemeen',
  `text_category` int(5) NOT NULL DEFAULT '0',
  `text_date` date NOT NULL DEFAULT '0000-00-00',
  `text_title_nl` text NOT NULL,
  `text_title_en` text NOT NULL,
  `text_title_de` text NOT NULL,
  `text_title_fr` text NOT NULL,
  `text_body_nl` text NOT NULL,
  `text_body_en` text NOT NULL,
  `text_body_de` text NOT NULL,
  `text_body_fr` text NOT NULL,
  `text_permanent` int(1) unsigned NOT NULL DEFAULT '0',
  `homepage` int(1) NOT NULL DEFAULT '0',
  `active` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8 PACK_KEYS=0;

/*Data for the table `clo_text` */

insert  into `clo_text`(`idx`,`sort_order`,`text_menu`,`text_item`,`text_category`,`text_date`,`text_title_nl`,`text_title_en`,`text_title_de`,`text_title_fr`,`text_body_nl`,`text_body_en`,`text_body_de`,`text_body_fr`,`text_permanent`,`homepage`,`active`) values (31,4,'Links','Algemeen',0,'2014-04-03','Veilig betalen','Secure Payments','Sichere Zahlung','Paiement S&eacute;curis&eacute;','<p>In deze webshop kunt u volledig veilig geld ontvangen en verzenden via het betaalplatform Multisafepay.<br />\r\nVeilig betalen via iDEAL.&nbsp;<br />\r\nWij verstrekken geen financiele gegevens aan de ontvangende partij waardoor u er zeker van kunt zijn dat<br />\r\nuw gegevens veilig worden opgeslagen.</p>\r\n\r\n<p><strong>Wat kan ik zelf doen om veilig online te kopen en te verkopen?</strong><br />\r\n<br />\r\nUiteraard kunt u zelf ook nog een bijdrage leveren om al uw transacties veilig te laten verlopen.<br />\r\nHieronder vind u een aantal tips:<br />\r\n<br />\r\n1. Geef nooit gevoelige persoonlijke informatie prijs. Zorg er voor dat creditcard-gegevens, pasnummers, e-mail adressen en wachtwoorden altijd bij uzelf blijven. Met het prijsgeven van deze gegevens is het voor fraudeurs erg gemakkelijk om uw gegevens te misbruiken.<br />\r\n<br />\r\n2. Zorg ervoor dat u uw online aankopen altijd via een HTTPS verbinding doet (zoals bij ons). Via deze verbinding kunt u er zeker van zijn dat de gegevensoverdracht beveiligd is.<br />\r\n<br />\r\nBij aangesloten MultiSafepay webwinkels kunt u met uw&nbsp;eigen bankrekening&nbsp;betalen door middel van iDeal, Creditcards of het Belgische Mister Cash.<br />\r\n<br />\r\nUiteraard kunt u ook middels de reguliere betaalmethoden (Visa, Mastercard, Bankoverboekingen,) betalen bij aangesloten MultiSafepay webwinkels.</p>\r\n','Text in English language','Text in Deutsche Sprache','Texte en Francais',0,0,1),(35,3,'Links','Algemeen',0,'2014-04-28','Algemene Voorwaarden','Terms and Conditions','Gesch&auml;ftsbedingungen','Conditions g&eacute;n&eacute;rales de vente','<p><strong>Inhoudsopgave:</strong></p>\r\n\r\n<p>Artikel 1 - Definities</p>\r\n\r\n<p>Artikel 2 - Identiteit van de ondernemer</p>\r\n\r\n<p>Artikel 3 - Toepasselijkheid</p>\r\n\r\n<p>Artikel 4 - Het aanbod</p>\r\n\r\n<p>Artikel 5 - De overeenkomst</p>\r\n\r\n<p>Artikel 6 - Herroepingsrecht</p>\r\n\r\n<p>Artikel 7 - Kosten in geval van herroeping</p>\r\n\r\n<p>Artikel 8 - Uitsluiting herroepingsrecht</p>\r\n\r\n<p>Artikel 9 - De prijs</p>\r\n\r\n<p>Artikel 10 - Conformiteit en garantie</p>\r\n\r\n<p>Artikel 11 - Levering en uitvoering</p>\r\n\r\n<p>Artikel 12 - Duurtransacties: duur, opzegging en verlenging</p>\r\n\r\n<p>Artikel 13 - Betaling</p>\r\n\r\n<p>Artikel 14 - Klachtenregeling</p>\r\n\r\n<p>Artikel 15 - Geschillen</p>\r\n\r\n<p>Artikel 16 - Aanvullende of afwijkende bepalingen</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Artikel 1 - Definities</strong></p>\r\n\r\n<p>In deze voorwaarden wordt verstaan onder:</p>\r\n\r\n<ol>\r\n	<li><strong>Bedenktijd</strong>: de termijn waarbinnen de consument gebruik kan maken van zijn herroepingsrecht;</li>\r\n	<li><strong>Consument</strong>: de natuurlijke persoon die niet handelt in de uitoefening van beroep of bedrijf en een overeenkomst op afstand aangaat met de ondernemer;</li>\r\n	<li><strong>Dag</strong>: kalenderdag;</li>\r\n	<li><strong>Duurtransactie</strong>: een overeenkomst op afstand met betrekking tot een reeks van producten en/of diensten, waarvan de leverings- en/of afnameverplichting in de tijd is gespreid;</li>\r\n	<li><strong>Duurzame gegevensdrager</strong>: elk middel dat de consument of ondernemer in staat stelt om informatie die aan hem persoonlijk is gericht, op te slaan op een manier die toekomstige raadpleging en ongewijzigde reproductie van de opgeslagen informatie mogelijk maakt.</li>\r\n	<li><strong>Herroepingsrecht</strong>: de mogelijkheid voor de consument om binnen de bedenktijd af te zien van de overeenkomst op afstand;</li>\r\n	<li><strong>Ondernemer</strong>: de natuurlijke of rechtspersoon die producten en/of diensten op afstand aan consumenten aanbiedt;</li>\r\n	<li><strong>Overeenkomst op afstand</strong>: een overeenkomst waarbij in het kader van een door de ondernemer georganiseerd systeem voor verkoop op afstand van producten en/of diensten, tot en met het sluiten van de overeenkomst uitsluitend gebruik gemaakt wordt van &eacute;&eacute;n of meer technieken voor communicatie op afstand;</li>\r\n	<li><strong>Techniek voor communicatie op afstand</strong>: middel dat kan worden gebruikt voor het sluiten van een overeenkomst, zonder dat consument en ondernemer gelijktijdig in dezelfde ruimte zijn samengekomen.</li>\r\n</ol>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Artikel 2 - Identiteit van de ondernemer</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Artikel 3 - Toepasselijkheid </strong></p>\r\n\r\n<ol>\r\n	<li>Deze algemene voorwaarden zijn van toepassing op elk aanbod van de ondernemer en op elke tot stand gekomen overeenkomst op afstand tussen ondernemer en consument.</li>\r\n	<li>Voordat de overeenkomst op afstand wordt gesloten, wordt de tekst van deze algemene voorwaarden aan de consument beschikbaar gesteld. Indien dit redelijkerwijs niet mogelijk is, zal voordat de overeenkomst op afstand wordt gesloten, worden aangegeven dat de algemene voorwaarden bij de ondernemer zijn in te zien en zij op verzoek van de consument zo spoedig mogelijk kosteloos worden toegezonden.</li>\r\n	<li>Indien de overeenkomst op afstand elektronisch wordt gesloten, kan in afwijking van het vorige lid en voordat de overeenkomst op afstand wordt gesloten, de tekst van deze algemene voorwaarden langs elektronische weg aan de consument ter beschikking worden gesteld op zodanige wijze dat deze door de consument op een eenvoudige manier kan worden opgeslagen op een duurzame gegevensdrager. Indien dit redelijkerwijs niet mogelijk is, zal voordat de overeenkomst op afstand wordt gesloten, worden aangegeven waar van de algemene voorwaarden langs elektronische weg kan worden kennisgenomen en dat zij op verzoek van de consument langs elektronische weg of op andere wijze kosteloos zullen worden toegezonden.</li>\r\n	<li>Voor het geval dat naast deze algemene voorwaarden tevens specifieke product- of dienstenvoorwaarden van toepassing zijn, is het tweede en derde lid van overeenkomstige toepassing en kan de consument zich in geval van tegenstrijdige algemene voorwaarden steeds beroepen op de toepasselijke bepaling die voor hem het meest gunstig is.</li>\r\n</ol>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Artikel 4 - Het aanbod</strong></p>\r\n\r\n<ol>\r\n	<li>Indien een aanbod een beperkte geldigheidsduur heeft of onder voorwaarden geschiedt, wordt dit nadrukkelijk in het aanbod vermeld.</li>\r\n	<li>Het aanbod bevat een volledige en nauwkeurige omschrijving van de aangeboden producten en/of diensten. De beschrijving is voldoende gedetailleerd om een goede beoordeling van het aanbod door de consument mogelijk te maken. Als de ondernemer gebruik maakt van afbeeldingen zijn deze een waarheidsgetrouwe weergave van de aangeboden producten en/of diensten. Kennelijke vergissingen of kennelijke fouten in het aanbod binden de ondernemer niet.</li>\r\n	<li>Elk aanbod bevat zodanige informatie, dat voor de consument duidelijk is wat de rechten en verplichtingen zijn, die aan de aanvaarding van het aanbod zijn verbonden. Dit betreft in het bijzonder:</li>\r\n</ol>\r\n\r\n<ul>\r\n	<li>de prijs inclusief belastingen;</li>\r\n	<li>de eventuele kosten van aflevering;</li>\r\n	<li>de wijze waarop de overeenkomst tot stand zal komen en welke handelingen daarvoor nodig zijn;</li>\r\n	<li>het al dan niet van toepassing zijn van het herroepingsrecht;</li>\r\n	<li>de wijze van betaling, aflevering en uitvoering van de overeenkomst;</li>\r\n	<li>de termijn voor aanvaarding van het aanbod, dan wel de termijn waarbinnen de ondernemer de prijs garandeert;</li>\r\n	<li>de hoogte van het tarief voor communicatie op afstand indien de kosten van het gebruik van de techniek voor communicatie op afstand worden berekend op een andere grondslag dan het reguliere basistarief voor het gebruikte communicatiemiddel;</li>\r\n	<li>of de overeenkomst na de totstandkoming wordt gearchiveerd, en zo ja op welke wijze deze voor de consument te raadplegen is;</li>\r\n	<li>de manier waarop de consument, voor het sluiten van de overeenkomst, de door hem in het kader van de overeenkomst verstrekte gegevens kan controleren en indien gewenst herstellen;</li>\r\n	<li>de eventuele andere talen waarin, naast het Nederlands, de overeenkomst kan worden gesloten;</li>\r\n	<li>de gedragscodes waaraan de ondernemer zich heeft onderworpen en de wijze waarop de consument deze gedragscodes langs elektronische weg kan raadplegen; en</li>\r\n	<li>de minimale duur van de overeenkomst op afstand in geval van een duurtransactie.</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Artikel 5 - De overeenkomst</strong></p>\r\n\r\n<ol>\r\n	<li>De overeenkomst komt, onder voorbehoud van het bepaalde in lid 4, tot stand op het moment van aanvaarding door de consument van het aanbod en het voldoen aan de daarbij gestelde voorwaarden.</li>\r\n	<li>Indien de consument het aanbod langs elektronische weg heeft aanvaard, bevestigt de ondernemer onverwijld langs elektronische weg de ontvangst van de aanvaarding van het aanbod. Zolang de ontvangst van deze aanvaarding niet door de ondernemer is bevestigd, kan de consument de overeenkomst ontbinden.</li>\r\n	<li>Indien de overeenkomst elektronisch tot stand komt, treft de ondernemer passende technische en organisatorische maatregelen ter beveiliging van de elektronische overdracht van data en zorgt hij voor een veilige webomgeving. Indien de consument elektronisch kan betalen, zal de ondernemer daartoe passende veiligheidsmaatregelen in acht nemen.</li>\r\n	<li>De ondernemer kan zich - binnen wettelijke kaders - op de hoogte stellen of de consument aan zijn betalingsverplichtingen kan voldoen, alsmede van al die feiten en factoren die van belang zijn voor een verantwoord aangaan van de overeenkomst op afstand. Indien de ondernemer op grond van dit onderzoek goede gronden heeft om de overeenkomst niet aan te gaan, is hij gerechtigd gemotiveerd een bestelling of aanvraag te weigeren of aan de uitvoering bijzondere voorwaarden te verbinden.</li>\r\n	<li>De ondernemer zal bij het product of dienst aan de consument de volgende informatie, schriftelijk of op zodanige wijze dat deze door de consument op een toegankelijke manier kan worden opgeslagen op een duurzame gegevensdrager, meesturen:</li>\r\n</ol>\r\n\r\n<p>a. het bezoekadres van de vestiging van de ondernemer waar de consument met klachten terecht kan;</p>\r\n\r\n<p>b. de voorwaarden waaronder en de wijze waarop de consument van het herroepingsrecht gebruik kan maken, dan wel een duidelijke melding inzake het uitgesloten zijn van het herroepingsrecht;</p>\r\n\r\n<p>c. de informatie over garanties en bestaande service na aankoop;</p>\r\n\r\n<p>d. de in artikel 4 lid 3 van deze voorwaarden opgenomen gegevens, tenzij de ondernemer deze gegevens al aan de consument heeft verstrekt v&ouml; &ouml; r de uitvoering van de overeenkomst;</p>\r\n\r\n<p>e. de vereisten voor opzegging van de overeenkomst indien de overeenkomst een duur heeft van meer dan &eacute;&eacute;n jaar of van onbepaalde duur is.</p>\r\n\r\n<ol>\r\n	<li>In geval van een duurtransactie is de bepaling in het vorige lid slechts van toepassing op de eerste levering.</li>\r\n</ol>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Artikel 6 - Herroepingsrecht</strong></p>\r\n\r\n<p><em>Bij levering van producten:</em></p>\r\n\r\n<ol>\r\n	<li>Bij de aankoop van producten heeft de consument de mogelijkheid de overeenkomst zonder opgave van redenen te ontbinden gedurende de wettelijk vastgelegde 14 dagen. Deze bedenktermijn gaat in op de dag na ontvangst van het product door de consument of een vooraf door de consument aangewezen en aan de ondernemer bekend gemaakte vertegenwoordiger.</li>\r\n	<li>Tijdens de bedenktijd zal de consument zorgvuldig omgaan met het product en de verpakking. Hij zal het product slechts in die mate uitpakken of gebruiken voor zover dat nodig is om te kunnen beoordelen of hij het product wenst te behouden. Indien hij van zijn herroepingsrecht gebruik maakt, zal hij het product met alle geleverde toebehoren en - indien redelijkerwijze mogelijk - in de originele staat en verpakking aan de ondernemer retourneren, conform de door de ondernemer verstrekte redelijke en duidelijke instructies.</li>\r\n</ol>\r\n\r\n<p><em>Bij levering van diensten:</em></p>\r\n\r\n<ol>\r\n	<li>Bij levering van diensten heeft de consument de mogelijkheid de overeenkomst zonder opgave van redenen te ontbinden gedurende ten minste veertien dagen, ingaande op de dag van het aangaan van de overeenkomst.</li>\r\n	<li>Om gebruik te maken van zijn herroepingsrecht, zal de consument zich richten naar de door de ondernemer bij het aanbod en/of uiterlijk bij de levering ter zake verstrekte redelijke en duidelijke instructies.</li>\r\n	<li>Artikelen kunnen enkel worden geretourneerd wanneer deze niet zijn gebruikt of in contact zijn gekomen met water.<br />\r\n	Komt een artikel beschadigd of met gebruikssporen retour dan wordt het terug te betalen bedrag verminderd met 20%.<br />\r\n	Speciaal bestelde artikelen kunnen niet worden geretourneerd. Verpakkingen die zijn dicht geplakt met Ducktape worden geweigerd en niet in behandeling genomen.</li>\r\n</ol>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Artikel 7 - Kosten in geval van herroeping </strong></p>\r\n\r\n<ol>\r\n	<li>Indien de consument gebruik maakt van zijn herroepingsrecht, komen ten hoogste de kosten van terugzending voor zijn rekening.</li>\r\n	<li>Indien de consument een bedrag betaald heeft, zal de ondernemer dit bedrag zo spoedig mogelijk, doch uiterlijk binnen 30 dagen na de terugzending of herroeping, terugbetalen.</li>\r\n</ol>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Artikel 8 - Uitsluiting herroepingsrecht</strong></p>\r\n\r\n<ol>\r\n	<li>De ondernemer kan het herroepingsrecht van de consument uitsluiten voor zover voorzien in lid 2 en 3. De uitsluiting van het herroepingsrecht geldt slechts indien de ondernemer dit duidelijk in het aanbod, althans tijdig voor het sluiten van de overeenkomst, heeft vermeld.</li>\r\n	<li>Uitsluiting van het herroepingsrecht is slechts mogelijk voor producten:</li>\r\n</ol>\r\n\r\n<p>a. die door de ondernemer tot stand zijn gebracht overeenkomstig specificaties van de consument;</p>\r\n\r\n<p>b. die duidelijk persoonlijk van aard zijn;</p>\r\n\r\n<p>c. die door hun aard niet kunnen worden teruggezonden;</p>\r\n\r\n<p>d. die snel kunnen bederven of verouderen;</p>\r\n\r\n<p>e. waarvan de prijs gebonden is aan schommelingen op de financi&eacute;le markt waarop de ondernemer geen invloed heeft;</p>\r\n\r\n<p>f. voor losse kranten en tijdschriften;</p>\r\n\r\n<p>g. voor audio- en video-opnamen en computersoftware waarvan de consument de verzegeling heeft verbroken.</p>\r\n\r\n<ol>\r\n	<li>Uitsluiting van het herroepingsrecht is slechts mogelijk voor diensten:</li>\r\n</ol>\r\n\r\n<p>a. betreffende logies, vervoer, restaurantbedrijf of vrijetijdsbesteding te verrichten op een bepaalde datum of tijdens een bepaalde periode;</p>\r\n\r\n<p>b. waarvan de levering met uitdrukkelijke instemming van de consument is begonnen voordat de bedenktijd is verstreken;</p>\r\n\r\n<p>c. betreffende weddenschappen en loterijen.</p>\r\n\r\n<p>d. Verlichting, opblaasbare artikelen, elektrische apparaten die indien voorgeschreven niet door<br />\r\neen erkend installateur zijn aangesloten.<br />\r\ne. Schroefdraadomgeving van producten zoals pompen waarbij een koppeling wordt ingeschroefd.</p>\r\n\r\n<p><br />\r\n<strong>Artikel 9 - De prijs</strong></p>\r\n\r\n<ol>\r\n	<li>Gedurende de in het aanbod vermelde geldigheidsduur worden de prijzen van de aangeboden producten en/of diensten niet verhoogd, behoudens prijswijzigingen als gevolg van veranderingen in btw-tarieven.</li>\r\n	<li>In afwijking van het vorige lid kan de ondernemer producten of diensten waarvan de prijzen gebonden zijn aan schommelingen op de financi&eacute;le markt en waar de ondernemer geen invloed op heeft, met variabele prijzen aanbieden. Deze gebondenheid aan schommelingen en het feit dat eventueel vermelde prijzen richtprijzen zijn, worden bij het aanbod vermeld.</li>\r\n	<li>Prijsverhogingen binnen 3 maanden na de totstandkoming van de overeenkomst zijn alleen toegestaan indien zij het gevolg zijn van wettelijke regelingen of bepalingen.</li>\r\n	<li>Prijsverhogingen vanaf 3 maanden na de totstandkoming van de overeenkomst zijn alleen toegestaan indien de ondernemer dit bedongen heeft en:</li>\r\n</ol>\r\n\r\n<p>a. deze het gevolg zijn van wettelijke regelingen of bepalingen; of</p>\r\n\r\n<p>b. de consument de bevoegdheid heeft de overeenkomst op te zeggen met ingang van de dag waarop de prijsverhoging ingaat.</p>\r\n\r\n<ol>\r\n	<li>De in het aanbod van producten of diensten genoemde prijzen zijn inclusief btw.</li>\r\n</ol>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Artikel 10 - Conformiteit en Garantie</strong></p>\r\n\r\n<ol>\r\n	<li>De ondernemer staat er voor in dat de producten en/of diensten voldoen aan de overeenkomst, de in het aanbod vermelde specificaties, aan de redelijke eisen van deugdelijkheid en/of bruikbaarheid en de op de datum van de totstandkoming van de overeenkomst bestaande wettelijke bepalingen en/of overheidsvoorschriften. Indien overeengekomen staat de ondernemer er tevens voor in dat het product geschikt is voor ander dan normaal gebruik.</li>\r\n	<li>Een door de ondernemer, fabrikant of importeur verstrekte garantie doet niets af aan de wettelijke rechten en vorderingen die de consument op grond van de overeenkomst tegenover de ondernemer kan doen gelden.</li>\r\n</ol>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Artikel 11 - Levering en uitvoering</strong></p>\r\n\r\n<ol>\r\n	<li>De ondernemer zal de grootst mogelijke zorgvuldigheid in acht nemen bij het in ontvangst nemen en bij de uitvoering van bestellingen van producten en bij de beoordeling van aanvragen tot verlening van diensten.</li>\r\n	<li>Als plaats van levering geldt het adres dat de consument aan het bedrijf kenbaar heeft gemaakt.</li>\r\n	<li>Met inachtneming van hetgeen hierover in artikel 4 van deze algemene voorwaarden is vermeld, zal het bedrijf geaccepteerde bestellingen met bekwame spoed doch uiterlijk binnen 30 dagen uitvoeren tenzij een langere leveringstermijn is afgesproken. Indien de bezorging vertraging ondervindt, of indien een bestelling niet dan wel slechts gedeeltelijk kan worden uitgevoerd, ontvangt de consument hiervan uiterlijk 30 dagen nadat hij de bestelling geplaatst heeft bericht. De consument heeft in dat geval het recht om de overeenkomst zonder kosten te ontbinden en recht op eventuele schadevergoeding.</li>\r\n	<li>In geval van ontbinding conform het vorige lid zal de ondernemer het bedrag dat de consument betaald heeft zo spoedig mogelijk, doch uiterlijk binnen 30 dagen na ontbinding, terugbetalen.</li>\r\n	<li>Indien levering van een besteld product onmogelijk blijkt te zijn, zal de ondernemer zich inspannen om een vervangend artikel beschikbaar te stellen. Uiterlijk bij de bezorging zal op duidelijke en begrijpelijke wijze worden gemeld dat een vervangend artikel wordt geleverd. Bij vervangende artikelen kan het herroepingsrecht niet worden uitgesloten. De kosten van een eventuele retourzending zijn voor rekening van de ondernemer.</li>\r\n	<li>Het risico van beschadiging en/of vermissing van producten berust bij de ondernemer tot het moment van bezorging aan de consument of een vooraf aangewezen en aan de ondernemer bekend gemaakte vertegenwoordiger, tenzij uitdrukkelijk anders is overeengekomen.</li>\r\n</ol>\r\n\r\n<p><strong>Artikel 12 - Duurtransacties: duur, opzegging en verlenging</strong></p>\r\n\r\n<p><em>Opzegging</em></p>\r\n\r\n<ol>\r\n	<li>De consument kan een overeenkomst die voor onbepaalde tijd is aangegaan en die strekt tot het geregeld afleveren van producten (elektriciteit daaronder begrepen) of diensten, te allen tijde opzeggen met inachtneming van daartoe overeengekomen opzeggingsregels en een opzegtermijn van ten hoogste &eacute;&eacute;n maand.</li>\r\n	<li>De consument kan een overeenkomst die voor bepaalde tijd is aangegaan en die strekt tot het geregeld afleveren van producten (elektriciteit daaronder begrepen) of diensten, te allen tijde tegen het einde van de bepaalde duur opzeggen met inachtneming van daartoe overeengekomen opzeggingsregels en een opzegtermijn van ten hoogste &eacute;&eacute;n maand.</li>\r\n	<li>De consument kan de in de vorige leden genoemde overeenkomsten:</li>\r\n</ol>\r\n\r\n<ul>\r\n	<li>te allen tijde opzeggen en niet beperkt worden tot opzegging op een bepaald tijdstip of in een bepaalde periode;</li>\r\n	<li>tenminste opzeggen op dezelfde wijze als zij door hem zijn aangegaan;</li>\r\n	<li>altijd opzeggen met dezelfde opzegtermijn als de ondernemer voor zichzelf heeft bedongen.</li>\r\n</ul>\r\n\r\n<p><em>Verlenging</em></p>\r\n\r\n<ol>\r\n	<li>Een overeenkomst die voor bepaalde tijd is aangegaan en die strekt tot het geregeld afleveren van producten (elektriciteit daaronder begrepen) of diensten, mag niet stilzwijgend worden verlengd of vernieuwd voor een bepaalde duur.</li>\r\n	<li>In afwijking van het vorige lid mag een overeenkomst die voor bepaalde tijd is aangegaan en die strekt tot het geregeld afleveren van dag- nieuws- en weekbladen en tijdschriften stilzwijgend worden verlengd voor een bepaalde duur van maximaal drie maanden, als de consument deze verlengde overeenkomst tegen het einde van de verlenging kan opzeggen met een opzegtermijn van ten hoogste &eacute;&eacute;n maand.</li>\r\n	<li>Een overeenkomst die voor bepaalde tijd is aangegaan en die strekt tot het geregeld afleveren van producten of diensten, mag alleen stilzwijgend voor onbepaalde duur worden verlengd als de consument te allen tijde mag opzeggen met een opzegtermijn van ten hoogste &eacute;&eacute;n maand en een opzegtermijn van ten hoogste drie maanden in geval de overeenkomst strekt tot het geregeld, maar minder dan eenmaal per maand, afleveren van dag-, nieuws- en weekbladen en tijdschriften.</li>\r\n	<li>Een overeenkomst met beperkte duur tot het geregeld ter kennismaking afleveren van dag-, nieuws- en weekbladen en tijdschriften (proef- of kennismakingsabonnement) wordt niet stilzwijgend voortgezet en eindigt automatisch na afloop van de proef- of kennismakingsperiode.</li>\r\n</ol>\r\n\r\n<p><em>Duur</em></p>\r\n\r\n<ol>\r\n	<li>Als een overeenkomst een duur van meer dan een jaar heeft, mag de consument na een jaar de overeenkomst te allen tijde met een opzegtermijn van ten hoogste een maand opzeggen, tenzij de redelijkheid en billijkheid zich tegen opzegging v&ouml; &ouml;r het einde van de overeengekomen duur verzetten.</li>\r\n</ol>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Artikel 13 - Betaling</strong></p>\r\n\r\n<ol>\r\n	<li>Voor zover niet anders is overeengekomen, dienen de door de consument verschuldigde bedragen te worden voldaan binnen 14 dagen na het ingaan van de bedenktermijn als bedoeld in artikel 6 lid 1. In geval van een overeenkomst tot het verlenen van een dienst, vangt deze termijn aan nadat de consument de bevestiging van de overeenkomst heeft ontvangen.</li>\r\n	<li>Bij de verkoop van producten aan consumenten mag in algemene voorwaarden nimmer een vooruitbetaling van meer dan 50% worden bedongen. Wanneer vooruitbetaling is bedongen, kan de consument geen enkel recht doen gelden aangaande de uitvoering van de desbetreffende bestelling of dienst(en), alvorens de bedongen vooruitbetaling heeft plaatsgevonden.</li>\r\n	<li>De consument heeft de plicht om onjuistheden in verstrekte of vermelde betaalgegevens onverwijld aan de ondernemer te melden.</li>\r\n	<li>In geval van wanbetaling van de consument heeft de ondernemer behoudens wettelijke beperkingen, het recht om de vooraf aan de consument kenbaar gemaakte redelijke kosten in rekening te brengen.</li>\r\n</ol>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Artikel 14 - Klachtenregeling</strong></p>\r\n\r\n<ol>\r\n	<li>De ondernemer beschikt over een voldoende bekend gemaakte klachtenprocedure en behandelt de klacht overeenkomstig deze klachtenprocedure.</li>\r\n	<li>Klachten over de uitvoering van de overeenkomst moeten binnen bekwame tijd, volledig en duidelijk omschreven worden ingediend bij de ondernemer, nadat de consument de gebreken heeft geconstateerd.</li>\r\n	<li>Bij de ondernemer ingediende klachten worden binnen een termijn van 14 dagen gerekend vanaf de datum van ontvangst beantwoord. Als een klacht een voorzienbaar langere verwerkingstijd vraagt, wordt door de ondernemer binnen de termijn van 14 dagen geantwoord met een bericht van ontvangst en een indicatie wanneer de consument een meer uitvoerig antwoord kan verwachten.</li>\r\n	<li>Indien de klacht niet in onderling overleg kan worden opgelost ontstaat een geschil dat vatbaar is voor de geschillenregeling.</li>\r\n</ol>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Artikel 15 - Geschillen</strong></p>\r\n\r\n<ol>\r\n	<li>Op overeenkomsten tussen de ondernemer en de consument waarop deze algemene voorwaarden betrekking hebben, is uitsluitend Nederlands recht van toepassing.</li>\r\n</ol>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Artikel 16 - Aanvullende of afwijkende bepalingen</strong></p>\r\n\r\n<p>Aanvullende dan wel van deze algemene voorwaarden afwijkende bepalingen mogen niet ten nadele van de consument zijn en dienen schriftelijk te worden vastgelegd dan wel op zodanige wijze dat deze door de consument op een toegankelijke manier kunnen worden opgeslagen op een duurzame gegevensdrager.</p>\r\n','Text in English language','Text in Deutsche Sprache','Texte en Francais',1,0,1),(36,6,'Links','Algemeen',0,'2014-04-25','Disclaimer','Disclaimer','Haftungsausschluss','Avertissement','<p>Aan de afbeeldingen en de omschrijvingen op deze website kunnen geen rechten ontleend worden.<br />\r\n<br />\r\n<strong>Betrouwbaarheid verstrekte informatie</strong><br />\r\n<br />\r\nDe webshopeigenaar stelt hoge eisen aan de via deze website verstrekte informatie. Desalniettemin aanvaardt de webshopeigenaar geen aansprakelijkheid voor de actualiteit en/of het voorkomen van eventuele fouten in de informatie op deze website.<br />\r\n<br />\r\nAls u onjuiste en/of onvolledige informatie op onze website aantreft, stellen wij het zeer op prijs als u ons daarover informeert.<br />\r\n<br />\r\n<strong>Ongeauthoriseerd of oneigenlijk gebruik</strong><br />\r\n<br />\r\nOngeauthoriseerd of oneigenlijk gebruik van de webpagina of de inhoud daarvan kan een inbreuk vormen op rechten van intellectuele eigendom, regelgeving m.b.t. privacy, publicatie en/of communicatie in de breedste zin van het woord opleveren. U bent verantwoordelijk voor al hetgeen u vanuit de webpagina verzendt.<br />\r\n<br />\r\n<strong>Be&iuml;indigen website</strong><br />\r\n<br />\r\nDe webshopeigenaar mag de webpagina naar eigen inzicht en op ieder door hem gewenst moment (laten) veranderen of be&iuml;indigen, met of zonder voorafgaande kennisgeving. De webshopeigenaar is niet aansprakelijk voor de gevolgen van verandering of be&iuml;indiging.<br />\r\n<br />\r\n<strong>Privacy</strong><br />\r\n<br />\r\nDe webshopeigenaar behoudt zich het recht voor om u de toestemming te ontzeggen de website te gebruiken en/of van bepaalde diensten die op de website worden aangeboden gebruik te maken. In aansluiting daarop kan de webshopeigenaar de toegang tot de website monitoren.<br />\r\n<br />\r\n</p>\r\n','Text in English language','Text in Deutsche Sprache','Texte en Francais',0,0,1),(48,5,'Links','Algemeen',0,'2014-04-25','Privacy Policy','Privacy Policy','Privacy Policy','Privacy Policy','<h2>Privacyverklaring</h2>\r\n\r\n<p>We bewaren en gebruiken uitsluitend e-mailadressen die rechtstreeks aan ons worden opgegeven of waarvan bij opgave duidelijk is dat ze aan ons worden verstrekt. We gebruiken een e-mailadres alleen waarvoor dit aan ons is opgegeven en verder voor andere marketing- of service doeleinden, voor zover daarvoor ook toestemming is verleend.<br />\r\n<br />\r\nDeze toestemming(en) is/zijn ten alle tijde weer in te trekken via onze site of door dit op een andere wijze aan ons mee te delen. Bovendien wordt deze mogelijkheid in elke marketing- en service e-mail geboden middels een rechtstreekse verwijzing naar onze site. We verstrekken nooit e-mailadressen aan derden t.b.v. commerci&euml;le doeleinden.<br />\r\n<br />\r\n<strong>De webshopeigenaar verwerkt uw persoonsgegevens voor:</strong></p>\r\n\r\n<ul>\r\n	<li>De acceptatie van uw bestelling.</li>\r\n	<li>Het tegengaan van overkreditering.</li>\r\n	<li>Uitvoering van overeenkomsten met u.</li>\r\n	<li>Relatiebeheer en managementinformatie, product- en dienstontwikkeling en het bepalen van de (algemene) strategie.</li>\r\n</ul>\r\n\r\n<p>Uw persoonsgegevens worden (mits door u aangegeven) gebruikt om u al dan niet op basis van een voorafgaande selectie te informeren over interessante aanbiedingen en andere producten of diensten van onze webwinkel.<br />\r\n<br />\r\nDeze informatie zal u slechts per e-mail worden gestuurd indien u hiervoor toestemming heeft gegeven. Indien u geen informatie (meer) wenst te ontvangen kunt u dit kenbaar maken aan ons.<br />\r\n<br />\r\nMet betrekking tot informatie verkregen van van deze webshop kunt u contact opnemen via de <a href=\\\"http://contact.php\\\">contactpagina</a>.<br />\r\n<br />\r\nDoor de Algemene Voorwaarden van onze webshop te aanvaarden stemt u tevens in met de mogelijkheid dat wij uw persoonsgegevens gebruiken voor credit scoring.<br />\r\n<br />\r\n<strong>Adreswijzigingen:</strong><br />\r\n<br />\r\nKlanten zijn verplicht de webwinkeleigenaar van iedere adreswijziging op de hoogte te stellen. Zolang de webwinkeleigenaar geen verhuisbericht heeft ontvangen, wordt u geacht woonachtig te zijn op het laatst bij de webwinkeleigenaar bekende adres en blijft u aansprakelijk voor de door u bestelde artikelen die op het oude adres zijn afgeleverd.<br />\r\n<br />\r\nDoor het plaatsen van een bestelling, machtigt u de webwinkeleigenaar om - indien nodig - uw gegevens op te vragen bij de gemeentelijke bevolkingsadministratie of andere instanties.</p>\r\n','Text in English language','Text in Deutsche Sprache','Texte en Francais',0,0,1),(49,7,'Onder','Algemeen',0,'2014-04-03','Cookies','Cookies','Cookies','Cookies','<p><strong>COOKIE VERKLARING</strong><br />\r\n<br />\r\n<strong>Cookiewet</strong> Er is sinds 1 juni 2012 een nieuwe wet, de telecomwet. Daardoor is elke website wettelijk verplicht de gebruiker te informeren over &#39;cookies&#39; en toestemming te vragen voor het gebruik hiervan. Ook de websites van de technojet.nl maken gebruik van cookies.</p>\r\n\r\n<p><strong>Wat zijn cookies?</strong> Cookies zijn kleine bestanden die jouw voorkeuren tijdens het surfen onthouden en opslaan op je eigen computer. Een cookie slaat niet je naam, niet je adres, niet je leeftijd en ook andere persoonlijke gegevens weet een cookie niet.<br />\r\n<br />\r\nZe onthouden alleen je voorkeuren en je interesses op basis van je surfgedrag. Cookies kunnen dus NOOIT gebruikt worden om privegegevens van je computer uit te lezen of wachtwoorden te onderscheppen. Ook kunnen ze je computer niet infecteren met een virus of trojan. ze zijn dus volkomen veilig en worden al sinds de jaren 90 zonder incident gebruikt op bijna ALLE websites in de wereld.<br />\r\n<br />\r\n<strong>Op de navolgende websites kan je meer informatie over cookies vinden:</strong><br />\r\n<br />\r\nConsumentenbond: <a href=\"http://www.consumentenbond.nl/test/elektronica-communicatie/veilig-online/privacy-op-internet/extra/wat-zijn-cookies/\" target=\"_blank\">Wat zijn cookies?</a><br />\r\nConsumentenbond: <a href=\"http://www.consumentenbond.nl/test/elektronica-communicatie/veilig-online/privacy-op-internet/extra/waarvoor-dienen-cookies/\" target=\"_blank\">Waarvoor dienen cookies?</a><br />\r\nConsumentenbond: <a href=\"http://www.consumentenbond.nl/test/elektronica-communicatie/veilig-online/privacy-op-internet/extra/cookies-verwijderen/\" target=\"_blank\">Cookies verwijderen</a><br />\r\nConsumentenbond: <a href=\"http://www.consumentenbond.nl/test/elektronica-communicatie/veilig-online/privacy-op-internet/extra/cookies-uitschakelen/\" target=\"_blank\">Cookies uitschakelen</a></p>\r\n\r\n<p><em>Zodra u de site opent, accepteert u tevens het gebruik van cookies. Indien u dat niet wilt kunt u deze uitschakelen in uw browser.</em></p>\r\n\r\n<p><em>Cookies uitschakelen: Let op, bij het uitschakelen van cookies werkt geen enkele webwinkel meer en kunt u geen bestelling plaatsen!</em></p>\r\n\r\n<p><strong>Wat voor cookies gebruiken wij?</strong> De site maakt gebruik van de volgende cookies:</p>\r\n\r\n<p><br />\r\n<strong>1. Functionele cookies</strong> Noodzakelijke cookies: om naar behoren te kunnen surfen door de sites, maken we soms gebruik van cookies. Uw pc onthoudt de indeling die uzelf gemaakt hebt. Voor deze cookies hoeven we geen toestemming te vragen.</p>\r\n\r\n<p><strong>2. Cookies via Google Analytics</strong> Via onze website wordt een cookie geplaatst van het Amerikaanse bedrijf Google, als deel van de Analytics-dienst. Wij gebruiken deze dienst om bij te houden en rapportages te krijgen over hoe bezoekers de website gebruiken. Google kan deze informatie aan derden verschaffen indien Google hiertoe wettelijk wordt verplicht, of voor zover derden de informatie namens Google verwerken. Wij hebben hier geen invloed op. Wij hebben Google toegestaan de verkregen analytics informatie te gebruiken voor andere Google diensten.<br />\r\nDe informatie die Google verzamelt wordt zo veel mogelijk geanonimiseerd. Uw IP-adres wordt nadrukkelijk niet meegegeven. De informatie wordt overgebracht naar en door Google opgeslagen op servers in de Verenigde Staten. Google stelt zich te houden aan de Safe Harbor principles en is aangesloten bij het Safe Harbor-programma van het Amerikaanse Ministerie van Handel. Dit houdt in dat er sprake is van een passend beschermingsniveau voor de verwerking van eventuele persoonsgegevens.<br />\r\n<br />\r\n<strong>Hoe kan ik cookies uitzetten?</strong><br />\r\nHet uitschakelen van cookies heeft alleen gevolgen voor de computer en browser waarop je deze handeling uitvoert. Indien je gebruik maakt van meerdere computers en/of browsers dien je deze handeling zo vaak als nodig te herhalen.<br />\r\nCookies uitzetten: <a href=\"http://support.google.com/chrome/bin/answer.py?hl=nl&amp;answer=95647\" target=\"_blank\">Chrome</a> <a href=\"http://windows.microsoft.com/nl-NL/windows-vista/Block-or-allow-cookies\" target=\"_blank\">Internet Explorer</a> <a href=\"http://support.mozilla.org/nl/kb/Cookies%20in-%20en%20uitschakelen\" target=\"_blank\">Firefox</a> <a href=\"http://support.apple.com/kb/PH5042\" target=\"_blank\">Safari</a><br />\r\nAlleen advertentiecookies uitzetten: Als je geen third-party cookies wilt, dan kun je je daarvoor afmelden via de zogenoemde opt-out regeling op <a href=\"http://www.youronlinechoices.com/be-nl/\" target=\"_blank\">Your online choices</a></p>\r\n\r\n<p><strong>Toekomst.</strong><br />\r\nOp dit moment is er nog veel onduidelijkheid over de precieze uitwerking van de wet. Wij beraden ons nog over de manier waarop wij deze wet precies invulling gaat geven.</p>\r\n','Text in English language','Text in Deutsche Sprache','Texte en Francais',0,0,1),(54,8,'Links','Algemeen',0,'2021-11-30','Webwinkelsoftware','Webshop Software','Webshop Software','Logiciel Webshop','<p><b>LET OP dit is een DEMO winkel, wij verkopen dus niet echt.</b><br />\r\n<br />\r\n<b>W</b>ist je dat tegenwoordig meer dan 80% van alle internet aankopen wordt gedaan op een mobiel apparaat zoals de mobiele telefoon, iPad of tablet?<br />\r\n<br />\r\n<b>J</b>e kunt wel inschatten wat dat betekent voor je huidige webwinkelsoftware wanneer deze niet responsive is en klanten afhaken. Ergernis vanwege de navigatie en de zichtbaarheid is de hoofdreden. Omzetverlies is het onbedoelde gevolg en Google gaat deze websites lager ranken of zelfs uit de zoekresultaten verwijderen.<br />\r\n<br />\r\n<b>Cloverfield&nbsp;</b>webwinkelsoftware is aangepast aan de moderne eisen en net zo goed te zien op de PC als op je mobiele telefoon of tablet. De lay-out schaalt automatisch mee, probeer het maar eens en test de flexibiliteit.<br />\r\n<br />\r\nNeem vrijblijvend <a href=\"page-contact.php\">Contact </a>met ons op over deze software .<br />\r\n<br />\r\n<b>Cloverfield&nbsp;</b><em><strong>Responsive Webwinkel Software.</strong></em></p>\r\n','<p>Text in English language</p>\r\n','<p>Text in Deutsche Sprache</p>\r\n','<p>Texte en Francais</p>\r\n',1,1,1),(56,0,'Links','Nieuws',0,'2015-01-16','Website live','Website live','Website Live','Website Actif','<p><strong>Dit is een nieuwsberichtje.</strong><br />\r\n<br />\r\nSchrijf elke dag of elke week een bericht, ook interessant voor Google.</p>\r\n','Text in English language','Text in Deutsche Sprache','Texte en Francais',0,0,1),(57,7,'Links','Nieuws',0,'2015-01-16','Prachtige geschenken','Nice Gifts','Wunderbare Geschenke','Les cadeaux merveilleux','<p>Vraag niet hoe het kan, maar we zijn er weer in geslaagd om voor u de mooiste artikelen in te slaan.<br />\r\nPrachtige geschenken en u krijgt ze GRATIS thuis gestuurd bij een bestelling boven de &euro; 500.00</p>\r\n','Text in English language','Text in Deutsche Sprache','Texte en Francais',0,0,1),(59,1000,'none','Closed',0,'2016-02-18','Gesloten','Closed','Geschlossen','Fermez','Wegens onderhoud is de shop momenteel gesloten.<br>\r\nProbeert u het later nog eens.<br>','','','',1,0,1);

/*Table structure for table `clo_units` */

DROP TABLE IF EXISTS `clo_units`;

CREATE TABLE `clo_units` (
  `idx` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `unit_name_nl` text NOT NULL,
  `unit_name_en` text NOT NULL,
  `unit_name_de` text NOT NULL,
  `unit_name_fr` text NOT NULL,
  `unit_value` varchar(50) NOT NULL DEFAULT '',
  `unit_permanent` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `clo_units` */

insert  into `clo_units`(`idx`,`unit_name_nl`,`unit_name_en`,`unit_name_de`,`unit_name_fr`,`unit_value`,`unit_permanent`) values (1,'Stuk','','','','1',1),(2,'Doos','','','','124',0),(3,'Zak','','','','1',0),(4,'Vat','','','','1',0),(5,'Dozijn','','','','12',0),(6,'Doosje','','','','25',0),(7,'meters','','','','1',0);

/*Table structure for table `clo_vouchers` */

DROP TABLE IF EXISTS `clo_vouchers`;

CREATE TABLE `clo_vouchers` (
  `idx` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `coupon_email` varchar(50) NOT NULL DEFAULT '',
  `coupon_code` varchar(50) NOT NULL DEFAULT '',
  `coupon_discount` varchar(10) NOT NULL DEFAULT '',
  `coupon_type` varchar(3) NOT NULL DEFAULT 'abs',
  `coupon_text` text NOT NULL,
  `active` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `redeemed` datetime DEFAULT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `clo_vouchers` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
