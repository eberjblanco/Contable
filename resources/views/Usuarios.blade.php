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
     <div class="card card-warning">
        <div class="card-header">
          <h3 class="card-title">Registrar Nuevo Usuario</h3>
        </div>        
        <form  action="{{ route('User.store')}}" method="POST">
          @csrf
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <label for="exampleInputEmail1">Nombre</label>
                <input required="" name="name" type="text" class="form-control" id="name" placeholder="Ingrese Nombre">
              </div>
              <div class="col-md-6">
                <label for="exampleInputEmail1">Email</label>
                <input required="" name="email" type="text" class="form-control" id="email" placeholder="Ingrese Email">
              </div>  
            </div>
            <br>
             <div class="row">
              <div class="col-md-6" style="padding-top: 30px">

                  <div class="custom-control custom-switch">
                      <input type="checkbox" class="custom-control-input" id="customSwitch1">
                      <label class="custom-control-label" for="customSwitch1">Usuario SuperAdmin</label>
                    </div>
              </div>
              <div class="col-md-6">
                 <label for="exampleInputEmail1">Empresa a la que se asigna el usuario</label>

                <select class="form-control" name="id_empresa" id="id_empresa" required="">
                  <option value="" disabled=""  selected="">Seleccion...</option>
                  @forelse( $data['Empresas'] as $EmpresasItem )
                     <option value="{{ $EmpresasItem->id }}">{{ $EmpresasItem->Razon }}</option>
                  @empty
                      <option value="" disabled=""  selected="">No hay Empresas Registradas</option>
                  @endforelse    
                </select>
                
              </div>  
            </div>
           <br>
             <div class="row">
              <div class="col-md-6">
                <label for="exampleInputEmail1">Ingrese Clave</label>
                <input required="" name="clave1" type="password" class="form-control" id="clave1" placeholder="Ingrese Clave">
              </div>
              <div class="col-md-6">
                <label for="exampleInputEmail1">Ingrese Clave Nuevamente</label>
                <input required="" name="clave2" type="password" class="form-control" id="clave2" placeholder="Ingrese Clave">
              </div>  
            </div>
            
          
          
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
        <h3 class="card-title">Usuarios Registrados</h3>
      </div>  
      <br>
      <div class="col-md-12">
        <div class="table table-responsive">
             <table id="example2" class="table table-bordered table-hover">
          <thead>
          <tr>
            <th>id</th>
            <th>Email</th>
            <th>Nombre</th>
            
            <th> </th>           
            <th> </th>
            <th> </th>  
                
          </tr>
          </thead>
          <tbody>
            @forelse($data['Usuarios'] as $UsuariosItem)
              <tr>
                <td>{{ $UsuariosItem->id }}</td>
                <form method="POST" action="{{route('User.update',$UsuariosItem->id)}}">
                  @csrf
                  @method('PATCH')
                  <input type="hidden" name="id" id="id" value="{{ $UsuariosItem->id }}">
                    <td>{{ $UsuariosItem->email }}</td>
                  <td><input required="" type="text" class="form-control" name="name" id="name" value="{{ $UsuariosItem->name }}"></td>
                
               
                   
                  <td>
                      <button class="btn btn-warning" ><ion-icon name="create-outline"></ion-icon></button>
                  </td>
                </form>
                <td>
                  
                    <form method="POST" action="{{route('User.destroy',$UsuariosItem->id)}}">
                      @csrf
                      @method('DELETE')
                      <input type="hidden" name="id_elim" id="id_elim" value="{{ $UsuariosItem->id }}">
                      <button class="btn btn-warning" ><ion-icon name="trash-outline"></ion-icon></button>
                    </form>
                     
                            
                </td>

                  <td>
                  
                    <form method="" action="">
                     
                      <input type="hidden" name="id_elim" id="id_elim" value="{{ $UsuariosItem->id }}">
                      <button class="btn btn-warning" ><ion-icon name="key-outline"></ion-icon></button>
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
    $('#customSwitch1').change(function(){
      
      if ($('#customSwitch1').prop('checked')) {
        $('#id_empresa').val(0)
        $('#id_empresa').attr('disabled','true')
         $('#id_empresa').attr('required','true')
      }else{
       
        $('#id_empresa').val()
        $('#id_empresa').removeAttr('disabled')
         $('#id_empresa').removeAttr('required')
      }
    });

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

