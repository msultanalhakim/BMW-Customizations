<?php
include("connection.php");

$nip    = $_GET['NIP'];
$sql    = "SELECT * FROM tbl_pegawai WHERE NIP = $nip";
$query  = mysqli_query($conn, $sql)
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <title>BMW Customizations</title>
        <link rel="stylesheet" type="text/css" href="style.css"/>
        <link rel="icon" href="assets/icon/bmw.ico"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div class="form-container">
            <div class="form">
                <h4><a href="index.php" target="_self"><i class="fa-solid fa-arrow-left"></i></a> View <em>Mechanic</em></h4>
                <div class="form-control">
                    <?php
                        while($row = mysqli_fetch_array($query)){
                    ?>
                    <form class="form-item">
                        <img src="assets/images/profiles/<?php echo $row['foto'];?>" class="form-img"/>
                        <div class="item">
                            <h4>NIP:</h4>
                            <h6><?php echo $row['NIP'];?></h6>
                        </div>
                        <div class="item">
                            <h4>Name:</h4>
                            <h6><?php echo $row['nama'];?></h6>
                        </div>
                        <div class="item">
                            <h4>Birthday:</h4>
                            <h6><?php echo date('d F Y', strtotime($row['tanggal_lahir']));?></h6>
                        </div>
                        <div class="item">
                            <h4>Address:</h4>
                            <h6><?php echo $row['alamat'];?></h6>
                        </div>
                        <div class="item">
                            <h4>Division:</h4>
                            <h6><?php echo $row['divisi'];?></h6>
                        </div>
                        <br>
                    </form>
                    <?php } ?>
                </div>
            </div>
        </div>
        <script src="https://kit.fontawesome.com/d9b2e6872d.js" crossorigin="anonymous"></script>
    </body>
</html>