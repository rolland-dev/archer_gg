<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once './php/menu/head.php' ?>
    <title>Piublications</title>
</head>

<body>
    <?php require_once './php/menu/menu.php'; ?>

 
    <h1>Fils de publications</h1>
    <?php
     require_once "./php/bdd/config.php";
        $sql = "SELECT * FROM messages ";
        if ($result = mysqli_query($link, $sql)) {
            if (mysqli_num_rows($result) > 0) { 
    ?>
     
    <br><br>
    <div class="row">
        <?php
            while ($row = mysqli_fetch_array($result)) {
        ?>
        <div class="d-flex justify-content-center">
           <div class="messages">
                <figure class="text-center">
                <blockquote class="blockquote">
                    <p class="mb-0"><?= $row['commentaire'] ?></p>
                </blockquote>
                <figcaption class="blockquote-footer">
                <cite title="Source Title">Le <?= date('d-m-Y', strtotime($row['date'])) ?> de <?= strtoupper($row['editeur']) ?></cite>
                </figcaption>
                </figure>
            </div>  
        </div>
       

        <?php }
            }}
        ?>
    </div>

    <?php require_once './php/menu/footer.php'; ?>
</body>

</html>