@extends('layouts.app')
@section('content')
<div class="container">
  @if(Session::has('sucesso'))
  <div id="msg" data-notify="container" class="col-11 col-md-4 alert alert-success alert-with-icon animated fadeInDown" role="alert" data-notify-position="top-center" style="display: inline-block; margin: 15px auto; position: fixed; transition: all 0.5s ease-in-out 0s; z-index: 1031; top: 20px; left: 0px; right: 0px;">
    {{ Session::get('sucesso') }}
    <button type="button" aria-hidden="true" class="close" data-notify="dismiss" style="position: absolute; right: 10px; top: 50%; margin-top: -9px; z-index: 1033;"></button><span data-notify="title"></span><a href="#" target="_blank" data-notify="url"></a></div>

    @elseif(Session::has('falhou'))
    <div id="msg2" data-notify="container" class="col-11 col-md-4 alert alert-danger alert-with-icon animated fadeInDown" role="alert" data-notify-position="top-center" style="display: inline-block; margin: 15px auto; position: fixed; transition: all 0.5s ease-in-out 0s; z-index: 1031; top: 20px; left: 0px; right: 0px;">
      {{ Session::get('falhou') }}
      <button type="button" aria-hidden="true" class="close" data-notify="dismiss" style="position: absolute; right: 10px; top: 50%; margin-top: -9px; z-index: 1033;"></button><span data-notify="title"></span><a href="#" target="_blank" data-notify="url"></a></div>
      @endif
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
<!-- cadastrarAgenda -->
@include('agenda.cadastrarAgenda')
<!-- pre cadastro de paciente -->
@include('agenda.addNovoPaciente')


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://momentjs.com/downloads/moment.min.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.js'></script>

<script type="text/javascript">
   $(document).ready(function() {
        $('#cpf').mask('000.000.000-00');

        $().ready(function() {
        setTimeout(function () {
            $('#msg').hide(); // "foo" é o id do elemento que seja manipular.
        }, 4000); // O valor é representado em milisegundos.
        setTimeout(function () {
            $('#msg2').hide(); // "foo" é o id do elemento que seja manipular.
        }, 4000);
        });
    });
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
              dentista_id: '<?php echo $agenda->name; ?>',
              title: '<?php echo $agenda->name; ?>',
              start: '<?php echo $agenda->date; ?>',
              assunto: '<?php echo $agenda->details; ?>',
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
            $('#visualizar #date').text(event.start.format('DD/MM/Y'));

            $('#visualizar .nome_paciente').val(event.title);
            $('#visualizar .nome_dentista').val(event.dentista_id);
            $('#visualizar #detalhe').val(event.assunto);
            $('#visualizar #id_agenda').val(event.id);
            $('#visualizar #horas').val(event.start.format('HH:mm'));
            $('#visualizar #date').val(event.start.format('DD/MM/Y'));

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
      function DataHora(evento, objeto) {
        var keypress = (window.event) ? event.keyCode : evento.which;
        campo = eval(objeto);
        if (campo.value == '00/00/0000') {
          campo.value = "";
        }

        caracteres = '0123456789';
        separacao1 = '/';
        separacao2 = ' ';
        separacao3 = ':';
        conjunto1 = 2;
        conjunto2 = 5;
        conjunto3 = 10;
        conjunto4 = 13;
        conjunto5 = 16;
        if ((caracteres.search(String.fromCharCode(keypress)) != -1) && campo.value.length < (10)) {
          if (campo.value.length == conjunto1)
            campo.value = campo.value + separacao1;
          else if (campo.value.length == conjunto2)
            campo.value = campo.value + separacao1;
          else if (campo.value.length == conjunto3)
            campo.value = campo.value + separacao2;
          else if (campo.value.length == conjunto4)
            campo.value = campo.value + separacao3;
          else if (campo.value.length == conjunto5)
            campo.value = campo.value + separacao3;
        } else {
          event.returnValue = false;
        }
      }

    </script>
    <script src="{{asset('js/jquery.easy-autocomplete.js')}}"></script>
    <style>
        .autocomplete-manual{
            padding: 0px!important;
            border: 1px solid #ccc
        }
        .autocomplete-manual a:hover {
            background: none repeat scroll 0 0 #ebebeb;
            color:#000
        }


    </style>
    <script>
        $(document).ready(function(){
            $('.country_name').keyup(function(){
             
                var query = $(this).val();
                if(query != ''){
                    $.ajax({
                        url:"{{route('agenda.search.pacient')}}",
                        method:"GET",
                        data:{query:query},
                        minlenght:1,
                        success: function (data){
                            $('.countryList').fadeIn();
                            $('.countryList').html(data);
                        }
                    });
                }
            });
            $(document).on('click', 'li', function(){
                $('.country_name').val($(this).text());
                $('.countryList').fadeOut();
            });
        })
    </script>
    <script>

        var options = {

            url: "{{route('agenda.search.professional')}}",

            getValue: "name",

            list: {
            match: {
                enabled: true
            }
            },

            theme: "square"
        };

        $("#professional").easyAutocomplete(options);
    </script>
    
@endsection
