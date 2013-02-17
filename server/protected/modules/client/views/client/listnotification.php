<xml version="1.0" encoding="UTF-8" />
<response>
    <result value="<?php echo $result; ?>" info="<?php echo $info; ?>" />
    <?php if(!$result): ?>
        <data>
<?php if(count($notificationList)):?>
    <?php foreach($notificationList as $n): ?>
    <notification name="<?php echo $n->notification_name; ?>" id="<?php echo $n->notification_id;?>" url="<?php echo $n->notification_url; ?>" />
    <?php endforeach; ?>
<?php endif; ?>
        </data>
    <?php endif; ?>
</response>

<?php
/* return xml example:

<xml version="1.0" encoding="UTF-8" />
<response>
    <result value="0" info="list notification success" />
        <data>

        </data>
</response>
*/
?>
