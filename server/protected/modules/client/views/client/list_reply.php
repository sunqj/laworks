<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<response>
    <result value="<?php echo $result; ?>" info="<?php echo $info; ?>" />
        <?php if(!$result): ?>
        <data>
            <replies>
                <?php foreach($replies as $reply): ?>
                    <reply  
                    content="<?php echo $reply->reply_content; ?>"  
                    id="<?php echo $reply->reply_id; ?>" 
					user="<?php echo $reply->userTable->username; ?>" 
					/>
                <?php endforeach; ?>
            </replies>
        </data>
    <?php endif; ?>
</response>