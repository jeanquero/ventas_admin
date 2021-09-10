<nav id="sidebar" class="bg-dark">
  <div class="sidebar-header">
    <h3 class="ml-2">AVEM</h3>
    <hr />
  </div>
  <ul class="list-unstyled components text-white">
    <li>
      <a
        href="#homeSubmenu"
        data-toggle="collapse"
        aria-expanded="false"
        class="dropdown-toggle text-white"
        >Empresas</a
      >
      <ul class="collapse list-unstyled" id="homeSubmenu">
        <li><a href="index.php" >Asociados Y colaboradores APA</a></li>
        <li><a href="#">Empresas AVEM</a></li>
        <li><a href="#" id="newCompany">Nuevo</a></li>
      </ul>
    </li>
    <li>
      <a
        href="#homePersonas"
        data-toggle="collapse"
        aria-expanded="false"
        class="dropdown-toggle text-white"
        >Personas</a
      >
      <ul class="collapse list-unstyled" id="homePersonas">
        <li><a href="./src/view/person/contex.php" >Persona Natural</a></li>
        <li><a href="#">Estrudiante</a></li>
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