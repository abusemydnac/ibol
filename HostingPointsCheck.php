<?php

const PRE_CMD = 'docker exec node ironfish';
if (count($argv) >= 2) {
    $minNum = $argv[1];
    echo "\r\n" . 'set minNum:' . $minNum . "\r\n";
} else
    $minNum = 1;
if (count($argv) >= 3) {
    $maxNum = $argv[2];
    echo "\r\n" . 'set maxNum:' . $maxNum . "\r\n";
} else
    $maxNum = 1;

for ($i = $minNum; $i <= $maxNum; $i++) {
    echo date("Y-m-d H:i:s") . "|$i/$maxNum| 获取需要部署的node.......\r\n";

    changeNodeGraffiti($i);
}


function changeNodeGraffiti($i)
{

    $graffiti_file = "/root/.node$i/graffiti";
    if (is_file($graffiti_file)) {
        echo "\r\n" . $graffiti_file . "已存在默认阶段查看hosting时长.......\r\n";
        $grattifi = file_get_contents($graffiti_file);
        $grattifi = trim($grattifi);
        $isFinishHosting = getHostingPoints($grattifi);
        if (!$isFinishHosting and $grattifi) {
            echo $grattifi . " 未完成,继续努力 \r\n";
            $data = shell_exec("docker exec  node$i bash -c 'ironfish status'");
            echo $data;
            return '';
        }
    }
}

function getHostingPoints($grattifi)
{
    $websiteid = file_get_contents('http://43.154.249.28:8000/index.php?r=ironfishacc/getwebsiteid&graffiti=' . $grattifi);
    $link = 'https://api.ironfish.network/users/' . $websiteid . '/metrics?granularity=lifetime';
    $file_contents = file_get_contents($link);
    $data = json_decode($file_contents);
    //var_dump($data);
    echo "\r\n" . $grattifi . "|points:" . $data->points . "|websiteid:" . $websiteid . " |HostingPoints:" . $data->metrics->node_uptime->points .  " \r\n";
    if ($data->metrics->node_uptime->points >= 10)
        file_get_contents('http://43.154.249.28:8000/index.php?r=ironfishacc/getwebsiteid&hostpoints=' . $data->metrics->node_uptime->points . '&graffiti=' . $grattifi);
    if ($data->metrics->node_uptime->points >= 140) {
        return true;
    } else
        return false;
}

exit;
