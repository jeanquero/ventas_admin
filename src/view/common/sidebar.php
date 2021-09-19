<?php
$path = getcwd();
?>

<nav id="sidebar" class="">
  <div class="sidebar-header navbar-light border-bottom title-header" id="sidebar-title" style="background-color: #38414A; min-height: 90px; max-height: 90px">
      <span> <img src="../../../src/assets/img/logo.png"></span>
  </div>
    <h6 class="color-activo p-2 mt-2">REGISTROS</h6>
  <ul class="list-unstyled components">
    <li>
      <a
        href="#homeSubmenu"
        data-toggle="collapse"
        aria-expanded="false"
        class="dropdown-toggle text-success"
        ><i class="fa fa-building" aria-hidden="true"></i> Empresas</a
      >
      <ul class="collapse list-unstyled" id="homeSubmenu">
        <li><a href="./../empresas/contex.php" class="color-submenu" >Asociados Y colaboradores APA</a></li>
        <li><a href="./../aven/contex.php" class="color-submenu">Empresas AVEM</a></li>
        <li><a href="./../regular/contex.php" class="color-submenu">Regular</a></li>
      </ul>
    </li>
    <li>
      <a
        href="#homePersonas"
        data-toggle="collapse"
        aria-expanded="false"
        class="dropdown-toggle text-warning"
        ><i class="fa fa-user" aria-hidden="true"></i> Personas</a
      >
      <ul class="collapse list-unstyled" id="homePersonas">
        <li><a href="./../person/contex.php" class="color-submenu">Persona Natural</a></li>
        <li><a href="./../estudiante/contex.php" class="color-submenu">Estudiante</a></li>
      </ul>
    </li>
  </ul>
  <div class="sidebar-header navbar-light" style="color: black;">
    <div class="ml-1 p-2" ><a href="./../precios/contex.php" class="color-activo">PRECIO</a></div>
  </div>

  <div class="sidebar-header navbar-light" style="color: black;">
      <ul class="list-unstyled components">
          <li>
              <a
                      href="#homePagos"
                      data-toggle="collapse"
                      aria-expanded="false"
                      class="dropdown-toggle color-activo"
              ></i> PAGOS</a
              >
              <ul class="collapse list-unstyled" id="homePagos">
                  <li><a href="./../pago_por_empresas/contex.php" class="color-submenu">Empresas</a></li>
                  <li><a href="./../pago_por_personas/contex.php" class="color-submenu">Personas</a></li>
              </ul>
          </li>
      </ul>
  </div>
 <!-- <ul class="list-unstyled">
        <li><a href="./../pago_por_empresas/contex.php" class="text-info">Empresas</a></li>
        <li><a href="./../pago_por_personas/contex.php" class="text-info">Personas</a></li>
      </ul>-->
</nav>
<script>
 /*   $(document).ready(function(){
      $('#company_apa').click(function() {
    $("#contex").load("./src/view/empresas/contex.php");
});
$('#newCompany').click(function() {
        alert("ss")
    $("#contex").load("./src/view/empresas/form.php");
});
$('#person_re').click(function() {
        alert("ss")
    $("#contex").load("./src/view/person/contex.php");
});

    });*/
</script>

<style>
    a:link {
        text-decoration: none !important;
    }
    #sidebar-title{
        max-height: 55px;
        min-height: 56px;
    }
</style>
