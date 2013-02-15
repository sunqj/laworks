<xml version="1.0" encoding="UTF-8" />
<response>
    <result value="<?php echo $result; ?>" info="<?php echo $info; ?>" />
    <?php if(!$result): ?>
        <update latest="<?php echo $newver; ?>" type="<?php echo $type; ?>" url="<?php echo $url; ?>" />
        <data>
                <?php if(count($columns)):?>
                    <columns>
                        <?php foreach($columns as $column): ?>
                            <column name="<?php echo $column; ?>" />
                        <?php endforeach; ?>
                    </columns>
                <?php endif; ?>
        </data>
    <?php endif; ?>
</response>

<?php
/* return xml example:
<response>
    <result value="0" info="login success" />
    <<update latest="1360948973" type="1" url="/server/apk/1/caizhengting_sx-1360948973.apk" />
    <data>
        <columns>
            <column name="column1" />
            <column name="column2" />
            <column name="column3" />
        </columns>
    </data>
</response>


*/
?>
