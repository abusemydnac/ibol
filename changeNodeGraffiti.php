<?php

const PRE_CMD = 'docker exec node ironfish';
$graffiti_file = '/root/graffiti';
$weeklink_grattifi = 'http://43.154.249.28:8000/index.php?r=ironfishacc/getgraffiti&task=newminer';

changeNodeGraffiti($weeklink_grattifi, $graffiti_file);

function changeNodeGraffiti($weeklink_grattifi, $graffiti_file)
{

    if (is_file($graffiti_file)) {

        echo "已存在默认阶段不需要部署.......\r\n";
        $grattifi = file_get_contents($graffiti_file);
        $grattifi = trim($grattifi);
        if($grattifi){
            echo $grattifi;
            $data = shell_exec(PRE_CMD . " config:set blockGraffiti  '" . $grattifi . "'");
            echo $data;
            $data = shell_exec(PRE_CMD . " status  ");
            echo $data;
            return '';
        }
      
    }


    echo "获取需要部署的node.......\r\n";
    $grattifi = file_get_contents($weeklink_grattifi);
    $grattifi = trim($grattifi);
    if (strlen($grattifi) > 20) {
        echo "有点异常...\r\n";
        echo $grattifi;
        sleep(60);
    }
    if (empty($grattifi)) {
        echo "系统待执行任务为空....等待60秒...\r\n";
        sleep(60);
        return '';
    }
    echo "获取到需要执行" . $grattifi . ".......\r\n";

    $data = shell_exec(PRE_CMD . " config:set blockGraffiti  '" . $grattifi . "'");
    echo $data;
    file_put_contents($graffiti_file, $grattifi);
}


exit;
