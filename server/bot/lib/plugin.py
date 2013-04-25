#!/usr/bin/env python

import sys
import os

import MySQLdb

class Plugin:
    def __init__(self, filename):
        self.filename = filename

    def run(self):
        """ should rewrite by subclass """
        return True


class PluginRunner:
    def __init__(self, plugin_list):
        self.db = MySQLdb.connect(host='localhost', user='root',passwd='linuxred', db='server')
        self.cursor = self.db.cursor()
        self.plugin_list = []
        self.cwd = os.getcwd()
        self.plugin_dir = self.cwd + "/plugin"

    def load_plugins(self):
        """load all plugins in plugin_dir"""
        ns = {}
        for root, directories, files in os.walk(self.plugin_dir):
            for pfile in files:
                if pfile.endswith(".py"):

                    self.plugin_list.append(pfile)
                    try:
                        execfile(pfile, ns)
                    except:
                        pass
        
        return ns


    def run(self):
        sql = "select * from tianyi_article"
        count = self.cursor.execute(sql)
        rset  = self.cursor.fetchall()

        return rset

def test():
    return "this is a test"
