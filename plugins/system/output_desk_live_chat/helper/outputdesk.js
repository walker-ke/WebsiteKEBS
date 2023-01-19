function outputdesk_call()
{
	jQuery(function($) {
		document.getElementById('ostatus').innerHTML ='<div style="background-color: #fcf8e3;color: #8a6d3b;border-radius: 4px;margin-bottom: 18px;padding: 8px 35px 8px 14px;font-size:15px;">Getting access from OutputDesk ...</div>';
		var deskLink = '';
		var username = document.getElementById('username').value;
		var password = document.getElementById('password').value;
		$.ajax({
			async: false,
			method: "POST",
			url: url,
			data: { username: username, password: password },
			success: function (responseJson) {
				try {
				  response = JSON.parse(responseJson);
				} catch (exception) {
				  response = null;
				}
				if (response) {

					valid	= response.success?response.success:false;

					if (typeof response.message != 'undefined') {	
						var messages = response.message;
						var i, popContent='';
						for (i=0;i<messages.error.length;i++)popContent+=messages.error[i]+'\n';
						document.getElementById('ostatus').innerHTML = '<div style="background-color: #f2dede;border-color: #ebccd1;color: #a94442;border-radius: 4px;margin-bottom: 18px;padding: 8px 35px 8px 14px;font-size:15px;">'+popContent+'</div>';
					}
					if (typeof response.result != 'undefined') {	
						retResult= JSON.parse(response.result);
						document.getElementById('jform_params_message').value = retResult.message;
						document.getElementById('jform_params_name').value = retResult.name;
						document.getElementById('jform_params_plan').value = retResult.plan;
						document.getElementById('jform_params_code').value = retResult.code;
						document.getElementById('jform_enabled').value = 1;
						document.getElementById('ostatus').innerHTML = '';
						Joomla.submitbutton('plugin.apply');
					}
				}
				else {
					document.getElementById('ostatus').innerHTML = '<div style="background-color: #f2dede;border-color: #ebccd1;color: #a94442;border-radius: 4px;margin-bottom: 18px;padding: 8px 35px 8px 14px;font-size:15px;">We cant reach Output Desk server.</div>';
				}
			},
			error: function (request, status, error) {
					document.getElementById('ostatus').innerHTML = '<div style="background-color: #f2dede;border-color: #ebccd1;color: #a94442;border-radius: 4px;margin-bottom: 18px;padding: 8px 35px 8px 14px;font-size:15px;">'+error+'</div>';
			}
		})
	});
	return;
}
