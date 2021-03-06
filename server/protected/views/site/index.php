<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<?php 

/*
<h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>

<p>Congratulations! You have successfully created your Yii application.</p>

<p>You may change the content of this page by modifying the following two files:</p>
<ul>
	<li>View file: <code><?php echo __FILE__; ?></code></li>
	<li>Layout file: <code><?php echo $this->getLayoutFile('main'); ?></code></li>
</ul>

<p>For more details on how to further develop this application, please read
the <a href="http://www.yiiframework.com/doc/">documentation</a>.
Feel free to ask in the <a href="http://www.yiiframework.com/forum/">forum</a>,
should you have any questions.</p>
*/

?>

<?php if(Yii::app()->user->isGuest): ?>
<p>
请登录
</p>
<?php else: ?>
    <?php if(Yii::app()->user->permission_id == 0): ?>
        <p>电信管理员</p>
        <p>
        <a href="<?php echo YiiBase::app()->createUrl("admin/user/admin"); ?>">用户管理</a>
        </p>

        <p>
        <a href="<?php echo YiiBase::app()->createUrl("admin/enterprise/admin"); ?>">企业管理</a>
        </p>

        <p>
        <a href="<?php echo YiiBase::app()->createUrl("admin/channel/admin"); ?>">频道管理</a>
        </p>

        <p>
        <a href="<?php echo YiiBase::app()->createUrl("admin/news/admin"); ?>">新闻管理</a>
        </p>

    <?php elseif(Yii::app()->user->permission_id == 1): ?>
        <p>企业管理员</p>

        <p>
            <a href="<?php echo YiiBase::app()->createUrl("settings/article/admin"); ?>">文章管理</a>
        </p>

        <p>
            <a href="<?php echo YiiBase::app()->createUrl("settings/vote/admin");?>">投票管理</a>
        </p>

        <p>
            <a href="<?php echo YiiBase::app()->createUrl("settings/notification/admin"); ?>">通知管理</a>
        </p>

        <p>
            <a href="<?php echo YiiBase::app()->createUrl("settings/column/admin"); ?>">栏目管理</a>
        </p>

        <p>
            <a href="<?php echo YiiBase::app()->createUrl("settings/user/admin"); ?>">用户管理</a>
        </p>

        <p>
            <a href="<?php echo YiiBase::app()->createUrl("settings/contacts/admin"); ?>">通讯录管理</a>
        </p>
        
        <p>
            <a href="<?php echo YiiBase::app()->createUrl("settings/department/admin"); ?>">部门管理</a>
        </p>
        
        <p>
            <a href="<?php echo YiiBase::app()->createUrl("settings/enterprise/view", array('id' => Yii::app()->user->enterprise_id)); ?>">企业设置</a>
        </p>
    <?php elseif(Yii::app()->user->permission_id == 2): ?>
        <p>企业审核员</p>
    <?php elseif(Yii::app()->user->permission_id == 5): ?>
        <p>开发人员</p>
        <p>
            <a href="<?php echo YiiBase::app()->createUrl("dev/build/admin"); ?>">构建管理</a>
        </p>
    <?php elseif(Yii::app()->user->permission_id == 6): ?>
        <p>开发人员</p>
        <p>
            <a href="<?php echo YiiBase::app()->createUrl("ux/theme/admin"); ?>">主题管理</a>
        </p>
    <?php else: ?>
        <p>普通用户</p>
    <?php endif; ?>
<?php endif; ?>