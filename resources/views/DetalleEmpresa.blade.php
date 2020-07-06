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
      $ruta='Empresas.index';
    }
  @endphp


  <div class="col-md-12">      
    <div class="row">
      <div class="col-md-6">
        <form method="GET" action="{{route($ruta)}}">
          <input type="hidden" value="{{ $data['Empresa'][0]['id'] }}" name="id_empresa" id="id_empresa">
          
          <button  class="btn btn-warning"><ion-icon name="return-up-back-outline"></ion-icon></button>
        </form>
      </div>  
      <div class="col-md-6">
        <div class="row" style="padding-left: 50%">
          <h3>{{ $data['Empresa'][0]['Razon'] }}, </h3>
          <p style="padding-top: 9px">Nit: {{ $data['Empresa'][0]['Nit'] }}</p>
        </div>
      </div> 
    </div>
  </div>
  <hr>
  


  <div class="col-md-12">
    <div class="row">    
      

      @php
        $Nivel = $data['Nivel'];
        switch ($Nivel) {
          case 1:
          //si es superadmin
          @endphp
             <!--Documentos -->
            <div class="col-md-4">
              <div class="small-box bg-info">
                <div class="inner">
                  <form method="POST" action="{{ route('DocumentosC.index')}}">
                    @csrf
                    <input type="hidden" name="id_empresa" id="id_empresa" value="{{$data['id_empresa']}}">
                     <input type="hidden" name="ruta" id="ruta" value="">
                     <input type="hidden" name="Vengo" id="Vengo" value="detalle">
                    <h3>Documentos</h3>
                    <p>Carpetas</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-document-text"></i>
                  </div>
                 
                    <div class="col-md-12">
                      <div class="row">
                        <div class="col-md-4">
                        <select class="form-control" required="" name="año" id="año">
                          <option selected="" value="" disabled="">Año</option>
                           @for($i=0;$i<20;$i++)
                            <option value="{{ date('Y') - $i }}">{{ date('Y') - $i }}</option>
                           @endfor
                        </select>
                      </div>
                      <div class="col-md-4">
                        <select class="form-control" required="" name="mes" id="mes">
                          <option selected="" value="" disabled="">Mes</option>
                             @for($i=1;$i<13;$i++)
                            <option value="{{  $i }}">{{  $i }}</option>
                           @endfor
                        </select>
                      </div>
                      <div class="col-md-4">
                        <button type="submit" class=" btn btn-warning btn-block">Acceder</button>
                      </div>
                      
                      </div>
                    </div>
                 
                 
                </form>
                </i></a>
              </div>
            </div>
            <!--Seguridad -->
            <div class="col-md-4">
              <div class="small-box bg-info">
                <div class="inner">             
                    <h3>Seguridad</h3>
                    <p>Niveles</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-ios-locked-outline"></i>
                    </div>
                    <div class="btn-group btn-block">
                      <button type="button" class="btn btn-warning">Configurar</button>
                      <button type="button" class="btn btn-warning dropdown-toggle dropdown-icon" data-toggle="dropdown">
                        <span class="sr-only">Toggle Dropdown</span>
                        <div class="dropdown-menu" role="menu">
                          <form method="GET" action="{{ route('ReglasUsuarioC.index') }}">
                            @csrf
                            
                             <input type="hidden" name="id_empresa" id="id_empresa" value="{{$data['id_empresa']}}">
                            <a class="dropdown-item" href="#" onclick="$(this).closest('form').submit()">Nuevo...</a>                       
                          </form>
                          
                          <div class="dropdown-divider"></div>                      
                           <a class="dropdown-item" onclick="$('#exampleModal').modal('show')" >Usuarios Asignados</a>                     
                        </div>
                      </button>
                    </div>
                 
                </i></a>
              </div>
            </div>           
            <!--Centros de Costo -->
            <div class="col-md-4">
              <div class="small-box bg-info">
                <div class="inner">
                  <form method="POST" action="{{ route('CcC.index') }}">
                    @csrf
                    <input type="hidden" name="id_empresa" id="id_empresa" value="{{$data['id_empresa']}}">
                     <input type="hidden" name="ruta" id="ruta" value="">
                    <h3>Centros de Costo</h3>
                    <p>Gestión</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-social-usd"></i>
                  </div>
                  <div class="col-md-12">
                   <button type="submit" class=" btn btn-warning btn-block">Gestionar</button>
                  </div>
                </form>
                </i></a>
              </div>
            </div>
            <!--Crear Factura -->
            <div class="col-md-4">
              <div class="small-box bg-info">
                <div class="inner">
                  <form method="POST" action="{{ route('FacturaC.index') }}">
                    @csrf
                    <input type="hidden" name="id_empresa" id="id_empresa" value="{{$data['id_empresa']}}">
                     <input type="hidden" name="ruta" id="ruta" value="">
                    <h3 style="margin-bottom: 40px">Cargar Factura</h3>
                    
                  </div>
                  <div class="icon">
                    <i class="ion ion-android-attach"></i>
                  </div>
                  <div class="col-md-12">
                   <button type="submit" class=" btn btn-warning btn-block">Acceder</button>
                  </div>
                </form>
                </i></a>
              </div>
            </div>
            <!--Status Transancción -->
            <div class="col-md-4">
              <div class="small-box bg-info">
                <div class="inner">                
                    <h3 style="margin-bottom: 40px">Transacciones</h3>
                  </div>
                  <div class="icon">
                    <i class="ion ion-ios-box-outline"></i>
                  </div>
                  <div class="col-md-12">


                    <div class="btn-group btn-block">
                      <button type="button" class="btn btn-warning">Ver</button>
                        <button type="button" class="btn btn-warning dropdown-toggle dropdown-icon" data-toggle="dropdown">
                          <span class="sr-only">Toggle Dropdown</span>
                          <div class="dropdown-menu" role="menu">
                            <form method="POST" action="{{ route('TranC.index') }}">
                                @csrf
                                <input type="hidden" name="id_empresa" id="id_empresa" value="{{$data['id_empresa']}}">
                                 <input type="hidden" name="ruta" id="ruta" value="">
                              
                               <input type="hidden" name="id_empresa" id="id_empresa" value="{{$data['id_empresa']}}">
                              <a class="dropdown-item" href="#" onclick="$(this).closest('form').submit()"><ion-icon name="paper-plane-outline"></ion-icon> Entr. Cliente</a>                       
                            </form> 

                             <form method="POST" action="{{ route('ContaC.index') }}">
                                @csrf
                                <input type="hidden" name="id_empresa" id="id_empresa" value="{{$data['id_empresa']}}">
                                 <input type="hidden" name="ruta" id="ruta" value="">
                              
                               <input type="hidden" name="id_empresa" id="id_empresa" value="{{$data['id_empresa']}}">
                              <a class="dropdown-item" href="#" onclick="$(this).closest('form').submit()">  <ion-icon name="trail-sign-outline"></ion-icon>  Contabilización</a>                       
                            </form>    

                            <div class="dropdown-divider"></div>                      
                            <form method="POST" action="">
                                @csrf
                                <input type="hidden" name="id_empresa" id="id_empresa" value="{{$data['id_empresa']}}">
                                 <input type="hidden" name="ruta" id="ruta" value="">
                              
                               <input type="hidden" name="id_empresa" id="id_empresa" value="{{$data['id_empresa']}}">
                              <a class="dropdown-item" href="#" onclick="$(this).closest('form').submit()">Todas</a>                       
                            </form>                     
                          </div>
                        </button>
                      </div>
                  </div>               
                </i></a>
              </div>
            </div>
            <!--Status Terceros -->
            <div class="col-md-4">
              <div class="small-box bg-info">
                <div class="inner">
                  <form method="POST" action="{{ route('ProvC.index') }}">
                    @csrf
                    <input type="hidden" name="id_empresa" id="id_empresa" value="{{$data['id_empresa']}}">
                     <input type="hidden" name="ruta" id="ruta" value="">
                    <h3 style="margin-bottom: 40px">Terceros</h3>
                  </div>
                  <div class="icon">
                    <i class="ion ion-android-cart"></i>
                  </div>
                  <div class="col-md-12">
                   <button type="submit" class=" btn btn-warning btn-block">Gestionar</button>
                  </div>
                </form>
                </i></a>
              </div>
            </div>

          @php            
            break;
          case 2:
          //si es admin
          @endphp
            <!--Documentos -->
            <div class="col-md-4">
              <div class="small-box bg-info">
                <div class="inner">
                  <form method="POST" action="{{ route('DocumentosC.index')}}">
                    @csrf
                    <input type="hidden" name="id_empresa" id="id_empresa" value="{{$data['id_empresa']}}">

                    <h3>Documentos</h3>
                    <p>Carpetas</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-document-text"></i>
                  </div>
                 
                    <div class="col-md-12">
                      <div class="row">
                        <div class="col-md-4">
                        <select class="form-control" required="" name="año">
                          <option selected="" value="" disabled="">Año</option>
                            @forelse($data['año'] as $AñoItem)
                              <option value="{{ $AñoItem->año }}">{{ $AñoItem->año }}</option>
                            @empty  

                            @endforelse
                        </select>
                      </div>
                      <div class="col-md-4">
                          <select class="form-control" required="" name="mes">
                          <option selected="" value="" disabled="">Mes</option>
                             @forelse($data['Meses'] as $MesesItem)
                                <option value="{{ $MesesItem->mes }}">{{ $MesesItem->mes }}</option>
                              @empty  

                              @endforelse
                        </select>
                      </div>
                      <div class="col-md-4">
                        <button type="submit" class=" btn btn-warning btn-block">Acceder</button>
                      </div>
                      
                      </div>
                    </div>
                 
                 
                </form>
                </i></a>
              </div>
            </div>
            <!--Seguridad -->
            <div class="col-md-4">
              <div class="small-box bg-info">
                <div class="inner">             
                    <h3>Seguridad</h3>
                    <p>Niveles</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-ios-locked-outline"></i>
                    </div>
                    <div class="btn-group btn-block">
                      <button type="button" class="btn btn-warning">Configurar</button>
                      <button type="button" class="btn btn-warning dropdown-toggle dropdown-icon" data-toggle="dropdown">
                        <span class="sr-only">Toggle Dropdown</span>
                        <div class="dropdown-menu" role="menu">
                          <form method="GET" action="{{ route('ReglasUsuarioC.index') }}">
                            @csrf
                            
                             <input type="hidden" name="id_empresa" id="id_empresa" value="{{$data['id_empresa']}}">
                            <a class="dropdown-item" href="#" onclick="$(this).closest('form').submit()">Nuevo...</a>                       
                          </form>
                          
                          <div class="dropdown-divider"></div>                      
                           <a class="dropdown-item" onclick="$('#exampleModal').modal('show')" >Usuarios Asignados</a>                     
                        </div>
                      </button>
                    </div>
                 
                </i></a>
              </div>
            </div>
             <!--Centros de Costo -->
            <div class="col-md-4">
              <div class="small-box bg-info">
                <div class="inner">
                  <form method="POST" action="{{ route('CcC.index') }}">
                    @csrf
                    <input type="hidden" name="id_empresa" id="id_empresa" value="{{$data['id_empresa']}}">
                     <input type="hidden" name="ruta" id="ruta" value="">
                    <h3>Centros de Costo</h3>
                    <p>Gestión</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-social-usd"></i>
                  </div>
                  <div class="col-md-12">
                   <button type="submit" class=" btn btn-warning btn-block">Gestionar</button>
                  </div>
                </form>
                </i></a>
              </div>
            </div>
             <!--Crear Factura -->
            <div class="col-md-4">
              <div class="small-box bg-info">
                <div class="inner">
                  <form method="POST" action="{{ route('FacturaC.index') }}">
                    @csrf
                    <input type="hidden" name="id_empresa" id="id_empresa" value="{{$data['id_empresa']}}">
                     <input type="hidden" name="ruta" id="ruta" value="">
                    <h3 style="margin-bottom: 40px">Cargar Factura</h3>
                    
                  </div>
                  <div class="icon">
                    <i class="ion ion-android-attach"></i>
                  </div>
                  <div class="col-md-12">
                   <button type="submit" class=" btn btn-warning btn-block">Acceder</button>
                  </div>
                </form>
                </i></a>
              </div>
            </div>
            <!--Status Transancción -->
            <div class="col-md-4">
              <div class="small-box bg-info">
                <div class="inner">
                  <form method="POST" action="{{ route('TranC.index') }}">
                    @csrf
                    <input type="hidden" name="id_empresa" id="id_empresa" value="{{$data['id_empresa']}}">
                     <input type="hidden" name="ruta" id="ruta" value="">
                    <h3 style="margin-bottom: 40px">Transacciones</h3>
                  </div>
                  <div class="icon">
                    <i class="ion ion-ios-box-outline"></i>
                  </div>
                  <div class="col-md-12">
                   <button type="submit" class=" btn btn-warning btn-block">Revisar</button>
                  </div>
                </form>
                </i></a>
              </div>
            </div>
            <!--Status Terceros -->
            <div class="col-md-4">
              <div class="small-box bg-info">
                <div class="inner">
                  <form method="POST" action="{{ route('ProvC.index') }}">
                    @csrf
                    <input type="hidden" name="id_empresa" id="id_empresa" value="{{$data['id_empresa']}}">
                     <input type="hidden" name="ruta" id="ruta" value="">
                    <h3 style="margin-bottom: 40px">Terceros</h3>
                  </div>
                  <div class="icon">
                    <i class="ion ion-android-cart"></i>
                  </div>
                  <div class="col-md-12">
                   <button type="submit" class=" btn btn-warning btn-block">Gestionar</button>
                  </div>
                </form>
                </i></a>
              </div>
            </div>

          @php
            break;

          case $Nivel >= 3:
          //si es limitado
          @endphp

            <!-- Archvios-->
            @forelse($data['Seguridad'] as $SeguridadItem)
              @if($SeguridadItem->id_regla == 1)
                <div class="col-md-4">
                  <div class="small-box bg-info">
                    <div class="inner">
                      <form method="POST" action="{{ route('DocumentosC.index')}}">
                        @csrf
                        <input type="hidden" name="id_empresa" id="id_empresa" value="{{$data['id_empresa']}}">
                        <h3>Documentos</h3>
                        <p>Carpetas</p>
                      </div>
                      <div class="icon">
                        <i class="ion ion-document-text"></i>
                      </div>
                     
                        <div class="col-md-12">
                          <div class="row">
                            <div class="col-md-4">
                            <select class="form-control" required="" name="año">
                              <option selected="" value="" disabled="">Año</option>
                                @forelse($data['año'] as $AñoItem)
                                  <option value="{{ $AñoItem->año }}">{{ $AñoItem->año }}</option>
                                @empty  

                                @endforelse
                            </select>
                          </div>
                          <div class="col-md-4">
                              <select class="form-control" required="" name="mes">
                              <option selected="" value="" disabled="">Mes</option>
                                 @forelse($data['Meses'] as $MesesItem)
                                    <option value="{{ $MesesItem->mes }}">{{ $MesesItem->mes }}</option>
                                  @empty  

                                  @endforelse
                            </select>
                          </div>
                          <div class="col-md-4">
                            <button type="submit" class=" btn btn-warning btn-block">Acceder</button>
                          </div>
                          
                          </div>
                        </div>
                     
                     
                    </form>
                    </i></a>
                  </div>
                </div>
              @endif
            @empty

            @endforelse 

            <!--seguridad-->
            @forelse($data['Seguridad'] as $SeguridadItem)
              @if($SeguridadItem->id_regla == 7)
                <div class="col-md-4">
                  <div class="small-box bg-info">
                      <div class="inner">             
                          <h3>Seguridad</h3>
                          <p>Niveles</p>
                          </div>
                          <div class="icon">
                            <i class="ion ion-ios-locked-outline"></i>
                          </div>
                          <div class="btn-group btn-block">
                            <button type="button" class="btn btn-warning">Configurar</button>
                            <button type="button" class="btn btn-warning dropdown-toggle dropdown-icon" data-toggle="dropdown">
                              <span class="sr-only">Toggle Dropdown</span>
                              <div class="dropdown-menu" role="menu">

                                @forelse($data['Seguridad'] as $SeguridadItem2)
                                  @if($SeguridadItem2->id_regla == 3)
                                    <form method="GET" action="{{ route('ReglasUsuarioC.index') }}">
                                      @csrf
                                      
                                       <input type="hidden" name="id_empresa" id="id_empresa" value="{{$data['id_empresa']}}">
                                      <a class="dropdown-item" href="#" onclick="$(this).closest('form').submit()">Nuevo...</a>                       
                                    </form>
                                  @endif                               
                                @empty
                                   
                                @endforelse

                                
                                
                                <div class="dropdown-divider"></div> 

                                 @forelse($data['Seguridad'] as $SeguridadItem2)
                                  @if($SeguridadItem2->id_regla == 4)
                                    <a class="dropdown-item" onclick="$('#exampleModal').modal('show')" >Usuarios Asignados</a>                          
                                    </form>
                                  @endif                               
                                @empty
                                  
                                @endforelse                     
                                                  
                              </div>
                            </button>
                          </div>
                       
                      </i></a>
                  </div>
                </div>
              @endif
            @empty

            @endforelse 
           

            <!-- Centros de Costo-->
            @forelse($data['Seguridad'] as $SeguridadItem)
              @if($SeguridadItem->id_regla == 5)
                <div class="col-md-4">
                  <div class="small-box bg-info">
                    <div class="inner">
                      <form method="POST" action="{{ route('CcC.index') }}">
                        @csrf
                        <input type="hidden" name="id_empresa" id="id_empresa" value="{{$data['id_empresa']}}">
                         <input type="hidden" name="ruta" id="ruta" value="">
                        <h3>Centros de Costo</h3>
                        <p>Gestión</p>
                      </div>
                      <div class="icon">
                        <i class="ion ion-social-usd"></i>
                      </div>
                      <div class="col-md-12">
                       <button type="submit" class=" btn btn-warning btn-block">Gestionar</button>
                      </div>
                    </form>
                    </i></a>
                  </div>
                </div>
              @endif
            @empty

            @endforelse

            <!-- Cargar Factura-->
            @forelse($data['Seguridad'] as $SeguridadItem)
              @if($SeguridadItem->id_regla == 6)
                <div class="col-md-4">
                  <div class="small-box bg-info">
                    <div class="inner">
                      <form method="POST" action="{{ route('FacturaC.index') }}">
                        @csrf
                        <input type="hidden" name="id_empresa" id="id_empresa" value="{{$data['id_empresa']}}">
                         <input type="hidden" name="ruta" id="ruta" value="">
                        <h3 style="margin-bottom: 40px">Cargar Factura</h3>
                        
                      </div>
                      <div class="icon">
                        <i class="ion ion-android-attach"></i>
                      </div>
                      <div class="col-md-12">
                       <button type="submit" class=" btn btn-warning btn-block">Acceder</button>
                      </div>
                    </form>
                    </i></a>
                  </div>
                </div>
              @endif
            @empty

            @endforelse

           
          @php
            break; 
        }
      @endphp
     
    </div>
  </div>




<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Usuarios Registrados en {{  $data['Empresa'][0]['Razon']  }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="table table-responsive">
             <table id="example2" class="table table-bordered table-hover">
              <thead>
              <tr>
                
                <th>Email</th>
                <th>Nombres</th>
                <th> </th>
                <th> </th>           
              
                    
              </tr>
              </thead>
              <tbody>
                @forelse($data['Trabajadores'] as $TrabajadoresItem)
                  <tr>
                    <form method="POST" action="{{route('ReglasUsuarioC.edit')}}">
                      @csrf
                      <input type="hidden" id="id_usuario" name="id_usuario" value="{{ $TrabajadoresItem->User->id }}">
                      <input type="hidden" name="id_empresa" id="id_empresa" value="{{ $TrabajadoresItem->id_empresa}}}">
                      <td>{{ $TrabajadoresItem->User->email }}</td>                     
                      <td>{{ $TrabajadoresItem->User->name }}</td>
                      <td><button class="btn btn-warning"><ion-icon name="eye-outline"></ion-icon></button></td>   
                    </form>
                    <form method="POST" action="{{ route('DetEmpCController.destroy') }}">
                      @csrf
                      @method('delete')
                       <input type="hidden" id="id_usuario" name="id_usuario" value="{{ $TrabajadoresItem->User->id }}">
                        <input type="hidden" name="id_empresa" id="id_empresa" value="{{ $TrabajadoresItem->id_empresa}}}">
                       <td><button class="btn btn-warning"><ion-icon name="trash-outline"></ion-icon></button></td>
                    </form>
                  </tr>
                @empty
                    <p>No hay Registros</p>
                @endforelse           
              </tbody>
            </table>  
            </div>
      </div>
      <div class="modal-footer">        
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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

       
    
    });
  </script>

@endsection


