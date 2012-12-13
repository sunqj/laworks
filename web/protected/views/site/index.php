<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<h1>欢迎使用<i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>

<p>本系统是电信3G信息发布系统后台程序</p>


<!-- <p>You may change the content of this page by modifying the following two files:</p> -->
<!-- <ul> -->
        <li>View file: <code><?php echo __FILE__; ?></code></li>
        <li>Layout file: <code><?php echo $this->getLayoutFile('main'); ?></code></li>
<!-- </ul>  -->

<!-- <p>For more details on how to further develop this application, please read -->
<!-- the <a href="http://www.yiiframework.com/doc/">documentation</a>. -->
<!-- Feel free to ask in the <a href="http://www.yiiframework.com/forum/">forum</a>, -->
<!-- should you have any questions.</p>  -->

<?php if(!$user): ?>
<p>
请登录
</p>
<?php else: ?>
    <?php if($user->permission_id == 0): ?>
        <p>电信管理员</p>
        <p>
        <a href="<?php echo YiiBase::app()->createUrl("user/index"); ?>">用户管理</a>
        </p>

        <p>
        <a href="<?php echo YiiBase::app()->createUrl("enterprise/admin"); ?>">企业管理</a>
        </p>

        <p>
        <a href="<?php echo YiiBase::app()->createUrl("channel/admin"); ?>">频道管理</a>
        </p>

        <p>
        <a href="<?php echo YiiBase::app()->createUrl("news/admin"); ?>">新闻管理</a>
        </p>
    <?php elseif($user->permission_id == 1): ?>
        <p>企业管理员</p>

        <p>
            <a href="<?php echo YiiBase::app()->createUrl("article/admin"); ?>">文章管理</a>
        </p>

        <p>
            <a href="<?php echo YiiBase::app()->createUrl("notification/admin"); ?>">通知管理</a>
        </p>

        <p>
            <a href="<?php echo YiiBase::app()->createUrl("column/admin"); ?>">栏目管理</a>
        </p>

        <p>
            <a href="<?php echo YiiBase::app()->createUrl("user/admin", 
                array("enterprise_id" => $user->enterprise_id)); ?>">用户管理</a>
        </p>

        <p>
            <a href="<?php echo YiiBase::app()->createUrl("departent/admin"); ?>">部门管理</a>
        </p>
    <?php elseif($user->permission_id == 2): ?>
        <p>企业审核员</p>
    <?php else: ?>
        <p>普通用户</p>
    <?php endif; ?>
<?php endif; ?>
