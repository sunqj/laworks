<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<response>
    <result value="<?php echo $result; ?>" info="<?php echo $info; ?>" />
        <?php if(!$result): ?>
        <data>
            <votes>
                <?php foreach($votes as $vote): ?>
                    <vote 
                    name="<?php echo $vote->vote_name; ?>" 
                    summary="<?php echo $vote->vote_summary; ?>" 
                    content="<?php echo $vote->vote_content; ?>" 
                    icon="<?php echo $vote->vote_icon; ?>" 
                    id="<?php echo $vote->vote_id; ?>" />
                    
                <?php endforeach; ?>
            </votes>
        </data>
    <?php endif; ?>
</response>
