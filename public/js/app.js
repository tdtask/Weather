'use strict';

/*
 * App - главный модуль
 */
let App = (function() {
	let self = { 
		params: {
			'api_weather_export_file': '/api/weather/export_file',
		}
	};
	
	self.getData = function(){
		let select_file_type = document.getElementById('file_type'),
			file_type = select_file_type.options[select_file_type.selectedIndex].value;
		return {
			'file_type': file_type
		};
	};
	
	self.getFormData = function(data){
		let form_data = new FormData();
		for ( let key in data ) {
			form_data.append(key, data[key]);
		}
		return form_data;
	};
	
	self.makeFile = function(){
		let data = self.getData();
		self.request(data);
	};
	
	self.request = function(data){
		let xhr = new XMLHttpRequest(),
			form_data = self.getFormData(data);
		xhr.open('POST', self.params.api_weather_export_file);
		xhr.onload = function() {
			if (xhr.status === 200) {
				let data = JSON.parse(xhr.responseText);
				if(data.code == 0){
					document.getElementById('response').innerHTML = "Weather file is created and saved.<br/> Path: "+data.file;
				}else{
					document.getElementById('response').innerHTML = "Something went wrong.<br/> Error: "+data.error;
				}
			}
			else {
				console.log('Request failed.' + xhr.responseText);
			}
		};
		xhr.send(form_data);
	};
	return self;
})();