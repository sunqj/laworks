<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<response>
    <result value="<?php echo $result; ?>" info="<?php echo $info; ?>" />
        <?php if(!$result): ?>
        <data>
            <articles>
                <?php foreach($articles as $article): ?>
                    <article 
                    id="<?php echo $article->article_id; ?>"
                    name="<?php echo $article->article_name; ?>" 
                    desc="<?php echo $article->article_summary; ?>"
                    url="<?php echo $article->article_url;?>"
                    type="<?php echo $article->article_type; ?>"
                    icon="<?php echo $article->article_icon; ?>"
                    />
                <?php endforeach; ?>
            </articles>
        </data>
        <?php endif; ?>
</response>


<?php
/* 
<?xml version="1.0" encoding="UTF-8"?>
<response>
    <result value="0" info="get artile list success"/>
    <data>
        <articles>
            <article id="3" name="我的文章3" desc="" url="/server/static/article/1/201303/1364304380.html" type="0" icon=""/>
            <article id="11" name="asdfasdf" desc="" url="/server/static/article/1/201303/1364315060.html" type="0" icon=""/>
        </articles>
    </data>
</response>
*/
?>
