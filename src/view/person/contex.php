
<?php require_once __DIR__ . "/../../repository/person.php";

$person = new Person();
$table = $person->getPerson(null);
 ?>





<div class="content-wrapper">
<div class="row">
    <div class="col">
    <h4>Empresas</h4>
    </div>
    <div class="col">
      <button type="button" class="btn btn-warning float-right" data-toggle="modal" data-target="#agregarEmpresa" data-whatever="@mdo">Agregar Empresa</button>
    </div>
  </div>
<div class="row mt-4">
  <div class="col-12 col-12">
    <div class="card p-4">
  
  <table class="table p-4">
      <thead class="thead-light">
    <tr>
      <th scope="col">Nombre</th>
      <th scope="col">Apellido</th>
      <th scope="col">Doc. Identidad</th>
      <th scope="col">Correo</th>
      <th scope="col">Celular</th>
      <th scope="col">Ciudad</th>
      <th scope="col">Cargo</th>
      <th scope="col">Invitado</th>
      <th scope="col">Empresa</th>
      <th scope="col">Accion</th>
    </tr>
  </thead>
  <tbody>
     <?php if(count($table)>0) {?>
      <tr>
         <?php foreach($table as $key => $value){?> 
          
           <td><?php 
            if ($key == "id") {
              echo '<a href="#" id="'.$value.'" class="editCompany">
              <span><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span> <span><i class="fa fa-trash" aria-hidden="true"></i></span> 

              </a>';
            }else {
              
              echo $value;
              

              
            }
            
            ?> </td>


<?php }?> </tr>
      <?php }?>
  </tbody>
</table>
</div>
</div>

<!-- Content here -->
</div>



</div>

<script>

</script>