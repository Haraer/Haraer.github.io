<?php
session_start();
session_destroy();
header("Location:index.html");   //跳转到首页
