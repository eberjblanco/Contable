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
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">

  <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
@endsection


@section('content')
  @forelse($data['Emp'] as $EmpItem) 
    @php( $id_empresa=$EmpItem->id )
    @php( $Razon=$EmpItem->Razon )
    @php( $Nit=$EmpItem->Nit )    
  @empty

  @endforelse  

  <div class="col-md-6">
    <a href="{{ route('regemp.index')}}" class="btn btn-warning"><ion-icon name="return-up-back-outline"></ion-icon></a>
  </div>
  <hr>
  <div class="row">
    <div class="col-md-6">   
       <div class="card card-warning">
        <div class="card-header">
          <h3 class="card-title">Usuarios Registrados en el Sistema</h3>
        </div> 
        <div class="card-body">
          <div class="table table-responsive">
             <table id="example2" class="table table-bordered table-hover">
              <thead>
              <tr>
               
                <th>Email</th>               
               
                <th> </th>          
                        
              </tr>
              </thead>
              <tbody>
                @forelse($data['Usuarios'] as $UsuariosItem)
                  
                    
                    <tr>
                      <form method="POST" action="{{ route('UserEmpC.store') }}">
                        @csrf
                       
                        <td> <input type="hidden" value="{{ $UsuariosItem->id }}" id="id_usuario"  name="id_usuario">
                        <input type="hidden" value="{{ $id_empresa }}" id="id_empresa"  name="id_empresa"><ion-icon style="margin-right: 10px" name="person-outline"></ion-icon>{{ $UsuariosItem->email }}</td>

                        
                        
                        <td><button type="submit" class="btn btn-warning"><ion-icon name="person-add-outline"></ion-icon></button></td>
                      </form>
                    </tr>

                @empty
                   
                @endforelse          
              </tbody>
            </table>  
            </div>
        </div>     
        <div class="card-footer">

        </div>       
  </div>
  </div>
  <div class="col-md-6">   
       <div class="card card-warning">
        <div class="card-header">
          <h3 class="card-title">Usuarios Asignados a {{ $Razon }}</h3>
        </div> 
        <div class="card-body">
          <div class="table table-responsive">
             <table id="example3" class="table table-bordered table-hover">
              <thead>
              <tr>
                
                <th>Email</th>   
                  
                <th> </th>          
                        
              </tr>
              </thead>
              <tbody>
                @forelse($data['UsuEmp'] as $UsuEmpItem)
                  <tr>
                    <form method="POST" action="{{ route('UserEmpC.destroy') }}">
                      @csrf
                      @method('DELETE')
                     

                      <td>  <input type="hidden" value="{{ $id_empresa }}" id="id_empresa"  name="id_empresa"><input type="hidden" id="id" name="id" value=" {{ $UsuEmpItem->id }}"><ion-icon name="person-outline" style="margin-right: 10px"></ion-icon>{{ $UsuEmpItem->User->email }}</td>
                     
                      <td><button class="btn btn-warning"><ion-icon name="trash-outline"></ion-icon></button></td>
                    </form>
                  </tr>
                @empty
                   
                @endforelse           
              </tbody>
            </table>  
            </div>
        </div>     
        <div class="card-footer">

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

      $('#example3').DataTable({
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

