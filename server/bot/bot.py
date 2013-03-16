#!/usr/bin/env python

import feedparser

if __name__ == '__main__':
    print "Leo's feed parse daemon"


    feed = feedparser.parse("http://news.163.com/special/00011K6L/rss_newstop.xml")
    print feed.feed.title
    
    print "fetched %s news" % (len(feed.entries)) 

    print "print news one by one"
    for index,item in enumerate(feed.entries):
        #Title
        print str(index + 1) + ". Title:" + item.title

        #Summary
        summary = item['summary_detail'].value.split("......")[0]
        print summary
        
        #Link
        link = item['link'] 
        print "Link:\n" + link

        print



        

    
    


