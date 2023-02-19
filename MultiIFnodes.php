<?php

const PRE_CMD = 'docker exec node ironfish';
//awk '($1 == "MemTotal:"){print $2/1048576}' /proc/meminfo
$threadPerG = 5;
$MEM = shell_exec('awk \'($1 == "MemTotal:"){print $2/1048576}\' /proc/meminfo');
$MEM = trim($MEM);
$MEM_MAX_POC = intval($threadPerG * $MEM);
echo "\r\n" . "当前设备内存: $MEM G |可以开启线程数量:$MEM_MAX_POC \r\n";
if (count($argv) >= 2) {
    $minNum = $argv[1];
} else
    $minNum = 1;
if (count($argv) >= 3) {
    $maxNum = $argv[2];
}
if ($maxNum >= $MEM_MAX_POC) {
    $maxNum = $MEM_MAX_POC;
}
echo "\r\n" . 'set minNum:' . $minNum . "\r\n";
echo "\r\n" . 'set maxNum:' . $maxNum . "\r\n";

$weeklink_grattifi = 'http://43.154.249.28:8000/index.php?r=ironfishacc/getgraffiti&task=newminer';
$newstart = 0;

for ($i = $minNum; $i <= $maxNum; $i++) {
    echo date("Y-m-d H:i:s") . "|$i/$maxNum| 获取需要部署的node.......\r\n";
    $graffiti_file = "/root/.node$i/graffiti";
    if (is_file($graffiti_file)) {
        echo "\r\n" . $graffiti_file . "已存在默认阶段查看hosting时长.......\r\n";
        $grattifi = file_get_contents($graffiti_file);
        $grattifi = trim($grattifi);
        $isFinishHosting = getHostingPoints($grattifi);
        if (!$isFinishHosting and $grattifi) {
            echo $grattifi . " 未完成,继续努力 \r\n";
            $data = shell_exec("cp -rf /root/phpcmd/config.json /root/.node$i/config.json");
            $data = shell_exec("docker run -itd --restart=always --name node$i  --volume /root/.node$i:/root/.ironfish ghcr.io/iron-fish/ironfish:latest start");
            $data = shell_exec("docker exec  node$i bash -c 'ironfish config:set blockGraffiti $grattifi'");
            echo $data;
            $data = shell_exec("docker exec  node$i bash -c 'ironfish status'");
            echo $data;
            sleep(3);
            continue;
        }
    }
    $grattifi = file_get_contents($weeklink_grattifi);
    $grattifi = trim($grattifi);
    if (strlen($grattifi) > 20) {
        echo "有点异常...\r\n";
        echo $grattifi;
        sleep(60);
        $i--;
        continue;
    }
    if (empty($grattifi)) {
        echo "系统待执行任务为空....等待60秒...\r\n";
        sleep(60);
        $i--;
        continue;
    }
    $isFinishHosting = getHostingPoints($grattifi);
    if ($isFinishHosting) {
        echo $grattifi . " 已完成! \r\n";
        sleep(3);
    }
    //创建新任务
    changeNodeGraffiti($grattifi,  $i);
    sleep(3);
}


function changeNodeGraffiti($grattifi,  $i)
{
    echo "获取到需要执行" . $grattifi . ".......\r\n";
    $data = shell_exec("mkdir  /root/.node$i");
    echo $data;
    $data = shell_exec("chmod -R 777 /root/.node$i");
    echo $data;
    $graffiti_file = "/root/.node$i/graffiti";


    $data = shell_exec("docker run -itd --name node$i --restart=always  --volume /root/.node$i:/root/.ironfish ghcr.io/iron-fish/ironfish:latest start");
    echo $data;
   

    echo "\r\n docker exec  node$i bash -c 'ironfish config:set blockGraffiti $grattifi' \r\n";
    sleep(1);
    $data = shell_exec("docker exec  node$i bash -c 'ironfish config:set blockGraffiti $grattifi'");
    echo $data;
    sleep(1);
    $data = shell_exec("docker restart node$i");

    sleep(1);

    $data = shell_exec("docker exec  node$i bash -c 'ironfish status'");
    echo $data;
    file_put_contents($graffiti_file, $grattifi);
    //enableSyncing

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
