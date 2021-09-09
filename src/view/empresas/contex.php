<?php require_once __DIR__ . "/../../repository/company.php";
$company = new Company();
$table = $company->getCompany();
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
            <th scope="col">Empresa</th>
            <th scope="col">RUC/Equivalente</th>
            <th scope="col">Direccion</th>
            <th scope="col">Pais</th>
            <th scope="col">Rubro</th>
            <th scope="col">Contacto Comtable</th>
            <th scope="col">Participantes</th>
            <th scope="col">Estado</th>
            <th scope="col">Nombre del Registrador</th>
            <th scope="col">Accion</th>
          </tr>
        </thead>
  <tbody>
      <tr>
        <td> Prueba </td>
        <td> 551554221  </td>
        <td> Lima, Peru</td>
        <td> Peru  </td>
        <td> Banca </td>
        <td> 55598885 </td>
        <td> 10 </td>
        <td> <span class="badge badge-danger">Incompleto</span> </td>
        <td> Jean </td>
        <td> <span><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span> <span><i class="fa fa-trash" aria-hidden="true"></i></span>  </td>
      </tr>
      <tr>
        <td> Prueba </td>
        <td> 551554221  </td>
        <td> Lima, Peru</td>
        <td> Peru  </td>
        <td> Banca </td>
        <td> 55598885 </td>
        <td> 10 </td>
        <td> <span class="badge badge-success">Completo</span> </td>
        <td> Jean </td>
        <td> <span><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span> <span><i class="fa fa-trash" aria-hidden="true"></i></span>  </td>
      </tr>
     <?php if (count($table)>0) {?>
      <tr>
         <?php foreach ($table as $key => $value) {?> 
          
           <td><?php
            if ($key == "payment") {
                if ($value == "0") {
                    echo '<button type="button" class="btn btn-danger">incompleto</button>';
                } else {
                    echo '<button type="button" class="btn btn-success">Completo</button>';
                }
            } elseif ($key == "id") {
                echo '<a href="#" id="'.$value.'" class="editCompany">
                <img src="/../../img/edit.svg"/>
              </a>';
            } else {
                echo $value;
                if ($key == "nombre_representante") {
                    echo '<a href="#">
                <img src="/../../img/edit.svg"/>
              </a>';
                }

                if ($key == "workers") {
                    echo '<a href="#">
                <img src="/../../img/edit.svg"/>
              </a>';
                }
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

<?php require_once __DIR__."./modal_new_empresa.php" ?>


</div>

<script>

</script>