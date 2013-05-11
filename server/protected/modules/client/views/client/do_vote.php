<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<response>
    <result value="<?php echo $result; ?>" info="<?php echo $info; ?>" />
        <?php if(!$result): ?>
        <data>
            <options>
                <?php foreach($options as $option): ?>
                    <option 
                    id="<?php echo $option->option_id; ?>" 
                    count="<?php echo $option->option_count; ?>"  />
                <?php endforeach; ?>
            </options>
        </data>
    <?php endif; ?>
</response>