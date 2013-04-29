#!/usr/bin/env python 
#-*- encoding:UTF-8 -*-
import os
import re
import sys
import time
import logging
import urllib2

sys.path.append("%s/../lib" % (os.getcwd()))
#third party libs

#self libs
import plugin

#BeautifulSoup
from BeautifulSoup import BeautifulSoup

class BotRC(plugin.Plugin):
    def __init__(self):
        plugin.Plugin.__init__(self)
        self.entierprise_id = 2
        self.site = "http://yjb.shaanxi.gov.cn/"
        self.column_dict = {
                1:["IssuedContentAction.do?dispatch=vContentListBySubid&columninfoid=23"],
                   #"IssuedContentAction.do?dispatch=vContentListBySubid&columninfoid=24",
                   #"IssuedContentAction.do?dispatch=vContentListBySubid&columninfoid=25"],
                2:[],
                3:[],
                4:[],
                5:[],
                6:[""]
                }


    def get_data(self):
        for column_id, url_list in self.column_dict.iteritems():

            if not url_list:
                continue

            column_article_list = []
            for index_page in url_list:
                if not index_page.strip():
                    continue
                print index_page
                page_url = self.site + index_page

                try:
                    index_page_content = urllib2.urlopen(page_url, timeout=15)
                except Exception, e:
                    print e
                index_page_soup = BeautifulSoup(index_page_content.read())
                links = index_page_soup.findAll(title=re.compile(".*"))
                if not links:
                    continue

                for index, link in enumerate(links):
                    article_url = self.site + link.get('href')
                    print article_url
                    article_name = link.get('title')
                    article_page = None
                    try:
                        article_page = urllib2.urlopen(article_url, timeout=10)
                    except:
                        continue

                    htm = article_page.read()
                    content = unicode(htm,'gb2312','ignore').encode('utf-8','ignore')
                    article_content_soup = BeautifulSoup(content)

                    tdtags = article_content_soup.findAll('td', attrs={'class':'font19'})
                    
                    if not tdtags:
                        continue

                    tdtags = tdtags[0]
                    

                    fonttags =  article_content_soup.findAll('td', attrs={'class':'font19'})
                    fonttag = fonttags[0]

                    #article_icon
                    imgtags = tdtags.findAll('img')
                        
                    #article_content 
                    article = { }

                    article['icon'] = '' 
                    if imgtags:
                        article['icon'] = self.site + imgtags[0].get('src')

                    article['name'] = article_name
                    if fonttag.text:
                        article['content'] = fonttag.renderContents()
                    else:
                        tdtag.font.replaceWith("")
                        article['content'] = tdtag.renderContents()

                    cwd = os.getcwd()
                    filedir= "/static/article/%s/%s/" % (column_id, time.strftime("%Y%m"))
                    rel_dir = "..%s" % (filedir)
                    if not os.path.exists(rel_dir):
                        os.mkdir(rel_dir)

                    filename = "%s.html" % (int(time.time()))

                    real_filepath = "../%s/%s" % (filedir, filename)
                    
                    #self.dump_content_tohtml(article_name, article['content'].encode('utf-8'), real_filepath)
                    
                    article['url'] = "%s/%s" % (filedir, filename)
                    column_article_list.append(article)
                    # debug purpose, just add one line
                    #break
                    

            self.dict_data[column_id] = column_article_list 

        return True

