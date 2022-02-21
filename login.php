<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loginsida</title>
    <style>
        body {
            text-align: center;
        }
    </style>
</head>
<body>

<?php


$namnArray = array();
$myFile = "textfil.txt";

$fh = fopen($myFile, 'a');
    $stringData1 = "Lars,Gris\n";
    $pos = strpos($stringData1, ',');
    $string = strtolower(substr($stringData1, 0, $pos));
    array_push($namnArray, $string);
    $stringData = $string . substr($stringData1, $pos);
    fwrite($fh, $stringData);
    $stringData2 = "Erik,Hund\n";
    $pos2 = strpos($stringData2, ',');
    $string2 = strtolower(substr($stringData2, 0, $pos2));
    array_push($namnArray, $string2);
    $stringData = $string2 . substr($stringData2, $pos2);
    fwrite($fh, $stringData);
fclose($fh);

$array = array();
$array2 = array();

$fh = fopen($myFile, 'r');
    while( !feof ($fh) ) {

    $theData = fgets($fh);
    $kommapos = strpos($theData, ',');
    $namn = substr($theData, 0, $kommapos);
    array_push($namnArray, $namn);
    array_push($array, $theData);

}//while( !feof ($fh) )

fclose($fh);


?>

    <h3>Logga in, eller skapa en ny användare</h3>

    <form method="post">
        <label for="name">Mata in ditt namn</label><br>
        <input type="text" id="name" name="name"><br>
        <label for="password">Mata in ditt lösenord</label><br>
        <input type="password" id="password" name="password"><br>
        <input type="submit" name = "submit" value="Logga in"><br>
        <input type="submit" name = "submit2" value="Skapa en ny användare"><br>

    </form>    

<?php


    if(isset($_POST['submit'])){ 

            $lines = file('textfil.txt');
            $lines = array_unique($lines);
            file_put_contents('textfil.txt', implode($lines));

            $name = strtolower($_POST["name"]);
            if (empty($name)) {
                echo 'Mata in ett användarnamn';
                return;
            }
            $password = $_POST["password"];
            if (empty($password)) {
                echo 'Mata in ett lösenord';
                return;
            }
            $namePass = $name.",".$password."\n";
            array_push($array2, $namePass );
            $result=array_diff($array,$array2);

        if (sizeof($result) - sizeof($array) == 0) {echo 'Felaktigt namn eller lösenord, försök igen.';
        return;}

        else {
            Session_start();
            $_Session['username'] = $_POST["name"];
            header('Location: index.php');}
}// if(isset($_POST['submit']))

    if(isset($_POST['submit2'])){ 
        
            $lines = file('textfil.txt');
            $lines = array_unique($lines);
            file_put_contents('textfil.txt', implode($lines));

            $name2 = strtolower($_POST["name"]);
            if (empty($name2)) {
                echo 'Mata in ett användarnamn';
                return;
            }
            $password2 = $_POST["password"];
            if (empty($password2)) {
                echo 'Mata in ett lösenord';
                return;
            }
            $namePass2 = $name2.",".$password2."\n";

        
        if (in_array($name2, $namnArray)) {
                
            echo 'Namnet är redan upptaget, vänligen välj ett annat.'; 
        }//(in_array($name2, $namnArray)) {
        
        else {
            $fh = fopen("textfil.txt", 'a');
                $pos3 = strpos($namePass2, ',');
                $string3 = substr($namePass2, 0, $pos3);
                $stringData3 = $string3 . substr($namePass2, $pos3);
                array_push($array, $stringData3);
                fwrite($fh, end($array));
            fclose($fh);
            echo 'Ny användare registrerad';
        }//else 
        }//if(isset($_POST['submit2']))
       
    ?>
    
</body>
</html>