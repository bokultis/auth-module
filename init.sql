--
-- Table structure for table `auth_acl`
--

CREATE TABLE IF NOT EXISTS `auth_acl` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(10) unsigned NOT NULL,
  `privilege_id` int(10) unsigned NOT NULL,
  `allowed` enum('yes','no') NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `role_id` (`role_id`,`privilege_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='role can or cannot do privilege on resource' AUTO_INCREMENT=4 ;

--
-- Dumping data for table `auth_acl`
--

INSERT INTO `auth_acl` (`id`, `role_id`, `privilege_id`, `allowed`) VALUES
(1, 1, 1, 'yes'),
(2, 4, 2, 'yes'),
(3, 2, 3, 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `auth_privilege`
--

CREATE TABLE IF NOT EXISTS `auth_privilege` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `resource_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `resource_id` (`resource_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `auth_privilege`
--

INSERT INTO `auth_privilege` (`id`, `code`, `name`, `resource_id`) VALUES
(1, 'access', 'Access Admin Panel', 1),
(3, 'master', 'Master Operations', 1);

-- --------------------------------------------------------

--
-- Table structure for table `auth_resource`
--

CREATE TABLE IF NOT EXISTS `auth_resource` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `parent_id` int(10) unsigned NOT NULL,
  `module` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='resources' AUTO_INCREMENT=3 ;

--
-- Dumping data for table `auth_resource`
--

INSERT INTO `auth_resource` (`id`, `code`, `name`, `parent_id`, `module`) VALUES
(1, 'admin', 'Admin Module', 0, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `auth_role`
--

CREATE TABLE IF NOT EXISTS `auth_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `parent_id` int(10) unsigned NOT NULL COMMENT 'parent role',
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `auth_role`
--

INSERT INTO `auth_role` (`id`, `name`, `parent_id`) VALUES
(1, 'Admin', 0),
(2, 'Master Admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `auth_user`
--

CREATE TABLE IF NOT EXISTS `auth_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(10) unsigned NOT NULL COMMENT 'role',
  `username` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL COMMENT 'md5',
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `status` enum('active','blocked','pending') NOT NULL DEFAULT 'pending',
  `lang` char(5) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `data` text COMMENT 'custom json data',
  `created` datetime NOT NULL,
  `logged` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `role_id` (`role_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='users and admins' AUTO_INCREMENT=2 ;

--
-- Dumping data for table `auth_user`
--

INSERT INTO `auth_user` (`id`, `role_id`, `username`, `password`, `first_name`, `last_name`, `email`, `status`, `lang`, `image_path`, `data`, `created`, `logged`) VALUES
(1, 2, 'admin', 'aa01f6f431087f5bb9fc9f698c1ef14b', 'Horisen', 'Worker', 'info@horisen.com', 'active', 'en', NULL, '{\r\n  "dashboard": {\r\n    "region1": {\r\n      "widgets": [\r\n        {\r\n          "componentClass": "hDashboard.Widget.Cms"\r\n        },\r\n        {\r\n          "componentClass": "hDashboard.Widget.Admin"\r\n        }\r\n      ]\r\n    },\r\n    "region2": {\r\n      "widgets": [\r\n        {\r\n          "componentClass": "hDashboard.Widget.Auth"\r\n        },\r\n        {\r\n          "componentClass": "hDashboard.Widget.Cms.Statistics"\r\n        }\r\n      ]\r\n    }\r\n  }\r\n}', '2012-03-28 10:58:53', '2014-08-28 11:47:53');


INSERT INTO `module` (`id`, `application_id`, `code`, `name`, `description`, `settings`, `data`) VALUES
(30, 1, 'auth', 'Auth', 'Users and permissions management', '', '{\r\n    "widgets":{\r\n        "hDashboard.Widget.Auth":{\r\n            "jsFiles":["/modules/auth/js/Widget.js"],\r\n            "cssFiles":[]\r\n        }\r\n    }\r\n}');