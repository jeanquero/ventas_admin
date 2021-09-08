<!DOCTYPE html>
<html lang="en">
<?php require_once __DIR__."/src/view/common/header2.php" ?>
<body>
<div class="wrapper">
    <?php require_once __DIR__."/src/view/common/sidebar.php" ?>
    <div class="content">
    <?php require_once __DIR__."/src/view/common/navbar.php" ?>
        <div class="content-wrapper">
           <?php require_once __DIR__."/src/view/common/contex.php" ?>
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
</html>