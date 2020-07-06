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
    <form method="POST" action="{{ route('MesesC.store') }}">
      @csrf
      <div class="card card-warning">
        <div class="card-header">
          <h3 class="card-title">Habilitar Período</label></h3>
        </div>
        <div class="card-body">
          <div class="col-md-12">
            <div class="row">
              <div class="col-md-6">
                <select required=""  class="form-control" name="año" id="año">
                  <option selected="" disabled="" value="">Seleccione Año...</option>
                  @for($i=0;$i<10;$i++)
                    <option value="{{ date('Y') - $i }}">{{ date('Y') - $i }}</option>
                  @endfor
                </select>
              </div>
              <div class="col-md-6">
                 <select  required="" class="form-control" name="mes" id="mes">
                  <option selected="" disabled="" value="">Seleccione Mes...</option>
                  @for($i=1;$i<13;$i++)
                    <option value="{{  $i }}">{{  $i }}</option>
                  @endfor
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <button class="btn btn-warning">Agregar</button>
        </div>
      </div>
    </form>
  </div>


  <div class="col-md-12">   
      <div class="card card-warning">
        <div class="card-header">
          <h3 class="card-title">Períodos Habilitados</label></h3>
        </div>
        <div class="card-body">
          <table id="example2" class="table table-bordered table-hover">
            <thead>
              <tr>
               
                <th>Período (Año-Mes)</th>            
                <th> </th> 
              </tr>
            </thead>
            <tbody>
              @forelse( $data['Meses'] as $MesesItem )
                <tr>
                  <form method="POST" action=" {{ route('MesesCController.destroy') }} ">
                    @csrf

                    <input type="hidden" id="id" name="id" value="{{ $MesesItem->id }}">
                    <td>{{ $MesesItem->año .'-'.$MesesItem->mes }}</td>
                    <td><button class="btn btn-warning"><ion-icon name="trash-outline"></ion-icon></button></td>
                  </form>
                </tr>
              @empty
                 
              @endforelse
            </tbody>
          </table>  
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


