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
       <form method="GET" action="{{route('DetEmpC.index')}}">
        <input type="hidden" value="{{ $data['Empresa'][0]['id'] }}" name="id_empresa" id="id_empresa">
        
        <button  class="btn btn-warning"><ion-icon name="return-up-back-outline"></ion-icon></button>
      </form>
      </div>       
    </div>
  </div>
  <hr>






  <div class="col-md-12">
      <div class="card card-warning">
        <div class="card-header">
          <h3 class="card-title">Cargar Documentos</label></h3>
        </div>
        <form id="" method="POST" action="{{ route('FacturaC.Masiva') }}" enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="id_empresa" value="{{ $data['Empresa'][0]['id'] }}">
        <div class="card-body">

            <div class="col-md-12">

            <div class="row" style="margin-bottom: 10px; margin-bottom: 20px">
              <div class="col-md-6">
                <select class="form-control" name="cc" required="">
                    <option value="" selected="" disabled="">Centro de Costo...</option>
                    @forelse($data['Cc'] as $CcItem)
                      <option value="{{ $CcItem->id }}">{{ $CcItem->descripcion .' '. $CcItem->año.'-'.$CcItem->mes}}</option>
                    @empty
                       
                    @endforelse         
                </select>      
              </div>
              <div class="col-md-6">
                  <div class="row" style="padding-left: 80px">
                      <div class="custom-control custom-radio" style="margin-right: 40px">
                        <input class="custom-control-input" type="radio" id="customRadio1" name="tipo" checked="" value="I">
                        <label for="customRadio1" class="custom-control-label">Ingreso</label>
                      </div>
                      <div class="custom-control custom-radio" style="margin-right: 40px">
                        <input class="custom-control-input" type="radio" id="customRadio2" name="tipo" value="G">
                        <label for="customRadio2" class="custom-control-label">Gasto</label>
                      </div>
                      <div class="custom-control custom-radio">
                        <input class="custom-control-input" type="radio" id="customRadio3" name="tipo" value="O">
                        <label for="customRadio3" class="custom-control-label">Otro</label>
                      </div>
                  </div>
              </div>
            </div>
           </div>

          <div class="col-md-12" style="background: #2E3134;padding-top: 15px; padding-left: 15px; margin-bottom: 20px">
              <input style="margin-bottom: 15px;color: white" type="file" name="doc[]" id="doc" multiple="" required="" accept="application/pdf">
                              
                <div id="filas" style="color: white;"></div>   
             
            </div>
          
        
        
            <div class="col-md-12">
              <div id="tabla"></div>
            </div>
         
           
        </div>
        <div class="card-footer">
          <button class="btn btn-warning">Agregar</button>
        </div>
        </form>
      </div>
    
      
    
      <!--<div class="card card-warning">
        <div class="card-header">
          <h3 class="card-title">Cargar Varias Facturas a una Transacción</label></h3>
        </div>
        <form id="" method="POST" action="{{ route('FacturaC.Agregar') }}" enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="id_empresa" value="{{ $data['Empresa'][0]['id'] }}">
        <div class="card-body">
          
          <div class="col-md-12">
            <div class="row" style="margin-bottom: 10px; margin-bottom: 20px">
              <div class="col-md-6">
                <select class="form-control" name="cc" required="">
                    <option value="" selected="" disabled="">Centro de Costo...</option>
                    @forelse($data['Cc'] as $CcItem)
                      <option value="{{ $CcItem->id }}">{{ $CcItem->descripcion .' '. $CcItem->año.'-'.$CcItem->mes}}</option>
                    @empty
                       
                    @endforelse         
                </select>      
              </div>
              <div class="col-md-6">
                  <div class="row" style="padding-left: 80px">
                      <div class="custom-control custom-radio" style="margin-right: 40px">
                        <input class="custom-control-input" type="radio" id="customRadio1" name="tipo" checked="" value="Ingreso">
                        <label for="customRadio1" class="custom-control-label">Ingreso</label>
                      </div>
                      <div class="custom-control custom-radio" style="margin-right: 40px">
                        <input class="custom-control-input" type="radio" id="customRadio2" name="tipo" value="Gasto">
                        <label for="customRadio2" class="custom-control-label">Gasto</label>
                      </div>
                      <div class="custom-control custom-radio">
                        <input class="custom-control-input" type="radio" id="customRadio3" name="tipo" value="Otro">
                        <label for="customRadio3" class="custom-control-label">Otro</label>
                      </div>
                  </div>
              </div>
            </div>

            <div class="col-md-12" style="background: #2E3134;padding-top: 15px; padding-left: 15px">
              <input style="margin-bottom: 15px;color: white" type="file" name="doc[]" id="doc"  required="">
                              
                <div id="filas" style="color: white;"></div>   
             
            </div>
            <div class="col-md-12">
               <div class="form-group">
                <label for="exampleFormControlTextarea1">Comentarios(opcional):</label>
                <textarea name="comentario" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
              </div>
            </div>
          </div>
           
        </div>
        <div class="card-footer">
          <button class="btn btn-warning">Agregar</button>
        </div>
        </form>
      </div>-->
   
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

  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

 






  <script type="text/javascript">

     $(function () {
      mensaje = $('#mensaje').html();
      tipo = $('#tipo').html();
      if (tipo=='Error') {toastr.error(mensaje)}
      if (tipo =='OK') {toastr.success(mensaje)}
    });

    $('#doc').change(function(data){

      const input = document.getElementById('doc');

      cabeza = "<table class=table><thead><tr><th scope='col'>#</th><th scope='col'>Doc. Principal</th><th scope='col'>Comentario</th><th scope='col'>Documentos Auxiliares</th></tr></thead><tbody>"

      filas=''

      for (var i = 0; i < input.files.length; i++) {
        filas=filas + '<tr><td>'+ parseInt(i+1) +'</td><td>'+ input.files[i].name +'</td><td><textarea placeholder="Comentario...(opcional)" name=comen_'+i+' id=comen_'+ i +' class="form-control"></textarea></td><td><input type="file" accept="application/pdf" name="docAux_'+ i +'[]" id="docAux_'+ i +'" multiple onchange=mostrar('+ i +')><div id="lista_'+ i +'"></div></td></tr>'
      }

      $('#filas').html(cabeza + filas + '</tbody></table>')

    })

    function mostrar(id){
      docAux =''
      const inputAux = document.getElementById('docAux_'+ id);
      for (var i = 0; i < inputAux.files.length; i++) {
        docAux = docAux + '  |  ' + inputAux.files[i].name
      }
      $('#lista_'+id).html(docAux)
    }

  </script>

@endsection

