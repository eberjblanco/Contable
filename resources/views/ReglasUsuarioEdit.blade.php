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
          <h3 class="card-title">Editar a  {{ $data['UsuarioSel'][0]['email'] }} en {{ $data['Empresa'][0]['Razon'] }}</h3>
        </div>        
        <form  action="{{ route('ReglasUsuarioC.update') }}" method="GET">
          @csrf
         
          <input type="hidden" name="id_empresa" id="id_empresa" value="{{ $data['Empresa'][0]['id'] }}">
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <label for="exampleInputEmail1">Email</label>
                <input required="" name="email" type="email" class="form-control" id="email" placeholder="Ingrese Email" value="{{ $data['UsuarioSel'][0]['email'] }}" disabled="">
                <input type="hidden" name="id_usuario" id="id_usuario" value="{{ $data['UsuarioSel'][0]['id'] }}">
              </div>
              <div class="col-md-6">
                <label for="exampleInputEmail1">Nivel</label>
                <select class="form-control" name="nivel" id="nivel" required="">

                 @switch($data['UsuarioSelUserEmp'][0]['id_nivel'] )
                      @case(1)
                          <option value="{{ $data['UsuarioSelUserEmp'][0]['id_nivel'] }}" selected="">SuperAdmin</option>
                          @break
                      @case(2)
                          <option value="{{ $data['UsuarioSelUserEmp'][0]['id_nivel'] }}" selected="">Admin</option>
                          @break
                      @case(3)
                          <option value="{{ $data['UsuarioSelUserEmp'][0]['id_nivel'] }}" selected="">Limitado</option>
                          @break                   
                  @endswitch                  
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
                   @switch( $data['UsuarioSelUserEmp'][0]['id_status'] )
                        @case(1)
                            <option value="{{$data['UsuarioSelUserEmp'][0]['id_status']}}" selected="" >Si</option>
                            @break
                        @case(0)
                            <option value="{{$data['UsuarioSelUserEmp'][0]['id_status']}}" selected="" >No</option>
                            @break
                                      
                    @endswitch 
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
                      $id=1


                    @endphp
                    @forelse($data['Reglas'] as $ReglasItem)
                      @php($Seg=0)
                       <tr>
                          <input type="hidden" name="id_regla_{{ $id }}" id="id_regla_{{ $id }}" value="{{ $id }}">                         
                         <td>
                          @forelse($data['ReglasUsuario2'] as $ReglasUsuario2Item)
                            @if($ReglasUsuario2Item->id_regla == $ReglasItem->id)
                               <input type="checkbox" name="checkbox_{{ $id }}" id="checkbox_{{ $id }}" value="{{ $ReglasItem->id }}" checked="">
                               @php($Seg=1)
                            @endif   
                          @empty

                          @endforelse  

                          @if($Seg==0)                         
                               <input type="checkbox" name="checkbox_{{ $id }}" id="checkbox_{{ $id }}" value="{{ $ReglasItem->id }}">                         
                          @endif                     
                        </td>
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

            @if($data['Nivel']<3)
              <button type="submit" class="btn btn-warning">Modificar</button>
            @else
              @forelse($data['Seguridad'] as $SeguridadItem)
                @if($SeguridadItem->id_regla = 4)
                <button type="submit" class="btn btn-warning">Modificar</button>
                @endif
              @empty

              @endforelse
            @endif
          </div>
        </form>
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


    $('#checkbox_3').change(function(){
      if ($('#checkbox_3').prop('checked')) {      
        $('#checkbox_7').prop('checked',true)
      }
    })

    $('#checkbox_4').change(function(){
       if ($('#checkbox_4').prop('checked')) {
        $('#checkbox_7').prop('checked',true)
      }
    })

    $('#checkbox_7').change(function(){

       if ($('#checkbox_7').prop('checked')==false) { 
           
        $('#checkbox_3').prop('checked',false)
        $('#checkbox_4').prop('checked',false)
       }
    })
   

     $(function () {

    $('#example2').DataTable({
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


            $('#selPrin').click(function(){
      total = $('#id').val()
      if($(this).prop('checked') == true){
        for (var i = 0; i < total; i++) {
          $('#checkbox_' + i).prop('checked',true);
        }
      }else{
        for (var i = 0; i < total; i++) {
          $('#checkbox_' + i).prop('checked',false);
        }
      }
    });

    
      

       
    
    });
  </script>

@endsection


