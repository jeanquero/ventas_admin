<div class="modal fade" id="agregarEmpresa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h5 class="modal-title" id="exampleModalLabel">Agregar empresa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Empresa*:</label>
            <input type="text" class="form-control" id="empresa">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">RCU o equivalente*:</label>
            <input type="text" class="form-control" id="rcu"></input>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Direccion de empresa*:</label>
            <input type="text" class="form-control" id="rcu"></input>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Rubro o actividad*:</label>
            <input type="text" class="form-control" id="rubro"></input>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Pais*:</label>
            <select class="form-control" id="pais">
                <option value="Peru" selected>Peru</option>

            </select>
            <div class="form-group">
              <label for="message-text" class="col-form-label">Conctacto contable/tesoreria/facturaci&oacute;n actividad*:</label>
              <input type="text" class="form-control" id="rubro"></input>
            </div>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Cantidad de participantes*:</label>
            <input type="number" class="form-control" id="cant_part"></input>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning">Guardar</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>