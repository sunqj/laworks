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
<?xml version="1.0" encoding="UTF-8"?>
<response>
    <result value="0" info="login success"/>
    <data>
        <update latest="0" type="0" url=""/>
        <user id="3" username="lauser1" realname=""/>
        <enterprise id="1" name="laworks" theme="3"/>
        <columns>
            <column name="值班信息" id="1"/>
            <column name="日程安排" id="2"/>
            <column name="公共信息" id="3"/>
            <column name="紧急事件" id="5"/>
            <column name="工作信息" id="6"/>
            <column name="联系人" id="-1"/>
            <column name="通知" id="-2"/>
            <column name="设置" id="-3"/>
        </columns>
    </data>
</response>

*/
?>
