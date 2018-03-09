<?php
// Скрипт проверки
include 'config.php';
# Соединямся с БД
$link = mysqli_connect($DB_server, $DB_user, $DB_pass, $DB_base) or die("не выбрана база! "+mysql_error());

if (isset($_COOKIE['id']) and isset($_COOKIE['hash']))
{
    $query = mysqli_query($link, "SELECT *,INET_NTOA(user_ip) AS user_ip FROM users WHERE user_id = '".intval($_COOKIE['id'])."' LIMIT 1");
    $userdata = mysqli_fetch_assoc($query);

    if(($userdata['user_hash'] !== $_COOKIE['hash']) or ($userdata['user_id'] !== $_COOKIE['id'])
 or (($userdata['user_ip'] !== $_SERVER['REMOTE_ADDR'])  and ($userdata['user_ip'] !== "0")))
    {
        setcookie("id", "", time() - 3600*24*30*12, "/");
        setcookie("hash", "", time() - 3600*24*30*12, "/");
        print "Error user";
    }
    else
    {
        include 'header.php';    
        $string_text = '<h4><p style="text-align: center;">&nbsp; Формирование отчета</h4>';
        $string_data1 = '<h4><p style="text-align:center"><a href="otchot_stat.php">Формирование статического отчета</a></p> </h4>';
        $string_data2 = '<h4><p style="text-align:center"><a href="otchot_din.php">Формирование динамического отчета</a></p> </h4>';
        // Основоная рабочая область
        echo $string_text;
        echo $string_data1;
        echo $string_data2;
        
        
        
        
    }
}
else
{
    print "COOCKES!";
}



?>


<?php
include 'footer.php';
?>
