<div class="modal fade" id="cadastrarAgenda" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="{{route('agenda.store')}}" method="post">
      {!! csrf_field() !!}
      <div class="modal-header" style="background-color: #9c27b0">
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" style="color: #fff">×</span>
        </button>
      </div>
      <div class="modal-body">

        <div class="row">
          <div class="col-md-8">
            <div class="form-group">
              <label>Data da consulta</label>
              <input name="data_inicio" id="start" required="" type="text" class="form-control date" onkeypress="DataHora(event, this)" autocomplete="off" />
            </div>

          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label class="bmd-label-floating">Horas</label>
              <input name="horas" type="time" required="" autocomplete="off" class="form-control hora" />
            </div>

          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label class="bmd-label-floating">Paciente</label>
              <input type="text" name="search2" id="country_name" class="form-control country_name" autocomplete="off">
               <div class="countryList" id="countryList"></div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label class="bmd-label-floating">Profissional</label>
              <input name="search" required="" id="professional" type="text" class="form-control"/>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label class="bmd-label-floating">Detalhe (Opcional)</label>
              <textarea class="form-control" rows="2" name="assunto"></textarea>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button"  style="border: 1px solid #ccc" data-dismiss="modal">Cancelar</button>
        <button class="btn btn-primary" type="submit">Marcar</button>
      </div>
      </form>
    </div>
  </div>
</div>
