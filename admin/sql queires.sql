-- Table for slider images (multiple photos per slider)
CREATE TABLE `slider_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slider_id` int(11) NOT NULL COMMENT 'Foreign key to slider table',
  `image_path` varchar(255) NOT NULL COMMENT 'Path to the image file',
  `image_order` int(11) DEFAULT 0 COMMENT 'Order of images',
  `is_cover` tinyint(1) DEFAULT 0 COMMENT '1 for cover photo, 0 for others',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `slider_id` (`slider_id`),
  CONSTRAINT `slider_images_ibfk_1` FOREIGN KEY (`slider_id`) REFERENCES `slider` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Add a column to indicate if slider has multiple images
ALTER TABLE `slider` ADD COLUMN `has_multiple_images` tinyint(1) DEFAULT 0 AFTER `status`;



