﻿/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     2012/12/9 02:00 AM                           */
/*==============================================================*/

drop database leo_test;
create database leo_test;
use leo_test;


CREATE TABLE tianyi_articles
(
    article_id                  int not null auto_increment,
    article_tag                 varchar(256) default null,
    article_url                 varchar(1024) not null,
    article_icon                varchar(256) default null,
    article_type                int default 0,
    article_name                varchar(256) not null,
    article_status              int not null default 1,
    article_content             longblob not null,
    article_summary             varchar(1024) default null,
    article_isbanner            int default 0,
    article_audit_gmt           int default null,
    article_create_gmt          int not null,
    article_update_gmt          int not null,
    article_click_count         int not null default 0,  
    article_reject_reason       varchar(512) default null,

    /*foreign keys*/

    column_id                   int not null,
    audit_user_id               int not null,
    enterprise_id               int not null,
    create_user_id              int not null,
    PRIMARY KEY (article_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE tianyi_channels
(
    channel_id                  int not null auto_increment,
    channel_name                varchar(128) not null unique,
    channel_desc		varchar(512) default null,
    channel_icon                varchar(1024) default null,
    channel_index               int default 0,
    channel_status		int not null default 1,
    PRIMARY KEY (channel_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE tianyi_common_articles
(
    article_id                  int not null auto_increment,
    channel_id                  int not null,
    article_url                 varchar(1024) default null,
    article_name                varchar(256) not null,
    article_icon                varchar(256) default null,
    article_status              int not null default 1,
    article_content             longblob not null,
    article_summary             varchar(1024) default 1024,
    article_audit_gmt           int not null,
    article_create_gmt          int not null,
    article_update_gmt          int not null,
    article_click_count         int not null default 0, 

    /* foreign keys */

    audit_user_id               int not null default 0,
    create_user_id              int not null,
    PRIMARY KEY (article_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE tianyi_columns
(
    column_id                   int not null,
    column_icon                 varchar(1024) default null, 
    column_name                 varchar(1024) default null,
    column_desc                 varchar(1024) default null,
    column_index                int not null default 0, 
    column_status               int not null default 0,
    column_create_gmt           int not null default 0,
    column_update_gmt           int not null default 0,

    /* foreign keys */

    enterprise_id               int not null,

    PRIMARY KEY (column_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE tianyi_enterprises
(
    enterprise_id               int not null auto_increment,
    enterprise_name             varchar(128) not null unique,
    enterprise_desc             varchar(1024) not null,
    enterprise_logo             varchar(1024) default null,
    enterprise_status           int not null default 1,

    PRIMARY KEY (enterprise_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE tianyi_departments
(
    department_id               int not null auto_increment,
    department_name             varchar(64) not null,
    department_desc             varchar(1024) not null,
    department_status           int not null default 1,

    /* foreign keys */

    enterprise_id               int not null,

    PRIMARY KEY (department_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE tianyi_users_departments
(
    dummy_id                    int not null auto_increment,

    /* foreign keys */

    department_id               int not null default -1,
    user_id                     int not null default -1,

    PRIMARY KEY (dummy_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE tianyi_notifications 
(
    notification_id             int not null auto_increment,
    notification_name           varchar(64) not null,
    notification_desc           varchar(1024) not null,
    notification_status         int not null default 1 COMMENT '通知状态，1：没审核，2：已经审核',
    notification_audit_gmt      int not null default 0,
    notification_create_gmt     int not null default 0,

    /* foreign keys */
    department_id               int not null,
    audit_user_id               int default 0,
    enterprise_id               int not null,
    create_user_id              int not null,

    PRIMARY KEY (notification_id)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3;

CREATE TABLE tianyi_notifications_users
(
    dummy_id int not null auto_increment,
    nu_received_flag            int not null default '0' COMMENT '0:没有收到，1：收到',

    /* foreign keys */

    user_id                     int not null,
    notification_id             int not null,

    PRIMARY KEY  (dummy_id)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE tianyi_options
(
    option_id                   int not null auto_increment,
    option_count                int not null default 0,
    option_content              varchar(1024),

    /* foreign keys */

    vote_id              int not null,

    PRIMARY KEY (option_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE tianyi_permissions
(
    permission_id               int not null auto_increment,
    permission_name             varchar(1024) not null,
    permission_desc             varchar(1024) not null,
    PRIMARY KEY (permission_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE tianyi_users
(
    user_id                     int not null auto_increment,
    username            	varchar(32) not null unique,
    password        	        varchar(64) not null,
    user_cell                   varchar(20) not null,
    user_other                  varchar(32) default null,
    user_extra                  varchar(32) default null,
    user_image                  varchar(256) default null,
    user_email                  varchar(64) default null,
    user_status                 int not null default 1,
    user_hometel                varchar(20) default null,
    user_realname       	varchar(32) default null,
    user_position               int default 1000,
    user_officetel              varchar(20) default null,
    user_login_count            int default 0,
    user_last_login_time        int default null,
    user_last_check_time        int default null,

    /* foreign keys */

    permission_id               int not null,
    enterprise_id               int not null,

    PRIMARY KEY (user_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE tianyi_users_votes
(
    dummy_id	                int not null auto_increment,

    /* foreign keys */

    vote_id                     int not null,
    user_id                     int not null,
    option_id                   int not null,

    PRIMARY KEY (dummy_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE tianyi_votes
(
    vote_id                     int not null auto_increment,
    vote_url                    varchar(1024) default null,
    vote_type                   int not null default 0,
    vote_name                   varchar(1024) not null,
    vote_icon                   varchar(1024) default null,
    vote_status                 int not null default 1,
    vote_summary                varchar(1024) default null,
    vote_content                varchar(1024) not null,
    vote_audit_userid           int not null,
    vote_create_userid          int not null,
    vote_audit_time_gmt         int not null,
    vote_create_time_gmt        int not null,

    /* foreign keys */

    enterprise_id               int not null,
    PRIMARY KEY (vote_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE tianyi_settings
(
    setting_id                  int not null auto_increment,
    setting_audit               int not null default 0 COMMENT '0:关，1：开',
    setting_user_history        int not null default 0 COMMENT '0:不记录，1:记录',

    /* foreign keys */

    enterprise_id               int not null,

    PRIMARY KEY (setting_id)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE tianyi_history
(
    history_id                  int not null auto_increment,
    history_gmt                 int not null,
    history_ip                  VARCHAR(235) null,

    /* foreign keys */

    user_id                     int not null, 

    PRIMARY KEY (history_id)
) ENGINE = InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE tianyi_contacts
(
    contact_id                  int not null auto_increment,
    contact_name                varchar(256) not null,
    contact_index               int not null default '1' COMMENT '排序,值越小，越靠前',
    contact_number              varchar(21) not null,
    contact_position            varchar(256) default null,

    /* foreign keys */

    user_id                     int not null,

    PRIMARY KEY (contact_id)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE tianyi_topic
(
    topic_id                   int not null auto_increment,
    topic_tag                  varchar(256) default null COMMENT '扩展：topic_tag',
    topic_status               int default null,
    topic_content              varchar(1024) not null,
    topic_created_gmt          int not null,
    topic_updated_gmt          int not null,

    /* foreign keys */

    enterprise_id              int not null,
    user_id                    int not null,

    PRIMARY KEY  (topic_id)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

CREATE TABLE tianyi_reply
(
    reply_id                   int not null auto_increment,
    reply_content              varchar(1024) not null COMMENT '评论内容',
    reply_create_gmt           int not null,

    /* foreign keys */

    topic_id                   int not null,
    user_id                    int not null,

    PRIMARY KEY  (reply_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


/* fake data */


