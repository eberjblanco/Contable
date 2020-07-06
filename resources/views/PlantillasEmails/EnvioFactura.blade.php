
<body>
	<h3>Estimado(a), {{ $Nombres }}.</h3>
	<p>     Hemos recibido de su parte los siguientes documentos:</p>
	<table style="width:100%">
	  <tr>
	     
	  </tr>
	  <tr align="center">
	  @php
	  	for($i=0; $i < count($Archivos); $i++) {
	  @endphp
	  	<tr align="center"><td> <p>{{ $Archivos[$i] }}</p> </td></tr>
	  @php
	  	}
	  @endphp	
	   	    
	  </tr>	 
	</table>
	<p>Atentamente,</p>
	<p>ContableWork.com</p>
</body>
