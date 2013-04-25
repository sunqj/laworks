#!/usr/bin/env python

import os
import sys

sys.path.append("%s/lib" % (os.getcwd()))

import plugin

if __name__ == '__main__':
    print plugin.test()


    n = plugin.Plugin("filename")
    print n.run()

    r = plugin.PluginRunner(["filename"])
    print r.load_plugins()
    print r.run()
