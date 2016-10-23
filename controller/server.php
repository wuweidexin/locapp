<?php
/**
* API接口服务端
* site http://www.jbxue.com
*
*/
    require 'conn.php';  
    header('Content-Type:text/html;charset=utf-8');  
      
    $action = $_GET['action'];  
    switch ($action) {  
      
        //注册会员  
        case"adduserinfo";  
            $username = lib_replace_end_tag(trim($_GET['username']));  
            $password2 = lib_replace_end_tag(trim($_GET['userpassword']));  
            $password = md5("$password2" . ALL_PS);  
            $email = lib_replace_end_tag(trim($_GET['email']));  
      
            if ($username == '' || $password2 == '' || $password == '') {  
                $res = urlencode("参数有误");  
                exit(json_encode($res)); //有空信息  
            }  
      
            $sql = "select username from `member` where username='$username'";  
            $query = mysql_query($sql, $conn);  
            $count = mysql_num_rows($query);  
      
            if ($count > 0) {  
                exit(json_encode(1)); //返回1表示注册失败  
            } else {  
      
                $addsql = "insert into `member` (username,password,email) values ('$username','$password','$email')";  
                mysql_query($addsql);  
                exit(json_encode(0)); //返回0表示注册成功  
            }  
            break;
      
        //查询用户信息  
        case"selectuserinfo";  
            $username = lib_replace_end_tag($_GET['username']);  
            $sql = "select id,username,nickname,mobile from `member` where username='$username'";  
            $query = mysql_query($sql, $conn);  
            $row = mysql_fetch_array($query);  
            foreach ($row as $key => $v) {  
                $res[$key] = urlencode($v);  
            }  
            exit(json_encode($res));  
            break;
      
        //会员登录  
        case"userlogin";  
            $username = lib_replace_end_tag($_GET['username']);  
            $password2 = lib_replace_end_tag(trim($_GET['userpassword']));  
            $password = md5("$password2" . ALL_PS);  
            $sqluser = "select id,username,password from `member` where username='" . $username . "' and password='" . $password . "'";  
            $queryuser = mysql_query($sqluser);  
            $rowuser = mysql_fetch_array($queryuser);  
            if ($rowuser && is_array($rowuser) && !emptyempty($rowuser)) {  
                if ($rowuser['username'] == $username && $rowuser['password'] == $password) {  
                    if ($rowuser['password'] == $password) {  
                        $res = urlencode("登录成功");  
                        exit(json_encode($res));  
                    } else {  
                        $res = urlencode("密码错误");  
                        exit(json_encode($res));  
                    }  
                } else {  
                    $res = urlencode("用户名不存在");  
                    exit(json_encode($res));  
                }  
            } else {  
                $res = urlencode("用户名密码错误");  
                exit(json_encode($res));  
            }  
            /* 
             * 0：表示登录成功，1：表示密码错误，2：用户名不存在，3：用户名密码错误 
             */  
            break;  
      
        default:  
            exit(json_encode(error));  
    }  
?> 