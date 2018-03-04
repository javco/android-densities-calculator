<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8"/>
	<!--link href="css/some-stylesheet.css"
	      rel="stylesheet"/-->
	<script src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
	<script src="js/jquery.form.min.js"></script>
</head>
<body>

<h1>Conversor de imágenes</h1>

<p>Asignar la densidad de la imágen de referéncia y subir el archivo de la imágen (mdpi por defecto)</p>

<form id="ImageConversorForm" enctype="multipart/form-data" method="post" action="libs/image_upload.php">
	<input type="radio" name="density1" value="ldpi">ldpi
	<input type="radio" name="density1" value="mdpi" checked> mdpi
	<input type="radio" name="density1" value="tvdpi"> tvdpi
	<input type="radio" name="density1" value="hdpi"> hdpi
	<input type="radio" name="density1" value="xhdpi"> xhdpi
	<input type="radio" name="density1" value="xxhdpi"> xxhdpi
	<input type="radio" name="density1" value="xxxhdpi"> xxxhdpi

	<br/>

	<input type="file" name="uploaded_file"/><br /><br />
	<input type="submit" value="Convertir"/>
</form>

<div id="ImageConversionResponseMsg">
</div>

<script type="text/javascript">
$(document).ready(function(){

	var options = { 
        target:        '#ImageConversionResponseMsg',   // target element(s) to be updated with server response 
        beforeSubmit:  showRequest,  // pre-submit callback 
        success:       showResponse,  // post-submit callback,
        statusCode: {
		    /*200: function() {
		      alert( "ok" );
		    }*/
		  }
 
        // other available options: 
        //url:       url         // override for form's 'action' attribute 
        //type:      type        // 'get' or 'post', override for form's 'method' attribute 
        //dataType:  null        // 'xml', 'script', or 'json' (expected server response type) 
        //clearForm: true        // clear all form fields after successful submit 
        //resetForm: true        // reset the form after successful submit 
 
        // $.ajax options can be used here too, for example: 
        //timeout:   3000 
    }; 
 
 	// bind to the form's submit event 
    $('#ImageConversorForm').submit(function() { 
        // inside event callbacks 'this' is the DOM element so we first 
        // wrap it in a jQuery object and then invoke ajaxSubmit 
        $(this).ajaxSubmit(options); 
 
        // !!! Important !!! 
        // always return false to prevent standard browser submit and page navigation 
        return false; 
    }); 
});

// pre-submit callback 
function showRequest(formData, jqForm, options) { 
    /*
    // formData is an array; here we use $.param to convert it to a string to display it 
    // but the form plugin does this for you automatically when it submits the data 
    var queryString = $.param(formData); 
 
    // jqForm is a jQuery object encapsulating the form element.  To access the 
    // DOM element for the form do this: 
    // var formElement = jqForm[0]; 
 
    alert('About to submit: \n\n' + queryString); 
 
    // here we could return false to prevent the form from being submitted; 
    // returning anything other than false will allow the form submit to continue
    */
    return true; 
} 
 
// post-submit callback 
function showResponse(responseText, statusText, xhr, $form)  { 
    // for normal html responses, the first argument to the success callback 
    // is the XMLHttpRequest object's responseText property 
 
    // if the ajaxSubmit method was passed an Options Object with the dataType 
    // property set to 'xml' then the first argument to the success callback 
    // is the XMLHttpRequest object's responseXML property 
 
    // if the ajaxSubmit method was passed an Options Object with the dataType 
    // property set to 'json' then the first argument to the success callback 
    // is the json data object returned by the server 
 
    /*alert('status: ' + statusText + '\n\nresponseText: \n' + responseText + 
        '\n\nThe output div should have already been updated with the responseText.');*/ 
} 
</script>

<h1>Conversor de densidades</h1>

<p>Asignar la densidad de la imágen de referéncia e introduir el ancho en píxeles (mdpi por defecto)</p>

<form id="dpconversor">
	
	<input type="radio" name="density2" value="ldpi">ldpi
	<input type="radio" name="density2" value="mdpi" checked> mdpi
	<input type="radio" name="density2" value="tvdpi"> tvdpi
	<input type="radio" name="density2" value="hdpi"> hdpi
	<input type="radio" name="density2" value="xhdpi"> xhdpi
	<input type="radio" name="density2" value="xxhdpi"> xxhdpi
	<input type="radio" name="density2" value="xxxhdpi"> xxxhdpi

	<p>
		<label for="pxs">image width in px</label>
		<input id="pxs" type="text" size="3" />
	</p>
	<p>
		<input type="button" value="calcular" id="calc-dps" />
	</p>
	<p>
		<label for="xxxhdpi">pxs value for xxxhdpi density</label>
		<input id="xxxhdpi" type="text" disabled="true" size="3" />
	</p>
	<p>
		<label for="xxhdpi">pxs value for xxhdpi density</label>
		<input id="xxhdpi" type="text" disabled="true" size="3" />
	</p>
	<p>
		<label for="xhdpi">pxs value for xhdpi density</label>
		<input id="xhdpi" type="text" disabled="true" size="3" />
	</p>
	<p>
		<label for="hdpi">pxs value for hdpi density</label>
		<input id="hdpi" type="text" disabled="true" size="3" />
	</p>
	<p>
		<label for="tvdpi">pxs value for tvdpi density</label>
		<input id="tvdpi" type="text" disabled="true" size="3" />
	</p>
	<p>
		<label for="mdpi">pxs value for mdpi density</label>
		<input id="mdpi" type="text" disabled="true" size="3" />
	</p>
	<p>
		<label for="ldpi">pxs value for ldpi density</label>
		<input id="ldpi" type="text" disabled="true" size="3" />
	</p>
</form>

<h1>Conceptos básicos</h1>

<p><b>Densidad:</b> Puntos (px) que existen en un área</p>

<p>Tamaños</p>

<ul>
	<li>Pequeños: 2" a 3,x"</li>
	<li>Medianos: 3,x" a 5,x"</li>
	<li>Largos: 4,x" a 7,x"</li>
	<li>Extralargos: 7" a 10"</li>
</ul>

<p>Densidades</p>

<ul>
	<li>low (l): 100dpi a 130dpi</li>
	<li>medium (m): 130dpi a 180 mdpi</li>
	<li>high (h): 160/170dpi a 250 hdpi</li>
	<li>extrahight (xh): 250 a 300 xhdpi</li>
</ul>

<h1>Tamaño de los iconos</h1>

<p>
ldpi    | mdpi    | tvdpi    | hdpi    | xhdpi     | xxhdpi    | xxxhdpi
</p>
<p>
36 x 36 | 48 x 48 | 64 x 64  | 72 x 72 | 96 x 96   | 144 x 144 | 192 x 192
</p>


<script>
	$(document).ready(function(){

		$("#calc-dps").click(function(){

			//xhdpi width px
			var pxs = $("#pxs").val();
			var density = $("#dpconversor input[name=density2]").filter(':checked').val();
			
			var ldpi_scaling_ratio = 0.75;
			var mdpi_scaling_ratio = 1;
			var tvdpi_scaling_ratio = 1.33;
			var hdpi_scaling_ratio = 1.5;
			var xhdpi_scaling_ratio = 2;
			var xxhdpi_scaling_ratio = 3;
			var xxxhdpi_scaling_ratio = 4;

			var ldpi, mdpi, tvdpi, hdpi, xhdpi, xxhdpi, xxxhdpi;

			switch(density)
			{
				case "ldpi":
					ldpi = ldpi_scaling_ratio * pxs / ldpi_scaling_ratio;
					mdpi = mdpi_scaling_ratio * pxs / ldpi_scaling_ratio;
					tvdpi = tvdpi_scaling_ratio * pxs / ldpi_scaling_ratio;
					hdpi = hdpi_scaling_ratio * pxs / ldpi_scaling_ratio;
					xhdpi = xhdpi_scaling_ratio * pxs / ldpi_scaling_ratio;
					xxhdpi = xxhdpi_scaling_ratio * pxs / ldpi_scaling_ratio;
					xxxhdpi = xxxhdpi_scaling_ratio * pxs / ldpi_scaling_ratio;
					break;

				case "mdpi":
					ldpi = ldpi_scaling_ratio * pxs / mdpi_scaling_ratio;
					mdpi = mdpi_scaling_ratio * pxs / mdpi_scaling_ratio;
					tvdpi = tvdpi_scaling_ratio * pxs / mdpi_scaling_ratio;
					hdpi = hdpi_scaling_ratio * pxs / mdpi_scaling_ratio;
					xhdpi = xhdpi_scaling_ratio * pxs / mdpi_scaling_ratio;
					xxhdpi = xxhdpi_scaling_ratio * pxs / mdpi_scaling_ratio;
					xxxhdpi = xxxhdpi_scaling_ratio * pxs / mdpi_scaling_ratio;
					break;

				case "tvdpi":
					ldpi = ldpi_scaling_ratio * pxs / tvdpi_scaling_ratio;
					mdpi = mdpi_scaling_ratio * pxs / tvdpi_scaling_ratio;
					tvdpi = tvdpi_scaling_ratio * pxs / tvdpi_scaling_ratio;
					hdpi = hdpi_scaling_ratio * pxs / tvdpi_scaling_ratio;
					xhdpi = xhdpi_scaling_ratio * pxs / tvdpi_scaling_ratio;
					xxhdpi = xxhdpi_scaling_ratio * pxs / tvdpi_scaling_ratio;
					xxxhdpi = xxxhdpi_scaling_ratio * pxs / tvdpi_scaling_ratio;
					break;

				case "hdpi":
					ldpi = ldpi_scaling_ratio * pxs / hdpi_scaling_ratio;
					mdpi = mdpi_scaling_ratio * pxs / hdpi_scaling_ratio;
					tvdpi = tvdpi_scaling_ratio * pxs / hdpi_scaling_ratio;
					hdpi = hdpi_scaling_ratio * pxs / hdpi_scaling_ratio;
					xhdpi = xhdpi_scaling_ratio * pxs / hdpi_scaling_ratio;
					xxhdpi = xxhdpi_scaling_ratio * pxs / hdpi_scaling_ratio;
					xxxhdpi = xxxhdpi_scaling_ratio * pxs / hdpi_scaling_ratio;
					break;

				case "xhdpi":
					ldpi = ldpi_scaling_ratio * pxs / xhdpi_scaling_ratio;
					mdpi = mdpi_scaling_ratio * pxs / xhdpi_scaling_ratio;
					tvdpi = tvdpi_scaling_ratio * pxs / xhdpi_scaling_ratio;
					hdpi = hdpi_scaling_ratio * pxs / xhdpi_scaling_ratio;
					xhdpi = xhdpi_scaling_ratio * pxs / xhdpi_scaling_ratio;
					xxhdpi = xxhdpi_scaling_ratio * pxs / xhdpi_scaling_ratio;
					xxxhdpi = xxxhdpi_scaling_ratio * pxs / xhdpi_scaling_ratio;
					break;

				case "xxhdpi":
					ldpi = ldpi_scaling_ratio * pxs / xxhdpi_scaling_ratio;
					mdpi = mdpi_scaling_ratio * pxs / xxhdpi_scaling_ratio;
					tvdpi = tvdpi_scaling_ratio * pxs / xxhdpi_scaling_ratio;
					hdpi = hdpi_scaling_ratio * pxs / xxhdpi_scaling_ratio;
					xhdpi = xhdpi_scaling_ratio * pxs / xxhdpi_scaling_ratio;
					xxhdpi = xxhdpi_scaling_ratio * pxs / xxhdpi_scaling_ratio;
					xxxhdpi = xxxhdpi_scaling_ratio * pxs / xxhdpi_scaling_ratio;
					break;

				case "xxxhdpi":
					ldpi = ldpi_scaling_ratio * pxs / xxxhdpi_scaling_ratio;
					mdpi = mdpi_scaling_ratio * pxs / xxxhdpi_scaling_ratio;
					tvdpi = tvdpi_scaling_ratio * pxs / xxxhdpi_scaling_ratio;
					hdpi = hdpi_scaling_ratio * pxs / xxxhdpi_scaling_ratio;
					xhdpi = xhdpi_scaling_ratio * pxs / xxxhdpi_scaling_ratio;
					xxhdpi = xxhdpi_scaling_ratio * pxs / xxxhdpi_scaling_ratio;
					xxxhdpi = xxxhdpi_scaling_ratio * pxs / xxxhdpi_scaling_ratio;
					break;

				default:
					ldpi = 0;
					mdpi = 0;
					tvdpi = 0;
					hdpi = 0;
					xhdpi = 0;
					xxhdpi = 0;
					xxxhdpi = 0;
			}

			//fill hdpi form input
			$("#xxxhdpi").val(xxxhdpi);

			//fill hdpi form input
			$("#xxhdpi").val(xxhdpi);

			//fill hdpi form input
			$("#xhdpi").val(xhdpi);

			//fill hdpi form input
			$("#hdpi").val(hdpi);

			//fill hdpi form input
			$("#tvdpi").val(tvdpi);

			//fill hdpi form input
			$("#mdpi").val(mdpi);

			//fill hdpi form input
			$("#ldpi").val(ldpi);

		});	

	});
</script>


</body>
</html>


