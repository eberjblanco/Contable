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
    <div class="row">
      <div class="col-md-1" style="border-right: solid 1px;">

         
          
          <form method="GET" action="{{route('DetEmpC.index')}}">
            <input type="hidden" value="{{ $data['Empresa'][0]['id'] }}" name="id_empresa" id="id_empresa">            
            <button  class="btn btn-warning"><ion-icon name="return-up-back-outline"></ion-icon></button>
          </form>
          
      </div>  
      <div class="col-md-2" style="padding-left: 30px">
         @if($data['Nivel'] < 3) 
              <form method="POST" action="{{ route('CcC.index') }}">
                @csrf
                <input type="hidden" name="ruta" required="" value="">
                <input type="hidden" name="id_empresa" required="" value="{{ $data['Empresa'][0]['id'] }}">
               
                 <button class="btn btn-warning"><ion-icon name="return-up-back-outline"></ion-icon> CECO</button>
              </form>
        @else
           @forelse($data['Seguridad'] as $SeguridadItem2)
            @if($SeguridadItem2->id_regla == 2)
              <form method="POST" action="{{ route('CcC.index') }}">
                @csrf
                <input type="hidden" name="ruta" required="" value="">
                <input type="hidden" name="id_empresa" required="" value="{{ $data['Empresa'][0]['id'] }}">
               
                <button class="btn btn-warning"><ion-icon name="return-up-back-outline"></ion-icon> CECO</button>
              </form>
            @endif                               
          @empty
             
          @endforelse
        @endif
      </div> 
      <div class="col-md-8">
        <div class="row" style="padding-left: 70%">
          <h4>{{ $data['Empresa'][0]['Razon'] }}, </h4>
          <p style="padding-top: 6px">{{ $data['Empresa'][0]['Nit'] }}</p>  
        </div>      
      </div>
    </div>
  </div>
  <hr>
  @php
    $prueba = json_decode( $data['contenido']);
  @endphp




  <div class="col-md-12">
    <div class="card card-warning">
      <div class="card-header">
        <h3 class="card-title">Lista de Documentos - <label>Período {{ $data['año'] .'-'.$data['mes'] }}</label></h3>
      </div>  
      <br>
     

          @if($data['ruta'] != '')
            <div class="col-md-12" style="margin-bottom: 20px">
              <div class="row">
                <div class="col-md-6">
                  <form method="POST" action="{{ route('DocumentosC.CrearCarpeta') }}">
                    @csrf
                    <div class="row">
                      <div class="col-md-6">
                        <input onkeypress="return valideKeyText(event);" placeholder="Nombre" class="form-control" type="text" required="" name="nombre" id="nombre">
                      </div>
                      <div class="col-md-6">
                        <input type="hidden" name="ruta"  value="{{ $data['ruta'] }}">
                        <input type="hidden" name="id_empresa" required="" value="{{ $data['Empresa'][0]['id'] }}">
                        <input type="hidden" name="año" value="{{ $data['año'] }}">
                        <input type="hidden" name="mes" value="{{ $data['mes'] }}">
                        <button class="btn btn-warning"><ion-icon name="add-circle-outline"></ion-icon>Crear Carpeta</button>
                      </div>
                    </div>
                  </form>
                </div>

                <div class="col-md-6">
                   <form method="POST" action="{{ route('DocumentosCController.CrearArchivo') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row"> 
                      <div class="col-md-6">
                         <input required="" type="file" name="archivo" class="form-control" >
                      </div>
                      <div class="col-md-6" >
                          <input type="hidden" name="ruta" required="" value="{{ $data['ruta'] }}">
                          <input type="hidden" name="id_empresa" required="" value="{{ $data['Empresa'][0]['id'] }}">
                          <input type="hidden" name="año" value="{{ $data['año'] }}">
                          <input type="hidden" name="mes" value="{{ $data['mes'] }}">
                          <button class="btn btn-warning"><ion-icon name="add-circle-outline"></ion-icon>Cargar Archivo</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>

             <div class="col-md-12">
              <hr>
            </div>

          @endif
          
      
     
      <div class="col-md-12">
          <div class="row">
            <div class="col-md-1">
              <form method="POST" action="{{ route('DocumentosC.Volver')}}">
                @csrf
                <input type="hidden" name="ruta" id="ruta" value="{{ $data['ruta'] }}">
                <input type="hidden" name="id_empresa" id="id_empresa" value="{{ $data['Empresa'][0]['id'] }}">
                <input type="hidden" name="año" id="año" value="{{ $data['año'] }}">
                <input type="hidden" name="mes" id="mes" value="{{ $data['mes'] }}">
                <button class="btn btn-warning"><ion-icon name="return-up-back-outline"></ion-icon></button>
              </form>
            </div>
            <div class="col-md-10" style="padding-top: 5px">
              <div class="row">
                <label>Ruta: </label><p>{{ $data['ruta'] }}</p>  
              </div>              
            </div>
          </div>
         
      </div>
      <div class="col-md-12">        
        <div class="table table-responsive">
          <table id="example2" class="table table-bordered table-hover">
            <thead>
              <tr>
               
                <th>Nombre</th>
                <th> </th> 
                <th> </th> 
                 <th> </th>
              </tr>
            </thead>
            <tbody>
             
              @forelse($prueba as $pruebaItem)

                @if($pruebaItem!= '.' &&  $pruebaItem!='..')
                   <tr>
                     <td>
                      @php
                        $mystring = $pruebaItem;
                        $findme = ".";
                        $pos = strpos($mystring, $findme);                        
                      @endphp
                      @if($pos === false)
                        <ion-icon name="folder-open-outline" style="margin-right: 5px; margin-top: 5px"></ion-icon>
                        @php($ruta = 'DocumentosCController.Borrar')
                      @else
                        <ion-icon name="document-outline" style="margin-right: 5px; margin-top: 5px"></ion-icon>
                        @php($ruta = 'DocumentosCController.BorrarArchivo')
                      @endif
                      {{ $pruebaItem }}
                    </td>
                     <td>
                      @if( $pos == false )
                          <form method="POST" action="{{ route('DocumentosC.index')}}">
                            @csrf
                            <input type="hidden" name="ruta" id="ruta" value=" {{ $data['ruta'].'/'. $pruebaItem }}">
                            <input type="hidden" name="id_empresa" id="id_empresa" value="{{ $data['Empresa'][0]['id'] }}">
                            <input type="hidden" name="año" id="año" value="{{ $data['año'] }}">
                            <input type="hidden" name="mes" id="mes" value="{{ $data['mes'] }}">
                            <button class="btn btn-warning"><ion-icon name="search-outline"></ion-icon></button>
                          </form>
                      @endif                    
                    </td>
                     <td>

                      @if($data['ruta'] != '')
                        @if($data['Nivel'] < 3)


                           <form method="POST" action="{{ route($ruta) }}">
                              @csrf
                              <input type="hidden" name="ruta" required="" value="{{ $data['ruta'].'/'. $pruebaItem }}">
                              <input type="hidden" name="id_empresa" required="" value="{{ $data['Empresa'][0]['id'] }}">
                              <input type="hidden" name="año" value="{{ $data['año'] }}">
                              <input type="hidden" name="mes" value="{{ $data['mes'] }}">
                              <button class="btn btn-warning"><ion-icon name="trash-outline"></ion-icon></ion-icon></button>
                            </form>


                        @else


                           @forelse($data['Seguridad'] as $SeguridadItem2)
                            @if($SeguridadItem2->id_regla == 2)
                               <form method="POST" action="{{ route($ruta) }}">
                                @csrf
                                <input type="hidden" name="ruta" required="" value="{{ $data['ruta'].'/'. $pruebaItem }}">
                                <input type="hidden" name="id_empresa" required="" value="{{ $data['Empresa'][0]['id'] }}">
                                <input type="hidden" name="año" value="{{ $data['año'] }}">
                                <input type="hidden" name="mes" value="{{ $data['mes'] }}">
                                <button class="btn btn-warning"><ion-icon name="trash-outline"></ion-icon></ion-icon></button>
                              </form>
                            @endif                               
                          @empty
                             
                          @endforelse



                        @endif
                      @else

                        @if($data['Nivel'] < 3) 
                              <form method="POST" action="{{ route('CcC.index') }}">
                                @csrf
                                <input type="hidden" name="ruta" required="" value="">
                                <input type="hidden" name="id_empresa" required="" value="{{ $data['Empresa'][0]['id'] }}">
                               
                                <button class="btn btn-warning"><ion-icon name="trash-outline"></ion-icon></ion-icon></button>
                              </form>
                        @else
                           @forelse($data['Seguridad'] as $SeguridadItem2)
                            @if($SeguridadItem2->id_regla == 2)
                              <form method="POST" action="{{ route('CcC.index') }}">
                                @csrf
                                <input type="hidden" name="ruta" required="" value="">
                                <input type="hidden" name="id_empresa" required="" value="{{ $data['Empresa'][0]['id'] }}">
                               
                                <button class="btn btn-warning"><ion-icon name="trash-outline"></ion-icon></ion-icon></button>
                              </form>
                            @endif                               
                          @empty
                             
                          @endforelse
                        @endif

                      @endif
                      
                     
                    </td>
                     <td>
                        @if( $pos == true )
                       
                          <a href="{{ 'documentos/'.$data['año'].'/'.$data['mes'].'/'.$data['Empresa'][0]['id'].'/'.$data['ruta'].'/'.$pruebaItem }}" download="{{ $pruebaItem }}" class="btn btn-warning"><ion-icon name="cloud-download-outline"></ion-icon></a>
                        @endif
                                                                      
                    </td>
                   </tr>
                   
                @endif
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

  

  function valideKeyText(evt) {
      var code = evt.which ? evt.which : evt.keyCode;       

      if (code == 8 || code == 32 || code >= 48 && code <= 57) {
          //backspace
          return true;
      } else if (code >= 97 && code <= 122) {
          //is a number
          return true;
      } else {
          return false;
      }

  }

   function elim(id){
      if ($('#'+'customSwitch3_' + id).prop('checked')) {
        $('#btn_elim_'+id).prop('disabled',false)
      }else{
        $('#btn_elim_'+id).prop('disabled',true)
      }
    }
   

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


