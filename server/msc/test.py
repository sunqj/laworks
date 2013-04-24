#!/usr/bin/env python

import urllib2
from BeautifulSoup import BeautifulSoup
import MySQLdb
import re

site_root = "http://yjb.shaanxi.gov.cn"
url = "http://yjb.shaanxi.gov.cn/IssuedContentAction.do?dispatch=vContentListBySubid&columninfoid=26";


if __name__ == '__main__':
    database = MySQLdb.connect(host='localhost', user='root',passwd='linuxred', db='server')
    cursor = database.cursor()
    sql = 'select * from tianyi_user'
    count = cursor.execute(sql)
    users = cursor.fetchall()
    print users

    page = urllib2.urlopen(url)
    soup = BeautifulSoup(page)
    links = soup.findAll(title=re.compile('.*'));
    articles = []

    for index, link in enumerate(links):
        #print "%02s: \ntitle: %s\nlink:%s%s" %(index, link.get('title'), site_root, link.get('href'))
        #print
        articles.append({'title': link.get('title'), 'link': link.get('href')})

    for article in articles:
        article_url = "%s%s" % (site_root, article['link'])

        article_page = urllib2.urlopen(article_url)
        htm = article_page.read()
        content = unicode(htm,'gb2312','ignore').encode('utf-8','ignore')
        
        asoup = BeautifulSoup(content)
        tdtags = asoup.findAll('td', attrs={'class':'font19'})
        print tdtags

        tdtag = tdtags[0]
        fonttag = tdtag.findAll('font')[0]

        print article['title']
        if fonttag.text:
            import pdb
            pdb.set_trace()
            print "fonttag:"
            ptags = fonttag.findAll('p|div')
            if ptags:
                for ptag in ptags:
                    print str(ptag)
            else:
                print fonttag.text
        else:
            print "ptag:"
            ptags = tdtag.findAll('p')
            for ptag in ptags:
                ptag_content = str(ptag)
                print ptag_content

        print 
            
    
