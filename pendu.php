

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Le pendu</title>
</head>
<body>
    <h1>Le super jeu du pendu.</h1>

     <form method="POST">
        <div>
            <label for="tentative">Tentative</label>
            <input type="text" id="tentative" name="tentative" value="">
        </div>
        <input type="submit" value="Entrer une lettre ou une phrase">
    </form>

<?php include('fil_rouge.php'); ?>

<p><?php echo $result; ?></p>
    


    

</body>
</html>
<?php echo $_POST['tentative'] ?? 'Pas de nom saisi'; ?>