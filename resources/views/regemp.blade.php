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
        <form role="form" action="{{ route('regemp.store')}}" method="POST" name="f1">
          @csrf
          <div class="card-body">
  <div class="row">
    <div class="col">
            <div class="form-group">
              <label for="exampleInputEmail1">Nit</label>
              <input required="" name="Nit_nva" type="text" class="form-control" id="Nit_nva" placeholder="Ingrese Nit">
            </div>
    </div>        
    <div class="col">
            <div class="form-group col-md-6">
              <label for="exampleInputPassword1">Razón</label>
              <input required="" name="Razon_nva" type="text" class="form-control" id="Razon_nva" placeholder="Ingrese Razón">
            </div>
  </div>
</div>



<!--Departamento -->
<div class="row">
    <div class="col">
      <div class="form-group">
                <div class="form-group">
                <label for="exampleInputPassword1">Departamento</label>
                <input required="" name="Departamento_nva" type="text" class="form-control" id="Departamento_nva" placeholder="Ingrese Departamento">
                </div>
      </div>
    </div>
<!--Municipio -->
    <div class="form-group col-md-6">
          <div class="col">
            <div class="form-group">
              <label for="exampleInputPassword1">Municipio</label>
              <input required="" name="Municipio_nva" type="text" class="form-control" id="Municipio_nva" placeholder="Ingrese Municipio">
            </div>
          </div>
    </div>
</div>
                          <!-- Nuevos Campos insertados -->
                          <!-- Departamento -->
<!--
    <div class="form-group col-md-12">
    <label for="exampleInputPassword1">Departamento</label>
            <select class="form-control" id="pais" name=Departamento_Nvo onchange="cambia_provincia()"> 
            <option selected value="0">Seleccione Departamento
            <option value="1">Amazonas
            <option value="2">Antioquia
            <option value="3">Arauca
            <option value="4">Atlántico
            <option value="5">Bolívar
            <option value="6">Boyacá
            <option value="7">Caldas
            <option value="8">Caquetá
            <option value="9">Casanare
            <option value="10">Cauca
            <option value="11">Cesar
            <option value="12">Chocó
            <option value="13">Córdoba
            <option value="14">Cundinamarca
            <option value="15">Guainía
            <option value="16">Guaviare
            <option value="17">Huila
            <option value="18">La Guajira
            <option value="19">Magdalena
            <option value="20">Meta
            <option value="21">Nariño
            <option value="22">Norte de Santander
            <option value="23">Putumayo
            <option value="24">Quindío
            <option value="25">Risaralda
            <option value="26">San Andrés y Providencia
            <option value="27">Santander
            <option value="28">Sucre
            <option value="29">Tolima
            <option value="30">Valle del Cauca
            <option value="31">Vaupés
            <option value="32">Vichada
            </select>
    </div>
    <div class="form-group col-md-12">
    <label for="exampleInputPassword1">Municipio</label>
            <select class="form-control" id="provincia" name=Municipio_Nva> 
            <option>Seleccione Municipio
            </select> 
            </div> 
            <br>           
          <div>
                        
NUEVO DATOS A RECOGER -->

<!-- Direccion -->
      <div class="form-group col-md-12">
          <div class="form-group">
            <label>Dirección</label>
            <textarea rows="3" required="" name="Direccion_nva" type="text" class="form-control" id="Razon_nva" placeholder="Ingrese Dirección "></textarea>
          </div>
      </div>
 <!-- Correo -->   
 <div class="row">
    <div class="col">      
      <div class="form-group">         
              <div class="form-group">
              <label for="exampleInputPassword1">Correo</label>
              <input required="" name="Correo_nva" type="email" class="form-control" id="Correo_nva" placeholder="Ingrese Correo ">
              </div>
      </div>
    </div>

<!-- Telefono -->
    <div class="col">    
        <div class="form-group col-md-12">
            <div class="form-group">
              <label for="exampleInputPassword1">Teléfono</label>
              <input required="" name="Telefono_nva" type="text" class="form-control" id="Razon_nva" placeholder="Ingrese Teléfono ">
            </div>
        </div>
    </div>
</div> 
<!-- FIN NUEVO DATOS A RECOGER  --> 

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
          <input type="text" name="Correo_edit" id="Correo_edit" class="form-control" placeholder="Correo" value="{{ $EmpresasItem->Correo }}">   
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

<script>
  var provincias_1=new Array("Leticia","Puerto Nariño");
  var provincias_2=new Array(
    "Medellín","Abejorral","Abriaquí","Alejandría","Amaga","Amalfi","Andes","Angelópolis","Angostura","Anorí","Anzá","Apartadó","Arboletes","Argelia","Armenia","Barbosa","Belmira","Bello","Betania","Betulia","Briceño","Buriticá","Cáceres","Caicedo","Caldas","Campamento","Cañasgordas","Caracolí","Caramanta","Carepa","Carolina del Príncipe","Caucasia","Chigorodó","Cisneros","Ciudad Bolívar","Cocorná","Concepción","Concordia","Copacabana","Dabeiba","Donmatías","Ebéjico","El Bagre","El Carmen de Viboral","El Jardín","El Jardín","El Peñol","El Retiro","El Santuario", "Entrerríos","Envigado","Fredonia","Frontino","Giraldo","Giradota","Gómez Plata","Granada","Guadalupe","Guarne","Guatapé","Heliconia","Hispania","Itagüí","Jericó","La Ceja","La Estrella","La Pintada","La Unión", "Liborina","Maceo","Marinilla","Montebello","Murindó","Mutatá","Nariño","Nechí","Necoclí","Olaya","Peque","Pueblorrico","Puerto Berrio","Puerto Nare","Puerto Triunfo","Remedios","Rionegro","Sabanalarga","Sabaneta","Salgar","San Andrés","San Carlos","San Francisco","San Jerónimo","San José de la Montaña","San Juan de Urabá","San Luis","San Pedro de los Milagros","San Pedro de Urabá","San Rafael", "San Roque", "San Vicente Ferrer","Santa Fe de Antioquia", "Santa Rosa de Osos", "Santo Domingo", "Segovia", "Sonsón","Sopetrán", "Támesis", "Tarazá", "Tarso", "Titiribí", "Toledo", "Turbo", "Uramita", "Urrao", "Valdivia", "Valparaíso", "Vegachí", "Venecia", "Vigía del Fuerte", "Yalí", "Yarumal", "Yolombó", "Yondó", "Zaragoza"
    );
  var provincias_3=new Array("Arauca","Arauquita","Cravo Norte","Fortul","Puerto Rondón","Saravena","Tame");
  var provincias_4=new Array(
    "Barranquilla","Baranoa","Campo de la Cruz","Candelaria","Galapa","Juan de Acosta","Luruaco","Malambo","Manatí","Palmar de Varela","Piojó","Polonuevo","Ponedera","Puerto Colombia","Repelón","Sabanagrande","Santa Lucía","Santo Tomás","Soledad","Suan","Tubará","Usiacurí"
    );
  var provincias_5=new Array(
    "Cartagena de Indias","Achí","Altos del Rosario","Arenal","Arjona","Arroyohondo","Barranco de Loba","Calamar","Cantagallo","Cicuco","Clemencia","Córdoba","El Carmen de Bolívar","El Guamo","El Peñon","Hatillo de Loba","Magangué","Mahates","Margarita","María La Baja","Montecristo","Morales","Norosí","Pinillos","Regidor","Rioviejo","San Cristóbal","San Estanislao","San Fernando","San Jacinto","San Jacinto del Cauca","San Juan Nepomuceno","San Martín de Loba","San Pablo","Santa Catalina","Santa Cruz de Mompox","Santa Rosa","Santa Rosa del Sur","Simití","Soplaviento","Talaigua Nuevo","Tiquisio", "Turbaco","Turbana","Villanueva","Zambrano"
    );
  var provincias_6=new Array("-");
  var provincias_7=new Array("-");
  var provincias_8=new Array("-");
  var provincias_9=new Array("-");
  var provincias_10=new Array("-");
  var provincias_11=new Array("-");
  var provincias_12=new Array("-");
  var provincias_13=new Array("-");
  var provincias_14=new Array("-");
  var provincias_15=new Array("-");
  var provincias_16=new Array("-");
  var provincias_17=new Array("-");
  var provincias_18=new Array("-");
  var provincias_19=new Array("-");
  var provincias_20=new Array("-");
  var provincias_21=new Array("-");
  var provincias_22=new Array("-");
  var provincias_23=new Array("-");
  var provincias_24=new Array("-");
  var provincias_25=new Array("-");
  var provincias_26=new Array("-");
  var provincias_27=new Array("-");
  var provincias_28=new Array("-");
  var provincias_29=new Array("-");
  var provincias_30=new Array("-");
  var provincias_31=new Array("-");
  var provincias_32=new Array("-");

  var todasProvincias = [
    [],
    provincias_1,
    provincias_2,
    provincias_3,
    provincias_4,
    provincias_5,
    provincias_6,
    provincias_7,
    provincias_8,
    provincias_9,
    provincias_10,
    provincias_11,
    provincias_12,
    provincias_13,
    provincias_14,
    provincias_15,
    provincias_16,
    provincias_17,
    provincias_18,
    provincias_19,
    provincias_20,
    provincias_21,
    provincias_22,
    provincias_23,
    provincias_24,
    provincias_25,
    provincias_26,
    provincias_27,
    provincias_28,
    provincias_29,
    provincias_30,
    provincias_31,
    provincias_32,
  ];

  function cambia_provincia(){ 
    //tomo el valor del select del pais elegido 
    var pais 
    pais = document.f1.pais[document.f1.pais.selectedIndex].value 
    //miro a ver si el pais está definido 
    if (pais != 0) { 
        //si estaba definido, entonces coloco las opciones de la provincia correspondiente. 
        //selecciono el array de provincia adecuado 
        mis_provincias=todasProvincias[pais]
        //calculo el numero de provincias 
        num_provincias = mis_provincias.length 
        //marco el número de provincias en el select 
        document.f1.provincia.length = num_provincias 
        //para cada provincia del array, la introduzco en el select 
        for(i=0;i<num_provincias;i++){ 
          document.f1.provincia.options[i].value=mis_provincias[i] 
          document.f1.provincia.options[i].text=mis_provincias[i] 
        } 
    }else{ 
        //si no había provincia seleccionada, elimino las provincias del select 
        document.f1.provincia.length = 1 
        //coloco un guión en la única opción que he dejado 
        document.f1.provincia.options[0].value = "-" 
        document.f1.provincia.options[0].text = "-" 
    } 
    //marco como seleccionada la opción primera de provincia 
    document.f1.provincia.options[0].selected = true 
}

  </script>

@endsection


