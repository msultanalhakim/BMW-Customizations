<?php 
include('connection.php');

$del    = $_GET['del'];
$insert = $_GET['insert'];
$update = $_GET['update'];
if(isset($del)){
    $uploaddir  = 'assets/images/profiles/';
    $sql = "SELECT * FROM tbl_pegawai WHERE NIP = '$del'";
    $query = mysqli_query($conn, $sql);
    $row    = mysqli_fetch_array($query);
    if(file_exists($uploaddir . $row['foto'])){
    unlink($uploaddir . $row['foto']);}

    $delquery = mysqli_query($conn, "DELETE FROM tbl_pegawai WHERE NIP = '$del'");
}

$sql    = "SELECT * FROM tbl_pegawai ORDER BY waktu_ditambahkan ASC";
$query  = mysqli_query($conn, $sql);
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
        <div class="container">
            <div class="sub-container">
                <div class="main-banner">
                    <div class="banner-text">
                        <h6>Welcome to BMW Customizations!</h6><br>
                        <h4><em>BMW</em> with expensive modification, <br> still wealthy?</h4><br><br>
                        <a href="#sub-banner" class="btn-banner">Schedule Now!</a>
                    </div>
                </div>
                <div class="sub-banner" id="sub-banner">
                    <div class="sub-banner-text">
                            <h4><u>List</u> <em>Mechanic</em><a href="insert.php" class="btn-add"><i class="fa-solid fa-user"></i> <i class="fa-solid fa-plus"></i></a></h4>
                            <br>
                            <div class='notification'>
                                <?php if(isset($del)){
                                    ?>
                                    <div class='notification-content'>Data telah berhasil dihapus.<span class='btn-close' onclick="this.parentElement.style.display='none';">&times;</span></div>";
                                    <?php
                                }elseif(isset($insert)){
                                    ?>
                                    <div class='notification-content'>Data telah berhasil ditambah.<span class='btn-close' onclick="this.parentElement.style.display='none';">&times;</span></div>";
                                    <?php
                                }elseif(isset($update)){
                                    ?>
                                    <div class='notification-content'>Data telah berhasil dirubah.<span class='btn-close' onclick="this.parentElement.style.display='none';">&times;</span></div>";
                                    <?php
                                }?>?>
                            </div>
                    </div>
                    <div class="item">
                        <ul>
                            <li><h4>NIP</h4></li>
                            <li><h4>Name</h4></li>
                            <li><h4>Birthday</h4></li>
                            <li class="address"><h4>Address</h4></li>
                            <li><h4>Division</h4></li>
                            <li><h4>Utilities</h4></li>
                        </ul>
                    </div>
                    <?php
                    $no = 1;
                    while($row = mysqli_fetch_array($query)){
                    ?>
                    <div class="item">
                        <ul>
                            <li><h6><?php echo $row['NIP'];?></h6></li>
                            <li><h6><?php echo $row['nama'];?></h6></li>
                            <li><h6><?php echo date('d F Y', strtotime($row['tanggal_lahir']));?></h6></li>
                            <li class="address"><h6><?php echo $row['alamat'];?></h6></li>
                            <li><h6><?php echo $row['divisi'];?></h6></li>
                            <li>
                                <a href="update.php?NIP=<?php echo $row['NIP'];?>" class="btn btn-edit"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a href="view.php?NIP=<?php echo $row['NIP'];?>" class="btn btn-detail"><i class="fa-solid fa-eye"></i></a>
                                <a href="index.php?del=<?php echo $row['NIP']?>" class="btn btn-delete"><i class="fa-solid fa-trash"></i></a>
                            </li>
                        </ul>
                    </div>
                    <?php } ?>
                </div>
                
                </div>
            </div>
        </div>
        <script src="script.js"></script>
        <script src="https://kit.fontawesome.com/d9b2e6872d.js" crossorigin="anonymous"></script>
    </body>
</html>