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
<p style="text-align: center;">Тип магазина
<SELECT NAME="tip_tt"> 
    <OPTION value = "АГ">Гастроном 
    <OPTION value = "АУ">Универсам
    </OPTION>
</SELECT><br></p>
<p style="text-align: center;">Номер магазина <input name="number_tt" type="text"><br></p>
<p style="text-align: center;">
    <input name="submit" type="submit" value="Отправить" class="btn btn-success">&nbsp;&nbsp;&nbsp;
    <input name="Очистить" type="reset" value="   Очистить   " class="btn btn-warning"/>
</p>
    </h4>
</form>

<?php
include 'footer.php';
?>