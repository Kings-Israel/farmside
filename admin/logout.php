<?php
session_start();

session_destroy();

echo"<script>window.open('admin_login.php', '_self')</script>";
echo"<script>alert('You have logged out')</script>";
?>