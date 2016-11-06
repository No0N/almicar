<?php
include 'config.php';
echo'<h3><p style="text-align:center">Статический отчет</p></h3>';


// Скрипт проверки





# Соединямся с БД
$link = mysqli_connect($DB_server, $DB_user, $DB_pass, $DB_base) or die("No DB! "+mysql_error());
$file = fopen($file_name, wb);

 
if (isset($_COOKIE['id']) and isset($_COOKIE['hash']))
{
    $query = mysqli_query($link, "SELECT *,INET_NTOA(user_ip) AS user_ip FROM users WHERE user_id = '".intval($_COOKIE['id'])."' LIMIT 1") or die("ошибка в запросе "+mysql_error());
    $userdata = mysqli_fetch_assoc($query);
    include 'header.php';
    echo '<form method="post" ><h4>';
    echo '<p style="text-align:center">C&nbsp;<input maxlength="20" name="datain" size="20" type="text"  /></p>';
    echo '<p style="text-align:center">по&nbsp;<input maxlength="20" name="dataout" size="20" type="text"  /></p>';
    echo '<p style="text-align:center"><input name="submit" type="submit" class="btn btn-success" />&nbsp;&nbsp;&nbsp;<input name="Сбросить" type="reset" value="Сбросить" class="btn btn-warning" /></p>';
    echo '<p style="text-align: center;">&nbsp;<input class="btn btn-success" name="submit" type="button" value="  Вернуться   " onclick="location.href=&#39;otchet.php&#39;" /></p>';
    echo '</h4></form>';

    if(($userdata['user_hash'] !== $_COOKIE['hash']) or ($userdata['user_id'] !== $_COOKIE['id'])
 or (($userdata['user_ip'] !== $_SERVER['REMOTE_ADDR'])  and ($userdata['user_ip'] !== "0")))
    {
        setcookie("id", "", time() - 3600*24*30*12, "/");
        setcookie("hash", "", time() - 3600*24*30*12, "/");
        print "Sry, No login-pass";
        
    }
    else
    {
        // Данные из формы
      if(isset($_POST['submit']))
        {   
        
        // Проверка данных
        // Даты оба поля пустые вывод за сегодня
        $datain = $_POST['datain'];
        $dataout = $_POST['dataout'];
        
        
        
       
    
       // Формирование запроса
       
       $database = date(Y).'-'.date(m).'-'.date(d);
       if(!empty($datain) == TRUE){
          
           if (!empty($dataout) == TRUE) {
                }
           else {
                
               $dataout = $datain;
           }
       }
       elseif(!empty($datain) == FALSE) {
           $datain = $database;
           $dataout = $datain;
           
       }
       $query_sourse = "SELECT * FROM `home40540_car`.`data` WHERE `date` >= '".$datain."' and `date` <= '".$dataout."' ORDER BY `id`";
        
    mysql_connect($DB_server, $DB_user, $DB_pass) or
        die("Could not connect: " . mysql_error());
    mysql_select_db($DB_base);

    $result = mysql_query($query_sourse);
    
    
    
    
    if (!$result) {
        echo 'DB ERROR: ' . mysql_error();
         exit;
}
    // Шапка таблицы
       
    $head_otch = "   ID   ;     Дата     ;     Время     ;          Тип поставки          ;          Тип магазина          ;          Номер магазина          ;     Номер машины     ";
    fwrite($file,b"\xEF\xBB\xBF".$head_otch.b"\n"); 
    //fputcsv($file, $head_otch, ';');

    

    while ($row = mysql_fetch_array($result)) {
        $bid = $row['id'];
        $bdate = $row['date'];
        $btime = $row['time'];
        $btip_post = $row['tip_post'];
        $btip_tt = $row['tip_tt'];
        $bnumber_tt = $row['number_tt'];
        $buser_id = $row['user_id'];
        
        
        
        
        
        
        $otc = array($bid, $bdate, $btime, $btip_post, $btip_tt, $bnumber_tt, $buser_id);
    fputcsv($file, $otc, ';');
    
        
    }

    mysql_free_result($result);
    fclose($file); 
    echo '<h4><p style="text-align:center"><a href="'.$file_name.'"> скачать файл </a></p><h4>';
    }
}    
    
            
           
        
           
          
          
            
            
            
            
            
        }
        
        
        
    
    
    

else
{
    print "Not work cookey";
}



?>




<?php
include 'footer.php';
?>
