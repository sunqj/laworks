#!/usr/bin/env python
#-*- encoding:UTF-8 -*-
import os
import sys

sys.path.append("%s/lib" % (os.getcwd()))

import plugin

if __name__ == '__main__':
    r = plugin.PluginRunner("BotRC")
    print r.run()
