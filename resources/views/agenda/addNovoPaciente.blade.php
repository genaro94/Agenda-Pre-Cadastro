<div class="modal fade" id="addNovoPaciente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="{{route('agenda.store.pacient')}}" method="post">
      {!! csrf_field() !!}
      <div class="modal-header" style="background-color: #9c27b0">
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" style="color: #fff">×</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label class="bmd-label-floating">Nome do paciente</label>
              <input name="name" required="" type="text" class="form-control" autocomplete="off" />
            </div>
        </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label class="bmd-label-floating">CPF</label>
              <input name="cpf" required="" id="cpf" type="text" class="form-control cpf"/>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-8">
            <div class="form-group">
              <label class="bmd-label-floating">E-mail</label>
              <input name="email" required="" type="text" class="form-control"/>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label class="bmd-label-floating">Senha</label>
              <input name="password" required="" type="password" class="form-control"/>
            </div>
          </div>
        </div>

      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button"  style="border: 1px solid #ccc" data-dismiss="modal">Cancelar</button>
        <button class="btn btn-primary" type="submit">Cadastrar</button>
      </div>
      </form>

    </div>
  </div>
</div>

