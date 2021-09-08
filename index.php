<!DOCTYPE html>
<html lang="en">
<?php require_once __DIR__."/src/view/common/header2.php" ?>
<body>
<div class="wrapper">
    <?php require_once __DIR__."/src/view/common/sidebar.php" ?>
    <div class="content">
    <?php require_once __DIR__."/src/view/common/navbar.php" ?>
        <div class="content-wrapper" id="contex">
           <?php require_once __DIR__."/src/view/empresas/contex.php" ?>
        </div>
    </div>
</div>
</body>
<script>
    $(document).ready(function(){
        $("#sidebarCollapse").on('click', function(){
        $("#sidebar").toggleClass('active');
        });
    });
</script>
<script>
    $(document).ready(function(){
      $('.editCompany').click(function(e) {
          alert("edit")
          console.log(e);
          console.log(this.id)
    $("#contex").load("./src/view/empresas/form.php?id="+this.id);
});


    });
</script>
</html>