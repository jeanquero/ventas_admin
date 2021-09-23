<?php 
require_once __DIR__ . "/../../repository/paises.php";
$pais = new Pais;
$paises = $pais->getData();
?>
<div class="modal fade" id="agregarEmpresa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h5 class="modal-title" id="create_company">Agregar empresa</h5>
        <h5 class="modal-title" id="update_company">Editar empresa</h5>
        <button type="button"  class="close close_modal" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" id="form-empresa" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
          <div class="form-group">
            <label for="name" class="col-form-label">Empresa*:</label>
            <input type="text" class="form-control" id="name" required>
          </div>
          <div class="form-group">
            <label for="ruc" class="col-form-label">RUC y Equivalente*:</label>
            <input type="text" class="form-control" id="ruc" required></input>
          </div>
          <div class="form-group">
            <label for="address" class="col-form-label">Direcci&oacute;n de empresa*:</label>
            <input type="text" class="form-control" id="address" required></input>
          </div>
          <div class="form-group">
            <label for="activity" class="col-form-label">Rubro o actividad*:</label>
            <input type="text" class="form-control" id="activity"></input>
          </div>
          <div class="form-group">
            <label for="country" class="col-form-label">Pa&iacute;s*:</label>
            <select class="form-control" id="country" required>
            <option selected value="null">Seleccione una opción del menu</option>
                            <?php foreach ($paises as &$value) { ?>
                                <option value="<?php echo $value["id"] ?>"><?php echo $value["name"] ?></option>
                            <?php  } ?>

            </select>
            <div class="form-group">
              <label for="billing" class="col-form-label">Conctacto contable/tesoreria/facturaci&oacute;n actividad*:</label>
              <input type="text" class="form-control" id="billing"></input>
            </div>
          </div>
          <input type="hidden" id="id" />
          <input type="hidden" id="old_document" />
        
          <div class="form-group">
            <label for="participants_number" class="col-form-label">Cantidad de participantes*:</label>
            <input type="number" class="form-control" id="participants_number" require></input>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" id="saveCompany">Guardar</button>
        <button type="button" class="btn btn-danger close_modal" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>

<script>

  $("#update_company").hide();
  var myModal = new bootstrap.Modal(document.getElementById("agregarEmpresa"), {});
  var saveEmpresa = $("#form-empresa");
  $(".close_modal").click(function(e) {
   // alert("s")
    //$("#agregarEmpresa").hide();
    myModal.hide();
    myModal.hide();
      });
  saveEmpresa.validate();
  let guardar = document.getElementById('saveCompany');
    guardar.addEventListener("click", () => {
      
      if (!saveEmpresa.valid()) {
            Swal.fire({
                title: 'Error!',
                text: 'Error en los datos de la empresa',
                icon: 'error',
                showConfirmButton: false,
                timer: 2500
            });
        } else {
          companyCreate();
        }
    });

    const companyCreate = async () => {

const response = await fetch('./../../controllers/company.php', {
    method: 'POST',
    body: new URLSearchParams({
        'name': document.getElementById('name').value,
        'address': document.getElementById('address').value,
        'ruc': document.getElementById('ruc').value,
        'participants_number': document.getElementById('participants_number').value,
        'activity': document.getElementById('activity').value,
        'country': document.getElementById('country').value,
        'billing': document.getElementById('billing').value,
        'documentType': '2',
        'id': document.getElementById('id').value,
        'old_document': document.getElementById('old_document').value 
        
      
    })

});

console.log('no hay error', response);
const resp = await response.json();
console.log('no hay error', resp);
if (resp && resp['error'] == "true") {
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