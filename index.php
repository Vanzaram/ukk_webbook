<?php
  include('koneksi.php'); 
?>
<!DOCTYPE html>
<html>
  <head>
    <title>library</title>
    <style type="text/css">
    @media only screen and (max-width: 600px) {
      .hapus{
        position: relative;
        bottom: -20px;   
        padding-left: 16px;
        padding-right: 16px;
      }
      .tambah{
        position: relative;
        float:left;
        top:30px;
        right:200px;
      }
      
      form{
      position: relative;
      left: 200px;
      }
      td{
        font-size: 12px;
      }
      td a{
            font-size: 10px;
      }
      .edit{
        padding-left: 20px;
        padding-right: 20px;
      }
}
      * {
        background-color: #FF8C00;
        font-family: "Trebuchet MS";
      }                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               
      h1 {
        text-transform: uppercase;
        color: #ffffff;
        text-align:left;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       
      }
    table {
      border: solid 1px #0000FF;
      border-collapse: collapse;
      border-spacing: 0;
      width: 70%;
      margin: 10px auto 10px auto;
    }
    table thead th {
        background-color: #0000FF;
        border: solid 1px #0000FF;
        color: #FFFFFF;
        padding: 10px;
        text-align: left;
        
        text-decoration: none;
    }
    table tbody td {
        border: solid 1px #0000FF;
        color: #333;
        padding: 10px;
    }
    a {
          background-color: #0000FF;
          color: #fff;
          padding: 10px;
          text-decoration: none;
          font-size: 12px;
    }
    
    .tambah{
        position: relative;
        float:left;
        margin-left:200px
      }
      form{
        float:right;
        margin-right:200px
      }
      .button{
        padding-bottom:40px
      }
      .button-cari{
        padding: 2px 15px;
        background: blue;
        font-size: 16px;
        border: none;
        color: #fff;
      }
      /* .button-keluar{
        font-weight: bold;
        font-size: 14px;
        color: white;
        width: 44px;
        height: 19px;
        background: #0000FF;
        border-radius: 6px;
        position: absolute;
        right: 0;
        bottom: 0;
      } */

      .container {
        justify-content: space-between;
        flex-direction: column;
        height: 100vh;
        display: flex;
        padding: 10px;
        margin-right: 190px;
      }
      .container .btn-holder {
        justify-content: flex-end;
        display: flex;
      }
      .container .btn-holder button {
        padding: 0px 10px;
        background: blue;
        font-size: 16px;
        border: none;
        color: #fff;
      }
      input {
      box-sizing: border-box;
      background: #C0C0C0;
      border: 2px solid #fff;
      outline-color: white;
      color: #fff;
    }
    </style>
  </head>
  <body>
            
    <center><h1>Daftar Buku</h1><center>
    <div class="button">
    <a href="tambah_buku.php" class ="tambah">+ &nbsp; Tambah</a>
    
    <form action="index.php" method="get">
	<input type="text" name="cari">
	<input type="submit" value="Cari" class="button-cari">
</form>
</div>
    <table>
      <thead>
        <tr>
          <th style="text-align:center;">Gambar</th>
          <th style="text-align:center;">Judul</th>
          <th style="text-align:center;">Pengarang</th>
          <th style="text-align:center;">Penerbit</th>
          <th style="text-align:center;">Action</th>
        </tr>
      </thead>
      <tbody>
    
      <?php
     

      $query = "SELECT * FROM buku ORDER BY id ASC";
      $result = mysqli_query($conn, $query);
      if(!$result){
        die ("Query Error: ".mysqli_error($conn).
           " - ".mysqli_error($conn));
      }
      ?>
      <?php
      if(isset($_GET['cari'])) {
          $cari = $_GET['cari'];
          $result = mysqli_query($conn, "SELECT * FROM buku WHERE judul LIKE '%".$cari."%'");				
      } else {
          $result = mysqli_query($conn, $query);
      }
      
      $no = 1; 
      
      while($row = mysqli_fetch_assoc($result))
      {  
      ?>

       <tr>
          <td style="text-align: center;color: #fff;"><img src="gambar/<?php echo $row['gambar']; ?>" style="width: 120px;"></td>
          <td style="text-align:center;color: #fff;"><?php echo $row['judul']; ?></td>
          <td style="text-align:center;color: #fff;"><?php echo $row['pengarang']; ?></td>
          <td style="text-align:center;color: #fff;"><?php echo $row['penerbit']; ?></td>
          <td style="text-align:center;color: #fff;">
              <a href="edit_buku.php?id=<?php echo $row['id']; ?>" class = "edit"> Edit</a> 
              <a href="proses_hapus.php?id=<?php echo $row['id']; ?>" class = "hapus" onclick="return confirm('Anda yakin akan menghapus buku ini?')">Hapus</a>
          </td>
      </tr>
      <?php
        $no++; //untuk nomor urut terus bertambah 1
      }
      ?>
      </tbody>
    </table>

   
    <div class="container">
  <div class="btn-holder">
    <a href="keluar.php">
      <button type="button" class="button-keluar">Logout</button>
    </a>
  </div>
</div>
    

  </body>
  
</html>