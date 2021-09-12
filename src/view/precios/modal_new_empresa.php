<?php 

$document_type = $company->getDocumentType();
?>
<div class="modal fade" id="agregarEmpresa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h5 class="modal-title" id="create_company">Agregar Precio</h5>
        <h5 class="modal-title" id="update_company">Editar Precio</h5>
        <button type="button"  class="close close_modal" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" id="form-empresa" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
          <div class="form-group">
            <label for="name" class="col-form-label">Tipo*:</label>
            <select class="form-control" id="document_type" required>
            <option selected value="null">Seleccione una opción del menu</option>
                            <?php foreach ($document_type as &$value) { ?>
                                <option value="<?php echo $value["id"] ?>"><?php echo $value["name"] ?></option>
                            <?php  } ?>

            </select>
          </div>
          <div class="form-group">
            <label for="precio_individual" class="col-form-label">Precio Individual*:</label>
            <input type="number" class="form-control" id="precio_individual" required></input>
          </div>
          <div class="form-group">
            <label for="precio_corparativo" class="col-form-label">Precio Corporativo*:</label>
            <input type="number" class="form-control" id="precio_corparativo" required></input>
          </div>
          <div class="form-group">
            <label for="divisa" class="col-form-label">Divisa*:</label>
            <input type="text" class="form-control" id="divisa"></input>
          </div>
          <div class="form-group">
            <input type="checkbox" value="true" id="estado" name="estado">
            <label class="col-form-label" for="estado">
            Estado
            </label>
          </div>

          
          <input type="hidden" id="id" />
        
          
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

const response = await fetch('./../../controllers/precios.php', {
    method: 'POST',
    body: new URLSearchParams({
        'document_type': document.getElementById('document_type').value,
        'precio_individual': document.getElementById('precio_individual').value,
        'precio_corparativo': document.getElementById('precio_corparativo').value,
        'divisa': document.getElementById('divisa').value,
        'estado': document.getElementById('estado').checked,
        'id': document.getElementById('id').value,
        
      
    })

});

console.log('no hay error', response);
const resp = await response.json();
console.log('no hay error', resp);
if (resp && resp['error'] == "true") {
    myModal.hide();
    Swal.fire({
        title: 'Error!',
        text: resp['error'],
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