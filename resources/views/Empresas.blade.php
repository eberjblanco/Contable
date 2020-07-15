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

  <style type="text/css">
    .imagen{
      width: 80px;
      height: 80px;
      border-radius: 50%;
      float: left;
      margin-top: 3%;
      margin-left: 3%;
      margin-right: 4%;
    } 
    .textos{
      float: left;
      margin-top: 4%;
      margin-left: 3%;
      margin-right: 4%;
    }
  </style>
@endsection

@section('content')

  <div class="col-md-12">
    <div class="card card-warning">
      <div class="card-header">
        <h3 class="card-title">Lista de Empresas</h3>
      </div>  
      <br>
      <div class="col-md-12">
        <div class="table table-responsive">
          <table id="example2" class="table table-bordered table-hover">
            <thead>
              <tr>
               
                <th>Nombre</th>            
                <th> </th> 
              </tr>
            </thead>
            <tbody>
              @forelse( $data['Empresas'] as $EmpresasItem )
                
                  <tr>
                    <form method="GET" action="{{route('DetEmpC.index')}}">
                  @csrf
                    <input type="hidden" value="{{ $EmpresasItem->id_empresa }}" name="id_empresa" id="id_empresa">
                    <input type="hidden" name="Vengo" id="Vengo" value="Empresas.index">
                    <td>
                    <div class="col-md-6">
                       <img src="{{ 'logos/'.$EmpresasItem->id_empresa.'.jpeg'}}" class="imagen">  
                        <div class="textos">                                         
                        <h3>{{ $EmpresasItem->Empresa->Razon }},</h3>
                        <p>Nit: {{ $EmpresasItem->Empresa->Nit }}</p>  
                        </div>                    
                    </div>          
                    </td>
                    <td>
                      @if($EmpresasItem->id_status==1)
                      <button class="btn btn-warning"><ion-icon name="eye-outline"></ion-icon></button>
                      @else
                      <label>Inhabilitado</label>
                      @endif
                    </td>
                     </form>
                  </tr>                        
               
                
              @empty
                  <option value="" disabled=""  selected="">No se encuentra asignado a ninguna empresa</option>
              @endforelse  


             
            </tbody>
          </table>  
        </div>
        <br>
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

  <script type="text/javascript">
   

     $(function () {
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


