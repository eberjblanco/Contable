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
        <form role="form" action="{{ route('regemp.store')}}" method="POST" name="f1" enctype="multipart/form-data">
          @csrf
          <div class="card-body">
            <div class="row">
              <div class="col-md-4">
              <div class="row">
                <div class="col-md-12">
                  <label>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                  quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                  consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                  cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                  proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</label>
                </div>
              </div>
               <div class="row">
                  <div class="col-md-12">
                    <input type="file" name="">
                  </div>
               </div>
              </div>
              <div class="col-md-8">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Nit</label>
                      <div class="row">
                        <div class="col-xs-9 col-sm-9 col-md-9">
                          <input required="" name="Nit_nva" type="text" class="form-control" id="Nit_nva" placeholder="Ingrese Nit">
                        </div>
                        <label>-</label>
                        <div class="col-xs-2 col-sm-2 col-md-2">
                          <input required="" name="Nit_nva_dig" type="text" class="form-control" id="Nit_nva_dig" placeholder="">
                        </div>
                      </div>
                    </div>
                  </div>        
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputPassword1">Razón</label>
                      <input required="" name="Razon_nva" type="text" class="form-control" id="Razon_nva" placeholder="Ingrese Razón">
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputPassword1">Departamento</label>                 
                      <select  class="form-control" name=Departamento_nva id="Departamento_nva" onchange="municipios(this.value)">
                        <option selected="" disabled="" value="">Seleccione Departamento</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputPassword1">Municipio</label>
                        <select class="form-control" id="Municipio_nva" name=Municipio_nva > 
                          <option selected="" disabled="" value="">Seleccione Municipio</option>
                      </select> 
                    </div> 
                  </div>       
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Dirección</label>
                      <textarea rows="3" required="" name="Direccion_nva" type="text" class="form-control" id="Razon_nva" placeholder="Ingrese Dirección "></textarea>
                    </div>
                  </div>
                </div>
              </div>         
            </div>                 
          <div>

          <div class="row">
            <div class="col">      
              <div class="form-group">         
                <div class="form-group">
                <label for="exampleInputPassword1">Correo</label>
                <input required="" name="Correo_nva" type="email" class="form-control" id="Correo_nva" placeholder="Ingrese Correo ">
                </div>
              </div>
            </div>

            <div class="col">    
              <div class="form-group col-md-12">
                <div class="form-group">
                  <label for="exampleInputPassword1">Teléfono</label>
                  <input required="" name="Telefono_nva" type="text" class="form-control" id="Razon_nva" placeholder="Ingrese Teléfono ">
                </div>
              </div>
            </div>
        </div> 

        <div class="card-footer">
          <button type="submit" class="btn btn-warning">Guardar</button>
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
                  <td>{{ $EmpresasItem->Nit }}</td>

                  <td>{{ $EmpresasItem->Razon }}</td>

    <!-- ANTIGUO BOTON PARA EDITAR -->              
     <!--             <td>
                      <button class="btn btn-warning" ><ion-icon name="create-outline"></ion-icon></button>
                  </td>
                      </form>
      -->
  <!-- FIN ANTIGUO BOTON PARA EDITAR -->                         
 <!-- STAR MODAL -->              
<td>
<!-- Button trigger modal -->
<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal"><ion-icon name="create-outline"></ion-icon>
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="2" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Registro</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
<!--  FORMULARIO MODAL -->
        <form method="POST" action="{{route('regemp.update',$EmpresasItem->id)}}">
          @csrf
          @method('PATCH')
        <input type="hidden" name="id" id="id" value="{{ $EmpresasItem->id }}">
 <div class="row">
    <div class="col">   
        <div class="form-group">
          <label for="exampleInputPassword1">Nit</label>
          <input type="text" name="Nit_edit" id="Nit_edit" class="form-control" placeholder="Nit" value="{{ $EmpresasItem->Nit }}">
        </div>
    </div>
          <br>
      <div class="col">      
        <div class="form-group">
           <label for="exampleInputPassword1">Razon</label>
          <input type="text" name="Razon_edit" id="Razon_edit" class="form-control" placeholder="Razon" value="{{ $EmpresasItem->Razon }}">   
        </div> 
      </div>
  </div>
        <br>
 <div class="row">
    <div class="col">  
        <div class="form-group">
           <label for="exampleInputPassword1">Departamento</label>
          <input type="text" name="Departamento_edit" id="Departamento_edit" class="form-control" placeholder="Departamento" value="{{ $EmpresasItem->Departamento }}">   
        </div> 
    </div> 
        <br>
    <div class="col">  
        <div class="form-group">
           <label for="exampleInputPassword1">Municipio</label>
          <input type="text" name="Municipio_edit" id="Municipio_edit" class="form-control" placeholder="Municipio" value="{{ $EmpresasItem->Municipio }}">   
        </div> 
    </div>  
  </div>
        <br>
        <div class="form-group">
           <label for="exampleInputPassword1">Direccion</label>
          <input type="text" name="Direccion_edit" id="Direccion_edit" class="form-control" placeholder="Direccion" value="{{ $EmpresasItem->Direccion }}">
        </div>    
        <br>
<div class="row">
    <div class="col">  
        <div class="form-group">
           <label for="exampleInputPassword1">Correo</label>
          <input type="email" name="Correo_edit" id="Correo_edit" class="form-control" placeholder="Correo" value="{{ $EmpresasItem->Correo }}">   
        </div> 
    </div>
        <br>
    <div class="col">  
        <div class="form-group">
           <label for="exampleInputPassword1">Telefono</label>
          <input type="text" name="Telefono_edit" id="Telefono_edit" class="form-control" placeholder="Telefono" value="{{ $EmpresasItem->Telefono }}">   
        </div> 
    </div>
</div>

<!-- BOTON ENVIAR -->
        <div class="card-footer">
            <button type="submit" class="btn btn-warning" style="float:right;">Actualizar</button>
        </div>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>                    
</td>

<!-- END MODAL -->                 

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

  <script type="text/javascript" src="js/colombia.json"></script>

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

      //llenar select de departamento
        $.getJSON("js/colombia.json", function(datos) {
            $.each(datos, function(idx,id) {
                $("#Departamento_nva").append(new Option(id.departamento, id.departamento));
            });
        });
    });

    function municipios(nombre) {
      //limpias el select
        $('#Municipio_nva').empty().append('<option selected="selected" value="">Seleccione Municipio...</option>');

      $.getJSON("js/colombia.json", function(datos) {
          $.each(datos, function(idx,id) {
              if (id.departamento==nombre) {
                Total = id.ciudades.length
                for (var i = 0; i < Total; i++) {
                  $("#Municipio_nva").append(new Option(id.ciudades[i], id.ciudades[i]));
                }
              }
          });
      });
    }

    function cambiar(){     
      $("#btn_cam_img").click();
    }

  </script>

@endsection


