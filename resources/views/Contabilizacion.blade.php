@extends('layouts.appAdmin')

@section('head_local')
  
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">
  
  <link rel="stylesheet" href="dist/css/adminlte.min.css">  
 
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">

  <link rel="stylesheet" href="plugins/toastr/toastr.min.css">

  <style type="text/css">
    th.hide_me, td.hide_me {display: none;}
  </style>
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
    
    

   <div class="row">
      <div class="col-md-12">
      <div class="card card-warning ">
          <div class="card-header">
            <div class="row">
              <div class="col-md-5">
                <h3 class="card-title">Documentos Existentes/Importar Excel(SIIGO)</label></h3>
              </div>
              <div class="col-md-5" align="right">
                <input type="file" id="fileUpload" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"/>
              </div>
              <div class="col-md-2" align="right">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
              </div>
            </div>
          </div>
          <div class="card-body collapse ">              
            <div class="table table-responsive" style="">
              <table id="example5" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>FecDoc</th>
                    <th>Consecutivo</th>
                    <th>Nit</th>
                    <th>Ceco</th>
                    <th>DescSec</th>  
                    <th>Tpo. Compro</th>  
                    <th> </th>                   
                  </tr>
                </thead>
                <tbody id="tbody">
                @php
                  $cont=1;
                @endphp

                @forelse($data['Comprobantes'] as $ComproItem)


                  <tr>
                    <td id="idTablaComp_{{ $cont }}">{{ $ComproItem->id }}</td>
                    <td>{{ $ComproItem->FecDoc }}</td>
                    <td>{{ $ComproItem->TpoCompro.$ComproItem->CodCompro.'-'.$ComproItem->NroDoc }}</td>
                    <td>{{ $ComproItem->Nit }}</td>
                    <td>
                      {{ $ComproItem->Ceco.'-'.$ComproItem->SubCeco }}
                    </td>
                    <td>{{ $ComproItem->DescSec }}</td>     

                    <td>
                      <button id="btnEnviarComp_{{ $cont }}" onclick="enviarCom('{{ $ComproItem->id }}','{{ $cont }}','{{  $ComproItem->Ceco }}','{{  $ComproItem->TpoCompro }}')" class="btn btn-warning"><ion-icon name="checkmark-outline"></ion-icon></button>
                    </td>           
                  </tr>

                  @php
                    $cont = $cont + 1;
                  @endphp
                   
                @empty

                @endforelse

                </tbody>
              </table>                 
            </div>
          </div>
        
      </div>
    </div>
   </div>
   
    <div class="row">
      <div class="col-md-12">
        <div class="card card-warning">
            <div class="card-header">              
              <div class="row">
                <div class="col-md-10">
                  <h3 class="card-title">Trans. Existentes</label></h3>
                </div>
                
                <div class="col-md-2" align="right">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                </div>
              </div>
            </div>
            <div class="card-body collapse">
              <div class="table table-responsive">                       
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                      <tr>                    
                        <th>ID</th>
                        <th>Fecha</th>
                        <th>Doc</th>
                        <th> </th>
                      </tr>
                    </thead>
                    <tbody>
                      @php
                        $cont=1;
                      @endphp
                      @forelse($data['Registros'] as $RegistrosItem)                       
                        <tr>
                          <td id="idTabla_{{ $cont }}">
                            {{ $RegistrosItem->id }}
                          </td>
                          <td id="FecTabla_{{ $cont }}">

                            @forelse($data['Conta'] as $ContaItem)
                              @if($RegistrosItem->id == $ContaItem->id_tran)
                                {{ $ContaItem->fecha }}
                              @endif
                            @empty

                            @endforelse

                          </td>              
                          <td>
                           @forelse($data['Documentos'] as $DocumentosItem)

                              @if($DocumentosItem->id_tran == $RegistrosItem->id)
                                  <div class="row">
                                     <a href="#" data-toggle="modal" data-target="#exampleModal" style="margin-right: 25px" onclick="prevista('{{'Documentos/Temp/'.$data['Empresa'][0]['Razon'].'/'.$RegistrosItem->Cc->mes.'/'.$DocumentosItem->nombre}}')">{{ $DocumentosItem->nombre }}</a>
                                  </div>
                                  <hr>                                                             
                              @endif                             

                           @empty

                           @endforelse

                          </td>   
                          <td><button id="btnEnviar_{{ $cont }}" onclick="enviarTran('{{ $RegistrosItem->id }}','{{ $cont }}')" class="btn btn-warning"><ion-icon name="checkmark-outline"></ion-icon></button></td>                 
                        </tr>

                        @php
                          $cont = $cont + 1;
                        @endphp

                        @empty                         
                      @endforelse               
                    
                    </tbody>
                  </table>
              </div>
            </div>
           
        </div>      
      </div>
    </div>
    <hr>
    <div class="row">
       <div class="col-md-7">
        <div class="card card-warning">
            <div class="card-header">
              <h3 class="card-title">Relación</label></h3>
            </div>
           
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12">
                    <label>Tipo de Relación</label>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <input onclick="verFormsiigoTran()" type="radio" name="r1" id="TransExcel" value="TransExcel" checked=""> Transacción vs Siigo
                  </div>
                  <div class="col-md-6">
                    <input onclick="verFormPDFTran()"  type="radio" name="r1" id="TransExcel" value="TransExcel"> Transacción vs Doc. Creado
                  </div>
                </div>
              
                <hr>
                <form method="POST" action="{{ route('ContaC.AgregarTranDoc')}}" enctype="multipart/form-data"  name="formTranPDF" id="formTranPDF" style="display: none;">
                    @csrf

                    <div class="row">
                      <div class="col-md-12">
                         <input name="doc[]" id="doc" required="" type="file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel, application/pdf"/>
                      </div>
                    </div>
                    <br>
                    <div class="row">
                      <div class="col-md-12">
                        <textarea class="form-control" name="comentario" id="comentario" placeholder="Comentario(opcional)..."></textarea>
                      </div>
                    </div>
                    <br>
                    <div class="row">
                      <div class="col-md-12">
                        <textarea class="form-control" name="observaciones" id="observaciones" placeholder="Observaciones(opcional)..."></textarea>
                      </div>
                    </div>
                    <br>              
                    <input required="" type="hidden" name="id_empresa" id="id_empresa" value="{{ $data['Empresa'][0]['id'] }}">
                    <input required="" type="hidden" name="id_cc" id="id_cc" value="">
                    <input required="" type="hidden" name="tipo" id="tipo" value="">
                    <input required="" type="hidden" name="id_comp" id="id_comp" value="">

                    <div class="row">
                      <div class="col-md-4">
                        <input style="margin-right: 3px" type="radio" name="r1" id="r1" value="pagar" checked="">Pagar
                      </div>
                       <div class="col-md-4">
                        <input style="margin-right: 3px" type="radio" name="r1" id="r2" value="cobrar">Cobrar
                      </div>
                       <div class="col-md-4">
                        <input style="margin-right: 3px" type="radio" name="r1" id="r3" value="archivar">Archivar
                      </div>
                    </div>
                    <br>
                    <div class="row">
                      <div class="col-md-12">
                        <div align="center"><button  class="btn btn-warning">Relacionar</button></div>
                      </div>
                    </div>
                  
                </form>




                <form method="POST" action="{{ route('ContaC.AgregarTranSiigo') }}" name="formDocTran" id="formDocTran" style="display: block;">
                  @csrf
                   <input required="" type="hidden" name="id_empresa" id="id_empresa" value="{{ $data['Empresa'][0]['id'] }}">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="row"><p style="font-weight: bold;margin-right: 5px">Nro. Trans: </p><p id="tranRelId"></p></div>
                      <input required="" type="hidden" class="form-control" name="txtTranRelId" id="txtTranRelId">
                    </div>
                    <div class="col-md-6">
                       <div class="row"><p style="font-weight: bold;margin-right: 5px">Fecha: </p><p id="tranRelFec"></p></div>
                      
                      <input required="" type="hidden" class="form-control" name="txtTranRelFec" id="txtTranRelFec">
                    </div>
                  </div>
                                 
                  <div class="col-md-6">
                    <div class="row">
                      <div class="row"><p style="font-weight: bold;margin-right: 5px">Nro. Doc: </p><p id="DocNum"></p></div>   
                      <input required="" type="hidden" class="form-control" name="txtDocNum" id="txtDocNum">                
                    </div>
                  </div>
                
                  <div class="row">
                    <div class="col-md-4">
                      <input style="margin-right: 3px" type="radio" name="r1" id="r1" value="pagar" checked="">Pagar
                    </div>
                     <div class="col-md-4">
                      <input style="margin-right: 3px" type="radio" name="r1" id="r2" value="pagar">Cobrar
                    </div>
                     <div class="col-md-4">
                      <input style="margin-right: 3px" type="radio" name="r1" id="r3" value="pagar">Archivar
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-md-12">
                      <textarea class="form-control" placeholder="Comentario(opcional)..." name="comentario" id="comentario"></textarea>
                    </div>
                  </div>
                  <br>
                  <div class="row">
                      <div class="col-md-12">
                        <textarea class="form-control" name="observaciones" id="observaciones" placeholder="Observaciones(opcional)..."></textarea>
                      </div>
                    </div>
                  <br>
                  <div class="row">
                    <div class="col-md-12">
                      <div align="center"><button id="btnRel" disabled="" class="btn btn-warning">Relacionar</button></div>
                    </div>
                  </div>
                </form>

                
              </div>
        </div>     
      </div>
    </div>

      
   
   





<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">PreVisualización</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="modalPrevista"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>       
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="preexampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Previsualización</h5>       
      </div>
      <div class="modal-body">
        <div class="table table-responsive" style="">
          <table id="example3" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>Consecutivo</th>
                <th>Nit</th>
                <th>Ceco</th>
                <th>DescSec</th>                  
                           
              </tr>
            </thead>
            <tbody id="tbody">
              <tr>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                            
              </tr>
            </tbody>
          </table>                 
        </div>
        <div class="table-responsive" style="display: none">
          <table id="example4" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>FecDoc</th>
                <th>Nit</th>
                <th>Ceco</th>
                <th>DescSec</th>
                <!--ocultas-->
                <th>TpoCompro</th>
                <th>CodCompro</th>
                <th>NroDoc</th>
                <th>CtaConta</th>
                <th>DebCre</th>
                <th>ValSec</th>                
                <th>Secuencia</th>
                <th>SubCeco</th>                               
                <th>ComproAnu</th>
                <th>BaseReten</th>
                <th>GrupoAct</th>
                <th>CodAct</th>
                <th>NroDocProvee</th>
                <th>PrefDocProvee</th>
                <th>FecDocProvee</th>
                <th>TpoComproCruce</th>
                <th>NroDocCruce</th>
                <th>FecDocCruce</td>
              </tr>
            </thead>
            <tbody id="tbody">
              <tr>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>

                <td>0</td>     
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>                
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>                
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>                
                <td>0</td>
                <td>0</td>
                <td>0</td>
                
                
              </tr>
            </tbody>
          </table> 
        </div>      
      </div>
      <div class="modal-footer">
        <div class="col-md-6">
          
          <button type="button" class="btn btn-warning" data-dismiss="modal" onclick="guardar()">Guardar</button>
        </div>
        <div class="col-md-6" align="right">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="limpiarInputFile()">Cerrar</button>
        </div> 
      </div>
    </div>
  </div>
</div>

  
 


    
  <p id="tipo" style="visibility: hidden;">{{ $data['Tipo']}}</p>
  <p id="mensaje" style="visibility: hidden;">{{ $data['Texto']}}</p>
  <div id="contReg" num="{{ count($data['Registros']) }}"></div>
  <div id="contRegComp" num="{{ count($data['Comprobantes']) }}"></div>



@endsection


@section('script_local')
  
  <script src="plugins/jquery/jquery.min.js"></script>
  
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  
  <script src="plugins/datatables/jquery.dataTables.js"></script>

  <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
  
  <script src="dist/js/adminlte.min.js"></script>
  
  <script src="dist/js/demo.js"></script>

  <script src="plugins/datatables/jquery.dataTables.js"></script>

  <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>

  <script src="plugins/toastr/toastr.min.js"></script>

  <script type="text/javascript" src="https://unpkg.com/xlsx@0.14.1/dist/xlsx.full.min.js"></script>




  <script type="text/javascript">   
    var resp

    $(function () { 

      mensaje = $('#mensaje').html();
      tipo = $('#tipo').html();
      if (tipo=='Error') {toastr.error(mensaje)}
      if (tipo =='OK') {toastr.success(mensaje)}
    
      $('#example2').DataTable({
        //"order": [[ 0, "desc" ]]
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
      });

      $('#example3').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,       
        "autoWidth": false,
        "pageLength": 4
      });

      $('#example4').DataTable();

      $('#example5').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,       
        "autoWidth": false,
        "pageLength": 4
      });

    });

    function verFormsiigoTran(){
      $('#formDocTran').css('display','block')
      $('#formTranPDF').css('display','none')
    }

    function verFormPDFTran(){
      $('#formDocTran').css('display','none')
      $('#formTranPDF').css('display','block')
    }

    function limpiarInputFile(){      
      $('#fileUpload').val('')
    }

    function prevista(archivo){
      imagen = ' <embed src="'+ archivo +'" width="100%" height="500px"></embed>'
      $('#modalPrevista').html(imagen)
    }

    function enviarTran(idTran,cont){
      //Color Fila
        contReg = $('#contReg').attr('num')        
        for (var i = 1; i <= contReg; i++) {
          $('#idTabla_' + i).css('background-color','')
        }
        $('#idTabla_' + cont).css('background-color','#B3EF8C')
      //p ID      
        $('#tranRelId').html($('#idTabla_' + cont).html())
        $('#txtTranRelId').val($('#idTabla_' + cont).html())
      //txt fecha
        $('#tranRelFec').html($('#FecTabla_' + cont).html())
        $('#txtTranRelFec').val($('#FecTabla_' + cont).html())  
      

      //Seguridad Boton Relacionar
        segRel()  
    }

     function enviarCom(idTran,cont,ceco,tpocompro){
      //formulario Transaccion vs Siigo
        //Color Fila
          contReg = $('#contRegComp').attr('num')        
          for (var i = 1; i <= contReg; i++) {
            $('#idTablaComp_' + i).css('background-color','')
          }
          $('#idTablaComp_' + cont).css('background-color','#B3EF8C')
        //p ID      
          $('#DocNum').html($('#idTablaComp_' + cont).html())
          $('#txtDocNum').val($('#idTablaComp_' + cont).html())

        


        
      //formulario Transaccion vs PDF
        $('#id_cc').val(ceco)
        $('#tipo').val(tpocompro)
        $('#id_comp').val(idTran)


      

      //Seguridad Boton Relacionar
        segRel()  
    }

    function enviarDoc(){

      //P DocNum
        $('#DocNum').html('0000')
      //txt DocNum
        $('#txtDocNum').val(0)  
      //Seguridad Boton Relacionar
        segRel()  
    }

    function segRel(){
      //variables
        SegTranid = $('#txtTranRelId').val()
        SegTranFec = $('#txtTranRelFec').val()    
        SegtxtDocNum = $('#txtDocNum').val() 

      if (SegTranid!= '' && SegTranFec!= '' && SegtxtDocNum !='') {
        $('#btnRel').removeAttr('disabled')
      }else{
        $('#btnRel').attr('disabled','true')
      }
    }

    $('#fileUpload').change(function(){
      Upload()
      $("dvExcel").empty();    
      $('#preexampleModal').modal('show')
    })

    function Upload() {
        //Reference the FileUpload element.
        var fileUpload = document.getElementById("fileUpload");
 
        //Validate whether File is valid Excel file.
        var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.xls|.xlsx)$/;
        if (regex.test(fileUpload.value.toLowerCase())) {
            if (typeof (FileReader) != "undefined") {
                var reader = new FileReader();
 
                //For Browsers other than IE.
                if (reader.readAsBinaryString) {
                    reader.onload = function (e) {
                        ProcessExcel(e.target.result);
                    };
                    reader.readAsBinaryString(fileUpload.files[0]);
                } else {
                    //For IE Browser.
                    reader.onload = function (e) {
                        var data = "";
                        var bytes = new Uint8Array(e.target.result);
                        for (var i = 0; i < bytes.byteLength; i++) {
                            data += String.fromCharCode(bytes[i]);
                        }
                        ProcessExcel(data);
                    };
                    reader.readAsArrayBuffer(fileUpload.files[0]);
                }
            } else {
                alert("This browser does not support HTML5.");
            }
        } else {
            alert("Por favor Ingresa un Archivo Excel Válido");
        }
    };

    function ProcessExcel(data) {
      //Read the Excel File data.
      var workbook = XLSX.read(data, {
          type: 'binary'
      });

      //Fetch the name of First Sheet.
      var firstSheet = workbook.SheetNames[0];

      //Read all rows from First Sheet into an JSON array.
      var excelRows = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[firstSheet]);

      $('#tbody').html('')
      //Add the data rows from Excel file

      var t3 = $('#example3').DataTable();   
      t3.row(':eq(0)').remove().draw(); 

      var t4 = $('#example4').DataTable();   
      t4.row(':eq(0)').remove().draw(); 
      

      for (var i = 3; i < excelRows.length; i++) { 

        FecDoc = "0"
        if (excelRows[i]['__EMPTY_5']!= ''){
          FecDoc = excelRows[i]['__EMPTY_5']+' - ' +excelRows[i]['__EMPTY_6'] +' - '+ excelRows[i]['__EMPTY_7']
        }

        Nit = "0"
        if (excelRows[i]['__EMPTY_14']!= '') {
          Nit = excelRows[i]['__EMPTY_14']
        }

        Ceco = "0"
        if (excelRows[i]['__EMPTY_12']!= '') {
          Ceco = excelRows[i]['__EMPTY_12']
        }

        DescSec = "0"
        if (excelRows[i]['__EMPTY_16']!= '') {
          DescSec = excelRows[i]['__EMPTY_16']
        }



        TpoCompro = "0"
        if (excelRows[i]['CHANGE COLOMBIA'] != '') {
          TpoCompro = excelRows[i]['CHANGE COLOMBIA']
        }

       
        CodCompro = "0"
        if (excelRows[i]['__EMPTY']!= '') {
          CodCompro = excelRows[i]['__EMPTY']
        }
        
        NroDoc = "0"
        if (excelRows[i]['__EMPTY_1']!= '') {
          NroDoc = excelRows[i]['__EMPTY_1']
        }

        CtaConta = "0"
        if (excelRows[i]['__EMPTY_2']!= '') {
          CtaConta = excelRows[i]['__EMPTY_2']
        }

        DebCre = "0"
        if (excelRows[i]['__EMPTY_3']!= '') {
          DebCre = excelRows[i]['__EMPTY_3']
        }

        ValSec = "0"
        if (excelRows[i]['__EMPTY_4']!= '') {
          ValSec = excelRows[i]['__EMPTY_4']
        }

        Secuencia = "0"
        if (excelRows[i]['__EMPTY_11']!= '') {
          Secuencia = excelRows[i]['__EMPTY_11']
        }       
        

        SubCeco = "0"
        if (excelRows[i]['__EMPTY_13']!= '') {
          SubCeco = excelRows[i]['__EMPTY_13']
        }
      
        ComproAnu = "0"
        if (excelRows[i]['__EMPTY_18']!= '') {
          ComproAnu = excelRows[i]['__EMPTY_18']
        }
       
       //empty 32 base de retencion NUEVO DATO
       /* BaseReten = "0"
        if (excelRows[i]['__EMPTY_27']!= '') {
          BaseReten = excelRows[i]['__EMPTY_27']
        } */
       //empty 32 base de retencion NUEVO DATO INGRESADO
        BaseReten = "0"
        if (excelRows[i]['__EMPTY_32']!= '') {
          BaseReten = excelRows[i]['__EMPTY_32']
        }

        //Cambio de lugar EMPTY_32 al EMPTY_38 por el nuevo documento
        GrupoAct = "0"
        if (excelRows[i]['__EMPTY_38']!= '') {
          GrupoAct = excelRows[i]['__EMPTY_38']
        }
        //Cambio de lugar EMPTY_33 al EMPTY_39 por el nuevo documento
        CodAct = "0"
        if (excelRows[i]['__EMPTY_39']!= '') {
          CodAct = excelRows[i]['__EMPTY_39']
        }
        //empty 43 numero documetno proveeedor NUEVO DATO
        NroDocProvee = "0"
        if (excelRows[i]['__EMPTY_43']!= '') {
          NroDocProvee = excelRows[i]['__EMPTY_43']
        }
        //empty 44 numero documento proveedodr NUEVO DATO
        PrefDocProvee = "0"
        if (excelRows[i]['__EMPTY_44']!= '') {
          PrefDocProvee =excelRows[i]['__EMPTY_44']
        }
        //Cambio de lugar de EMPTY_39,EMPTY_40 y EMPTY_41 a EMPTY_45, EMPTY_46 y EMPTY_47.
        FecDocProvee = "0"
        if (excelRows[i]['__EMPTY_45'] != '') {
          FecDocProvee = excelRows[i]['__EMPTY_45']+' - ' +excelRows[i]['__EMPTY_46'] +' - '+ excelRows[i]['__EMPTY_47']
        }
        //empty 53 tipo y comprovante cruce NUEVO DATO
        TpoComproCruce = "0"
        if (excelRows[i]['__EMPTY_53']!= '') {
          TpoComproCruce = excelRows[i]['__EMPTY_53']
        }
        //empty 54 numero y documento cruce NUEVO DATO
        NroDocCruce = "0"
        if (excelRows[i]['__EMPTY_54']!= '') {
          NroDocCruce = excelRows[i]['__EMPTY_54']
        }
        //Cambio de lugar de EMPTY_49,EMPTY_50 y EMPTY_51 a EMPTY_56, EMPTY_57 y EMPTY_58.
        FecDocCruce = "0"
        if (excelRows[i]['__EMPTY_56'] != '') {
          FecDocCruce = excelRows[i]['__EMPTY_56']+' - ' +excelRows[i]['__EMPTY_57'] +' - '+ excelRows[i]['__EMPTY_58']
        }


        t3.row.add([
          TpoCompro + CodCompro + '-' + NroDoc,
          Nit,
          Ceco +'-'+SubCeco,
          DescSec
        ]).draw( false );

       

        t4.row.add([
          FecDoc,
          Nit,
          Ceco,
          DescSec,
          TpoCompro,
          CodCompro,
          NroDoc,
          CtaConta,
          DebCre,
          ValSec,
          Secuencia,
          SubCeco,
          ComproAnu,
          BaseReten,
          GrupoAct,
          CodAct,
          NroDocProvee,
          PrefDocProvee,
          FecDocProvee,
          TpoComproCruce,
          NroDocCruce,
          FecDocCruce
        ]).draw( false );
      } 
    };

    function guardar(){

      var ajaxurl = '{{ route('ComproC.guardar') }}';
      var tabla = tablaJSON('example4')
      id_empresa = $('id_empresa').val()

      $.ajax({
          url: ajaxurl,
          method: "GET",
          data:{_token: '{{csrf_token()}}', tabla:tabla, id_empresa:id_empresa},
          success:function(data){
            respuesta = JSON.parse(data)
            //console.log(respuesta.registrosagregados)
            if (respuesta.registrosagregados!='0') {
              mensaje = "Se agregaron " + respuesta.registrosagregados + " registros"
              toastr.success(mensaje)
            }

            if (respuesta.cecosInexistentes!='') {
              mensaje = 'CECOS no Registrados: ' + respuesta.cecosInexistentes
              toastr.error(mensaje)
            }

           
            if (respuesta.registrosExistentes!='0') {
              mensaje = "Se Obviaron " + respuesta.registrosExistentes + " registros porque ya existian en el sistema"
              toastr.error(mensaje)
            }

           //reinicia la pagina
           setTimeout(
             function() 
             {
               location.reload()
             }, 3000);
            
            


          }
      })
    }

    function tablaJSON(tabla){
      var json = '{';
      var otArr = [];
      var tbl2 = $('#'+ tabla +' tbody tr').each(function(i) {        
         x = $(this).children();
         var itArr = [];
         x.each(function() {
            itArr.push('"' + $(this).text() + '"');
         });
         otArr.push('"' + i + '": [' + itArr.join(',') + ']');
      })
      json += otArr.join(",") + '}'

      return json
    }

  </script>

@endsection

  
