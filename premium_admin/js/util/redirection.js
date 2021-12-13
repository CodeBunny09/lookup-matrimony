function redirectToURL(URL)
{
		window.location = URL;
}
function redirectToURLNewPage(URL)
{
		window.open(URL,"_new");
}


function openNewWindow(URL)
{
		window.open(URL)
}
function showAlertBox(msg)
{
	var resp = confirm(msg);
	return resp;
}
function isNumberKey(evt)
 {
          var charCode = (evt.which) ? evt.which : event.keyCode;
          if (charCode != 46 && charCode > 31 
            && (charCode < 48 || charCode > 57))
             return false;

          return true;
 }
function checkUncheck(obj,cssClass)
	 {
	 	if(obj.checked)
			$(cssClass).attr("checked","checked");
		else
			$(cssClass).attr("checked",false);
	 }
function registerRowSelect()
{
                    $(".table-checkbox").on("change",function(){
                    var chkValue = $(this).val();
                    if(chkValue!="MASTER")
                    {
                        if ($(this).is(':checked')) {
                            $("#dialog"+chkValue).css("background","#ffffdd");
                        } else {
                            $("#dialog"+chkValue).css("background","#ffffff");
                        }   				

                    }else if(chkValue == "MASTER"){
                        if ($(this).is(':checked')) {
                            $(".dialog").css("background","#ffffdd");
                        } else {
                            $(".dialog").css("background","#ffffff");
                        }   				
                    }
                });

}
function registerRowSelect2()
{
                    $(".table-checkbox").on("change",function(){
                    var chkValue = $(this).val();
                    if(chkValue!="MASTER")
                    {
                        if ($(this).is(':checked')) {
                            $("#listing"+chkValue).css("background","#ffffdd");
                        } else {
                            $("#listing"+chkValue).css("background","#ffffff");
                        }   				

                    }else if(chkValue == "MASTER"){
                        if ($(this).is(':checked')) {
                            $(".listing").css("background","#ffffdd");
                        } else {
                            $(".listing").css("background","#ffffff");
                        }   				
                    }
                });

}

function submitActionForm(actionName)
{
    var action = $("#action_form").attr("action");
    $("#action_form").attr("action",action);
     if(actionName=="DELETE"){
                var confirm_resp = confirm("Are you sure to delete the record?");
                if(confirm_resp){
                   $("#action").val(actionName);
                   $("#action_form").submit();
                }
     }else{
                   $("#action").val(actionName);
                   $("#action_form").submit();
     }
}
