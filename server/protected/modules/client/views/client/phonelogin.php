<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<response>
    <result value="<?php echo $result; ?>" info="<?php echo $info; ?>" />
    <?php if(!$result): ?>
        <data>
                <?php if(count($columns)):?>
                    <update latest="<?php echo $newver; ?>" type="<?php echo $type; ?>" url="<?php echo $url; ?>" />
                    <user id="<?php echo $user->user_id; ?>" username="<?php echo $user->username ;?>" realname="<?php echo $user->user_realname; ?>" />
                    <enterprise id="<?php echo $user->enterpriseTable->enterprise_id; ?>" 
                    			name="<?php echo $user->enterpriseTable->enterprise_name; ?>"
                    			theme="<?php echo $theme?>" 
                    				/>
                    <columns>
                        <?php foreach($columns as $column): ?>
                            <column name="<?php echo $column->column_name; ?>" id="<?php echo $column->column_id; ?>" />
                        <?php endforeach; ?>
                    </columns>
                <?php endif; ?>
        </data>
    <?php endif; ?>
</response>

<?php
/* return xml example:

<xml version="1.0" encoding="UTF-8" />
<response>
    <result value="0" info="login success" />
        <data>
            <update latest="1360948973" type="1" url="/server/apk/1/caizhengting_sx-1360948973.apk" />
            <user id="7" username="18049229109" realname="Leo.C.Wu" />
            <enterprise id="1" name="laworks" />
            <columns>
                <column name="column1" id="1" />
                <column name="column2" id="2" />
                <column name="column3" id="3" />
            </columns>
        </data>
</response>
*/
?>
