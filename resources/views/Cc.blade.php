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
      <div class="col-md-6" style="padding-left: 20%">
        <div class="row">
          <h3>{{ $data['Empresa'][0]['Razon'] }}, </h3>
          <p style="padding-top: 10px; "> Nit: {{ $data['Empresa'][0]['Nit'] }}</p>
        </div>
      </div> 
    </div>
  </div>
  <hr>


  <div class="col-md-12">
    <div class="card card-warning">
        <div class="card-header">
          <h3 class="card-title">Agregar Centro de Costo en {{ $data['Empresa'][0]['Razon'] }}</h3>
        </div>        
        <form  action="{{ route('CcC.Agregar') }}" method="POST">
          @csrf
          <input type="hidden" name="id_empresa" id="id_empresa" value="{{ $data['Empresa'][0]['id'] }}">
          <div class="card-body">
            <div class="row" style="margin-bottom: 15px">
              <div class="col-md-6">
               <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Código</span>
                  </div>
                  <input type="text" class="form-control" name="cod" id="cod" placeholder="x-x">
                </div>
              </div>                       
            </div>
            <div class="row" style="margin-bottom: 15px">
              <div class="col-md-6">
                 <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Nombre</span>
                  </div>
                   <input required="" name="nombre" type="text" class="form-control" id="nombre" placeholder="Nombre">
                </div>
               
              
              </div>
              <div class="col-md-6">
                 <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Habilitado</span>
                  </div>
                      <select class="form-control" name="habilitado" id="habilitado" required="">
                   <option value="" selected="" disabled="">Seleccionar...</option>
                  <option value="1">Si</option>
                  <option value="0">No</option>
                </select>
                </div>
               
            
              </div>             
            </div>
             <div class="row">
              <div class="col-md-6">

                 <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Año</span>
                  </div>
                    <select class="form-control" required="" name="año" id="año">
                  <option selected="" value="" disabled="">Año</option>
                   @for($i=0;$i<20;$i++)
                    <option value="{{ date('Y') - $i }}">{{ date('Y') - $i }}</option>
                   @endfor
                </select>
                </div>

              
              </div>
              <div class="col-md-6">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Año</span>
                  </div>
                    <select class="form-control" required="" name="mes" id="mes">
                  <option selected="" value="" disabled="">Mes</option>
                   <option value="0" >Todo el Año</option>
                     @for($i=1;$i<13;$i++)
                    <option value="{{  $i }}">{{  $i }}</option>
                   @endfor
                </select>
                </div>
              
              </div>             
            </div>
          </div>
          
          <div class="card-footer">
           <button type="submit" class="btn btn-warning">Agregar</button>
          </div>
        </form>
    </div>
  </div>

  <div class="col-md-12">
    <div class="card card-warning">
        <div class="card-header">
          <h3 class="card-title">Centros de Costo existentes en {{ $data['Empresa'][0]['Razon'] }}</h3>
        </div>        
        <div class="card-body">
            <div class="table table-responsive">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Código</th>   
                  <th>Descripción</th>     
                  <th>Año</th>
                  <th>Mes</th>
                  <th>Habilitado</th>
                  <th> </th>
                  <th> </th>
                  <th> </th>
                </tr>
                </thead>
                <tbody>
                  @forelse($data['CC'] as $CCItem)
                    <tr>
                        <form method="POST" action="{{ route('CcC.Editar') }}">
                          @csrf                           
                          <input type="hidden" name="id_empresa" id="id_empresa" value="{{ $data['Empresa'][0]['id'] }}">
                          <input type="hidden" name="id" id="id" value="{{ $CCItem->id }}">
                          <td>
                            {{ $CCItem->codigo }}
                          </td>
                          <td>
                           {{ $CCItem->descripcion }}
                          </td>
                          <td>
                            {{ $CCItem->año }}
                          </td>
                          <td>
                           {{ $CCItem->mes }}
                          </td>
                          <td>
                          <select class="form-control" name="habilitado" id="habilitado" required="">

                            @php
                              switch ($CCItem->habilitado) {
                                case 1:
                                 $hab = 'Si';
                                  break;
                                case 0:
                                  $hab = 'No';
                                  break;
                                
                                default:
                                  # code...
                                  break;
                              }
                            @endphp

                            <option value="{{ $CCItem->habilitado }}" selected="">{{ $hab }}</option>
                            <option value="1">Si</option>
                            <option value="0">No</option>
                          </select>
                        </td>
                      <td>
                      <input type="hidden" name="id" id="id" value="{{ $CCItem->id}}">
                        <button class="btn btn-warning" ><ion-icon name="create-outline"></ion-icon></button>
                        
                      </td>
                      </form>
                      <td style="padding-left: 35px">
                        <form method="POST" action="{{ route('CcC.Eliminar') }}">
                           @csrf
                            <input type="hidden" name="id_empresa" id="id_empresa" value="{{ $data['Empresa'][0]['id'] }}">
                             <input type="hidden" name="mes" id="mes" value="{{  $CCItem->mes  }}">
                              <input type="hidden" name="año" id="año" value="{{  $CCItem->año  }}">
                               <input type="hidden" name="ruta" id="ruta" value="{{  $CCItem->descripcion  }}">
                         <div class="row">
                            <div class="form-group" style="margin-right: 10px;padding-top: 6px">
                              <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                <input onchange="elim({{ $CCItem->id }})" type="checkbox" class="custom-control-input" id="customSwitch3_{{ $CCItem->id }}">
                                <label class="custom-control-label" for="customSwitch3_{{ $CCItem->id }}">Seguro?</label>
                              </div>
                            </div>
                           
                            <input type="hidden" name="id_empresa" id="id_empresa" value="{{$data['Empresa'][0]['id']}}">
                            <input type="hidden" name="id" id="id" value="{{ $CCItem->id}}">
                             <button id="btn_elim_{{ $CCItem->id }}" disabled="" class="btn btn-warning" ><ion-icon name="trash-outline"></ion-icon></button>
                         </div>
                        </form>
                      </td>
                      <td>
                         <form method="POST" action="{{route('DocumentosC.index')}}"> 
                           @csrf     
                           <input type="hidden" name="año" value="{{ $CCItem->año }}">
                           <input type="hidden" name="mes" value="{{ $CCItem->mes }}">
                            <input type="hidden" name="Vengo" id="Vengo" value="CcC.index">
                            <input type="hidden" name="id_empresa" id="id_empresa" value="{{$data['Empresa'][0]['id']}}">
                            <input type="hidden" name="ruta" id="ruta" value="{{ $CCItem->descripcion}}">

                          <button class="btn btn-warning" ><ion-icon name="eye-outline"></ion-icon></button>
                        </form> 
                      </td>
                    </tr>
                  @empty
                     
                  @endforelse           
                </tbody>
              </table>  
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
  <!-- DataTables -->
  <script src="plugins/datatables/jquery.dataTables.js"></script>
  <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
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

  <script type="text/javascript">

    function elim(id){
      if ($('#'+'customSwitch3_' + id).prop('checked')) {
        $('#btn_elim_'+id).prop('disabled',false)
      }else{
        $('#btn_elim_'+id).prop('disabled',true)
      }
    }
   

     $(function () {

       $('[data-mask]').inputmask()

      mensaje = $('#mensaje').html();
      tipo = $('#tipo').html();
      if (tipo=='Error') {toastr.error(mensaje)}
      if (tipo =='OK') {toastr.success(mensaje)}


    
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
      });

       
    
    });
  </script>

@endsection


