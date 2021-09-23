<?php
require_once __DIR__ . "/../../conf/monolog.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once __DIR__ . "/../../controllers/exel_export.php";
    $excel = new ExcelExport();
    try {
        $excel->exportEstudiante();
    } catch (Exception $e) {
        $log = new Monolog();
        $log->Logger($e->getMessage(), 'error');
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<link href="./../../css/style2.css" rel="stylesheet" />
<?php require_once __DIR__."/../common/header2.php" ?>
<body>
<div class="wrapper">
    <?php require_once __DIR__."/../common/sidebar.php" ?>
    <div class="content">
    <?php require_once __DIR__."/../common/navbar.php" ?>
        <div class="content-wrapper" id="contex">
<?php require_once __DIR__ . "/../../repository/person.php";

$person = new Person();
$table = $person->getEstudiante();
 ?>





<div class="content-wrapper">
<div class="row">
    <div class="col">
    <h4>Estudiantes</h4>
    </div>
    <div class="col">
      <button type="button" class="btn btn-warning float-right" data-toggle="modal" id="open_modal" data-target="#agregarEmpresa" data-whatever="@mdo">Agregar Estudiante</button>
      <form method="post">
            <button type="submit" class="btn btn-success float-right mr-4 mt-1">Exportar excel</button>
        </form>
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
      <th scope="col">Centro de estudios</th>
      <th scope="col">Código de estudiante</th>
      <th scope="col">Accion</th>
    </tr>
  </thead>
  <tbody>
     <?php if(count($table)>0) {?>
      <script>
                        var people = [];
                      </script>
      <?php foreach ($table as $arr) { 
           ?>   <script>
           people.push(<?php echo json_encode($arr) ?>);
         </script>   <tr>
         <?php foreach($arr as $key => $value){?> 
          
           <td><?php 
            if ($key == "id") {
              echo ' <span><i class="fa fa-pencil-square-o editCompany" id="'.$value.'"  aria-hidden="true"></i></span> <span><i class="fa fa-trash deletePerson" id="'.$value.'_delete" aria-hidden="true"></i></span>';
            }else if($key == "guest") {
              if($value == "true") {
                echo "Si";
              } else {
                echo "No";
              }
            }else {
              echo $value; 
            }
            
            ?> </td><?php }?> 


<?php }?> </tr>
      <?php }?>
  </tbody>
</table>
</div>
</div>

<!-- Content here -->
</div>

<?php require_once __DIR__."/modal_new_person.php" ?>


</div>

<script>
  var myModal = new bootstrap.Modal(document.getElementById("agregarEmpresa"), {});
          $(document).ready(function() {
            $("#open_modal").click(function(e) {
              $("#update_company").hide();
              $("#create_company").show();
              saveEmpresa[0].reset()
              document.getElementById('id').value = null;
              document.getElementById('old_document').value = null;
              document.getElementById('old_email').value = null;
            });
            $('.deletePerson').click(function(e) {
              personDelete(this.id,'delete')
              
            })
            
            $('.editCompany').click(function(e) {

              console.log(people.filter(d => d.id == this.id));
              var update_comapy = people.filter(d => d.id == this.id);

              document.getElementById('name').value = update_comapy[0].name;
              document.getElementById('last_name').value = update_comapy[0].last_name;
              document.getElementById('document').value = update_comapy[0].document_number;
              document.getElementById('email').value = update_comapy[0].email;
              document.getElementById('phone_number').value = update_comapy[0].phone_number;
              document.getElementById('city').value = update_comapy[0].city;
              
              
              document.getElementById('id').value = update_comapy[0].id;
              document.getElementById('old_document').value = update_comapy[0].document_number;
              document.getElementById('old_email').value = update_comapy[0].email;
              document.getElementById('codigo_estudiante').value = update_comapy[0].codigo_estudiante;
              document.getElementById('centro').value = update_comapy[0].centro;
              
              
              
        
        
              
              myModal.show();
              $("#update_company").show();
              $("#create_company").hide();


            });


          });

          const personDelete = async (id, action) => {

const response = await fetch('./../../controllers/person.php', {
  method: 'POST',
  body: new URLSearchParams({
    
    'id': id.split("_")[0],
    'action': action
    


  })

});

console.log('no hay error', response);
const resp = await response.json();
console.log('no hay error', resp);
if (resp && resp['success'] == "false") {
  myModal.hide();
  Swal.fire({
    title: 'Error!',
    text: resp['message'],
    icon: 'error',
    showConfirmButton: false,
    timer: 2500
  });
  console.error('Error', resp);
} else {
  console.log('no hay error', resp);

   location.reload(); 

   saveEmpresa[0].reset()
  myModal.hide();
}


}
        </script>

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