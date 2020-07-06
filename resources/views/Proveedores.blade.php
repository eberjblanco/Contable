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

<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">
  
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

  

    <div class="card card-warning">
        <div class="card-header">
          <h3 class="card-title">Agregar Tercero</label></h3>
        </div>
        <form id="" method="POST" action="{{ route('ProvC.Agregar') }}" enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="id_empresa" value="{{ $data['Empresa'][0]['id'] }}">
          <div class="card-body">          
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-6">
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><ion-icon name="business-outline"></ion-icon></span>
                      </div>
                      <input type="text" class="form-control" placeholder="Nombre" name="txt_nombre" id="txt_nombre" required="">
                    </div>
                </div>
                <div class="col-md-6">
                  <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text">@</span>
                      </div>
                      <input type="email" class="form-control" placeholder="Email" name="txt_email" id="txt_email" required="">
                    </div>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-6">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                      </div>
                      <input type="text" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask required="" id="txt_telefono" name="txt_telefono">
                    </div>
                </div>
                <div class="col-md-6">
            
                </div>
              </div>
            </div>
            <br>
            <div class="col-md-12">
              <textarea name="txt_direccion" id="txt_direccion" class="form-control" placeholder="Dirección" required=""></textarea>
            </div>


          </div>
          <div class="card-footer">
            <button class="btn btn-warning">Agregar</button>
          </div>
        </form>
    </div>

    <div class="card card-warning">
        <div class="card-header">
          <h3 class="card-title">Terceros Registrados</label></h3>
        </div>       
        <div class="card-body">          
          <div class="table table-responsive">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Nombre</th>     
                  <th>Email</th>
                  <th>Teléfono</th>
                  <th>Habilitado</th>
                  <th> </th>
                  <th> </th>
                </tr>
                </thead>
                <tbody>
                  @forelse($data['Proveedores'] as $ProveedoresItem)
                    <tr>                       
                      <td>{{ $ProveedoresItem->Nombre }}</td>
                      <td>{{ $ProveedoresItem->email }}</td>
                      <td>{{ $ProveedoresItem->telefono }}</td>     
                      <form method="POST" action="{{ route('ProvC.Editar') }}">
                        @csrf
                        <input type="hidden" name="id" id="id" value="{{ $ProveedoresItem->id }}">
                         <input type="hidden" name="id_empresa" id="id_empresa" value="{{ $data['Empresa'][0]['id'] }}">
                        <td>                        
                          <select class="form-control" name="habilitado" id="habilitado">
                            @php
                              switch ($ProveedoresItem->habilitado) {
                                case 0:
                                  $hab ='Deshabilitado';
                                  break;
                                case 1:
                                  $hab ='Habilitado';
                                  break;
                              }
                            @endphp
                            <option value="{{$ProveedoresItem->Habilitado}}" selected="" disabled="">{{ $hab }}</option>
                            <option value="1">Habilitado</option>
                            <option value="0">Deshabilitado</option>
                          </select>
                        </td>                 
                        <td>
                           <button class="btn btn-warning" ><ion-icon name="create-outline"></ion-icon></button>
                        </td>
                      </form>
                      <td>
                        <form method="POST" action="{{ route('ProvC.Eliminar') }}">
                           @csrf                           
                           <div class="row">
                              <div class="form-group" style="margin-right: 10px;padding-top: 6px">
                                <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                  <input onchange="elim({{ $ProveedoresItem->id }})" type="checkbox" class="custom-control-input" id="customSwitch3_{{ $ProveedoresItem->id }}">
                                  <label class="custom-control-label" for="customSwitch3_{{ $ProveedoresItem->id }}">Seguro?</label>
                                </div>
                              </div>
                             
                              <input type="hidden" name="id_empresa" id="id_empresa" value="{{$data['Empresa'][0]['id']}}">
                              <input type="hidden" name="id" id="id" value="{{ $ProveedoresItem->id}}">
                               <button id="btn_elim_{{ $ProveedoresItem->id }}" disabled="" class="btn btn-warning" ><ion-icon name="trash-outline"></ion-icon></button>
                           </div>
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

  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

  <!-- InputMask -->
  <script src="plugins/moment/moment.min.js"></script>
  <script src="plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
  <!-- date-range-picker -->
  <script src="plugins/daterangepicker/daterangepicker.js"></script>

  <!-- InputMask -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>

<!-- DataTables -->
  <script src="plugins/datatables/jquery.dataTables.js"></script>
  <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>

  

  <script type="text/javascript">

  function elim(id){
    if ($('#'+'customSwitch3_' + id).prop('checked')) {
      $('#btn_elim_'+id).prop('disabled',false)
    }else{
      $('#btn_elim_'+id).prop('disabled',true)
    }
  }

  function req(obj){
    //todos sin required
      $('#txt_T').removeAttr('required')
      $('#txt_C').removeAttr('required')
    //este si
      $('#'+obj).attr('required','true')
  }

  $(function () {   
    //Date range picker
    $('#reservation').daterangepicker()

    $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
      });


    $('[data-mask]').inputmask()

    mensaje = $('#mensaje').html();
    tipo = $('#tipo').html();
    if (tipo=='Error') {toastr.error(mensaje)}
    if (tipo =='OK') {toastr.success(mensaje)}
  });

      
  </script>

@endsection

