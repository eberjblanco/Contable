@extends('layouts.appAdmin')

@section('head_local')
    <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
 
<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">

<link rel="stylesheet" href="plugins/toastr/toastr.min.css">

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<link rel="stylesheet" href="plugins/toastr/toastr.min.css">

<!-- daterange picker -->
<link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  
@endsection

@section('content')
  <div class="col-md-12">  
    <div class="row">
      <div class="col-md-6">
       <form method="GET" action="{{route('DetEmpC.index')}}">
        <input type="hidden" value="{{ $data['Empresa'][0]['id'] }}" name="id_empresa" id="id_empresa">
        
        <button  class="btn btn-warning"><ion-icon name="return-up-back-outline"></ion-icon></button>
      </form>
      </div>       
    </div>
  </div>
  <hr>

  

    <!--<div class="card card-warning">
        <div class="card-header">
          <h3 class="card-title">Parámetros de Búsqueda</label></h3>
        </div>
        <form id="" method="POST" action="{{ route('TranC.Buscar') }}" enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="id_empresa" value="{{ $data['Empresa'][0]['id'] }}">
          <div class="card-body">          
            <div class="col-md-12">

              <div class="row" style="margin-bottom: 10px; margin-bottom: 20px">
                <div class="col-md-2" style="padding-top: 5px">
                    <div class="custom-control custom-radio" style="margin-right: 40px">
                      <input onclick="req('txt_T')" class="custom-control-input" type="radio" id="customRadio1" name="tipo"  value="T" checked="">
                      <label for="customRadio1" class="custom-control-label">Transacción</label>
                    </div>
                </div>
                <div class="col-md-4">
                   <input required="" type="text" class="form-control" name="txt_T" id="txt_T">
                </div>
                <div class="col-md-3" style="padding-top: 5px">
                    <div class="custom-control custom-radio" style="margin-right: 40px">
                      <input onclick="req('txt_C_name')" class="custom-control-input" type="radio" id="customRadio2" name="tipo" value="cc">
                      <label for="customRadio2" class="custom-control-label">Centro de Costo</label>
                    </div>
                </div>
                <div class="col-md-3">
                  <div class="row">
                      <div class="col-md-9">
                        <input class="form-control" type="text" id="txt_C_name" name="txt_C_name" required="" >  
                      </div>
                      <div class="col-md-2">
                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-lg-cc"><ion-icon name="search-outline"></ion-icon></button>
                        <input type="hidden" id="cc" name="cc">  
                      </div>
                  </div>
                </div>
                
              </div>
             
              <div class="row" style="margin-bottom: 10px; margin-bottom: 20px">
                <div class="col-md-2" style="padding-top: 5px">
                    <div class="custom-control custom-radio" style="margin-right: 40px">
                      <input onclick="req('txt_E')" class="custom-control-input" type="radio" id="customRadio3" name="tipo" value="E">
                      <label for="customRadio3" class="custom-control-label">Egreso</label>
                    </div>
                </div>
                <div class="col-md-4">
                   <input required="" type="text" class="form-control" name="txt_E" id="txt_E">
                </div>
                  <div class="col-md-3" style="padding-top: 5px">
                    <div class="custom-control custom-radio" style="margin-right: 40px">
                      <input onclick="req('txt_F')" class="custom-control-input" type="radio" id="customRadio4" name="tipo" value="F">
                      <label for="customRadio4" class="custom-control-label">Factura</label>
                    </div>
                </div>
                <div class="col-md-3">
                   <input required="" type="text" class="form-control" name="txt_F" id="txt_F">
                </div>
              </div>
             
              <div class="row" style="margin-bottom: 10px; margin-bottom: 20px">
                <div class="col-md-2" style="padding-top: 5px">
                    <div class="custom-control custom-radio" style="margin-right: 40px">
                      <input onclick="req('sel_prov_name')" class="custom-control-input" type="radio" id="customRadio5" name="tipo" value="Prov">
                      <label for="customRadio5" class="custom-control-label">Terceros</label>
                    </div>
                </div>
                <div class="col-md-4">
                  <div class="row">
                      <div class="col-md-9">
                        <input class="form-control" type="text" id="sel_prov_name" name="sel_prov_name" required="" >  
                      </div>
                      <div class="col-md-2">
                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-lg"><ion-icon name="search-outline"></ion-icon></button>
                        <input type="hidden" id="sel_prov" name="sel_prov">  
                      </div>
                  </div>
                </div>
                <div class="col-md-3" style="padding-top: 5px">
                    <div class="custom-control custom-radio" style="margin-right: 40px">
                      <input onclick="req('txt_Fecha')" class="custom-control-input" type="radio" id="customRadio6" name="tipo" value="Fecha">
                      <label for="customRadio6" class="custom-control-label">Rango de Fecha</label>
                    </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="far fa-calendar-alt"></i>
                        </span>
                      </div>
                      <input type="text" class="form-control float-right" id="txt_Fecha" name="txt_Fecha">
                    </div>
                  </div>
                </div>
              </div>
            </div>           
          </div>
          <div class="card-footer">
            <button class="btn btn-warning">Buscar</button>
          </div>
        </form>
    </div>-->








    <div class="card card-warning">
        <div class="card-header">
          <h3 class="card-title">Transacciones</label></h3>
        </div>
        <div class="card-body">
           <div class="table table-responsive">
            <form method="POST" action="{{ route('TranC.Contabilizacion') }}">
              @csrf
               <input id="countReg" num="{{ count($data['Registros']) }}" value="{{ count($data['Registros']) }}" name="countReg" type="hidden">
               <input type="hidden" value="{{ $data['Empresa'][0]['id'] }}" name="id_empresa" id="id_empresa">
              <button id="enviar" class="btn btn-warning" disabled="">Enviar a Contabilización</button>
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th><input id="check_todos"  onclick="todos()" type="checkbox" > </th> 
                    <th>ID</th>
                    <th>Fec. Entr.</th>
                    <th>Dia</th>  
                                       
                    <th>CeCo</th>
                    <th>Tip*</th>
                    <th>Est.#</th>                         
                    <th>Doc.</th>
                    <th>Opc.</th>
                  </tr>
                </thead>
                <tbody>
                  @php
                    $cont=1;
                  @endphp

                  @forelse( $data['Registros'] as $RegistrosItem)

                    <tr id="fila_{{ $cont }}" name="" style="background-color: ">
                      @php
                        $date = new DateTime($RegistrosItem->created_at);
                      @endphp

                      <td>
                        <input onclick="selFila('{{ $cont }}')" type="checkbox" id="checkFila_{{ $cont }}" name="" value="{{ $cont }}"> 
                      </td>

                      <td>
                        <input type="hidden" value="{{ $RegistrosItem->id }}" name="id_tran_{{ $cont }}" id="id_tran_{{ $cont }}">
                        {{ $RegistrosItem->id }}
                      </td>

                      <td>{{ $date->format('Y-m-d ') }}</td>

                      <td>
                        <div class="row">                          
                          <div class="col-md-6">
                            @forelse( $data['Cc'] as $ccItem)
                              @if($ccItem->id==$RegistrosItem->id_cc)
                                <input readonly="" class="form-control" type="text" name="fecha_{{ $cont }}" id="fecha_{{ $cont }}" value="{{ $ccItem->año.'-'.$ccItem->mes }}">
                              @endif

                            @empty

                            @endforelse
                          </div>
                          <div class="col-md-6">
                            <input type="text" class="form-control" id="num_{{ $cont }}" name="num_{{ $cont }}" >
                          </div>
                        </div>                      
                      </td>

                     
                      <td>{{ $RegistrosItem->Cc->descripcion }}</td>

                      <td>{{ $RegistrosItem->tipo }}</td>

                      @php
                      $simbolo='';
                        switch ($RegistrosItem->Estado->descripcion) {
                          case 'Entregado por Cliente':
                            $simbolo = "<ion-icon name='paper-plane-outline'></ion-icon>";
                            break;
                        }

                      @endphp
                      <td>{{ str_replace("1", " ", print($simbolo))  }}</td>

                      <td>
                       

                       @forelse($data['Documentos'] as $DocumentosItem)
                          @if($DocumentosItem->id_tran == $RegistrosItem->id)
                              <div class="row">
                                 <a href="#" data-toggle="modal" data-target="#exampleModal" style="margin-right: 25px" onclick="prevista('{{'Documentos/Temp/'.$data['Empresa'][0]['Razon'].'/'.$RegistrosItem->Cc->mes.'/'.$DocumentosItem->nombre}}')">{{ $DocumentosItem->nombre }}</a>
                              </div>
                              <hr>
                          @endif

                       @empty

                       @endforelse

                      </td>  

                      <td>
                        <div class="btn-group btn-block">
                          <button type="button" class="btn btn-warning">Opciones</button>
                          <button type="button" class="btn btn-warning dropdown-toggle dropdown-icon" data-toggle="dropdown">
                            <span class="sr-only">Toggle Dropdown</span>
                            <div class="dropdown-menu" role="menu">
                              <a class="dropdown-item" >Comentarios</a>                     
                              <div class="dropdown-divider"></div>                      
                              <a class="dropdown-item" >Eliminar</a>                     
                            </div>
                          </button>
                        </div>
                      </td> 
                    </tr> 

                    @php
                      $cont = $cont + 1;
                    @endphp  

                  @empty
                     
                  @endforelse  

                </tbody>
              </table>    
            </form>
          </div>
        </div>
        <div class="card-footer">
          <div class="row">
               <div class="col-md-6" style="border-right: solid 1px;">
            <div class="row">
              <p style="font-weight: bold;">Tipo*</p>
            </div>
            <div class="row">
              <div class="col-md-4">
                I = Ingreso
              </div>
              <div class="col-md-4">
                G = Gasto
              </div>
              <div class="col-md-4">
                O = Otro
              </div>
            </div>
          </div>
          <div class="col-md-6" style="padding-left: 20px">
            <div class="row">
              <p style="font-weight: bold;">Estados#</p>
            </div>
            <div class="row">
              <div class="col-md-4">
                <img src="dist/img/envia.png" width="20%"> = Entr. Cliente
              </div>
              <div class="col-md-4">
                <ion-icon name="trail-sign-outline"></ion-icon> = Contabili.
              </div>
              <div class="col-md-4">
                <ion-icon name="search-outline"></ion-icon> = Revisión 
              </div>                                 
            </div>
            <div class="row">      
                <div class="col-md-4">
                <ion-icon name="build-outline"></ion-icon> = Cambios
              </div>         
              <div class="col-md-4">
                <ion-icon name="eye-outline"></ion-icon> = Rev Final
              </div>     
                <div class="col-md-4">
                <ion-icon name="checkmark-circle-outline"></ion-icon> = Aprob
              </div>
                       
            </div>
            <div class="row">
               <div class="col-md-4">
                <ion-icon name="file-tray-full-outline"></ion-icon> = Arch
              </div>  
               
            </div>
          </div>
          </div>       
        </div>
    </div>
 
    <div class="modal fade" id="modal-lg">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Terceros</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="table table-responsive">
            <table id="example2" class="table table-bordered table-hover">
              <thead>
              <tr>
                <th>Nombre</th> 
                <th> </th>
              
              </tr>
              </thead>
              <tbody>
                @forelse($data['Proveedores'] as $ProveedoresItem)
                  <tr>                       
                    <td>{{ $ProveedoresItem->Nombre }}</td>
                    <td>
                      <button class="btn btn-warning" onclick="sel_provee('{{ $ProveedoresItem->id }}','{{ $ProveedoresItem->Nombre }}')">Seleccionar</button>
                    </td>                     
                  </tr>
                @empty
                   
                @endforelse           
              </tbody>
            </table>  
        </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>


    <div class="modal fade" id="modal-lg-cc">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Centros de Costo</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="table table-responsive">
            <table id="example3" class="table table-bordered table-hover">
              <thead>
              <tr>
                <th>Descripción</th> 
                <th> </th>
              
              </tr>
              </thead>
              <tbody>
                @forelse($data['Cc'] as $CcItem)
                  <tr>                       
                    <td>{{ $CcItem->descripcion.' '.$CcItem->año.'-'.$CcItem->mes }}</td>
                    <td>
                      <button class="btn btn-warning" onclick="sel_cc('{{ $CcItem->id }}','{{ $CcItem->descripcion.' '.$CcItem->año.'-'.$CcItem->mes }}')">Seleccionar</button>
                    </td>                     
                  </tr>
                @empty
                   
                @endforelse           
              </tbody>
            </table>  
        </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div> 






     <div class="modal fade" id="modal-lg-doc">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Documentos</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div> 





<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">PreVisualización</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="modalPrevista"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>       
      </div>
    </div>
  </div>
</div>

  <p id="tipo" style="visibility: hidden;">{{ $data['Tipo']}}</p>
  <p id="mensaje" style="visibility: hidden;">{{ $data['Texto']}}</p>
 

@endsection


@section('script_local')

  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
 
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="dist/js/demo.js"></script>

  <script src="plugins/datatables/jquery.dataTables.js"></script>
  <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>

  <script src="plugins/toastr/toastr.min.js"></script>

  <!-- InputMask -->
  <script src="plugins/moment/moment.min.js"></script>
  <script src="plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
  <!-- date-range-picker -->
  <script src="plugins/daterangepicker/daterangepicker.js"></script>

  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">


  

  <script type="text/javascript">


    $(function () {   
    
      $('#txt_C_name').removeAttr('required')
      $('#sel_prov_name').removeAttr('required')
      $('#txt_E').removeAttr('required')
      $('#txt_F').removeAttr('required')
      $('#txt_Fecha').removeAttr('required')

      //Date range picker
      $('#txt_Fecha').daterangepicker({
          locale: {
              format: 'YYYY/MM/DD'
          }
      })

      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        "fixedColumns": true,
        "columnDefs": [
          { "width": "15%", "targets": 2 },
          { "width": "20%", "targets": 3 }
        ]
      });

      $('#example3').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
       
      });


      mensaje = $('#mensaje').html();
      tipo = $('#tipo').html();
      if (tipo=='Error') {toastr.error(mensaje)}
      if (tipo =='OK') {toastr.success(mensaje)}
    });

     function prevista(archivo){
      imagen = ' <embed src="'+ archivo +'" width="100%" height="500px"></embed>'
      $('#modalPrevista').html(imagen)
    }


    function todos(){
      num = $('#countReg').attr('num')
      for (var i = 1; i <= num; i++) {
        if ($('#check_todos').prop('checked')) {
          $('#checkFila_'+i).prop('checked',true)
        }else{
          $('#checkFila_'+i).prop('checked',false)
        }        
        selFila(i)
      }
    }

   


    function selFila(id){
      if ($('#checkFila_'+id).prop('checked')) {       
       $('#fila_'+id).css('background-color','#C4BFBE')
       $('#num_'+id).prop('name','num_' + id)    
       $('#id_tran_'+id).prop('name','id_tran_' + id)        
       $('#num_'+id).prop('required','true')   
      }else{
        $('#fila_'+id).css('background-color','')
        $('#num_'+id).prop('name','')      
        $('#id_tran_'+id).prop('name','')                
        $('#num_'+id).removeProp('required') 
      }     
      segEnviar()
    }


    function segEnviar(){
      $('#enviar').attr('disabled',true)
      num = $('#countReg').attr('num')
      for (var i = 1; i <= num; i++) {
       if ($('#checkFila_'+i).prop('checked')) {
        $('#enviar').removeAttr('disabled')
       }
      }
    }



    function vistaPrevia(id){
      if ($('#vista_' + id).css('display') == 'none') {
        $('#vista_' + id).css('display','block')  
      }else{
        $('#vista_' + id).css('display','none')  
      }
      
    }

      function elim(id){
     
      if ($('#customSwitch3_' + id).prop('checked')) {

        $('#elim_'+id).removeAttr('disabled')
      }else{
        $('#elim_'+id).attr('disabled',true)
      }
    }

  
  $("#sel_prov_name").keydown(function(event){
    if (event.keyCode > 0) {
      $('#modal-lg').modal('show');
      return false
    }
    
  }); 

    $("#txt_C_name").keydown(function(event){
    if (event.keyCode > 0) {
      $('#modal-lg-cc').modal('show');
      return false
    }
    
  });

  function sel_cc(id,nombre){
  $('#cc').val(id)  
   $('#txt_C_name').val(nombre)
   $('#modal-lg-cc').modal('hide');
  }

  function sel_provee(id,nombre){
   $('#sel_prov').val(id)  
   $('#sel_prov_name').val(nombre)
   $('#modal-lg').modal('hide');

  }

  function req(obj){
    //todos sin required
      $('#txt_T').removeAttr('required')
      $('#txt_C_name').removeAttr('required')
      $('#sel_prov_name').removeAttr('required')
      $('#txt_E').removeAttr('required')
      $('#txt_F').removeAttr('required')
      $('#txt_Fecha').removeAttr('required')
    //este si
      $('#'+obj).attr('required','true')
  }

  

      
  </script>

@endsection


