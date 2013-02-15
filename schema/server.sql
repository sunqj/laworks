/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     2012/12/9 02:00 AM                           */
/*==============================================================*/

drop database server;
create database server;
use server;
SET sql_mode='NO_AUTO_VALUE_ON_ZERO';

CREATE TABLE tianyi_article
(
    article_id                  int not null auto_increment,
    article_tag                 varchar(256) default null,
    article_url                 varchar(256) not null,
    article_icon                varchar(256) default null,
    article_type                int default 0,
    article_name                varchar(64) not null,
    article_content             longblob not null,
    article_summary             varchar(100) default null,
    article_isbanner            int default 0,
    article_audit_gmt           int not null default 0,
    article_create_gmt          int not null default 0,
    article_update_gmt          int not null default 0,
    article_click_count         int not null default 0,  
    article_reject_reason       varchar(256) default null,

    /*foreign keys*/

    article_status              int not null default 0,
    column_id                   int not null,
    audit_user_id               int not null,
    enterprise_id               int not null,
    create_user_id              int not null,

    PRIMARY KEY (article_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE tianyi_channel
(
    channel_id                  int not null auto_increment,
    channel_name                varchar(20) not null unique,
    channel_desc		varchar(100) default null,
    channel_icon                varchar(256) default null,
    channel_index               int default 0,

    /*foreign keys*/

    role_status_id              int not null default 0,

    PRIMARY KEY (channel_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE tianyi_news
(
    news_id                     int not null auto_increment,
    news_url                    varchar(256) default null,
    news_name                   varchar(64) not null,
    news_icon                   varchar(256) default null,
    news_type                   int not null default 0,
    news_content                longblob not null,
    news_summary                varchar(100) default null,
    news_audit_gmt              int not null default 0,
    news_create_gmt             int not null default 0,
    news_update_gmt             int not null default 0,
    news_click_count            int not null default 0, 

    /* foreign keys */

    news_status                 int not null default 0,
    channel_id                  int not null,
    audit_user_id               int not null default 0,
    create_user_id              int not null,
    PRIMARY KEY (news_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE tianyi_column
(
    column_id                   int not null auto_increment,
    column_icon                 varchar(256) default null, 
    column_name                 varchar(20) default null,
    column_desc                 varchar(100) default null,
    column_index                int not null default 0, 
    column_create_gmt           int not null default 0,
    column_update_gmt           int not null default 0,

    /* foreign keys */

    column_status               int not null default 0,
    enterprise_id               int not null,

    PRIMARY KEY (column_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE tianyi_enterprise
(
    enterprise_id               int not null auto_increment,
    enterprise_name             varchar(20) not null unique,
    enterprise_desc             varchar(256) default null,
    enterprise_logo             varchar(256) default null,
    enterprise_appname          varchar(20)  default 'appname',

    /* foreign keys */

    enterprise_status           int not null default 0,
    enterprise_audit            int not null default 0 COMMENT '0:关，1：开',
    enterprise_user_history     int not null default 0 COMMENT '0:不记录，1:记录',

    PRIMARY KEY (enterprise_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE tianyi_department
(
    department_id               int not null auto_increment,
    department_name             varchar(64) not null,
    department_desc             varchar(1024) default null,

    /* foreign keys */

    department_status           int not null default 0,
    enterprise_id               int not null,

    PRIMARY KEY (department_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE tianyi_user_department
(
    dummy_id                    int not null auto_increment,

    /* foreign keys */

    department_id               int not null default -1,
    user_id                     int not null default -1,

    PRIMARY KEY (dummy_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE tianyi_notification
(
    notification_id             int not null auto_increment,
    notification_url            varchar(100) not null,
    notification_name           varchar(64) not null,
    notification_desc           longblob not null,
    notification_audit_gmt      int not null default 0,
    notification_create_gmt     int not null default 0,

    /* foreign keys */
    notification_status         int not null default 0, 
    department_id               int not null default 0,
    audit_user_id               int default 0,
    enterprise_id               int not null,
    create_user_id              int not null,

    PRIMARY KEY (notification_id)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3;

CREATE TABLE tianyi_notification_user
(
    dummy_id                    int not null auto_increment,

    /* foreign keys */

    receive_status              int not null default '0' COMMENT '0:没有收到，1：收到',
    user_id                     int not null,
    notification_id             int not null,

    PRIMARY KEY  (dummy_id)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE tianyi_option
(
    option_id                   int not null auto_increment,
    option_count                int not null default 0,
    option_content              varchar(1024),

    /* foreign keys */

    vote_id              int not null,

    PRIMARY KEY (option_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE tianyi_permission
(
    permission_id               int not null auto_increment,
    permission_name             varchar(1024) not null,
    PRIMARY KEY (permission_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE tianyi_role_status
(
    role_status_id              int not null auto_increment,
    role_status_name            varchar(64) not null,
    PRIMARY KEY (role_status_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

create TABLE tianyi_content_status
(
    content_status_id           int not null auto_increment,
    content_status_name         varchar(64) not null, 

    PRIMARY KEY (content_status_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

create TABLE tianyi_content_type
(
    content_type_id           int not null auto_increment,
    content_type_name         varchar(64) not null, 

    PRIMARY KEY (content_type_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE tianyi_user
(
    user_id                     int not null auto_increment,
    username            	varchar(20) not null unique,
    password        	        varchar(20) not null,
    user_other                  varchar(256) default null,
    user_extra                  varchar(256) default null,
    user_image                  varchar(64) default null,
    user_email                  varchar(32) default null,
    user_realname       	varchar(20) default null,
    user_position               int default 1000,
    user_login_count            int default 0,
    user_last_login_time        int default null,
    user_last_check_time        int default null,

    /* foreign keys */

    user_status                 int not null default 0,
    permission_id               int not null,
    enterprise_id               int not null,
    contacts_id                 int not null default 0,

    PRIMARY KEY (user_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE tianyi_contacts
(
    contacts_id                 int not null auto_increment,
    contacts_name               varchar(20) not null,
    contacts_cell               varchar(12) default null,
    contacts_title              varchar(12) default null,
    contacts_hometel            varchar(12) default null,
    contacts_officetel          varchar(12) default null,

    /* foreign keys */
    enterprise_id               int not null,

    PRIMARY KEY (contacts_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE tianyi_user_vote
(
    dummy_id	                int not null auto_increment,

    /* foreign keys */

    vote_id                     int not null,
    user_id                     int not null,
    option_id                   int not null,

    PRIMARY KEY (dummy_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE tianyi_vote
(
    vote_id                     int not null auto_increment,
    vote_url                    varchar(256) default null,
    vote_type                   int not null default 0,
    vote_name                   varchar(256) not null,
    vote_icon                   varchar(256) default null,
    vote_summary                varchar(100) default null,
    vote_content                varchar(256) not null,
    vote_audit_userid           int not null,
    vote_create_userid          int not null,
    vote_audit_time_gmt         int not null default 0,
    vote_create_time_gmt        int not null default 0,

    /* foreign keys */

    vote_status                 int not null default 1,
    enterprise_id               int not null,
    PRIMARY KEY (vote_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE tianyi_history
(
    history_id                  int not null auto_increment,
    history_gmt                 int not null,
    history_ip                  VARCHAR(235) null,

    /* foreign keys */

    user_id                     int not null, 

    PRIMARY KEY (history_id)
) ENGINE = InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE tianyi_topic
(
    topic_id                   int not null auto_increment,
    topic_tag                  varchar(256) default null COMMENT '扩展：topic_tag',
    topic_content              varchar(1024) not null,
    topic_created_gmt          int not null,
    topic_updated_gmt          int not null,

    /* foreign keys */

    topic_status               int not null default 0,
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

CREATE TABLE tianyi_build
(
    build_id                   int not null auto_increment,
    build_date                 int default 0,
    build_type                 int not null default 0,
    build_version              varchar(32) not null,
    build_comments             varchar(60) default null,

    /* foreign keys */
    enterprise_id              int default 0,

    PRIMARY KEY  (build_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE tianyi_theme
(
    theme_id                   int not null auto_increment,
    theme_name                 varchar(12) not null unique default 'theme1',

    /* foreign keys */
    enterprise_id              int default 0,

    PRIMARY KEY  (theme_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/****************/
/* initial data */
/****************/
/*permissions*/
insert into tianyi_permission(permission_id, permission_name) values(0, '系统管理员'),  (1, '企业管理员'), (2, '企业审核员'), (3, '企业普通用户');

/*users*/
insert into tianyi_user(user_id, username, password, permission_id, enterprise_id) values(0, 'admin', 'linuxred', 0, 0);

/*column*/

insert into tianyi_column(column_id, column_name, enterprise_id) values(0,"默认栏目", 0);

/*role_status*/
insert into tianyi_role_status(role_status_id, role_status_name) values(0, "正常"), (1, "禁用");

/*content_status*/
insert into tianyi_content_status(content_status_id, content_status_name) values(0, "正常"), (1, "删除"), (2, "审核中");

/*content_type*/
insert into tianyi_content_type(content_type_id, content_type_name) values(0, "原创"), (1, "转载");

/*enterprises*/
insert into tianyi_enterprise(enterprise_id, enterprise_name, enterprise_desc) values(0, '中国电信', '中国电信'); 

/*channels*/
insert into tianyi_channel(channel_name) values('Tianyi Channel');


/* test data */
/* enterprise */
insert into tianyi_enterprise(enterprise_name, enterprise_desc) values('laworks', 'laworks'); 
insert into tianyi_enterprise(enterprise_name, enterprise_desc) values('stworks', 'stworks'); 

/* user */
insert into tianyi_user(user_id, username, password, permission_id, enterprise_id) values(1, 'laadmin', 'linuxred', 1, 1);
insert into tianyi_user(user_id, username, password, permission_id, enterprise_id) values(2, 'laauditor', 'linuxred', 2, 1);
insert into tianyi_user(username, password, permission_id, enterprise_id) values('lauser1', 'linuxred', 3, 1), ('lauser2', 'linuxred', 3, 1), ('lauser3', 'linuxred', 3, 1), ('lauser4', 'linuxred', 3, 1);

/* contacts */
insert into tianyi_contacts(contacts_name, contacts_cell, contacts_hometel, contacts_officetel, enterprise_id) 
values
('contacts1', '10001', '20001', '30001', 1), 
('contacts2', '10002', '20002', '30002', 1), 
('contacts3', '10003', '20003', '30003', 1), 
('contacts4', '10004', '20004', '30004', 1);


