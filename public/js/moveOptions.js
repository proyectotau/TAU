// HTML/JavaScript Select list move options
// Moving Options between two Select list boxes
// http://www.mredkj.com/tutorials/tutorial_mixed2b.html

// jagar 2009/02/13
// Se prototipa para SuperAjax
// Se añade prefijo Administracion_
// En moveOptions se cambian el tipo de param From&To para sacarlo de <form> y usar document.getElementById

addOption = function (theSel, theText, theValue) {
    var newOpt = new Option(theText, theValue);
    var selLength = theSel.length;
    theSel.options[selLength] = newOpt;
}

deleteOption = function (theSel, theIndex)
{
    var selLength = theSel.length;
    if(selLength>0)
    {
        theSel.options[theIndex] = null;
    }
}
Administracion_moveOptions = function (selFrom, selTo)
{
    var NS4 = (navigator.appName == "Netscape" && parseInt(navigator.appVersion) < 5);
    var theSelFrom=document.getElementById(selFrom);
    var theSelTo=document.getElementById(selTo);
    var selLength = theSelFrom.length;
    var selectedText = new Array();
    var selectedValues = new Array();
    var selectedCount = 0;

    var i;

    // Find the selected Options in reverse order
    // and delete them from the 'from' Select.
    for(i=selLength-1; i>=0; i--)
    {
        if(theSelFrom.options[i].selected)
        {
            // Usuario Administrador
            // Grupo Administradores
            // Perfil Administracion
            if( theSelFrom.options[i].value == 0 ) {
                theSelFrom.options[i].selected = false;
                alert("El elemento "+theSelFrom.options[i].text+" no se puede mover");
                continue;
            }
            selectedText[selectedCount] = theSelFrom.options[i].text;
            selectedValues[selectedCount] = theSelFrom.options[i].value;
            deleteOption(theSelFrom, i);
            selectedCount++;
        }
    }

    // Add the selected text/values in reverse order.
    // This will add the Options to the 'to' Select
    // in the same order as they were in the 'from' Select.
    for(i=selectedCount-1; i>=0; i--)
    {
        addOption(theSelTo, selectedText[i], selectedValues[i]);
    }

    if(NS4) history.go(0);
}