<?php echo $_GET["id"]?>
<div class="content-wrapper">
<h4>Ingrese los datos de la empresa</h4>
            <form method="post" id="form-empresa" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="row">
                    <div class="mb-3 col-lg-6">
                        <label for="name" class="form-label">Empresa*</label>
                        <input type="text" class="form-control col-6" id="name" name="name" required>
                    </div>
                    <div class="mb-3 col-lg-6">
                        <label for="ruc" class="form-label">RUC o equivalente*</label>
                        <input type="text" value="<?php echo $_GET["ruc"] ?>" class="form-control col-6" id="ruc" name="ruc" required>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-lg-6">
                        <label for="address" class="form-label">Dirección de la empresa*</label>
                        <input type="text" class="form-control col-6" id="address" name="address" required>
                    </div>
                    <div class="mb-3 col-lg-6">
                        <label for="activity" class="form-label">Rubro o actividad</label>
                        <input type="text" class="form-control col-6" id="activity" name="activity">
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-lg-6">
                        <label for="billing" class="form-label">Contacto
                            contable/tesorería/facturación</label>
                        <input type="text" class="form-control col-6" id="billing" name="billing">
                    </div>
                    <div class="mb-3 col-lg-6">

                        <label for="country" class="form-label">Pais</label>
                        <select class="form-select" aria-label="Default select example" name="country" id="country" required>
                            <option selected value="null">Seleccione una opción del menu</option>
                            <?php foreach ($paises as &$value) { ?>
                                <option value="<?php echo $value["id"] ?>"><?php echo $value["name"] ?></option>
                            <?php  } ?>
                        </select>
                    </div>
                </div>
            </form>

</div>
<div class="line"></div>