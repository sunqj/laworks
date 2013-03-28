<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<response>
    <result value="<?php echo $result; ?>" info="<?php echo $info; ?>" />
        <?php if(!$result): ?>
        <data>
            <contacts>
                <contact name="1" cell="11" home="12" office="13" />
                <contact name="2" cell="21" home="22" office="23" />
            </contacts>
        </data>
    <?php endif; ?>
</response>