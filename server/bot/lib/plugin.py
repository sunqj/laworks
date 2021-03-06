#!/usr/bin/env python
#-*- coding: utf-8 -*-，
#coding = utf-8
import sys
import os
import time

#setting up log
import logging

#setting update traceback
import traceback

log_dir = "log"
if not os.path.exists(log_dir):
    os.mkdir(log_dir)

#set up logger
logging.basicConfig(level=logging.DEBUG,
                format='%(asctime)s %(filename)s[line:%(lineno)d] %(levelname)s %(message)s',
                datefmt='%a, %d %b %Y %H:%M:%S',
                filename='%s/bot.log' % (log_dir),
                filemode='a')

#3rd modules
import MySQLdb

class Plugin:
    def __init__(self):
        """init data"""
        self.db = MySQLdb.connect(host='localhost', user='root',passwd='linuxred', db='server')
        self.cursor = self.db.cursor()
        self.dict_data = {}

        # enterprise data
        self.create_user_id = -1
        self.enterprise_id = 0

    def run(self):
        """wrapper of get_data and add_database_record"""
        self.get_data()
        self.add_database_record()
        return True

    def get_enterprise_logo(self, eid):
        """get logo url of an enterprise"""
        logo = '../upload/theme/unpacked/lg.png' 
        if not os.path.exists(logo):
            return null

        return logo

    def get_column_icon(self, cid):
        """ get icon url of a column"""
        sql = 'select column_icon from tianyi_column where column_id = %s ' % cid
        self.cursor.execute(sql)
        icon = self.cursor.fetchone()[0]

        return icon

    def get_exists_data(self):
        """return a list of content that exists in database"""

        article_name_list = []
        for column_id, article_list in self.dict_data.iteritems():
            for article in article_list:
                article_name_list.append(article['name'])
        
        if not article_name_list:
            return []

        exist_article = []
        data = None
        in_str = "( '%s' )" % ("', '".join(article_name_list))
        sql = 'select article_name from tianyi_article where article_name in %s' % (in_str)

        try:
            self.cursor.execute("set names utf8")
            self.cursor.execute(sql)
            data = self.cursor.fetchall()
        except:
            logging.error("Leo: sql %s, error: %s" % (sql, e))
            return None

        if not data:
            return None

        for record in data:
            exist_article.append(record[0])

        return exist_article

    def translate_url(self, tag, site):
        """translate relative url to absolute url"""
        imgtags = tag.findAll('img')
        for imgtag in imgtags:
            for index, attr in enumerate(imgtag.attrs):
                if attr[0] == 'src':
                    imgtag.attrs[index] = (attr[0], "%s/%s" % (site, attr[1]))

        #atags =  tag.findAll('a')
        #for atag  in atags:
        #    pass

        return tag 


    def get_site_basedir(self):
        """the base directory of whole site"""
        return "/server"

    def dump_content_tohtml(self, title, content, column_id):
        """dump given title and content as a html file, and return relative url"""
        cwd = os.getcwd()
        filedir= "/static/article/%s/%s/" % (column_id, time.strftime("%Y%m"))  

        rel_dir = "..%s" % (filedir)
        if not os.path.exists(rel_dir):
            os.mkdir(rel_dir)

        filename = "%s.html" % (int(time.time()))
        real_filepath = "../%s/%s" % (filedir, filename)
        url = "%s/%s/%s" %(self.get_site_basedir(), filedir, filename)

        html = """<html>
        <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
            <title>%s</title>
        </head>
        <body>%s</body>
        </html>
        """
        fp = file(real_filepath, 'w')
        fp.write(html % (title, content))
        fp.close()

        return url

    def get_data(self):
        """ 
        virtual method, should rewrite by subclass 
        this method gets page data from remote site
        """
        return True

    def add_database_record(self):
        """
        add all data in self.dict_data to database
        """
        if not self.dict_data:
            return True

        existed_articles = self.get_exists_data()
        
        for column_id, article_list in self.dict_data.iteritems():
            if not article_list:
                continue
            values = []
            # value = None
            for article in article_list:
                if existed_articles and article['name'] in existed_articles:
                    continue

                value = (article['name'], article['content'], self.enterprise_id, self.create_user_id, column_id, self.create_user_id, article['url'], article['icon'])
                values.append(value)

            sql = 'insert into tianyi_article(article_name, article_content, enterprise_id, create_user_id, column_id, audit_user_id, article_url, article_icon) values(%s, %s, %s, %s, %s, %s, %s, %s) ' 

            try:
                self.cursor.execute("set names utf8")
                ret = self.cursor.executemany(sql, values)
                logging.debug("sql execute return code: %s" % (ret))
                self.db.commit()
            except Exception, e:
                logging.error("Leo: sql %s, error: %s" % (sql, e))

        self.cursor.close()
        self.db.close()

        
        return True

class PluginRunner:
    def __init__(self, classname):
        self.classname = classname
        self.db = MySQLdb.connect(host='localhost', user='root',passwd='linuxred', db='server', charset='utf8')
        self.cursor = self.db.cursor()
        self.plugin_list = []
        self.plugin_dict = {}
        self.cwd = os.getcwd()
        self.plugin_dir = self.cwd + "/plugin"

    def load_plugins(self):
        """load all plugins in plugin_dir"""
        for root, directories, files in os.walk(self.plugin_dir):
            for plugin_file in files:
                if not plugin_file.endswith(".py"):
                    continue
                
                ns = {}
                plugin_path = "%s/%s" %(self.plugin_dir, plugin_file)
                self.plugin_list.append(plugin_path)

                try:
                    execfile(plugin_path, ns)
                except:
                    logging.error("unable to load plugin: %s" %(plugin_file))
                    logging.error("reason: %s" %(traceback.format_exc()))

                if ns.has_key(self.classname):
                    try:
                        m = ns[self.classname]()
                    except Exception, e:
                        logging.error("unable to init plugin: %s, %s" %(plugin_file, e))
                        logging.error("plugin trace back: %s" % (traceback.format_exc()))
                        continue
                    
                    self.plugin_dict[plugin_path] = m

        logging.debug("Plugin list: %s" % (str(self.plugin_list)))

    def run(self):
        self.load_plugins()
        for plugin_path, plugin_obj in self.plugin_dict.iteritems():
            try:
                plugin_obj.run()
            except Exception, e:
                logging.error("pluin: %s failed, reason: %s" % (plugin_path, e))
                logging.error("plungin trace back: %s" % (traceback.format_exc()))
                continue
        return True

