<?php
include 'config.php';
echo'<h3><p style="text-align:center">Динамический отчет</p></h3>';


// Скрипт проверки





# Соединямся с БД
$link = mysqli_connect($DB_server, $DB_user, $DB_pass, $DB_base) or die("не выбрана база! "+mysql_error());

 
if (isset($_COOKIE['id']) and isset($_COOKIE['hash']))
{
    $query = mysqli_query($link, "SELECT *,INET_NTOA(user_ip) AS user_ip FROM users WHERE user_id = '".intval($_COOKIE['id'])."' LIMIT 1") or die("ошибка в запросе "+mysql_error());
    $userdata = mysqli_fetch_assoc($query);
    include 'header.php';
    echo '<form method="post" ><h4>';
    echo '<p style="text-align:center">C&nbsp;<input maxlength="20" name="datain" size="20" type="text"  /></p>';
    echo '<p style="text-align:center">по&nbsp;<input maxlength="20" name="dataout" size="20" type="text"  /></p>';
    echo '<p style="text-align:center"><input name="submit" type="submit" class="btn btn-success" />&nbsp;&nbsp;&nbsp;<input name="Сбросить" type="reset" value="Сбросить" class="btn btn-warning"/></p>';
    echo '</h4></form>';

    if(($userdata['user_hash'] !== $_COOKIE['hash']) or ($userdata['user_id'] !== $_COOKIE['id'])
 or (($userdata['user_ip'] !== $_SERVER['REMOTE_ADDR'])  and ($userdata['user_ip'] !== "0")))
    {
        setcookie("id", "", time() - 3600*24*30*12, "/");
        setcookie("hash", "", time() - 3600*24*30*12, "/");
        print "WTF?";
        
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
       $query_sourse = "SELECT * FROM `home40540_car`.`trip` WHERE `data` >= '".$datain."' and `data` <= '".$dataout."' ORDER BY `id` ";
        
    mysql_connect($DB_server, $DB_user, $DB_pass) or
        die("Could not connect: " . mysql_error());
    mysql_select_db($DB_base);

    $result = mysql_query($query_sourse);
    
    
    if (!$result) {
        echo 'DB ERROR: ' . mysql_error();
         exit;
}
    // Шапка таблицы
    echo '<div class="table-responsive">';
    echo '<TABLE class="table table-striped">';
    echo '<TR>';
    echo '<TD>   ID   </TD>';
    echo '<TD>   Дата   </TD>';
    echo '<TD>   Время   </TD>';
    echo '<TD>   Номер машины  </TD>';
            echo '<TD>   Магазин 1  </TD>';
            echo '<TD>   Магазин 2  </TD>';
            echo '<TD>   Магазин 3  </TD>';
            echo '<TD>   Магазин 4  </TD>';
            echo '<TD>   Магазин 5  </TD>';
            echo '<TD>   Магазин 6  </TD>';
            //echo '<TD>   Магазин 7  </TD>';
            //echo '<TD>   Магазин 8  </TD>';
            //echo '<TD>   Магазин 9  </TD>';
            //echo '<TD>   Магазин 10  </TD>';
    echo '</TR>';

    while ($row = mysql_fetch_array($result)) {
    echo '<TR>';
    echo '<TD>'.$row['id'].'</TD>';
    echo '<TD>'.$row['data'].'</TD>';
    echo '<TD>'.$row['time'].'</TD>';
    echo '<TD>'.$row['number_m'].'</TD>';
        echo '<TD>'.$row['tt_1'].'</TD>';
        echo '<TD>'.$row['tt_2'].'</TD>';
        echo '<TD>'.$row['tt_3'].'</TD>';
        echo '<TD>'.$row['tt_4'].'</TD>';
        echo '<TD>'.$row['tt_5'].'</TD>';
        echo '<TD>'.$row['tt_6'].'</TD>';
        //echo '<TD>'.$row['tt_7'].'</TD>';
        //echo '<TD>'.$row['tt_8'].'</TD>';
        //echo '<TD>'.$row['tt_9'].'</TD>';
        //echo '<TD>'.$row['tt_10'].'</TD>';
    echo '</TR>';
        
        
    }
    echo '</table>';
    echo '</div>';
    mysql_free_result($result);
        
    }
}    
       
            
           
        
           
          
          
            
            
            
            
            
        }
        
        
        
    
    
    

else
{
    print "Включите куки";
}



?>

<?php
include 'footer.php';
?>



