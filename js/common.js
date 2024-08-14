function $$$(id) {
	return document.getElementById(id);
}
function	Forward(url) {
	window.location.href = url;
}
function	_postback() {
	return void(1);
}

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
			query += "&"+t.attr("name")+"="+encodeURIComponent(t.val());
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

function showLoader() {
	$("#_loading").html("<div style=\"position: fixed; top: 50%; right: 50%; text-align: center; background: transparent; z-index: 999999999;\"><div class=\"windows8\"> <div class=\"wBall\" id=\"wBall_1\"> <div class=\"wInnerBall\"> </div> </div> <div class=\"wBall\" id=\"wBall_2\"> <div class=\"wInnerBall\"> </div> </div> <div class=\"wBall\" id=\"wBall_3\"> <div class=\"wInnerBall\"> </div> </div> <div class=\"wBall\" id=\"wBall_4\"> <div class=\"wInnerBall\"> </div> </div> <div class=\"wBall\" id=\"wBall_5\"> <div class=\"wInnerBall\"> </div> </div> </div></div>").hide().fadeIn(10);
}

function closeLoader() {
	$("#_loading").html("").hide().fadeOut(100);
}

function showResult(type,data) {
	closeLoader();
	$("#"+type+"").html(data).hide().fadeIn(100);
}
$(function(){
	$('.square-green input').iCheck({
		checkboxClass: 'icheckbox_square-green',
		radioClass: 'iradio_square-green',
		increaseArea: '20%'
	});
});
(function($) {
	$.fn.menumaker = function(options) {
		var navigation = $(this), settings = $.extend({
			title: "",
			format: "dropdown",
			sticky: false
		}, options);

		return this.each(function() {
			navigation.find('li ul').parent().addClass('has-sub');
			multiTg = function() {
				navigation.find(".has-sub").prepend('<span class="submenu-button"></span>');
				navigation.find(".has-sub ul li.active").parents('.has-sub').addClass('active');
				navigation.find('.submenu-button').on('click', function() {
					$(this).toggleClass('submenu-opened');
					$(this).parent().toggleClass('sub-open');
					if ($(this).siblings('ul').hasClass('open')) {
						$(this).siblings('ul').removeClass('open').hide();
					}
					else {
						$(this).siblings('ul').addClass('open').show();
					}
				});
				navigation.find('li.active').each(function() {
					$(this).addClass('sub-open');
					$(this).children('.submenu-button').addClass('submenu-opened');
					$(this).children('ul').addClass('open').show();
				});
			};
			multiTg();
		});
	};
	$(document).ready(function(){
		$(".sidebar-category").menumaker({
			title: "",
			format: "multitoggle"
		});
		$(".other-category").menumaker({
			title: "",
			format: "multitoggle"
		});

		$('.rating-container .c-ratings').bind('click', function() {
			var widget = $(this).parent();
			var vote = $(this).attr("rel");
			var id = $(widget).attr("rel");
			$.ajax({
				url:'/action.php',
				type: 'POST',
				data: 'url=rating&id='+id+'&vote='+vote,
				dataType: 'html',
				success: function(data){
					$(widget).html(data);
				}
			});
			return false;
		});

		$('.summernote').each(function() {
			$(this).summernote({
				height: $(this).height(),
				placeholder: $(this).attr("placeholder")
			});
		});

		$('._fc_like').click(function() {
			showLoader();
			var el = $(this);
			var id = parseInt(el.attr("rel"));
			$.ajax({
				url:'/action.php',
				type: 'POST',
				data: 'url=forum_like&id='+id,
				dataType: 'json',
				success: function(data){
					closeLoader();
					var rs = parseInt(data.rs);
					if(rs==1) el.html(data.msg);
					else  $('#login-modal').modal('show');
					return true;
				}
			});
			return false;
		});

		$('#flux.noti-mask').scroll(function() {
			var s_a = $(this).scrollTop();
			var s_b = $(this)[0].scrollHeight;
			var s_c = $(this).height();
			var s_s = s_b - s_a - s_c;
			if(s_s==0) {
				var ele = $(this).find('li').last();
				var id = parseInt(ele.attr("rel"));
				$.ajax({
					url:'/action.php',
					type: 'POST',
					data: 'url=notify&id='+id,
					dataType: 'html',
					success: function(data){
						ele.parent('ul.notifications-container').append(data);
					}
				});
			}
		});
	});
})(jQuery);

function sign_in(id) {
	var dataList = $query('#'+id);
	showLoader();
	$.ajax({
		url:"/action.php",
		cache: false,
		async: true,
		type: "post",
		data: 'url=user&type=signin&'+dataList,
		dataType: 'html',
		crossDomain: true,
		success: function(data){
			closeLoader();
			if(data==true) window.location.reload();
			else showResult('_result_login', data);
		},
		error: function(data){
				window.location.reload();
			//alert("Network error, data OK"+data); 
		} 
	});
	return false;
}

function check_register() {
	var inputs = document.forms['fr_register'].getElementsByTagName('input');

	var run_onchange = false;
	var email_filter = /^\w+[\+\.\w-]*@([\w-]+\.)*\w+[\w-]*\.([a-z]{2,4}|\d+)$/i;
	var user_filter = /^[A-z0-9_-]+$/i;
	var password = '';
	function valid(){
		var errors = false;
		for(var i=0; i<inputs.length; i++){
			var value = inputs[i].value;
			var name = inputs[i].getAttribute('name');

			var span = document.createElement('span');
			var p = inputs[i].parentNode;
			if(p.lastChild.nodeName == 'SPAN') {p.removeChild(p.lastChild);}
			var input_unt = ['reg'];
			var cke = input_unt.indexOf(name);
			if( value == '' && cke < 0){
				span.innerHTML = 'Trường bắt buộc phải nhập.';
			}
			if(name == 'user' && value != ''){
				if(value.length < 6 || value.length > 16 ){
					span.innerHTML ='Tên đăng nhập phải có từ 6 đến 16 ký tự.';
				} else {
					var return_val = user_filter.test(value);
					if(return_val == false){ span.innerHTML ='Tên đăng nhập không hợp lệ, (không được chứa các kí tự đặc biệt).'; }
				}
			}
			if(name == 'password' && value != ''){
				if(value.length < 6 || value.length > 16){
					span.innerHTML = 'Mật khẩu phải có từ 6 đến 16 ký tự.';
				} else {
					password = value;
				}
			}
			if(name == 're_password' && password != value){span.innerHTML = 'Mật khẩu nhập lại không khớp.';}
			if(name == 'tel' && value != ''){
				if(isNaN(value) == true || value.indexOf('.')!=-1 || value < 0){span.innerHTML = 'Số điện thoại hợp lệ.';}
				if(isNaN(value) == false && value.length < 8){span.innerHTML = 'Số điện thoại hợp lệ.';}
			}
			if(name == 'email' && value != '') {
				var return_val = email_filter.test(value);
				if(return_val == false){ span.innerHTML = 'Địa chỉ email không hợp lệ.'; }
			}

			if(span.innerHTML != ''){
				inputs[i].parentNode.appendChild(span);
				span.setAttribute('class', 'show-error');
				errors = true;
				run_onchange = true;
			}
		}
		return !errors;
	}

	var register = document.getElementById('_btn_register');
	register.onclick = function(){
		return valid();
	};

	for(var i=0; i<inputs.length; i++){
		inputs[i].onchange = function(){
			if(run_onchange == true){
				valid();
			}
		}
	}
}

function register_user(id) {
	var dataList = $query('#'+id);
	showLoader();
	$.ajax({
		url:'/action.php',
		type: 'POST',
		data: 'url=user&type=register&'+dataList,
		dataType: 'html',
		success: function(data){
			$query_unt('#' + id);
			closeLoader();
			showResult('_result_register', data);
			$('#register-modal').scrollTop($('#register-modal')[0].scrollHeight);
		}
	});
	return false;
}

function logout() {
	$.ajax({
		url:'/action.php',
		type: 'POST',
		data: 'url=user&type=logout',
		dataType: 'html',
		success: function(data){
			if(data==true) window.location.href = '/';
			else return false;
		}
	});
	return false;
}
function change_password() {
	$.ajax({
		url:'/action.php',
		type: 'POST',
		data: 'url=user&type=change_password',
		dataType: 'html',
		success: function(data){
			if(data==true) window.location.reload();
			else {
				alert(data);
				return false;
			}
		}
	});
	return false;
}

function add_course(id) {
	$.ajax({
		url:'/action.php',
		type: 'POST',
		data: 'url=add_course&id='+id,
		dataType: 'html',
		success: function(data){
			if(parseInt(data)>0) window.location.reload();
			else return false;
		}
	});
	return false;
}

function update_forum(ipt, type, id, post) {
	showLoader();
	if(type=='delete') {
		confirm("Dữ liệu sau khi xóa sẽ không thể phục hồi lại được.\nBạn có chắc chắn thực hiện điều này không?", function() {
			if(this.data == true) {
				$.ajax({
					url: '/action.php',
					type: 'POST',
					data: 'url=forum&type=' + type + '&id=' + id + '&post=' + post,
					dataType: 'json',
					success: function (data) {
						$query_unt('#' + ipt);
						closeLoader();
						var rs = parseInt(data.rs);
						if (rs == 1) window.location.href = data.msg;
						else alert(data.msg);
						return true;
					}
				});
			} else {
				closeLoader();
				return false;
			}
		});
	} else {
		var dataList = $query('#' + ipt);
		$.ajax({
			url: '/action.php',
			type: 'POST',
			data: 'url=forum&' + dataList + '&type=' + type + '&id=' + id + '&post=' + post,
			dataType: 'json',
			success: function (data) {
				$query_unt('#' + ipt);
				closeLoader();
				var rs = parseInt(data.rs);
				if (rs == 1) window.location.href = data.msg;
				else alert(data.msg);
				return true;
			}
		});
	}
	return false;
}

function comment_forum(type, id, ipt) {
	showLoader();
	var dataList = $query('#'+ipt);
	$.ajax({
		url:'/action.php',
		type: 'POST',
		data: 'url=forum_comment&type='+type+'&id='+id+'&'+dataList,
		dataType: 'json',
		success: function(data){
			$query_unt('#'+ipt);
			closeLoader();
			var rs = parseInt(data.rs);
			if(rs==1) $('#_list_f_comment').prepend(data.msg);
			else alert(data.msg);
			return true;
		}
	});
	return false;
}

function update_comment_forum(el, type, id) {
	showLoader();
	var element = el.parents('.f-line-left');
	if(type=='delete') {
		confirm("Dữ liệu sau khi xóa sẽ không thể phục hồi lại được.\nBạn có chắc chắn thực hiện điều này không?", function() {
			if(this.data == true) {
				$.ajax({
					url: '/action.php',
					type: 'POST',
					data: 'url=forum_comment&type=' + type + '&id=' + id,
					dataType: 'json',
					success: function (data) {
						closeLoader();
						var rs = parseInt(data.rs);
						if (rs == 1) element.parents(".forum-view").remove();
						else alert(data.msg);
						return true;
					}
				});
			} else {
				closeLoader();
				return false;
			}
		});
	} else {
		$.ajax({
			url: '/action.php',
			type: 'POST',
			data: 'url=forum_comment&type=' + type + '&id=' + id,
			dataType: 'json',
			success: function (data) {
				closeLoader();
				var rs = parseInt(data.rs);
				if (rs == 1) {
					element.find(".detail-wp").html(data.msg);
					element.find('.summernote').each(function () {
						$(this).summernote({
							placeholder: $(this).attr("placeholder")
						});
					});
				} else alert(data.msg);
				return true;
			}
		});
	}
	return false;
}


function edit_comment_forum(type, id, ipt) {
	showLoader();
	var dataList = $query('#'+ipt);
	$.ajax({
		url:'/action.php',
		type: 'POST',
		data: 'url=forum_comment&type='+type+'&id='+id+'&'+dataList,
		dataType: 'json',
		success: function(data){
			closeLoader();
			var rs = parseInt(data.rs);
			if(rs==1) {
				$('#'+ipt).parents('.detail-wp').html(data.msg);
			}
			else alert(data.msg);
			return true;
		}
	});
	return false;
}

function load_comment_forum(e, id) {
	showLoader();
	var post = parseInt(e.attr("rel"));
	$.ajax({
		url:'/action.php',
		type: 'POST',
		data: 'url=forum_comment&type=load&id='+id+'&post='+post,
		dataType: 'json',
		success: function(data){
			closeLoader();
			var rs = parseInt(data.rs);
			if(rs==1) {
				e.attr('rel', parseInt(data.load));
				e.html(data.button);
				$('#_list_f_comment').append(data.msg);
			}
			else e.hide();
			return true;
		}
	});
	return false;
}


function _showAllCourses(target) {
	var height_px = $('body').hasClass('es-template') ? "590px" : "303px";
	var wraper = $(target.closest('.block_courses')).find('.list-course-card');
	var checkOpen = wraper.attr('data-open');
	if ((typeof checkOpen == 'undefined') || (checkOpen == 'close')) {
		$(target).html("Thu gọn <i class='fa fa-fw fa-minus-circle'></i>");
		wraper.css({"height":"auto","overflow":"visible"});
		wraper.attr('data-open', 'open');
	} else {
		$(target).html("Xem tất cả <i class='fa fa-fw fa-plus-circle'></i>");
		wraper.css({"height": height_px,"overflow":"hidden"});
		wraper.attr('data-open', 'close');
	}
	return false;
}

function test_answer(inp) {
	showLoader();
	var dataList = $query('#'+inp);
	$.ajax({
		url:'/action.php',
		type: 'POST',
		data: 'url=answer&'+dataList,
		dataType: 'html',
		success: function(data){
			showResult('test-results', data);
			return true;
		}
	});
	return false;
}

function examination_answer(inp) {
    showLoader();
    confirm("ĐÃ LÀM XONG, NỘP BÀI KIỂM TRA.\nBạn có chắc chắn thực hiện điều này không?", function() {
        if (this.data == true) {
            var dataList = $query('#'+inp);
            $.ajax({
                url:'/action.php',
                type: 'POST',
                data: 'url=examination_answer&'+dataList,
                dataType: 'html',
                success: function(data){
                    showResult('examination-results', data);
                    var btn = $('#' + inp + ' button[type="submit"]');
                    btn.attr("type", "button");
                    btn.attr("aria-hidden", "true");
                    btn.attr("data-dismiss", "modal");
                    btn.attr("class", "btn btn-info btn-round");
                    btn.html('Thoát <i class="fa fa-remove fa-fw"></i>');
                    $('#exa-timer').remove();
                    return true;
                }
            });
        } else {
            closeLoader();
            return false;
        }
    });
    return false;
}

function extend(el) {
	$('#lecture-tab-download').toggleClass('open');
	var status = el.attr("rel");
	if(status==1) {
		el.attr("rel","0");
		el.html('<i class="fa fa-angle-double-right"></i> Thu hẹp');
	} else {
		el.attr("rel","1");
		el.html('<i class="fa fa-angle-double-left"></i> Mở rộng');
	}
}

function post_discussion(inp, rs, par) {
	var dataList = $query('#'+inp);
	$.ajax({
		url:'/action.php',
		type: 'POST',
		data: 'url=discussion&parent='+par+'&'+dataList,
		dataType: 'html',
		success: function(data){
			$query_unt('#'+inp);
			if(data==false) alert('Có lỗi xảy ra, không thể gửi thảo luận của bạn.');
			else {
				if(par>0) $('#'+rs+' .discussion-child-list').append(data);
				else $('#'+rs).prepend(data);
			}
			return true;
		}
	});
	return false;
}

function load_discussions(rs, type, el) {
	var id = parseInt(el.attr("rel"));
	$.ajax({
		url:'/action.php',
		type: 'POST',
		data: 'url=discussion_load&type='+type+'&id='+id,
		dataType: 'json',
		success: function(data){
			$('#'+rs).append(data.msg_content);
			el.attr('rel', data.msg_id);
		},
		error: function() {
			alert('Có lỗi xảy ra, không thể gửi thảo luận của bạn.');
		}
	});
	return false;
}

function courses_like(id, el) {
	var type = parseInt(el.attr('rel'));
	$.ajax({
		url:'/action.php',
		type: 'POST',
		data: 'url=like&type='+type+'&id='+id,
		dataType: 'html',
		success: function(data){
			if(data==true) {
				if(type==0) {
					el.addClass('wishlisted');
					el.attr('rel', 1);
				} else {
					el.removeClass('wishlisted');
					el.attr('rel', 0);
				}
			} else $('#login-modal').modal('show');
			return true;
		}
	});
	return false;
}

function trigger_input() {
	document.getElementById("edit__avatar").click();
}

function change_avatar(id) {
	var dataList = new FormData($('#'+id)[0]);
	dataList.append("url", 'user');
	dataList.append("type", 'avatar');
	showLoader();
	$.ajax({
		url: '/action.php',
		type: 'POST',
		data: dataList,
		dataType: 'html',
		success: function(){
			location.reload();
		},
		cache: false,
		contentType: false,
		processData: false
	});
	return false;
}

function open_modal(id, type) {
    showLoader();
    $.ajax({
        url: '/action.php',
        type: 'POST',
        data: 'url=' + type + '&id='+id,
        dataType: 'html',
        success: function(data){
            showResult('el-modal', data);
			console.log(data);
        },
		error: function(jqXHR, textStatus, errorThrown) {
			// Xử lý lỗi ở đây
			console.error("Request failed: " + textStatus + ", " + errorThrown);
			// Tùy chọn: Hiển thị thông báo lỗi cho người dùng
			alert("An error occurred while processing your request. Please try again later.");
		}
    });
}

function startTimer() {
    var presentTime = $('#exa-timer').html();
    if(!presentTime) return false;
    var timeArray = presentTime.split(/[:]+/);
    var m = timeArray[0];
    var s = checkSecond((timeArray[1] - 1));
    if(s==59){m=m-1};
    if(m<0) {
        examination_answer2();
    	return false;
    } else {
        $('#exa-timer').html(m + ":" + s);
        setTimeout(startTimer, 1000);
	}
}

function startTimer2() {
    var presentTime = $('#exa-timer').html();
    if(!presentTime) return false;
    var timeArray = presentTime.split(/[:]+/);
    var m = timeArray[0];
    var s = checkSecond((timeArray[1] - 1));
    if(s==59){m=m-1};
    if(m<0) {
        self_test_answer2();
        return false;
    } else {
        $('#exa-timer').html(m + ":" + s);
        setTimeout(startTimer2, 1000);
    }
}

function checkSecond(sec) {
    if (sec < 10 && sec >= 0) {sec = "0" + sec};
    if (sec < 0) {sec = "59"};
    return sec;
}

function examination_answer2() {
    showLoader();
    var dataList = $query('#fm-library');
    $.ajax({
        url:'/action.php',
        type: 'POST',
        data: 'url=examination_answer&'+dataList,
        dataType: 'html',
        success: function(data){
            showResult('examination-results', data);
            alert('HẾT THỜI GIAN LÀM BÀI KIỂM TRA.\nBài làm của bạn đã được nộp thành công.');
            var btn = $('#fm-library button[type="submit"]');
            btn.attr("type", "button");
            btn.attr("aria-hidden", "true");
            btn.attr("data-dismiss", "modal");
            btn.attr("class", "btn btn-info btn-round");
            btn.html('Thoát <i class="fa fa-remove fa-fw"></i>');
            return true;
        }
    });
    return false;
}

function product_list(id) {
    showLoader();
    $.ajax({
        url: '/action.php',
        type: 'POST',
        data: 'url=product_list&id=' + id,
        dataType: 'html',
        success: function (data) {
            showResult('_product', data);
            return true;
        }
    });
    return false;
}

function self_test() {
    showLoader();
    var dataList = $query('#self-test');
    $.ajax({
        url: '/action.php',
        type: 'POST',
        data: 'url=self_test_tick&' + dataList,
        dataType: 'html',
        success: function (data) {
            showResult('el-modal', data);
            return true;
        }
    });
    return false;
}
function self_test_answer(inp) {
    showLoader();
    confirm("ĐÃ LÀM XONG, NỘP BÀI KIỂM TRA.\nBạn có chắc chắn thực hiện điều này không?", function() {
        if (this.data == true) {
            var dataList = $('#' + inp).serialize(); // Lấy dữ liệu biểu mẫu đã được mã hóa
            $.ajax({
                url: '/action.php',
                type: 'POST',
                data: 'url=self_test_answer&' + dataList,
                dataType: 'html',
                success: function(data) {
					showResult('self-test-results', data);
                    //$('#self-test-results').html(data); // Hiển thị kết quả trả về
                    var btn = $('#' + inp + ' button[type="submit"]');
                    btn.attr("type", "button");
                    btn.attr("aria-hidden", "true");
                    btn.attr("data-dismiss", "modal");
                    btn.attr("class", "btn btn-info btn-round");
                    btn.html('Thoát <i class="fa fa-check fa-fw"></i>');
                    $('#exa-timer').remove();
                    closeLoader();
                },
                error: function() {
                    alert("Có lỗi xảy ra trong quá trình nộp bài.");
                    closeLoader();
                }
            });
        } else {
            closeLoader();
        }
    });
    return false;
}

function self_test_answer_bk(inp) {
    showLoader();
    confirm("ĐÃ LÀM XONG, NỘP BÀI KIỂM TRA.\nBạn có chắc chắn thực hiện điều này không?", function() {
        if (this.data == true) {
            var dataList = $query('#'+inp);
            $.ajax({
                url:'/action.php',
                type: 'POST',
                data: 'url=self_test_answer&'+dataList,
                dataType: 'html',
                success: function(data){
                    showResult('self-test-results', data);
                    var btn = $('#' + inp + ' button[type="submit"]');
                    btn.attr("type", "button");
                    btn.attr("aria-hidden", "true");
                    btn.attr("data-dismiss", "modal");
                    btn.attr("class", "btn btn-info btn-round");
                    btn.html('Thoát <i class="fa fa-check fa-fw"></i>');
					var newBtn = $('<button></button>');
                    newBtn.attr("type", "button");
                    newBtn.attr("class", "btn btn-success btn-round");
                    newBtn.html('Xem lại<i class="fa fa-check fa-fw"></i>');
                    newBtn.on('click', function() {
                        alert("Nút Mới được nhấn!"+inp);
                    });
                    $('#' + inp).append(newBtn);
                    $('#exa-timer').remove();
                    return true;
                }
            });
        } else {
            closeLoader();
            return false;
        }
    });
    return false;
}


function self_test_answer2() {
    showLoader();
    var dataList = $query('#fm-library');
    $.ajax({
        url:'/action.php',
        type: 'POST',
        data: 'url=self_test_answer&'+dataList,
        dataType: 'html',
        success: function(data){
            showResult('self-test-results', data);
            alert('HẾT THỜI GIAN LÀM BÀI KIỂM TRA.\nBài làm của bạn đã được nộp thành công.');
            var btn = $('#fm-library button[type="submit"]');
            btn.attr("type", "button");
            btn.attr("aria-hidden", "true");
            btn.attr("data-dismiss", "modal");
            btn.attr("class", "btn btn-info btn-round");
            btn.html('Thoát <i class="fa fa-remove fa-fw"></i>');
            return true;
        }
    });
    return false;
}
function viewAnswers(examId, user) {
	//console.log(examId);
    showLoader();
    $.ajax({
        url:'/action1.php',
        type: 'POST',
        data: 'url=open_examination&id='+examId+'&user='+user,
        dataType: 'html',
        success: function(data){
			//console.log(examId);
			console.log(data);
            showResult('_examination', data);
        }
    });
    return false;
}
document.addEventListener('DOMContentLoaded', function() {
    var accordions = document.querySelectorAll('.accordion-button');

    accordions.forEach(function(button) {
        button.addEventListener('click', function() {
            // Toggle active class
            this.classList.toggle('active');
            
            // Get the associated content
            var content = this.nextElementSibling;
            
            // Toggle visibility
            if (content.style.display === 'block') {
                content.style.display = 'none';
            } else {
                content.style.display = 'block';
            }
            
            // Close other accordion items
            accordions.forEach(function(otherButton) {
                if (otherButton !== button) {
                    otherButton.classList.remove('active');
                    otherButton.nextElementSibling.style.display = 'none';
                }
            });
        });
    });
});
