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

 
  @php
    if ($data['Nivel']==1) {
      $ruta='regemp.index';
    }else{
      $ruta='DetEmpC.index';
    }
  @endphp


  <div class="col-md-12">      
    <div class="col-md-6">
      <form method="GET" action="{{route('DetEmpC.index')}}">
        <input type="hidden" value="{{ $data['Empresa'][0]['id'] }}" name="id_empresa" id="id_empresa">
        
        <button  class="btn btn-warning"><ion-icon name="return-up-back-outline"></ion-icon></button>
      </form>
    </div>   
  </div>
  <hr>
    
  
  <div class="col-md-12">
     <div class="card card-warning">
        <div class="card-header">
          <h3 class="card-title">Agregar Usuario a {{ $data['Empresa'][0]['Razon'] }}</h3>
        </div>        
        <form  action="{{ route('ReglasUsuarioC.store') }}" method="POST">
          @csrf
          <input type="hidden" name="id_empresa" id="id_empresa" value="{{ $data['Empresa'][0]['id'] }}">
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <label for="exampleInputEmail1">Email</label>
                <input required="" name="email" type="email" class="form-control" id="email" placeholder="Ingrese Email">
              </div>
              <div class="col-md-6">
                <label for="exampleInputEmail1">Nivel</label>
                <select class="form-control" name="nivel" id="nivel" required="">
                  <option value="" selected="" disabled="">Seleccionar...</option>
                  <option value="2">Admin</option>
                  <option value="3">Limitado</option>
                </select>
              </div>
            </div>
            <br>
            <div class="row">
               <div class="col-md-6">
                <label for="exampleInputEmail1">Habilitado</label>
                <select class="form-control" name="habilitado" id="habilitado" required="">
                   <option value="" selected="" disabled="">Seleccionar...</option>
                  <option value="1">Si</option>
                  <option value="0">No</option>
                </select>
              </div>
            </div>
            <br>
            <label>Reglas de Seguridad</label>
            <hr>
            <div class="col-md-12">
              <div class="table table-responsive">
                 <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th><input type="checkbox"  name="selPrin" id="selPrin"> </th>
                    <th>Descripción</th>                    
                  
                        
                  </tr>
                  </thead>
                  <tbody>
                    @php
                      $id=0


                    @endphp
                    @forelse($data['Reglas'] as $ReglasItem)
                     <tr>
                        <input type="hidden" name="id_regla_{{ $id }}">
                       <td><input type="checkbox" name="checkbox_{{ $id }}" id="checkbox_{{ $id }}" value="{{ $ReglasItem->id }}"></td>
                       <td>{{ $ReglasItem->descripcion }}</td>
                       @php($id = $id + 1)
                     </tr>
                    @empty
                       
                    @endforelse           
                  </tbody>
                </table>  
              </div>
            </div>
          </div>
          
          <div class="card-footer">
            <button type="submit" class="btn btn-warning">Agregar</button>
          </div>
        </form>
    </div>
  

  <p id="tipo" style="visibility: hidden;">{{ $data['Tipo']}}</p>
  <p id="mensaje" style="visibility: hidden;">{{ $data['Texto']}}</p>
 
  <input type="hidden" name="id" id="id" value="{{ $id }}">

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

    $('#checkbox_2').change(function(){
      if ($('#checkbox_2').prop('checked')) {      
        $('#checkbox_6').prop('checked',true)
      }
    })

    $('#checkbox_3').change(function(){
       if ($('#checkbox_3').prop('checked')) {
        $('#checkbox_6').prop('checked',true)
      }
    })

    $('#checkbox_6').change(function(){

       if ($('#checkbox_6').prop('checked')==false) { 
           
        $('#checkbox_2').prop('checked',false)
        $('#checkbox_3').prop('checked',false)
       }
    })


   

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


