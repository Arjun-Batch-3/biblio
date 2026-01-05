<?php 
  session_start();
  include_once "php/config.php";
  if(!isset($_SESSION['client']['id'])){
    header("location: login.php");
  }
?>
<?php include_once "header.php"; ?>
<body>
  <div class="wrapper">
    <section class="users">
      <header>
        <div class="content">
          <?php 
            $sql = mysqli_query($conn, "SELECT * FROM register_table WHERE register_id = {$_SESSION['client']['id']}");
            if(mysqli_num_rows($sql) > 0){
              $row = mysqli_fetch_assoc($sql);
            }
          ?>
          <img src="../<?php echo $row['register_profile_picture']; ?>" alt="">
          <div class="details">
            <span><?php echo $row['register_full_name'] ?></span>
            <!-- <p><?php echo $row['status']; ?></p> -->
          </div>
        </div>
        <a href="../old_book_post.php" class="logout">Back</a>
      </header>
      <div class="search">
        <span class="text">Book Exchange Messages</span>
        <input type="text" placeholder="">
        <button><i class="fas fa-search"></i></button>
      </div>
      <div class="users-list">
  
      </div>
    </section>
  </div>

  <script src="javascript/users.js"></script>

</body>
</html>
