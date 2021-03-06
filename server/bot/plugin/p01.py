#!/usr/bin/env python 
#-*- coding: utf-8 -*-，
#coding = utf-8
import os
import re
import sys
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
        self.enterprise_id = 1
        self.site = "http://yjb.shaanxi.gov.cn/"
        self.column_dict = {
                1:["IssuedContentAction.do?dispatch=vContentListBySubid&columninfoid=23",
                   "IssuedContentAction.do?dispatch=vContentListBySubid&columninfoid=24",
                   "IssuedContentAction.do?dispatch=vContentListBySubid&columninfoid=25"],
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
            for index_page_url in url_list:
                if not index_page_url.strip():
                    continue
                print index_page_url
                page_url = self.site + index_page_url

                try:
                    index_page = urllib2.urlopen(page_url, timeout=15)
                except Exception, e:
                    print e

                index_html = index_page.read()
                index_page_content = unicode(index_html,'gb2312').encode('utf-8')
                index_page_soup = BeautifulSoup(index_page_content)
                links = index_page_soup.findAll(title=re.compile(".*"))
                if not links:
                    continue

                for index, link in enumerate(links):
                    article_url = self.site + link.get('href')
                    print article_url
                    article_page = None
                    try:
                        article_page = urllib2.urlopen(article_url, timeout=10)
                    except:
                        continue

                    htm = article_page.read()
                    try:
                        content = unicode(htm,'gb2312').encode('utf-8')
                    except:
                        pass
                        continue

                    article_content_soup = BeautifulSoup(content)
                    titletags = article_content_soup.findAll('title')
                    
                    article_name = titletags[0].renderContents()
                    tdtags = article_content_soup.findAll('td', attrs={'class':'font19'})
                    
                    if not tdtags:
                        continue

                    tdtags = tdtags[0]

                    fonttags =  article_content_soup.findAll('td', attrs={'class':'font19'})
                    fonttag = fonttags[0]

                        
                    #article_content 
                    article = { }

                    
                    article['name'] = article_name
                    tag = None
                    if fonttag.text:
                        tag = fonttag
                        #article['content'] = fonttag.renderContents()
                    else:
                        tdtag.font.replaceWith("")
                        tag = tdtag
                        #article['content'] = tdtag.renderContents()
                    
                    tag = self.translate_url(tag, self.site) 

                    #article_icon
                    imgtags = tag.findAll('img')

                    article['icon'] = '' 
                    if imgtags:
                        article['icon'] = imgtags[0].get('src')
                    
                    #article content
                    article['content'] = tag.renderContents()

                    url = self.dump_content_tohtml(article_name, article['content'], column_id)
                    
                    article['url'] = url
                    column_article_list.append(article)
                    # debug purpose, just add one line
                    # break
                    

            self.dict_data[column_id] = column_article_list 

        return True

