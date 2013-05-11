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
        self.enterprise_id = 3
        self.site = "http://www.wngaj.gov.cn"
        self.column_dict = {
                8:[
                   "/info/iList.jsp?cat_id=1315"],
                9:[],
                10:[]
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
                #index_page_content = unicode(index_html,'gb2312').encode('utf-8')
                index_page_content = index_html
                index_page_soup = BeautifulSoup(index_page_content)
                divtags = index_page_soup.findAll("div", attrs={'class': 'news_list_r_list'})
                if(len(divtags) < 0):
                    continue

                divtag = divtags[0]
                links = divtag.findAll(title=re.compile(".*"))

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
                    ##try:
                    #    #content = unicode(htm,'gb2312').encode('utf-8')
                    ##except:
                    #    #pass
                    #    #continue

                    article_content_soup = BeautifulSoup(htm)
                    titletags = article_content_soup.findAll('h1')
                    
                    article_name = titletags[0].renderContents()
                    content_divs = article_content_soup.findAll('div', 
                            attrs={'class':'news_content_l_content'})
                    
                    if(len(content_divs) < 1):
                        continue

                    content_div = content_divs[0]

                    article = { 'icon': None }

                    article_content = content_div.renderContents()

                    article['name'] = article_name
                    imgtags = content_div.findAll('img')

                    if imgtags:
                        article['icon'] = imgtags[0].get('src')
                    
                    article['content'] = article_content

                    url = self.dump_content_tohtml(article_name, article_content, column_id)
                    
                    article['url'] = url
                    column_article_list.append(article)
                    # debug purpose, just add one line
                    # break
                    

            self.dict_data[column_id] = column_article_list 

        return True

