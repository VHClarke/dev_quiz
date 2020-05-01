<?php
class User_Auth {

public function authenticate() {
    if (!isset($_SERVER['PHP_AUTH_USER'])) {
      header("WWW-Authenticate: Basic realm=\"MyProject\"");
      header("HTTP/1.0 403 Forbidden");
      print "credentials required";
      exit;
    } else if($_SERVER['SERVER_NAME']==="https://staging-api.example.com") {
      if ($_SERVER['PHP_AUTH_USER'] === 'devUsername' && $_SERVER['PHP_AUTH_PW'] === '$*rs9D(') {
              return true;
      }
       else {
        header("WWW-Authenticate: Basic realm=\"MyProject\"");
        header("HTTP/1.0 401 permission denied, invalid http basic credentials");
        print "invalid credentials";
        return false;
      }
    } else if($_SERVER['SERVER_NAME']==="https://api.example.com") {
      if ($_SERVER['PHP_AUTH_USER'] === 'prodUsername' && $_SERVER['PHP_AUTH_PW'] === '&&KeXt97&sd') {
              return true;
      }
       else {
        header("WWW-Authenticate: Basic realm=\"MyProject\"");
        header("HTTP/1.0 401 permission denied, invalid http basic credentials");
        print "invalid credentials";
        return false;
      }
    }
    else if($_SERVER['SERVER_NAME']==="localhost") {
      if ($_SERVER['PHP_AUTH_USER'] === 'devUsername' && $_SERVER['PHP_AUTH_PW'] === '$*rs9D(') {
              return true;
      }
       else {
        header("WWW-Authenticate: Basic realm=\"MyProject\"");
        header("HTTP/1.0 401 permission denied, invalid http basic credentials");
        print "invalid credentials";
        return false;
      }
    }
}
}
 ?>
