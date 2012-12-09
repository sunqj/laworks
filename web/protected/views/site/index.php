<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<h1>欢迎使用<i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>

<p>本系统是电信3G信息发布系统后台程序</p>

<!-- 
<p>You may change the content of this page by modifying the following two files:</p>
<ul>
        <li>View file: <code><?php echo __FILE__; ?></code></li>
        <li>Layout file: <code><?php echo $this->getLayoutFile('main'); ?></code></li>
</ul> 

<p>For more details on how to further develop this application, please read
the <a href="http://www.yiiframework.com/doc/">documentation</a>.
Feel free to ask in the <a href="http://www.yiiframework.com/forum/">forum</a>,
should you have any questions.</p> 
--!>

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
