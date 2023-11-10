<?php 
include('connection.php');

$nip    = $_GET['NIP'];

$sql    = "SELECT * FROM tbl_pegawai WHERE NIP = '$nip'";
$query  = mysqli_query($conn, $sql);

if(isset($_POST['submit'])){
    $nama           = $_POST['nama'];
    $lahir          = $_POST['tanggal_lahir'];
    $alamat         = $_POST['alamat'];
    $divisi         = $_POST['divisi'];
    
    if($_FILES['foto']['name'] != ""){
        $uploaddir      = 'assets/images/profiles/';
        $uploadname     = $_FILES['foto']['name'];
        $uploadtmp      = $_FILES['foto']['tmp_name'];
        $nameuploaded   = $nip . " " . $uploadname;
        $uptquery = mysqli_query($conn, "SELECT * FROM tbl_pegawai WHERE NIP = '$nip'");
        $row    = mysqli_fetch_array($uptquery);
        if(file_exists($uploaddir . $row['foto'])){
            unlink($uploaddir . $row['foto']);
            move_uploaded_file($uploadtmp, $uploaddir . $nameuploaded);
        }else{
            move_uploaded_file($uploadtmp, $uploaddir . $nameuploaded);
        }

        $sql = "UPDATE tbl_pegawai SET nama = '$nama', tanggal_lahir = '$lahir', alamat = '$alamat', divisi = '$divisi', foto = '$nameuploaded' WHERE NIP = '$nip'";
    }else{
        $sql = "UPDATE tbl_pegawai SET nama = '$nama', tanggal_lahir = '$lahir', alamat = '$alamat', divisi = '$divisi' WHERE NIP = '$nip'";
    }

    $query = mysqli_query($conn, $sql);
    if($query){
        header('Location: '.'index.php?update='.$nip);
    }
}
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
                <h4><a href="index.php" target="_self"><i class="fa-solid fa-arrow-left"></i></a> Update <em>Mechanic</em></h4>
                <?php
                    while($row = mysqli_fetch_array($query)){
                ?>
                <div class="form-control">
                    <form name="form-update" action="<?php $_SERVER['PHP_SELF']?>" method="POST" class="form-item" enctype="multipart/form-data">
                        <div class="item">
                            <h4>NIP:</h4>
                            <input type="number" name="nip" placeholder="Please input your NIP here.." value="<?php echo $row['NIP']?>" disabled required>
                        </div>
                        <div class="item">
                            <h4>Name:</h4>
                            <input type="text" name="nama" placeholder="Please input your name here.." value="<?php echo $row['nama']?>" required>
                        </div>
                        <div class="item">
                            <h4>Birthday:</h4>
                            <input type="date" name="tanggal_lahir" value="<?php echo $row['tanggal_lahir']?>" required>
                        </div>
                        <div class="item">
                            <h4>Address:</h4>
                            <textarea class="textarea" placeholder="Please input your address here.." name="alamat" required><?php echo $row['alamat']?></textarea>
                        </div>
                        <div class="item">
                            <h4>Division:</h4>
                            <select name="divisi" class="select">
                                <?php if($row['divisi'] == "IT"){echo ("<option value='IT' selected>IT</option>");}
                                else{echo ("<option value='IT'>IT</option>");}
                                ?>
                                <?php if($row['divisi'] == "HRD"){echo ("<option value='HRD' selected>HRD</option>");}
                                else{echo ("<option value='HRD'>HRD</option>");}
                                ?>
                                <?php if($row['divisi'] == "Umum"){echo ("<option value='Umum' selected>Umum</option>");}
                                else{echo ("<option value='Umum'>Umum</option>");}
                                ?>
                            </select>
                        </div>
                        <div class="item">
                            <h4>Picture:</h4>
                            <input type="file" name="foto" accept="image/png, image/jpg, image/jpeg">
                            <img src="assets/images/profiles/<?php echo $row['foto'];?>" class="update-img"/><br>
                            <span><?php echo $row['foto'];?></span>
                        </div>
                        <div class="item">
                            <input type="submit" name="submit" value="Update" class="btn-submit">
                            <input type="reset" value="Reset" class="btn-reset">
                        </div>
                        <br><br><br><br>
                    </form>
                    <?php }?>
                </div>
            </div>
        </div>
        <script src="https://kit.fontawesome.com/d9b2e6872d.js" crossorigin="anonymous"></script>
    </body>
</html>