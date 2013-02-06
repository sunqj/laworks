<xml version="1.0" encoding="UTF-8" />
<response>
    <result value="0" info="" />
    <update latest="<?php echo $latestVer; ?>" type="<?php echo $type; ?>" />
    <data>
        <?php if(count($columns)):?>
            <columns>
                <?php foreach($columns as $column): ?>
                    <column name="<?php echo $column; ?>" />
                <?php endforeach; ?>
            </columns>
        <?php endif;?>
    </data>
</response>

<?php
/* return xml example:
<xml version="1.0" encoding="UTF-8" />
<response>
    <result value="0" />
    <data>
        <update latest="aaa_123" type="1" />
        <columns>
            <column name="columnA" />
            <column name="columnB" />
        </columns>
    </data>
</response>
*/
?>
