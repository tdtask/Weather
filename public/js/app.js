'use strict';

/*
 * App - главный модуль
 */
let App = (function() {
	var self = { 
		params: {
			'url_file': '/files/create',
		}
	};
	
	self.getData = function(){
		let select_file_type = document.getElementById('file_type'),
			file_type = select_file_type.options[select_file_type.selectedIndex].value;
		return {
			'file_type': file_type
		};
	}
	
	self.getFormData = function(data){
		let form_data = new FormData();
		for ( let key in data ) {
			form_data.append(key, data[key]);
		}
		return form_data;
	}
	self.makeFile = function(){
		let data = self.getData();
		console.log(data);
		self.request(data);
	}
	self.request = function(data){
		let xhr = new XMLHttpRequest(),
			form_data = self.getFormData(data);
		xhr.open('POST', self.params.url_file);
		xhr.onload = function() {
			if (xhr.status === 200) {
				console.log(xhr.responseText);
			}
			else {
				console.log('Request failed.' + xhr.responseText);
			}
		};
		xhr.send(form_data);
	}
	return self;
})();