CREATE TABLE IF NOT EXISTS `#__audiofiles` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `artist_speaker` varchar(255) NOT NULL,
  `category` varchar(100) NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `audio_file` varchar(255) NOT NULL,
  `state` TINYINT NOT NULL DEFAULT '1',
  `upload_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 DEFAULT COLLATE utf8mb4_unicode_ci;

INSERT IGNORE INTO `#__audiofiles` (`id`, `title`, `description`, `artist_speaker`, `category`, `thumbnail`, `audio_file`) VALUES
(1, 'Just relax', 'Meditation commentary', 'Brahma Kumaris', 'meditation', '/images/ISW logo.png', '/files/someFile.mp3')