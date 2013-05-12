<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<response>
    <result value="<?php echo $result; ?>" info="<?php echo $info; ?>" />
        <?php if(!$result): ?>
        <data>
            <options type="<?php echo $type; ?>" voted="<?php echo $voted; ?>"> 
                <?php foreach($options as $option): ?>it stat
                    <option 
                    content="<?php echo $option->option_content; ?>" 
                    id="<?php echo $option->option_id; ?>"
                    count="<?php echo $option->option_count; ?>" />
                <?php endforeach; ?>
            </options>
        </data>
    <?php endif; ?>
</response>