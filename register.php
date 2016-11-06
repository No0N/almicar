<?php
// �������� ����������� ������ ������������

# ���������� � ��
$link=mysqli_connect("localhost", "home40540_car", "D2313d", "home40540_car");

if(isset($_POST['submit']))
{
    $err = array();

    # �������� �����
    if(!preg_match("/^[a-zA-Z0-9]+$/",$_POST['login']))
    {
        $err[] = "����� ����� �������� ������ �� ���� ����������� �������� � ����";
    }

    if(strlen($_POST['login']) < 3 or strlen($_POST['login']) > 30)
    {
        $err[] = "����� ������ ���� �� ������ 3-� �������� � �� ������ 30";
    }

    # ���������, �� ��������� �� ������������ � ����� ������
    $query = mysqli_query($link, "SELECT COUNT(user_id) FROM users WHERE user_login='".mysqli_real_escape_string($link, $_POST['login'])."'");
    //if(mysqli_num_rows($query) > 0)
    //{
    //    $err[] = "������������ � ����� ������� ��� ���������� � ���� ������";
    //}

    # ���� ��� ������, �� ��������� � �� ������ ������������
    if(count($err) == 0)
    {

        $login = $_POST['login'];

        # ������� ������ ������� � ������ ������� ����������
        $password = md5(md5(trim($_POST['password'])));

        mysqli_query($link,"INSERT INTO users SET user_login='".$login."', user_password='".$password."'");
        header("Location: login.php"); exit();
    }
    else
    {
        print "<b>��� ����������� ��������� ��������� ������:</b><br>";
        foreach($err AS $error)
        {
            print $error."<br>";
        }
    }
}
?>

<form method="POST">
����� <input name="login" type="text"><br>
������ <input name="password" type="password"><br>
<input name="submit" type="submit" value="������������������">
</form>