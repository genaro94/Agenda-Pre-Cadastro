@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Agenda</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://momentjs.com/downloads/moment.min.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.js'></script>

<script type="text/javascript">
      $(document).ready(function() {
        $('#calendar').fullCalendar({
          monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro',
          'Outubro', 'Novembro', 'Dezembro'],
          monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
          dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
          dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],

          buttonText: {
            today:    'Hoje',
            month:    'Mês',
            week:     'Semana',
            day:      'Dia'
          },

          header:{
            left: 'prev, next, today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
            // right: ''

          },
          allDayText: "dia inteiro",
          dateFormat: "dd/mm/yy",
          locale: 'pt-br',

          defaultDate: Date(),
          navLinks: true, // can click day/week names to navigate views
          editable: true,
          eventLimit: true, // allow "more" link when too many events
          events: [
          <?php
          foreach($agendas as $agenda){
            ?>
            {
              dentista_id: '<?php echo $agenda->nome_dentista; ?>',
              title: '<?php echo $agenda->nome_paciente; ?>',
              start: '<?php echo $agenda->data_inicio; ?>',
              color: '<?php echo $agenda->cor; ?>',
              assunto: '<?php echo $agenda->assunto; ?>',
              id: '<?php echo $agenda->id; ?>',
            },<?php
          }
          ?>
          ],

          eventClick: function(event) {

            $('#visualizar #paciente_id').text(event.title);
            $('#visualizar #dentista_id').text(event.dentista_id);
            $('#visualizar #assunto').text(event.assunto);
            $('#visualizar #id').text(event.id);
            $('#visualizar #horas').text(event.start.format('HH:mm'));
            $('#visualizar #data_inicio').text(event.start.format('DD/MM/Y'));

            $('#visualizar .nome_paciente').val(event.title);
            $('#visualizar .nome_dentista').val(event.dentista_id);
            $('#visualizar #detalhe').val(event.assunto);
            $('#visualizar #id_agenda').val(event.id);
            $('#visualizar #horas').val(event.start.format('HH:mm'));
            $('#visualizar #cor').val(event.color);
            $('#visualizar #data_inicio').val(event.start.format('DD/MM/Y'));

            $('#visualizar').modal('show');

            return false;

          },
          selectable: true,

          select: function(startDate, endDate) {
            $('#cadastrarAgenda #start').val(startDate.format('DD/MM/Y'));
            $('#cadastrarAgenda').modal('show');
          },
          eventStartEditable: false
        });

      });
    </script>


@endsection
