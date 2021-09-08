<?php require_once __DIR__ . "/../../repository/company.php";

$company = new Company();
$table = $company->getCompany();
 ?>





<div class="content-wrapper">
<div class="row">
    <div class="col">
    <h2>Empresas</h2>
    </div>
    <div class="col">
      
    </div>
    <div class="col">
    <button type="button" class="btn btn-warning">Agregar Empresa</button>
    </div>
  </div>
  
  
<table class="table table-bordered">
<thead>
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
     <?php if(count($table)>0) {?>
      <tr>
         <?php foreach($table as $key => $value){?> 
          
           <td><?php 
            if($key == "payment") {
                  if($value == "0") {
                    echo '<button type="button" class="btn btn-danger">incompleto</button>';
                  } else {
                    echo '<button type="button" class="btn btn-success">Completo</button>';
                  }
                  
            } else if ($key == "id") {
              echo '<a href="#" id="'.$value.'" class="editCompany">
                <img src="/../../img/edit.svg"/>
              </a>';
            }else {
              
              echo $value;
              if($key == "nombre_representante" ) {
                echo '<a href="#">
                <img src="/../../img/edit.svg"/>
              </a>';
              }

              if($key == "workers" ) {
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
<!-- Content here -->
</div>
<div class="line"></div>