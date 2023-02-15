<?php
const PRE_CMD = 'docker exec node ironfish';
$graffiti_file = '/root/graffiti';
$weeklink_graffiti = 'http://43.154.249.28:8000/index.php?r=ironfishacc/getgraffiti&task=newweektasktemp';
$gasfee = '0.00000003';
$fetgas = file_get_contents('http://43.154.249.28:8000/ironfish.gas');
$fetgas = trim($fetgas);
if ($fetgas and $fetgas > $gasfee)
    $gasfee = $fetgas;

//死循环
//10轮一次节点钱包扫描
for ($i = 0; $i < 100; $i++) {
    $randRand = rand(10, 100);
    if ($i > $randRand) {
        $i = $i - $randRand;
        // $data = shell_exec(PRE_CMD . " wallet:rescan -f ");
        // echo $data;
        // $data = shell_exec(PRE_CMD . " status  ");
        // echo $data;
    }
    weekTaskAutoRun($weeklink_graffiti, $gasfee);
}
function checkWalletStatus($wallet)
{
}
function weekTaskAutoRun($weeklink_graffiti, $gasfee)
{

    $list_cmd = PRE_CMD . ' wallet:accounts';
    $output = shell_exec($list_cmd);
    $data = explode(PHP_EOL, $output);
    $data = array_filter($data, function ($v) {
        return $v != 'default';
    });
    $data = array_filter($data);
    shuffle($data);
    echo " total accounts number:" . count($data) . "\r\n";
    foreach ($data as $wallet) {
        $data = shell_exec(PRE_CMD . " wallet:balance " . $wallet);
        echo $data;
        $info = explode('$IRON', $data);
        $balance = trim($info[1]);
        echo $wallet . " balance:" . $balance;
        //if ($balance >= 0.00000005) {
        if (floatval($balance) >= (floatval($gasfee) * 3)) {
            //ironfish wallet:transactions gcaitou --no-header --limit=1 --output=json
            echo "获取最新交易状态.......\r\n";
            $cmd = PRE_CMD . " wallet:transactions $wallet --no-header --limit=1 --output=json";
            echo "\r\n" . $cmd . "\r\n";
            $data = shell_exec($cmd);
            $data = json_decode($data);

            if ($data[0]->status == "pending" or $data[0]->status == "unconfirmed") {
                echo "不允许新交易,等待状态变化" . $data[0]->status . ".......\r\n";
                sleep(5);
                continue;
            }
            echo "获取需要执行周任务中.......\r\n";
            $graffiti = file_get_contents($weeklink_graffiti);
            $graffiti = trim($graffiti);
            if (strlen($graffiti) > 20) {
                echo "有点异常...\r\n";
                echo $graffiti;
                sleep(33);
                return '';
            }
            if (empty($graffiti)) {
                echo "系统待执行任务为空....等待60秒...\r\n";
                sleep(33);
                return '';
            }
            echo "获取到需要执行" . $graffiti . ".......\r\n";

            echo "1. MINT " . $graffiti . ".......\r\n";
            $mint_num = 400 + rand(1, 5000);
            $start_mint_result  = 0;
            while (!$start_mint_result) {
                $cmd = PRE_CMD . " wallet:mint --name=$graffiti --metadata=$graffiti --account=$wallet --amount=$mint_num --fee=$gasfee --confirm";
                echo "\r\n" . $cmd . "\r\n";
                $data = shell_exec($cmd);
                echo $data;
                echo "\r\n" . $cmd . "\r\n";
                if (stripos($data, "An error occurred while") > 0) {
                    echo "\r\n !!!!!!!!!!!!finish scanning!!!!!!!!!!! \r\n";
                    sleep(20);
                    $start_mint_result  = 0;
                    continue;
                }
              
                preg_match('/Asset Identifier: ([a-z0-9]*)/', $data, $matches);
                $IDENTIFIER = trim($matches[1]);
                if (!$IDENTIFIER) {
                    echo "MINT有点异常...\r\n";
                    echo $graffiti;
                    sleep(33);
                    return '';
                }

                preg_match('/Transaction Hash: ([a-z0-9]*)/', $data, $matches);
                $Transactionid = $matches[1];
                if ($Transactionid)
                    $start_mint_result = 1;
                else {
                    echo $data . "有点异常...\r\n";
                    echo $graffiti;
                    sleep(33);
                    return '';
                }
            }

            for ($j = 0; $j < 50; $j++) {
                $cmd = PRE_CMD . " wallet:transaction $Transactionid  $wallet";
                $data = shell_exec($cmd);

                preg_match('/Status: ([a-z0-9]*)/', $data, $matches);
                $Status = $matches[1];

                if ($Status != 'confirmed' and $Status != 'expired')
                    echo "\r\n " . date("Y-m-d H:i:s") . "[$j/(50)] $Status 未到账请等待秒50查询" . $IDENTIFIER . " | " . $graffiti . " | " . $wallet . "\r\n";
                else {
                    if ($Status == 'confirmed')
                        break;
                    if ($Status == 'expired') {
                        echo "\r\n expired超时未到账,执行失败";
                        return '';
                    }
                }
                sleep(50);
            }
            if ($j >= 49) {
                echo $graffiti . "超时退出...\r\n";
                return '';
            }


            $burn_num = 300 + rand(1, ($mint_num - 310));
            echo "2. BURN " . $graffiti . ".......\r\n";

            $start_burn_result  = 0;
            while (!$start_burn_result) {
                $cmd = PRE_CMD . " wallet:burn --assetId=$IDENTIFIER --amount=$burn_num --account=$wallet  --fee=$gasfee --confirm ";
                $data = shell_exec($cmd);
                echo $data;
                $send_num = $mint_num - $burn_num;
                if (stripos($data, "An error occurred while") > 0) {
                    echo "finish scanning";
                    sleep(20);
                    $start_burn_result  = 0;

                    continue;
                }
                preg_match('/Transaction Hash: ([a-z0-9]*)/', $data, $matches);
                $Transactionid = $matches[1];
                if ($Transactionid)
                    $start_burn_result = 1;
                else {
                    echo $data . "有点异常...\r\n";
                    echo $graffiti;
                    sleep(33);
                    return '';
                }
            }



            for ($j = 0; $j < 50; $j++) {
                $cmd = PRE_CMD . " wallet:transaction $Transactionid  $wallet";
                $data = shell_exec($cmd);
                preg_match('/Status: ([a-z0-9]*)/', $data, $matches);
                $Status = $matches[1];
                if ($Status != 'confirmed' and $Status != 'expired')
                    echo "\r\n " . date("Y-m-d H:i:s") . "[$j/(50)] 2MINT 需要等待余额变化|等待秒50 " . $Status . " | " . $graffiti . " | " . $wallet . "\r\n";
                else {
                    if ($Status == 'confirmed')
                        break;
                    if ($Status == 'expired') {
                        echo "\r\n expired超时未到账,执行失败";
                        return '';
                    }
                }
                sleep(50);
            }
            if ($j >= 49) {
                echo $graffiti . "超时退出...\r\n";
                return '';
            }


            echo "3. SEND " . $graffiti . ".......\r\n";
            $start_send_result  = 0;
            while (!$start_send_result) {
                $cmd = PRE_CMD . " wallet:send --assetId=$IDENTIFIER --account=$wallet --memo=\"$graffiti\" --amount=$send_num --to=dfc2679369551e64e3950e06a88e68466e813c63b100283520045925adbe59ca  --fee=$gasfee --confirm";
                $data = shell_exec($cmd);
                echo $data;
                if (stripos($data, "An error occurred while") > 0) {
                    echo "finish scanning";
                    sleep(20);
                    $start_send_result  = 0;

                    continue;
                }
                preg_match('/Transaction Hash: ([a-z0-9]*)/', $data, $matches);
                $Transactionid = $matches[1];
                echo "\r\n" . $cmd . "\r\n";
                if ($Transactionid)
                    $start_send_result = 1;
                else {
                    echo $data . "有点异常...\r\n";
                    echo $graffiti;
                    sleep(33);
                    return '';
                }
            }
            echo "完成同步到服务器" . $graffiti . ".......\r\n";
            echo "----------------------------------------------------------\r\n";

            $data = file_get_contents('http://43.154.249.28:8000/index.php?r=ironfishacc/getgraffiti&task=finishweek&graffiti=' . $graffiti);
            return '';
        }
    }
    //都没钱需要转账
    $data = shell_exec("docker exec node ironfish wallet:address " . $wallet);
    echo $data;
    $info = explode('key:', $data);
    $address = trim($info[1]);
    $data = file_get_contents('http://43.154.249.28:8000/index.php?r=ironsendtask/neediron&address=' . $address);
    exit($address . '请求钱中' . $data);
}





exit;
