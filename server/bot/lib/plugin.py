#!/usr/bin/env python
#-*- coding: utf-8 -*-，
#coding = utf-8
import sys
reload(sys)
sys.setdefaultencoding('utf-8')

import os

#setting up log
import logging

#setting update traceback
import traceback

log_dir = "log"
if not os.path.exists(log_dir):
    os.mkdir(log_dir)

logging.basicConfig(level=logging.DEBUG,
                format='%(asctime)s %(filename)s[line:%(lineno)d] %(levelname)s %(message)s',
                datefmt='%a, %d %b %Y %H:%M:%S',
                filename='%s/bot.log' % (log_dir),
                filemode='a')

#3rd modules
import MySQLdb

class Plugin:
    def __init__(self):
        self.db = MySQLdb.connect(host='localhost', user='root',passwd='linuxred', db='server')
        self.cursor = self.db.cursor()
        self.dict_data = {}

        # enterprise data
        self.create_user_id = -1
        self.enterprise_id = 0
        self.column_dict = {}

    def run(self):
        self.get_data()
        self.add_database_record()
        return True

    def get_enterprise_logo(self, eid):
        logo = '../upload/theme/unpacked/lg.png' 
        if not os.path.exists(logo):
            return null

        return logo

    def get_column_icon(self, cid):
        sql = 'select column_icon from tianyi_column where column_id = %s ' % cid
        self.cursor.execute(sql)
        icon = self.cursor.fetchone()[0]

        return icon

    def unique_input_data():
        """TODO: verify whether all record exists in database"""
        pass

    def dump_content_tohtml(self, title, content, filepath):
        html = """
        <html>
            <title>%s</title>
            <body>%s</body>
        </html>
        """
        fp = file(filepath, 'w')
        fp.write(html % (title, content))
        fp.close()

    def get_data(self):
        """ should rewrite by subclass """
        return True

    def add_database_record(self):
        if not self.dict_data:
            return True
        for column_id, article_list in self.dict_data.iteritems():
            if not article_list:
                continue
            values = []
            value = None
            for article in article_list:
                #value = ' ("%s", "%s", %s, %s, %s, %s, "%s", "%s") ' % (article['name'], article['content'].decode('utf-8'), self.enterprise_id, self.create_user_id, column_id, self.create_user_id, article['url'], article['icon'])

                value = (article['name'], article['content'], self.enterprise_id, self.create_user_id, column_id, self.create_user_id, article['url'], article['icon'])
                values.append(value)

                #sql = "insert into tianyi_article(article_name, article_content, enterprise_id, create_user_id, column_id, audit_user_id, article_url, article_icon) values%s; "  % (",".join(values))
                sql = 'insert into tianyi_article(article_name, article_content, enterprise_id, create_user_id, column_id, audit_user_id, article_url, article_icon) values(%s, %s, %s, %s, %s, %s, %s, %s) ' 

            try:
                self.cursor.execute("set names utf8")
                ret = self.cursor.executemany(sql, values)
                #ret = self.cursor.execute(sql.decode('utf-8'), value)
                logging.debug("sql execute return code: %s" % (ret))
                self.db.commit()
            except Exception, e:
                logging.error("Leo: sql %s" % (sql))

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

