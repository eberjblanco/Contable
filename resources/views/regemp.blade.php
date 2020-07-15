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
  <style type="text/css">
    .imagen{
      width: 240px;
      height: 240px;
      margin: auto; 
      border-radius: 50%;
      display: block;
    }
  </style>
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
                    <div id="imagenPreview"></div>
                    <img id= "blah" src="{{asset('dist/img/cargar.png')}}" class="imagen">
                  </div>
                </div>
                <br>
               <div class="row">
                  <div class="col-md-12">
                    <input type="file" name="imgInp" id="imgInp">
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
            <br>
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
               
                  <td>{{ $EmpresasItem->Nit }}</td>

                  <td>{{ $EmpresasItem->Razon }}</td>
               
           
                <td>
                  <button id="btn_editar_{{$EmpresasItem->id}}" idEmpresa="{{$EmpresasItem->id}}" Nit="{{$EmpresasItem->Nit}}" Razon="{{$EmpresasItem->Razon}}" Depto="{{$EmpresasItem->Departamento}}" Municipio="{{$EmpresasItem->Municipio}}" Direccion="{{$EmpresasItem->Direccion}}" Correo="{{$EmpresasItem->Correo}}" Telefono="{{$EmpresasItem->Telefono}}" type="button" class="btn btn-warning" onclick="editar({{$EmpresasItem->id}})"><ion-icon name="create-outline"></ion-icon></button>
                </td>
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
         
                  <form method="POST" action="{{route('regemp.update',$EmpresasItem->id)}}">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="id" id="id" value="{{ $EmpresasItem->id }}">
                     <div class="row">

                        <div class="col">   
                            <div class="form-group">
                              <label for="exampleInputPassword1">Nit</label>
                              <input readonly="" type="text" name="Nit_edit" id="Nit_edit" class="form-control" placeholder="Nit" value="">
                            </div>
                        </div>
                              <br>
                          <div class="col">      
                            <div class="form-group">
                               <label for="exampleInputPassword1">Razon</label>
                              <input readonly="" type="text" name="Razon_edit" id="Razon_edit" class="form-control" placeholder="Razon" value="">   
                            </div> 
                          </div>
                      </div>
                  <br>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputPassword1">Departamento</label>                 
                      <select  class="form-control" name=Departamento_nva_edit id="Departamento_nva_edit" onchange="municipios_nva(this.value)">
                        <option selected="" disabled="" value="">Seleccione Departamento</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputPassword1">Municipio</label>
                        <select class="form-control" id="Municipio_nva_edit" name=Municipio_nva_edit > 
                          <option selected="" disabled="" value="">Seleccione Municipio</option>
                      </select> 
                    </div> 
                  </div>       
                </div>
                  <br>
                  <div class="form-group">
                     <label for="exampleInputPassword1">Direccion</label>
                     <textarea type="text" name="Direccion_edit" id="Direccion_edit" class="form-control" placeholder="Direccion" value=""></textarea>                    
                  </div>    
                  <br>
          <div class="row">
              <div class="col">  
                  <div class="form-group">
                     <label for="exampleInputPassword1">Correo</label>
                    <input type="email" name="Correo_edit" id="Correo_edit" class="form-control" placeholder="Correo" value="">   
                  </div> 
              </div>
                  <br>
              <div class="col">  
                  <div class="form-group">
                     <label for="exampleInputPassword1">Telefono</label>
                    <input type="text" name="Telefono_edit" id="Telefono_edit" class="form-control" placeholder="Telefono" value="">   
                  </div> 
              </div>
          </div>

          <!-- BOTON ENVIAR -->
                  <div class="card-footer">
                      <button type="submit" class="btn btn-warning" style="float:right;">Actualizar</button>
                  </div>

                  </form>





                  
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
      //llenar select de departamento_nva
        $.getJSON("js/colombia.json", function(datos) {
            $.each(datos, function(idx,id) {
                $("#Departamento_nva_edit").append(new Option(id.departamento, id.departamento));
            });
        });

    function municipios_nva(nombre) {
      //limpias el select
        $('#Municipio_nva_edit').empty().append('<option selected="selected" value="">Seleccione Municipio...</option>');

      $.getJSON("js/colombia.json", function(datos) {
          $.each(datos, function(idx,id) {
              if (id.departamento==nombre) {
                Total = id.ciudades.length
                for (var i = 0; i < Total; i++) {
                  $("#Municipio_nva_edit").append(new Option(id.ciudades[i], id.ciudades[i]));
                }
              }
          });
      });
    }
    function cambiar(){     
      $("#btn_cam_img").click();
    }

     function readImage (input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#blah').attr('src', e.target.result); // Renderizamos la imagen
        }
        reader.readAsDataURL(input.files[0]);
      }
    }

    $("#imgInp").change(function () {
      // Código a ejecutar cuando se detecta un cambio de archivO
      readImage(this);
    });

    function editar(id) {
      $('#Nit_edit').val($('#btn_editar_'+id).attr('Nit'))
      $('#Razon_edit').val($('#btn_editar_'+id).attr('Razon'))
      $('#Departamento_edit').val($('#btn_editar_'+id).attr('Depto'))
      $('#Municipio_edit').val($('#btn_editar_'+id).attr('Municipio'))
      $('#Direccion_edit').val($('#btn_editar_'+id).attr('Direccion'))
      $('#Correo_edit').val($('#btn_editar_'+id).attr('Correo'))
      $('#Telefono_edit').val($('#btn_editar_'+id).attr('Telefono'))


      $('#exampleModal').modal('show')
     
    }

  </script>

  
@endsection


