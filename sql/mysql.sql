# phpMyAdmin MySQL-Dump
# version 2.2.2
# http://phpwizard.net/phpMyAdmin/
# http://phpmyadmin.sourceforge.net/ (download page)
# --------------------------------------------------------

#
# Table structure for table `dropdown`
#

CREATE TABLE dropdown (
    menuid      INT(4) UNSIGNED NOT NULL AUTO_INCREMENT,
    position    INT(4) UNSIGNED NOT NULL,
    itemname    VARCHAR(60)     NOT NULL DEFAULT '',
    itemurl     VARCHAR(100)    NOT NULL DEFAULT '',
    down        TINYINT(1)      NOT NULL DEFAULT '1',
    membersonly TINYINT(1)      NOT NULL DEFAULT '1',
    PRIMARY KEY (menuid)
)
    ENGINE = ISAM;
