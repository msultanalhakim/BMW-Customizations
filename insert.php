<?php
include("connection.php");

    if(isset($_POST['submit'])){
        $nip     = $_POST['NIP'];
        $nama    = $_POST['nama'];
        $lahir   = $_POST['tanggal_lahir'];
        $alamat  = $_POST['alamat'];
        $divisi  = $_POST['divisi'];
        $uploaddir  = 'assets/images/profiles/';
        $uploadname = $_FILES['foto']['name'];
        $uploadtmp  = $_FILES['foto']['tmp_name'];
        $nameuploaded = $nip . " " . $uploadname;

        move_uploaded_file($uploadtmp, $uploaddir . $nameuploaded);
        $sql = "INSERT INTO tbl_pegawai (NIP, nama, tanggal_lahir, alamat, divisi, foto, waktu_ditambahkan) VALUES ('$nip', '$nama',DATE_FORMAT('$lahir', '%Y-%m-%d'), '$alamat', '$divisi', '$nameuploaded', CURRENT_TIME())";
        $query = mysqli_query($conn, $sql);
        if($query){
            header('Location: '.'index.php?insert='.$nip);
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
                <h4><a href="index.php" target="_self"><i class="fa-solid fa-arrow-left"></i></a> Insert <em>Mechanic</em></h4>
                <div class="form-control">
                    <form name="form-insert" action="<?php $_SERVER['PHP_SELF'];?>" method="POST" class="form-item" enctype="multipart/form-data">
                        <div class="item">
                            <h4>NIP:</h4>
                            <input type="number" name="NIP" placeholder="Please input NIP here.." data-maxlength="10" oninput="this.value=this.value.slice(0,this.dataset.maxlength)" required>
                        </div>
                        <div class="item">
                            <h4>Name:</h4>
                            <input type="text" name="nama" placeholder="Please input name here.." required>
                        </div>
                        <div class="item">
                            <h4>Birthday:</h4>
                            <input type="date" name="tanggal_lahir" required>
                        </div>
                        <div class="item">
                            <h4>Address:</h4>
                            <textarea class="textarea" name="alamat" required></textarea>
                        </div>
                        <div class="item">
                            <h4>Division:</h4>
                            <select name="divisi" class="select">
                                <option value="IT">IT</option>
                                <option value="HRD">HRD</option>
                                <option value="Umum">Umum</option>
                            </select>
                        </div>
                        <div class="item">
                            <h4>Picture:</h4>
                            <input type="file" name="foto" accept="image/png, image/jpg, image/jpeg" required>
                        </div>
                        <div class="item">
                            <input type="submit" name="submit" value="Submit" class="btn-submit" >
                            <input type="reset" value="Reset">
                        </div>
                        <br><br><br><br>
                    </form>
                </div>
            </div>
        </div>
        <script src="https://kit.fontawesome.com/d9b2e6872d.js" crossorigin="anonymous"></script>
    </body>
</html>