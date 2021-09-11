<!DOCTYPE html>
<html lang="en">
<link href="./src/css/style2.css" rel="stylesheet" />
<?php require_once __DIR__ . "/../common/header2.php" ?>

<body>
  <div class="wrapper">
    <?php require_once __DIR__ . "/../common/sidebar.php" ?>
    <div class="content">
      <?php require_once __DIR__ . "/../common/navbar.php" ?>
      <div class="content-wrapper" id="contex">

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
              <button type="button" class="btn btn-warning float-right" data-toggle="modal" id="open_modal" data-target="#agregarEmpresa" data-whatever="@mdo">Agregar Empresa</button>
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
                    <!--  <tr>
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
      </tr>-->
                    <?php if (count($table) > 0) { ?>
                      <script>
                        var company = [];
                      </script>
                      <?php foreach ($table as $arr) {
                      ?>
                        <script>
                          company.push(<?php echo json_encode($arr) ?>);
                        </script>
                        <tr> <?php
                              foreach ($arr as $key => $value) { ?>

                            <td><?php
                                if ($key == "payment") {
                                  if ($value == "0") {
                                    echo '<span class="badge badge-danger">Incompleto</span> ';
                                  } else {
                                    echo '<span class="badge badge-success">Completo</span> ';
                                  }
                                } elseif ($key == "id") {
                                  echo ' <span><i class="fa fa-pencil-square-o editCompany" id="' . $value . '"  aria-hidden="true"></i></span> <span><i class="fa fa-trash eliminar_empresa" id="' . $value . '_delete_company" aria-hidden="true"></i></span>';
                                } else if ($key != "id_county") {
                                  echo $value;
                                  if ($key == "nombre_representante") {
                                    echo '<span><i class="fa fa-pencil-square-o representante_load"  id="' . $arr["id"] . '_rep" aria-hidden="true"></i></span>';
                                  }

                                  if ($key == "workers") {
                                    echo ' <span><i class="fa fa-pencil-square-o workers_load" id="' . $arr["id"] . '_work aria-hidden="true"></i></span>';
                                  }
                                }

                                ?> </td>


                          <?php } ?>
                        </tr> <?php } ?>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>

            <!-- Content here -->
          </div>

          <?php require_once __DIR__ . "/modal_new_empresa.php" ?>


        </div>

        <script>
          $(document).ready(function() {
            $(".representante_load").click(function(e) {
              window.location.href = "./src/view/representante/contex.php?company=" + this.id.split("_")[0];
            });

            $(".workers_load").click(function(e) {
              window.location.href = "./src/view/person_empresa/contex.php?company=" + this.id.split("_")[0];
            });

            $('.eliminar_empresa').click(function(e) {
              companyDelete(this.id.split("_")[0], 'delete')

            })

            $("#open_modal").click(function(e) {
              $("#update_company").hide();
              $("#create_company").show();
              document.getElementById('id').value = null;
              document.getElementById('old_document').value = null;
              saveEmpresa[0].reset()
            });
            $('.editCompany').click(function(e) {

              console.log(company.filter(d => d.id == this.id));
              var update_comapy = company.filter(d => d.id == this.id);

              document.getElementById('name').value = update_comapy[0].name_company;
              document.getElementById('address').value = update_comapy[0].address;
              document.getElementById('ruc').value = update_comapy[0].document_number;
              document.getElementById('participants_number').value = update_comapy[0].workers;
              document.getElementById('activity').value = update_comapy[0].name_company;
              document.getElementById('country').value = update_comapy[0].id_county;
              document.getElementById('billing').value = update_comapy[0].billing;
              document.getElementById('id').value = update_comapy[0].id;
              document.getElementById('old_document').value = update_comapy[0].document_number;
              var myModal = new bootstrap.Modal(document.getElementById("agregarEmpresa"), {});
              myModal.show();
              $("#update_company").show();
              $("#create_company").hide();


            });


          });

          const companyDelete = async (id, action) => {

            const response = await fetch('src/controllers/company.php', {
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
  $(document).ready(function() {
    $("#sidebarCollapse").on('click', function() {
      $("#sidebar").toggleClass('active');
    });
  });
</script>

</html>