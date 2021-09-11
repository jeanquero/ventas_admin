<nav id="sidebar" class="">
  <div class="sidebar-header navbar-light bg-dark border-bottom title-header">
    <h3 class="ml-2 p-2"><a href="../../../index.php" class="text-white">AVEM</a></h3>
  </div>
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
        <li><a href="index.php" class="text-info" >Asociados Y colaboradores APA</a></li>
        <li><a href="#" class="text-info">Empresas AVEM</a></li>
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
        <li><a href="./src/view/person/contex.php" class="text-info">Persona Natural</a></li>
        <li><a href="./src/view/estudiante/contex.php" class="text-info">Estudiante</a></li>
      </ul>
    </li>
  </ul>
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
</style>
