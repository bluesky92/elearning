function $$$(id) {
	return document.getElementById(id);
}
function	Forward(url) {
	window.location.href = url;
}
function	_postback() {
	return void(1);
}

//----------------------------------------------------------------------------------------------------------------------
function ajaxFunction() {
	var xmlHttp=null;
	try {
		// Firefox, Internet Explorer 7. Opera 8.0+, Safari.
		xmlHttp = new XMLHttpRequest();
	}
	catch (e) {
		// Internet Explorer 6.
		try {
			xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
		}
		catch (e) {
			try{
				xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e) {
				return false;
			}
		}
	}
}

/**
 *
 * @param obj
 * @returns {string}
 */
function $query(obj) {
	var query = "";
	$(obj).find("input").each(function(i){
		var t = $(obj).find("input").eq(i);
		if ((t.attr("type") != "checkbox") && (t.attr("type") != "radio") && (t.attr("type") != "file") ) {
			if (t.attr("type") != "password") {
				query += "&"+t.attr("name")+"="+encodeURIComponent(t.val());
			} else {
				query += "&"+t.attr("name")+"="+document.getElementsByName(t.attr("name"))[0].value;
			}
		}
		else {
			if(t.attr("type") == "checkbox") {
				if (t.is(":checked"))
					query += "&"+t.attr("name")+"="+t.attr("value");
			} else if (t.attr("type") == "radio") {
				if (t.is(":checked"))
					query += "&"+t.attr("name")+"="+t.attr("value");
			} else if (t.attr("type") == "file") {
				query += "&"+t.attr("name")+"="+document.getElementsByName(t.attr("name")).files;
			}
		}
	});
	$(obj).find("textarea").each(function(i) {
		var t = $(obj).find("textarea").eq(i);
		query += "&"+t.attr("name")+"="+encodeURIComponent(t.val());
	});
	$(obj).find("select").each(function(i) {
		var t = $(obj).find("select").eq(i);
		query += "&"+t.attr("name")+"="+encodeURIComponent(t.val());
	});

	return query.substring(1);
}

function $query_unt(obj) {
	var query = "";
	$(obj).find("input").each(function(i){
		var t = $(obj).find("input").eq(i);
		if((t.attr("type") != "button") && (t.attr("type") != "submit") && (t.attr("type") != "reset") && (t.attr("type") != "hidden")) {
			if ((t.attr("type") != "checkbox") && (t.attr("type") != "radio") ) {
				t.val('');
			} else {
				t.attr("checked", false);
			}
		} else {}
	});
	$(obj).find("textarea").each(function() {
		$(this).val('');
	});

	$(obj).find('textarea.summernote').each(function() {
		$(this).summernote("code", "");
	});
	return true;
}

//----------------------------------------------------------------------------------------------------------------------
function showLoader() {
	$("#loadingPopup").html("<div class=\"loading-body\"><div style=\"position: fixed; top: 50%; right: 50%; text-align: center; background: transparent; z-index: 999999999;\"><div class=\"windows8\"> <div class=\"wBall\" id=\"wBall_1\"> <div class=\"wInnerBall\"> </div> </div> <div class=\"wBall\" id=\"wBall_2\"> <div class=\"wInnerBall\"> </div> </div> <div class=\"wBall\" id=\"wBall_3\"> <div class=\"wInnerBall\"> </div> </div> <div class=\"wBall\" id=\"wBall_4\"> <div class=\"wInnerBall\"> </div> </div> <div class=\"wBall\" id=\"wBall_5\"> <div class=\"wInnerBall\"> </div> </div> </div></div></div>").hide().fadeIn(10);
	block = true;
}

//----------------------------------------------------------------------------------------------------------------------
function closeLoader() {
	$("#loadingPopup").html("").hide().fadeOut(100);
	block = false;
}

//----------------------------------------------------------------------------------------------------------------------
function showResult(type,data) {
	closeLoader();
	$("#"+type+"").html(data).hide().fadeIn(100);
	block = false;
}

//----------------------------------------------------------------------------------------------------------------------
function getSlug(table) {
	var name  = $('#name').val();
	showLoader();
	$.ajax({
		url:'/quangtri-admin/action.php',
		type: 'POST',
		data: 'url=get_slug&id='+table+'&name='+name,
		dataType: "html",
		success: function(data){
			$('#slug').val(data);
			closeLoader();
		}
	});
	return false;
}

//----------------------------------------------------------------------------------------------------------------------
function getSlugOther() {
	var name  = $('#name').val();
	showLoader();
	$.ajax({
		url:'/quangtri-admin/action.php',
		type: 'POST',
		data: 'url=get_slug_other&name='+name,
		dataType: "html",
		success: function(data){
			$('#slug').val(data);
			closeLoader();
		}
	});
	return false;
}


//----------------------------------------------------------------------------------------------------------------------
function sendLostForgot(id) {
	var dataList = $query('#'+id);
	showLoader();
	$.ajax({
		url:'reset_password.php',
		type: 'POST',
		data: dataList,
		dataType: "html",
		success: function(data){
			closeLoader();
			alert(data, function() {
				alert(this.data);
				window.location.reload();
			});
		}
	});
	return false;
}

//----------------------------------------------------------------------------------------------------------------------
function performSort(id, sort, table) {
	showLoader();
	$.ajax({
		url:'/quangtri-admin/action.php',
		type: 'POST',
		data: 'url=performsort&q='+id+'&sort='+sort+'&type='+table,
		dataType: "html",
		success: function(data){
			window.location.reload();
		}
	});
	return false;
}
//----------------------------------------------------------------------------------------------------------------------
function performSortUser(id, sort, table) {
	showLoader();
	$.ajax({
		url:'/quangtri-admin/action.php',
		type: 'POST',
		data: 'url=performsort_user&q='+id+'&sort='+sort+'&type='+table,
		dataType: "html",
		success: function(data){
			window.location.reload();
		}
	});
	return false;
}

//----------------------------------------------------------------------------------------------------------------------
function edit_status(el, id, type, table) {
	var status = el.attr("rel");
	$.ajax({
		url:'/quangtri-admin/action.php',
		type: 'POST',
		data: 'url=edit_status&id='+id+'&type='+type+'&table='+table+'&status='+status,
		dataType: "html",
		success: function(data){
			if(status==1) {
				el.removeClass("btn-event-close").addClass("btn-event-open");
				el.attr("rel","0");
				el.html(1);
				el.attr("data-original-title","Đóng");
			} else {
				el.removeClass("btn-event-open").addClass("btn-event-close");
				el.attr("rel","1");
				el.html(0);
				el.attr("data-original-title","Mở");
			}
		}
	});
	return false;
}

//----------------------------------------------------------------------------------------------------------------------
function edit_status_land(el, id, type, table) {
	var status = el.attr("rel");
	$.ajax({
		url:'/quangtri-admin/action.php',
		type: 'POST',
		data: 'url=edit_status_land&id='+id+'&type='+type+'&table='+table+'&status='+status,
		dataType: "html",
		success: function(data){
			if(status==1) {
				el.attr("rel","0");
				el.html(data).hide().fadeIn('show');
			} else {
				el.attr("rel","1");
				el.html(data).hide().fadeIn('show');
			}
		}
	});
	return false;
}

//----------------------------------------------------------------------------------------------------------------------
function edit_status_core(el, id, type, table, qr) {
	var status = el.attr("rel");
	$.ajax({
		url:'/quangtri-admin/action.php',
		type: 'POST',
		data: 'url=edit_status_core&id='+id+'&type='+type+'&table='+table+'&qr='+qr+'&status='+status,
		dataType: "html",
		success: function(data){
			if(status==1) {
				el.removeClass("btn-event-close").addClass("btn-event-open");
				el.attr("rel","0");
				el.attr("data-original-title","Đóng");
			} else {
				el.removeClass("btn-event-open").addClass("btn-event-close");
				el.attr("rel","1");
				el.attr("data-original-title","Mở");
			}
		}
	});
	return false;
}

//----------------------------------------------------------------------------------------------------------------------
function coreDashboard(id,type) {
		var dataList = $query('#'+id);
		showLoader();
		$.ajax({
			url:'/quangtri-admin/action.php',
			type: 'POST',
			data: 'url=core_dashboard&'+dataList+'&type='+type,
			dataType: "html",
			success: function(data){
				showResult(id, data);
			}
		});
		return false;
}
//----------------------------------------------------------------------------------------------------------------------
function changeInformation(id) {
	var dataList = new FormData($('#'+id)[0]);
	showLoader();
	$.ajax({
		url:'/quangtri-admin/action.php',
		type: 'POST',
		data: dataList,
		dataType: "html",
		success: function(data){
			showResult(id, data);
		},
		cache: false,
		contentType: false,
		processData: false
	});
	return false;
}

//----------------------------------------------------------------------------------------------------------------------
function backupDatabase(id) {
	showLoader();
	$.ajax({
		url:'/quangtri-admin/action.php',
		type: 'POST',
		data: 'url=backup_data',
		dataType: "html",
		success: function(data){
			showResult(id,data);
		},
		error: function(data){ 
				showResult(id,data);
			//alert("Network error, data OK"+data); 
		} 
	});
	return false;
}

//----------------------------------------------------------------------------------------------------------------------
function getDistrict(value, id, id2, type) {
	showLoader();
	$.ajax({
		url:'/quangtri-admin/action.php',
		type: 'POST',
		data: 'url=get_location&parent='+value+'&type='+type,
		dataType: "html",
		success: function(data){
			showResult(id, data);
		}
	});
	showLoader();
	$.ajax({
		url:'/quangtri-admin/action.php',
		type: 'POST',
		data: 'url=get_location&parent='+value+'&type=3',
		dataType: "html",
		success: function(data){
			showResult(id2, data);
		}
	});
	return false;
}
function getLocation(value, id, type) {
	showLoader();
	$.ajax({
		url:'/quangtri-admin/action.php',
		type: 'POST',
		data: 'url=get_location&parent='+value+'&type='+type,
		dataType: "html",
		success: function(data){
			showResult(id, data);
		}
	});
	return false;
}

//----------------------------------------------------------------------------------------------------------------------
function status_view(el, id, type, table) {
	var status = el.attr("rel");
	$.ajax({
		url:'/quangtri-admin/action.php',
		type: 'POST',
		data: 'url=edit_status&id='+id+'&type='+type+'&table='+table+'&status='+status,
		dataType: "html",
		success: function(data){
			if(status==1) {
				el.removeClass("btn-success").addClass("btn-warning");
				el.attr("rel","0");
				el.html("Chưa xem");
				el.attr("data-original-title","Chuyển sang: Đã xem");
			} else {
				el.removeClass("btn-warning").addClass("btn-success");
				el.attr("rel","1");
				el.html("Đã xem");
				el.attr("data-original-title","Chuyển sang: Chưa xem");
			}
		}
	});
	return false;
}

function open_modal_order(id) {
	showLoader();
	$.ajax({
		url:'/quangtri-admin/action.php',
		type: 'POST',
		data: 'url=open_order&id='+id,
		dataType: "html",
		success: function(data){
			showResult('_order', data);
		}
	});
	$.ajax({
		url:'/quangtri-admin/action.php',
		type: 'POST',
		data: 'url=edit_status&id='+id+'&type=is_active&table=order&status=0',
		dataType: "html",
		success: function(data){
			$('#_v_'+id).removeClass("btn-warning").addClass("btn-success");
			$('#_v_'+id).attr("rel","1");
			$('#_v_'+id).html("Đã xem");
			$('#_v_'+id).attr("data-original-title","Chuyển sang: Chưa xem");
		}
	});
	return false;
}

function open_modal_examination(id, user) {
    showLoader();
    $.ajax({
        url:'/quangtri-admin/action.php',
        type: 'POST',
        data: 'url=open_examination&id='+id+'&user='+user,
        dataType: 'html',
        success: function(data){
			console.log(user);
            showResult('_examination', data);
        }
    });
    return false;
}

function open_modal_contact(id) {
	showLoader();
	$.ajax({
		url:'/quangtri-admin/action.php',
		type: 'POST',
		data: 'url=open_contact&id='+id,
		dataType: "html",
		success: function(data){
			showResult('_contact', data);
		}
	});
	$.ajax({
		url:'/quangtri-admin/action.php',
		type: 'POST',
		data: 'url=edit_status&id='+id+'&type=is_active&table=contact&status=0',
		dataType: "html",
		success: function(data){
			$('#_v_'+id).removeClass("btn-warning").addClass("btn-success");
			$('#_v_'+id).attr("rel","1");
			$('#_v_'+id).html("Đã xem");
			$('#_v_'+id).attr("data-original-title","Chuyển sang: Chưa xem");
		}
	});
	return false;
}

function open_modal_discussion(id) {
	showLoader();
	$.ajax({
		url: '/quangtri-admin/action.php',
		type: 'POST',
		data: 'url=open_discussion&id=' + id,
		dataType: "html",
		success: function (data) {
			showResult('_discussion', data);
			return true;
		}
	});
	return false;
}

function open_notification(el, id, type) {
	showLoader();
	$.ajax({
		url:'/quangtri-admin/action.php',
		type: 'POST',
		data: 'url=open_'+type+'&id='+id,
		dataType: "html",
		success: function(data){
			showResult('_notification', data);
		}
	});
	$.ajax({
		url:'/quangtri-admin/action.php',
		type: 'POST',
		data: 'url=edit_status&id='+id+'&type=is_active&table='+type+'&status=0',
		dataType: "html",
		success: function(data){
			el.removeClass("btn-warning").addClass("btn-success");
		}
	});
	return false;
}

//----------------------------------------------------------------------------------------------------------------------
function roundVal(val){
	var result = Math.round(val);
	return result;
}

//----------------------------------------------------------------------------------------------------------------------
function checkAddUser(){
	var inputs = document.forms['member'].getElementsByTagName('input');
	var run_onchange = false;
	var emailfilter=/^\w+[\+\.\w-]*@([\w-]+\.)*\w+[\w-]*\.([a-z]{2,4}|\d+)$/i;
	var userfilter= /^[A-z0-9_-]+$/i;
	var pass ='';
	function valid(){
		var errors = false;
		for(var i=0; i<inputs.length; i++){
			var value = inputs[i].value;
			var id = inputs[i].getAttribute('id');

			// Tạo phần tử span lưu thông tin lỗi
			var span = document.createElement('span');
			// Nếu span đã tồn tại thì remove
			var p = inputs[i].parentNode;
			if(p.lastChild.nodeName == 'SPAN') {p.removeChild(p.lastChild);}

			if(id == 'user_name' && value == ''){span.innerHTML ='Tên đăng nhập của thành viên?';}
			if(id == 'email' && value == ''){span.innerHTML ='Email để liên lạc với thành viên?';}
			if(id == 'phone' && value == ''){span.innerHTML ='Số điện thoại liên lạc?';}
			if(id == 'password' && value == ''){span.innerHTML ='Mật khẩu của thành viên?';}
			if(id == 'full_name' && value == ''){span.innerHTML ='Họ và tên của thành viên?';}
			if(id == 'email' && value != '') {
				var returnval=emailfilter.test(value);
				if(returnval==false){span.innerHTML ='Địa chỉ email không hợp lệ!';}
			}
			if(id == 'user_name' && value != ''){
				if(value.length < 6 || value.length > 16 ){
					span.innerHTML ='Tên đăng nhập phải có từ 6 đến 16 ký tự!';
				} else {
					var returnval=userfilter.test(value);
					if(returnval==false){span.innerHTML ='Tên đăng nhập không hợp lệ! (không được chứa các kí tự đặc biệt)';}
				}
			}
			if(id == 'password' && value != ''){
				if(value.length < 6 || value.length > 16 ){
					span.innerHTML ='Mật khẩu phải có từ 6 đến 16 ký tự!';
				}
				else pass = value;
			}
			if(id == 'rePassword' && pass!=value){span.innerHTML ='Mật khẩu nhập lại không khớp!';}
			if(id == 'phone' && value != ''){
				if(isNaN(value) == true || value.indexOf('.')!=-1 || value < 0){span.innerHTML ='Số điện thoại không hợp lệ!';}
				if(isNaN(value) == false && value.length < 10){span.innerHTML ='Số điện thoại không hợp lệ!';}
			}

			if(span.innerHTML != ''){
				inputs[i].parentNode.appendChild(span);
				span.setAttribute('class', 'error');
				errors = true;
				run_onchange = true;
				inputs[i].style.border = '1px solid rgba(249, 180, 173, 0.7)';
				inputs[i].style.background = 'rgba(252, 204, 200, 0.5)';
			}
		}
		return !errors;
	}// end valid()

	// Chạy hàm kiểm tra valid()
	var register = document.getElementById('user');
	register.onclick = function(){
		return valid();
	}

	// Kiểm tra lỗi với sự kiện onchange -> gọi lại hàm valid()
	for(var i=0; i<inputs.length; i++){
		var id = inputs[i].getAttribute('id');
		inputs[i].onchange = function(){
			if(run_onchange == true){
				this.style.border = '1px solid #cccccc';
				this.style.background = '#ffffff';
				valid();
			}
		}
	}// end for
}

//----------------------------------------------------------------------------------------------------------------------
function checkEditUser(){
	var inputs = document.forms['member'].getElementsByTagName('input');
	var run_onchange = false;
	var emailfilter=/^\w+[\+\.\w-]*@([\w-]+\.)*\w+[\w-]*\.([a-z]{2,4}|\d+)$/i;
	var pass ='';
	function valid(){
		var errors = false;
		for(var i=0; i<inputs.length; i++){
			var value = inputs[i].value;
			var id = inputs[i].getAttribute('id');

			// Tạo phần tử span lưu thông tin lỗi
			var span = document.createElement('span');
			// Nếu span đã tồn tại thì remove
			var p = inputs[i].parentNode;
			if(p.lastChild.nodeName == 'SPAN') {p.removeChild(p.lastChild);}

			if(id == 'email' && value == ''){span.innerHTML ='Email để liên lạc với thành viên?';}
			if(id == 'phone' && value == ''){span.innerHTML ='Số điện thoại liên lạc?';}
			if(id == 'full_name' && value == ''){span.innerHTML ='Họ và tên của thành viên?';}
			if(id == 'email' && value != '') {
				var returnval=emailfilter.test(value);
				if(returnval==false){span.innerHTML ='Địa chỉ email bạn nhập không hợp lệ!';}
			}
			if(id == 'password' && value != ''){
				if(value.length < 6 || value.length > 16 ){
					span.innerHTML ='Mật khẩu phải có từ 6 đến 16 ký tự!';
				}
				else pass = value;
			}
			if(id == 'rePassword' && pass!=value){span.innerHTML ='Mật khẩu nhập lại không khớp!';}
			if(id == 'phone' && value != ''){
				if(isNaN(value) == true || value.indexOf('.')!=-1 || value < 0){span.innerHTML ='Số điện thoại không hợp lệ!';}
				if(isNaN(value) == false && value.length < 10){span.innerHTML ='Số điện thoại không hợp lệ!';}
			}

			if(span.innerHTML != ''){
				inputs[i].parentNode.appendChild(span);
				span.setAttribute('class', 'error');
				errors = true;
				run_onchange = true;
				inputs[i].style.border = '1px solid rgba(249, 180, 173, 0.7)';
				inputs[i].style.background = 'rgba(252, 204, 200, 0.5)';
			}
		}
		return !errors;
	}// end valid()

	// Chạy hàm kiểm tra valid()
	var register = document.getElementById('user');
	register.onclick = function(){
		return valid();
	}

	// Kiểm tra lỗi với sự kiện onchange -> gọi lại hàm valid()
	for(var i=0; i<inputs.length; i++){
		var id = inputs[i].getAttribute('id');
		inputs[i].onchange = function(){
			if(run_onchange == true){
				this.style.border = '1px solid #cccccc';
				this.style.background = '#ffffff';
				valid();
			}
		}
	}// end for
}

//----------------------------------------------------------------------------------------------------------------------
function userChangePassword(){
	var inputs = document.forms['changePass'].getElementsByTagName('input');
	var run_onchange = false;
	var pass ='';
	var passOld = '';
	function valid(){
		var errors = false;
		for(var i=0; i<inputs.length; i++){
			var value = inputs[i].value;
			var id = inputs[i].getAttribute('id');

			// Tạo phần tử span lưu thông tin lỗi
			var span = document.createElement('span');
			// Nếu span đã tồn tại thì remove
			var p = inputs[i].parentNode;
			if(p.lastChild.nodeName == 'SPAN') {p.removeChild(p.lastChild);}


			if(id == 'password2old' && value == ''){span.innerHTML ='Mật khẩu hiện tại của bạn?';}
			if(id == 'password2old' && value != ''){passOld = value;}
			if(id == 'password' && value == ''){span.innerHTML ='Mật khẩu mới mà muốn bạn đổi?';}
			if(id == 'password' && value != ''){
				if(value.length < 6 || value.length > 16 ){
					span.innerHTML ='Mật khẩu phải có từ 6 đến 16 ký tự!';
				}
				else {
					pass = value;
					if(pass == passOld){span.innerHTML ='Mật khẩu mới không được trùng với mật khẩu hiện tại!';}
				}
			}
			if(id == 'rePassword' && pass!=value){span.innerHTML ='Mật khẩu nhập lại không khớp!';}

			if(span.innerHTML != ''){
				inputs[i].parentNode.appendChild(span);
				span.setAttribute('class', 'error');
				errors = true;
				run_onchange = true;
				inputs[i].style.border = '1px solid rgba(249, 180, 173, 0.7)';
				inputs[i].style.background = 'rgba(252, 204, 200, 0.5)';
			}
		}
		return !errors;
	}// end valid()

	// Chạy hàm kiểm tra valid()
	var register = document.getElementById('btnChangePass');
	register.onclick = function(){
		return valid();
	}

	// Kiểm tra lỗi với sự kiện onchange -> gọi lại hàm valid()
	for(var i=0; i<inputs.length; i++){
		var id = inputs[i].getAttribute('id');
		inputs[i].onchange = function(){
			if(run_onchange == true){
				this.style.border = '1px solid #cccccc';
				this.style.background = '#ffffff';
				valid();
			}
		}
	}// end for
}

//----------------------------------------------------------------------------------------------------------------------
function userChangeInfo(){
	var inputs = document.forms['changeInfo'].getElementsByTagName('input');
	var run_onchange = false;
	var emailfilter=/^\w+[\+\.\w-]*@([\w-]+\.)*\w+[\w-]*\.([a-z]{2,4}|\d+)$/i;
	var pass ='';
	function valid(){
		var errors = false;
		for(var i=0; i<inputs.length; i++){
			var value = inputs[i].value;
			var id = inputs[i].getAttribute('id');

			// Tạo phần tử span lưu thông tin lỗi
			var span = document.createElement('span');
			// Nếu span đã tồn tại thì remove
			var p = inputs[i].parentNode;
			if(p.lastChild.nodeName == 'SPAN') {p.removeChild(p.lastChild);}

			if(id == 'email' && value == ''){span.innerHTML ='Email để liên lạc với bạn?';}
			if(id == 'full_name' && value == ''){span.innerHTML ='Họ và tên của bạn?';}
			if(id == 'email' && value != '') {
				var returnval=emailfilter.test(value);
				if(returnval==false){span.innerHTML ='Địa chỉ email bạn nhập không hợp lệ!';}
			}
			if(id == 'phone' && value != ''){
				if(isNaN(value) == true || value.indexOf('.')!=-1 || value < 0){span.innerHTML ='Số điện thoại không hợp lệ!';}
				if(isNaN(value) == false && value.length < 10){span.innerHTML ='Số điện thoại không hợp lệ!';}
			}

			if(id == 'passwordold' && value == ''){span.innerHTML ='Mật khẩu hiện tại của bạn?';}

			if(span.innerHTML != ''){
				inputs[i].parentNode.appendChild(span);
				span.setAttribute('class', 'error');
				errors = true;
				run_onchange = true;
				inputs[i].style.border = '1px solid rgba(249, 180, 173, 0.7)';
				inputs[i].style.background = 'rgba(252, 204, 200, 0.5)';
			}
		}
		return !errors;
	}// end valid()

	// Chạy hàm kiểm tra valid()
	var register = document.getElementById('btnChangeInfo');
	register.onclick = function(){
		return valid();
	}

	// Kiểm tra lỗi với sự kiện onchange -> gọi lại hàm valid()
	for(var i=0; i<inputs.length; i++){
		var id = inputs[i].getAttribute('id');
		inputs[i].onchange = function(){
			if(run_onchange == true){
				this.style.border = '1px solid #cccccc';
				this.style.background = '#ffffff';
				valid();
			}
		}
	}// end for
}
function multiple_choice_answer() {
	$("table#multiple-choice .item input[type='checkbox'][value='1']").change(function(e) {
		if(this.checked) {
			$(this).parent().find("input[type='checkbox'][value='0']").prop('checked', false);
		} else {
			$(this).parent().find("input[type='checkbox'][value='0']").prop('checked', true);
		}
	});
}
$(function(){
	multiple_choice_answer();
	$("table#multiple-choice").on("click focus", ".item.inactive", function(e) {
		var curRow = $("table#multiple-choice .item.inactive");
		curRow.clone().appendTo("table#multiple-choice tbody");
		curRow.removeClass("inactive").find("input:first").focus();
		multiple_choice_answer();
	}).on("click", ".btn.delete", function(e) {
		$(this).closest("tr").remove();
	});
});

function remove_discussion(ipt, id) {
	var dataList = $query('#'+ipt);
	showLoader();
	$.ajax({
		url: '/quangtri-admin/action.php',
		type: 'POST',
		data: 'url=discussion_delete&id=' + id + '&'+dataList,
		dataType: "html",
		success: function (data) {
			showResult('_discussion', data);
			return true;
		}
	});
	return false;
}

function remove_discussion_all(id) {
	showLoader();
	$.ajax({
		url: '/quangtri-admin/action.php',
		type: 'POST',
		data: 'url=discussion_delete_all&id=' + id,
		dataType: "html",
		success: function() {
			closeLoader();
			$('#_discussion').modal('hide');
			return true;
		}
	});
	return false;
}