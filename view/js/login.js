$(document).ready(function(){
	$('#enviar').click(function()
	{
		compruebaCampos();
	});
});

function compruebaCampos()
{
	if($('#login').val() == "" || $('#password').val() == "")
	{
		$('#error').css('display','block'); 	
	}else
	{
		document.formLogin.submit();	
	}	
}