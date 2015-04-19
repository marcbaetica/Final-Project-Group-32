<html>
<body>

Welcome <?php 


//echo exec('whoami');

echo shell_exec('sh /Applications/XAMPP/xamppfiles/htdocs/script.sh');
//echo exec("/Applications/XAMPP/xamppfiles/htdocs/script.sh");

echo $_POST["name"]; ?><br>
Your email address is: <?php echo $_POST["email"]; ?>

</body>
</html>