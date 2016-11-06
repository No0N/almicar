<?php
// Скрипт проверки
include 'config.php';
# Соединямся с БД
$link=mysqli_connect($DB_server, $DB_user, $DB_pass, $DB_base);

if (isset($_COOKIE['id']) and isset($_COOKIE['hash']))
{
    $query = mysqli_query($link, "SELECT *,INET_NTOA(user_ip) AS user_ip FROM users WHERE user_id = '".intval($_COOKIE['id'])."' LIMIT 1");
    $userdata = mysqli_fetch_assoc($query);

    if(($userdata['user_hash'] !== $_COOKIE['hash']) or ($userdata['user_id'] !== $_COOKIE['id'])
 or (($userdata['user_ip'] !== $_SERVER['REMOTE_ADDR'])  and ($userdata['user_ip'] !== "0")))
    {
        setcookie("id", "", time() - 3600*24*30*12, "/");
        setcookie("hash", "", time() - 3600*24*30*12, "/");
        print "Хм, что-то не получилось";
    }
    else
    {
        if(isset($_POST['submit']))
        {
        $err = array();

            if(count($err) == 0)
            {
                $user_id = $userdata['user_login'];
                $tip_post = $_POST['tip_post'];
                $tip_tt = $_POST['tip_tt'];
                $number_tt = $_POST['number_tt'];
                $t1 =

                mysqli_query($link,"INSERT INTO data SET date=STR_TO_DATE(now(), '%Y-%m-%d'),time=CURTIME(), tip_post='".$tip_post."', tip_tt='".$tip_tt."', number_tt='".$number_tt."', user_id='".$user_id."'");
                header("Location: ok.php"); exit();
            }
            else
            {
                print "ошибка";
                foreach($err AS $error)
                {
                    print $error."<br>";
                }
            }
        }
        
    }
}
else
{
    print "Включите куки";
}

include 'header.php';

?>


<form method="POST"><h4>
<p style="text-align: center;">Тип поставки
<SELECT NAME="tip_post"> 
    <OPTION value = "Основная поставка">Основная поставка 
    <OPTION value = "Супер Фрэш">Супер Фрэш
    <OPTION value = "Алкогольная поставка">Алкогольная поставка
    </OPTION>
</SELECT><br></p>
</br>
<p style="text-align: center;">Тип магазина
<SELECT NAME="tip_tt"> 
    <OPTION value = "АГ">Гастроном 
    <OPTION value = "АУ">Универсам
    </OPTION>
</SELECT><br></p>
</br>
<p style="text-align: center;">Номер магазина
<SELECT NAME="number_tt"> 
    <OPTION value = "1">1 
    <OPTION value = "2">2
    <OPTION value = "3">3 
    <OPTION value = "4">4
    <OPTION value = "5">5 
    <OPTION value = "6">6
    <OPTION value = "7">7 
    <OPTION value = "8">8
    <OPTION value = "9">9 
    <OPTION value = "10">10
    <OPTION value = "11">11 
    <OPTION value = "12">12
    <OPTION value = "13">13 
    <OPTION value = "14">14
    <OPTION value = "15">15 
    <OPTION value = "16">16
    <OPTION value = "18">18
    <OPTION value = "19">19
    <OPTION value = "20">20 
    <OPTION value = "21">21
    <OPTION value = "24">24 
    <OPTION value = "28">28
    <OPTION value = "29">29 
    <OPTION value = "30">30
    <OPTION value = "31">31 
    <OPTION value = "34">34
    <OPTION value = "35">35 
    <OPTION value = "38">38
    <OPTION value = "43">43
    <OPTION value = "46">46
    <OPTION value = "48">48
    </OPTION>
</SELECT><br></p>
</br>
</br>
<p style="text-align: center;">
    <input name="submit" type="submit" value="Отправить" class="btn btn-success">&nbsp;&nbsp;&nbsp;
    <input name="Очистить" type="reset" value="   Очистить   " class="btn btn-warning"/>
</p>
    </h4>
</form>

<?php
include 'footer.php';
?>