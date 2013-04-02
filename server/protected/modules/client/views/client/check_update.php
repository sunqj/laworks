<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<response>
    <result value="<?php echo $result; ?>" info="<?php echo $info; ?>" />
        <?php if(!$result): ?>
        <data>
             <update latest="<?php echo $newver; ?>" type="<?php echo $type; ?>" url="<?php echo $url; ?>" />
        </data>
    <?php endif; ?>
</response>