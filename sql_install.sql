CREATE TABLE IF NOT EXISTS `staff_levels` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`name` varchar(50) NOT NULL DEFAULT '',
`order` int(3) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
                    
CREATE TABLE IF NOT EXISTS `staff_members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `level_id` int(3) NOT NULL,
  `pilotid` int(5) NOT NULL,
  `title` varchar(50) NOT NULL,
  `titleabr` varchar(25) NOT NULL DEFAULT '',
  `email` varchar(150) NOT NULL,
  `order` int(5) NOT NULL,
  `since` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `bio` text NOT NULL,
  `picturelink` text NOT NULL,
  `contact_public` int(3) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;