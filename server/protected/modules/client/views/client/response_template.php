<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<response>
    <result value="<?php echo $result; ?>" info="<?php echo $info; ?>" />
        <?php if(!$result): ?>
        <data>
            <columns>
                <?php foreach($columns as $column): ?>
                    <column 
                    name="<?php echo $column->column_name; ?>" 
                    id="<?php echo $column->column_id; ?>" />
                <?php endforeach; ?>
            </columns>
        </data>
    <?php endif; ?>
</response>