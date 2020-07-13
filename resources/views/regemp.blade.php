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
  <div class="col-md-12">
     <div class="card card-warning">
        <div class="card-header">
          <h3 class="card-title">Registrar Nueva Empresa</h3>
        </div>        
        <form role="form" action="{{ route('regemp.store')}}" method="POST">
          @csrf
          <div class="card-body">
            <div class="form-group">
              <label for="exampleInputEmail1">Nit</label>
              <input required="" name="Nit_nva" type="text" class="form-control" id="Nit_nva" placeholder="Ingrese Nit">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Razón</label>
              <input required="" name="Razon_nva" type="text" class="form-control" id="Razon_nva" placeholder="Ingrese Razón ">
            </div>
          <p>hola mundo</p>
          </div>         

          <div class="card-footer">
            <button type="submit" class="btn btn-warning">Registrar</button>
          </div>
        </form>
    </div>
  </div>
  <hr>
  <div class="col-md-12">
   <div class="card card-warning">
      <div class="card-header">
        <h3 class="card-title">Empresas Registradas</h3>
      </div>  
      <br>
      <div class="col-md-12">
        <div class="table table-responsive">
             <table id="example2" class="table table-bordered table-hover">
          <thead>
          <tr>
            <th>id</th>
            <th>Nit</th>
            <th>Razon</th>
            <th> </th>           
            <th> </th> 
            <th> </th>           
            <th> </th>   
          </tr>
          </thead>
          <tbody>
            @forelse($data['Empresas'] as $EmpresasItem)
              <tr>
                <td>{{ $EmpresasItem->id }}</td>
                <form method="POST" action="{{route('regemp.update',$EmpresasItem->id)}}">
                  @csrf
                  @method('PATCH')
                  <input type="hidden" name="id" id="id" value="{{ $EmpresasItem->id }}">
                  <td><input required="" type="text" class="form-control" name="Nit_edit" id="Nit_edit" value="{{ $EmpresasItem->Nit }}"></td>
                  <td><input required="" type="text" class="form-control" name="Razon_edit" id="Razon_edit" value="{{ $EmpresasItem->Razon }}"></td>
                  <td>
                      <button class="btn btn-warning" ><ion-icon name="create-outline"></ion-icon></button>
                  </td>
                </form>
                <td>
                  
                    <form method="POST" action="{{route('regemp.destroy',$EmpresasItem->id)}}">
                      @csrf
                      @method('DELETE')
                      <input type="hidden" name="id_elim" id="id_elim" value="{{ $EmpresasItem->id }}">
                      <button class="btn btn-warning" ><ion-icon name="trash-outline"></ion-icon></button>
                    </form>
                     
                            
                </td>
                <td>
                    <form method="GET" action="{{route('UserEmpC.index')}}"> 
                       @csrf                    
                      <input type="hidden" name="id" id="id" value="{{ $EmpresasItem->id }}">                     
                      <button class="btn btn-warning" ><ion-icon name="people-outline"></ion-icon></ion-icon></button>
                    </form> 
                </td>

                <td>
                    <form method="GET" action="{{route('DetEmpC.index')}}"> 
                       @csrf     
                        <input type="hidden" name="Vengo" id="Vengo" value="regemp.index">               
                      <input type="hidden" name="id_empresa" id="id_empresa" value="{{ $EmpresasItem->id }}">
                      <button class="btn btn-warning" ><ion-icon name="eye-outline"></ion-icon></button>
                    </form> 
                </td>
              </tr>
            @empty
               
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

