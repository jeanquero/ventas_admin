<div class="modal fade" id="agregarEmpresa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h5 class="modal-title" id="create_company">Agregar Persona Natural</h5>
        <h5 class="modal-title" id="update_company">Editar Persona Natural</h5>
        <button type="button" class="close close_modal" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" id="form-person" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
          <div class="form-group">
            <label for="name" class="col-form-label">Nombre*:</label>
            <input type="text" class="form-control" id="name" required>
          </div>
          <div class="form-group">
            <label for="last_name" class="col-form-label">Apellido*:</label>
            <input type="text" class="form-control" id="last_name" required></input>
          </div>
          <div class="form-group">
            <label for="document" class="col-form-label">Documento de identidad*:</label>
            <input type="text" class="form-control" id="document" required></input>
          </div>
          <div class="form-group">
            <label for="email" class="col-form-label">Correo*:</label>
            <input type="email" class="form-control" id="email" required></input>
          </div>
          <div class="form-group">
            <label for="phone_number" class="col-form-label">Celular*:</label>
            <input type="number" class="form-control" id="phone_number" required></input>
          </div>
          <div class="form-group">
            <label for="city" class="col-form-label">Ciudad*:</label>
            <input type="text" class="form-control" id="city"></input>
          </div>

          <div class="form-group">
            <label for="position" class="col-form-label">Cargo*:</label>
            <input type="text" class="form-control" id="position"></input>
          </div>
          <div class="form-group">
            <input type="checkbox" value="true" id="part_invitado" name="part_invitado">
            <label class="col-form-label" for="flexCheckDefault">
              Invitado
            </label>
          </div>
          <div class="form-group">
            <label for="part_empresa" id="part_empresa_label" class="col-form-label">Empresa*</label>
            <input type="text" class="form-control" id="part_empresa" name="part_empresa" required>
          </div>

          <input type="hidden" id="id" />
          <input type="hidden" id="old_document" />
          <input type="hidden" id="old_email" />
          


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
  if (!document.getElementById('part_invitado').checked) {
    $("#part_empresa").hide();
    $("#part_empresa_label").hide();
  }

  var partInvitadoCheck = document.getElementById('part_invitado');
  partInvitadoCheck.addEventListener("change", (e) => {
    if (!document.getElementById('part_invitado').checked) {
      $("#part_empresa").hide();
      $("#part_empresa_label").hide();
    } else {
      $("#part_empresa").show();
      $("#part_empresa_label").show();
    }
  });

  $("#update_company").hide();
  var myModal = new bootstrap.Modal(document.getElementById("agregarEmpresa"), {});
  var saveEmpresa = $("#form-person");
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
      personCreate();
    }
  });

  const personCreate = async () => {

    const response = await fetch('./../../controllers/person.php', {
      method: 'POST',
      body: new URLSearchParams({
        'name': document.getElementById('name').value,
        'last_name': document.getElementById('last_name').value,
        'document': document.getElementById('document').value,
        'email': document.getElementById('email').value,
        'phone_number': document.getElementById('phone_number').value,
        'city': document.getElementById('city').value,
        'part_empresa': document.getElementById('part_empresa').value,
        'position':document.getElementById('position').value,
        'documentType': '2',
        'id_person_type': '2',
        'invitado': document.getElementById('part_invitado').checked,
        'id': document.getElementById('id').value,
        'old_document': document.getElementById('old_document').value,
        'old_email': document.getElementById('old_email').value


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