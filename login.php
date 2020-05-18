<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
    <label for="Username">Username:</label>
    <input type="text" name="Username" placeholder="Username"><br>

    <label for="password">Password:</label>
    <input type="password" name="password" placeholder="Password"><br>

    <input type="submit" name="submit" value="Login"><br>
</form>

<?php
if (isset($_POST["submit"])) 
{
    // Als invoer-velden leeg zijn error.
    if (empty($_POST["password"]) || empty($_POST["Username"])) 
    {
        echo "Please fill in all fields ", $_SERVER["PHP_SELF"];
    }
    else
    {
        $Username = $_POST["Username"];
        $password = $_POST["password"];


           // stuk code om de data te versturen en te controleren


    }
}
?>