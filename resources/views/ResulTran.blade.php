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

  
@endsection

@section('content')
  <div class="col-md-12">  
    <div class="row">
      <div class="col-md-6">
       <form method="POST" action="{{route('TranC.index')}}">
        @csrf
        <input type="hidden" value="{{ $data['Empresa'][0]['id'] }}" name="id_empresa" id="id_empresa">
        <button  class="btn btn-warning"><ion-icon name="return-up-back-outline"></ion-icon></button>
      </form>
      </div>       
    </div>
  </div>
  <hr>

  

    <div class="card card-warning">
        <div class="card-header">
          <h3 class="card-title">Transacciones</label></h3>
        </div>
        <div class="card-body">
           <div class="table table-responsive">
            <table id="example2" class="table table-bordered table-hover">
              <thead>
                <tr>
                 
                  <th>id</th>  
                  <th>Creada Por</th>  
                  <th>CeCo</th>
                  <th>Tipo</th>
                  <th>Estado</th>            
                  <th>Historial</th> 
                  <th>Gestionar</th> 
                </tr>
              </thead>
              <tbody>
                @forelse( $data['Registros'] as $RegistrosItem )                  
                 <tr>
                  <td>{{ $RegistrosItem->id }}</td>
                  <td>{{ $RegistrosItem->User->name }}</td>
                  <td>{{ $RegistrosItem->Cc->descripcion .' '.$RegistrosItem->Cc->año .'-'.$RegistrosItem->Cc->mes}}</td>
                  <td>{{ $RegistrosItem->tipo }}</td>
                  <td>{{ $RegistrosItem->Estado->descripcion }}</td>
                  <td>
                    <form method="POST" action="">
                      @csrf
                      <input type="hidden" name="id" id="id" value="{{ $RegistrosItem->id }}">
                      <button class="btn btn-warning"><ion-icon name="receipt-outline"></ion-icon></button>
                    </form>
                  </td> 
                  <td>
                    <div class="row">
                      <div style="padding-right: 20px ;margin-left: 20px;border-right:  solid 1px;" >
                          <form method="POST" action="" >
                            @csrf
                            <input type="hidden" name="id" id="id" name="id" id="id" value="{{ $RegistrosItem->id }}">
                            <input type="hidden" name="id" id="id" name="id" id="id" value="{{ $RegistrosItem->id_estado }}">
                            <button class="btn btn-warning"><ion-icon name="settings-outline"></ion-icon></button>
                          </form>
                      </div>                    
                      <div style="margin-left: 20px; ">
                         <form  method="POST" action="" >
                          @csrf
                          <input type="hidden" name="id" id="id" name="id" id="id" value="{{ $RegistrosItem->id }}">
                          <input type="hidden" name="id" id="id" name="id" id="id" value="{{ $RegistrosItem->id_estado }}">
                          <div class="row">
                            @if($RegistrosItem->id_estado == 1)
                              @php
                                 $ruta='';
                                $icon='trash-outline';
                              @endphp
                                <div class="form-group" style="margin-right: 10px;padding-top: 6px">
                                  <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                    <input onchange="elim({{ $RegistrosItem->id }})" type="checkbox" class="custom-control-input" id="customSwitch3_{{ $RegistrosItem->id }}">
                                    <label class="custom-control-label" for="customSwitch3_{{ $RegistrosItem->id }}">Seguro?</label>
                                  </div>
                                </div>
                                <button disabled="" id="elim_{{ $RegistrosItem->id  }}" class="btn btn-warning"><ion-icon name="{{ $icon }}"></ion-icon></button>
                            @else
                               @php
                                 $ruta='';
                                $icon='arrow-undo-outline';
                              @endphp
                                <button id="elim_{{ $RegistrosItem->id  }}" class="btn btn-warning"><ion-icon name="{{ $icon }}"></ion-icon></button>
                            @endif
                          
                            
                          </div>
                          
                        </form>
                      </div>                      
                    </div>                    
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
 
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="dist/js/demo.js"></script>

  <script src="plugins/datatables/jquery.dataTables.js"></script>
  <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>

  <script src="plugins/toastr/toastr.min.js"></script>

 

  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">

  <script type="text/javascript">

    function elim(id){
     
      if ($('#customSwitch3_' + id).prop('checked')) {

        $('#elim_'+id).removeAttr('disabled')
      }else{
        $('#elim_'+id).attr('disabled',true)
      }
    }


  $(function () {   
   

    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
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

      
  </script>

@endsection
