<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<response>
    <result value="<?php echo $result; ?>" info="<?php echo $info; ?>" />
        <?php if(!$result): ?>
        <data>
            <topics>
                <?php foreach($topics as $topic): ?>
                    <topic  
                    content="<?php echo $topic->topic_content; ?>" 
                    id="<?php echo $topic->topic_id; ?>" />
                <?php endforeach; ?>
            </topics>
        </data>
    <?php endif; ?>
</response>