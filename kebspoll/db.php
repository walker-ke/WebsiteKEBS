<?php
$conn = new mysqli('localhost', 'root', '', 'insert');
$name=$_POST['name'];
$email=$_POST['email'];
$sql="INSERT INTO `data` (`id`, `name`, `email`) VALUES (NULL, '$name', '$email')";
if ($conn->query($sql) === TRUE) {
    echo "data inserted";
}
else 
{
    echo "failed";
}
?>