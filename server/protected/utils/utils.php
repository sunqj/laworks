<?php

function getUploadDirAbsolute()
{
    return Yii::app ()->getBasePath () . "/../upload/";
}

function getUploadDirRelative()
{
    return "/server/upload/";
}

function getEnterpriseLogoDirAbsolute()
{
    $dir = getUploadDirAbsolute() . "enterprise_logo/" . Yii::app()->user->enterprise_id . "/";
    return $dir;
}

function getEnterpriseLogoDirRelative()
{
    $dir = getUploadDirRelative() . "enterprise_logo/" . Yii::app()->user->enterprise_id . "/";
    return $dir;
}



function getArticleIconDirAbsolute()
{
    $dir = getUploadDirAbsolute() . "article_icon/" . Yii::app()->user->enterprise_id . "/";
    return $dir;
}

function getArticleIconDirRelative()
{
    $dir = getUploadDirRelative() . "article_icon/" . Yii::app()->user->enterprise_id . "/";
    return $dir;
}


function getArticleImageDirAbsolute()
{
    $dir = getUploadDirAbsolute() . "article_image/" . Yii::app()->user->enterprise_id . "/";
    return $dir;
}

function getArticleImageDirRelative()
{
    $dir = getUploadDirRelative () . "article_image/" . Yii::app()->user->enterprise_id . "/";
    return $dir;
}



function getVoteImageDirAbsolute()
{
    $dir = getUploadDirAbsolute() . "vote_image/" . Yii::app()->user->enterprise_id . "/";
    return $dir;
}


function getVoteImageDirRelative()
{
    $dir = getUploadDirRelative() . "vote_image/" . Yii::app()->user->enterprise_id . "/";
    return $dir;
}


function getVoteIconDirAbsolute()
{
    $dir = getUploadDirRelative() . "vote_icon/" . Yii::app()->user->enterprise_id . "/";
    return $dir;
}

function getVoteIcondirRelative()
{
    $dir = getUploadDirRelative() . "vote_icon/" . Yii::app()->user->enterprise_id . "/";
    return $dir;
}

function getArticleStaticDirAbsolute()
{
    return Yii::app()->getBasePath() . "/../static/" . Yii::app()->user->enterprise_id;
}

function getArticleStaticDirRelative()
{
    return "/server/static/" . Yii::app()->user->enterprise_id;
}

function getColumnIconDirAbsolute()
{
    $dir = getUploadDirAbsolute() . "column_icon/" . Yii::app()->user->enterprise_id . "/";
    return $dir;
}

function getColumnIconDirRelative()
{
    $dir = getUploadDirRelative() . "column_icon/" . Yii::app()->user->enterprise_id . "/";
    return $dir;
}



