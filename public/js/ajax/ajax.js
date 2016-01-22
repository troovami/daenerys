var divname;
var http = getXmlHttpObject();

function handleHttpResponse()
{
 /*   
    if (http.readyState == 0)
    {
        results = "Error al Cargar los datos";
        //innerHTML es para llenar el div resultado con info, recuerden javascript es casesensitive (una variable a != A)
        document.getElementById(divname).innerHTML = results;
    }

    if (http.readyState == 1)
    {
        results = "";
        //results = '<img src="../imagenes/fetching.gif">';
        //innerHTML es para llenar el div resultado con info, recuerden javascript es casesensitive (una variable a != A)
        document.getElementById(divname).innerHTML = results;
    }
*/
    if (http.readyState == 4)
    {
        results = http.responseText;
        //innerHTML es para llenar el div resultado con info, recuerden javascript es casesensitive (una variable a != A)
        document.getElementById(divname).innerHTML = results;

    }
}

function nuevoAjax()
{
    var xmlhttp = false;
    try
    {
        // No IE
        xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
    }
    catch (e)
    {
        try
        {
            // IE 
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        catch (E) {
            xmlhttp = false;
        }
    }
    if (!xmlhttp && typeof XMLHttpRequest != "undefined") {
        xmlhttp = new XMLHttpRequest();
    }
    return xmlhttp;
}

function getXmlHttpObject()
{
    var xmlhttp;
    /*@cc_on
     @if (@_jscript_version >= 5)
     try
     {
     xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
     }
     catch (e)
     {
     try
     {
     xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
     }
     catch (e)
     {
     xmlhttp = false;
     }
     }
     @else
     xmlhttp = false;
     @end @*/

    if (!xmlhttp && typeof XMLHttpRequest != 'undefined')
    {
        try
        {
            xmlhttp = new XMLHttpRequest();
        }
        catch (e)
        {
            xmlhttp = false;
        }
    }
    return xmlhttp;
}

function filtro(valor){ 
    divname = "ajax";
    http.open("GET", 'ajax/' + valor, true);
    //http.open("GET", 'ajax/' + valor + '/' + valor2, true);
    //http.open("GET", 'ajax/hola/hola2/', true);
    //http.open("GET", 'Formulario/'+ selectedText, true);
    http.onreadystatechange = handleHttpResponse;
    http.send(null);

}


function brandSearch(){     
    divname = "ajax";
    var valor = document.getElementById('brandSearchInput').value;

    // Asigna un valor si la variable solo tiene espacion en blanco unicamente
    if(/^\s*$/.test(valor)){
        valor = "empty";
    } 
    //alert(valor.length);
    http.open("GET", 'brand-search/' + valor, true);    
    http.onreadystatechange = handleHttpResponse;
    http.send(null);
    

}
/*
function brandSearch(){     
    divname = "brandSearch";
    var valor = document.getElementById('brandSearchInput').value;

    // Asigna un valor si la variable solo tiene espacion en blanco unicamente
    if(/^\s*$/.test(valor)){
        valor = "empty";
    } 
    //alert(valor.length);
    http.open("GET", 'brand-search/' + valor, true);    
    http.onreadystatechange = handleHttpResponse;
    http.send(null);
    

}
*/