#!/usr/bin/env python
#-*- encoding:UTF-8 -*-
import os
import sys
import logging

sys.path.append("%s/../lib" % (os.getcwd()))

import MySQLdb

import plugin


class BotRC(plugin.Plugin):
    def __init__(self):
        plugin.Plugin.__init__(self)
        self.entierprise_id = 1
        self.column_dict = {}

    def get_data(self):
        self.dict_data = {
                1:[{'name': 'test', 'content': 'test',
                    'url': 'url', 'icon': 'test'}, {}]
                }
        return True

