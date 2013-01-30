<?php



function getBranchList()
{
    require Yii::app()->getBasePath() . "/utils/StringUtils.php";
    $SOURCE_DIR = "/backup/android-workspace/devilworks-platform/";
    $output = `cd $SOURCE_DIR; git branch`;
    $output = explode("\n", trim($output));
    $retVal = Array();
    $lineIndex = 0;
    
    foreach($output as $line)
    {
        $line = trim($line);
        if(startsWith($line, "* "))
        {
            $tempArray = explode(" ", $line);
            $retVal["$lineIndex"] = $tempArray[1];
        }
        else
        {
            $retVal["$lineIndex"] = $line;
        }
        ++$lineIndex;
    }

    return $retVal;
}

