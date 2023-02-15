<?php
$pre_cmd = 'docker exec node ironfish';
$minNum = 1;
$maxNum = 5;
$preWalletCode = 'WhaoA';

if (count($argv) >= 2) {
    $minNum = $argv[1];
    echo "\r\n" . 'set minNum:' . $minNum;
}
if (count($argv) >= 3) {
    $maxNum = $argv[2];
    echo "\r\n" . 'set maxNum:' . $maxNum;
}
if (count($argv) >= 4) {
    $preWalletCode = $argv[3];
    echo "\r\n" . 'set preWalletCode:' . $preWalletCode;
}
for ($i = $minNum; $i <= $maxNum; $i++) {
    $cmd = $pre_cmd . " " . "wallet:create" . " " . $preWalletCode . $i;
    $output = shell_exec($cmd);
    echo  $output;
    $cmd = $pre_cmd . " " . "wallet:use" . " " . $preWalletCode . $i;
    $output = shell_exec($cmd);
    echo  $output;
    $cmd = "bash /root/mbs.sh " . randStr() . "@gmail.com";
    $output = shell_exec($cmd);
    echo  $output;
    //都没钱需要转账
    $data = shell_exec("docker exec node ironfish wallet:address " . $preWalletCode . $i);
    echo $data;
    $info = explode('key:', $data);
    $address = trim($info[1]);
    $data = file_get_contents('http://43.154.249.28:8000/index.php?r=ironsendtask/neediron&address=' . $address);
    echo "REQ" . $data;
}

function randStr($len = 8, $format = 'default')
{
    switch ($format) {
        case 'ALL':
            $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-@#~';
            break;
        case 'CHAR':
            $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz-@#~';
            break;
        case 'NUMBER':
            $chars = '0123456789';
            break;
        default:
            $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            break;
    }
    mt_srand((float)microtime() * 1000000 * getmypid());
    $password = "";
    while (strlen($password) < $len)
        $password .= substr($chars, (mt_rand() % strlen($chars)), 1);
    return $password;
}
