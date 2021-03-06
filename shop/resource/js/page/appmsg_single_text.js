$(function () {
	var timestamp=new Date().getTime();
	 $('#file_upload').each(function(){
			var $fileInput = $(this);
			var $cont =  $fileInput.closest(".cont");
			var name = $fileInput.attr("name");
			setTimeout(function(){
			$fileInput.uploadify({			 
				'swf'      : '/resource/swf/uploadify.swf',
				'uploader' : '/uploads.php',
				'onUploadSuccess' : function(file,data,response)  {
					var jsonData = eval("("+data+")");
					var coverurl = $.trim($('#coverurl').val()); 
					$(".cover .i-img").attr("src",jsonData.fileUrl).show();
			    	$("#imgArea").show();
			    	var img = "<img src='"+jsonData.fileUrl+"' /> ";
					$('#delImg').prepend(img);
			    	if(coverurl){
			    		coverurl+=';';
			    	}
			    	$("#coverurl").val(coverurl+jsonData.fileUrl);
			    	$(".default-tip").hide();
			    }
			})
			},10);
		});
	 
	 
	 $('#file_upload2').each(function(){
			var $fileInput = $(this);
			var $cont =  $fileInput.closest(".cont");
			var name = $fileInput.attr("name");
			$fileInput.uploadify({			 
				'swf'      : '/resource/swf/uploadify.swf',
				'uploader' : '/uploads.php',
				'onUploadSuccess' : function(file,data,response)  {
					var jsonData = eval("("+data+")");
					var coverurl = $.trim($('#coverurl2').val());  
			    	$("#imgArea2").show();
			    	var img = "<img src='"+jsonData.fileUrl+"' /> ";
					$('#delImg2').prepend(img);
			    	if(coverurl){
			    		coverurl+=';';
			    	}
			    	$("#coverurl2").val(coverurl+jsonData.fileUrl);
			    	$(".default-tip").hide();
			    }
			 
			});
		});
	 
	 
	 $(".msg-editer #title").bind("keyup",function(){
		 $(".i-title").text($(this).val());
	 });
	 $(".msg-editer #summary").bind("keyup",function(){
		 $(".msg-text").text($(this).val());
	 });
	 $('#desc-block-link').click(function(){
		 $('#desc-block').show();
		 $(this).hide();
	 });
	 $('#url-block-link').click(function(){
		 $('#url-block').show();
		 $(this).hide();
	 });
	 $("#delImg").click(function(){
		 $(".default-tip").show();
		 $("#imgArea").hide();
		 $(this).html('删除');
		 $("#coverurl").val('');
		 $(".cover .i-img").hide();
	 });
	 $("#cancel-btn").click(function(event){
		 event.stopPropagation();
		 location.href = "/main/single_material";
		 return ;
	 });
	 var validator = $("#appmsg-form").validate({
			rules: {
				title: {
					required: true,
					maxlength: 64
				},
				time: {
					required: true
				},
				author: {
					required: true
				},
				summary: {
					maxlength: 120
				},
				 
				keywords:{
				    required:true
				}
			},
			messages: {
				title: {
					required: "请输入标题",
					maxlength: "标题不能超过64个字"
				},
				time: {
					required: "请输入发表时间"
				},
				author: {
					required: "请输入作者"
				},
				summary: {
					maxlength: "标题不能超过120个字"
				},
				 
				keywords:{
				    required:"关键字必填"
				}
			},
			showErrors: function(errorMap, errorList) {
				if (errorList && errorList.length > 0) {
					$.each(errorList,
							function(index, obj) {
						var item = $(obj.element);
						// 给输入框添加出错样式
						item.closest(".control-group").addClass('error');
						item.attr("title",obj.message);
					});
				} else {
					var item = $(this.currentElements);
					item.closest(".control-group").removeClass('error');
					item.removeAttr("title");
				}
			},
			submitHandler: function() {
				if($("#coverurl").val() == ''){
					alert("必须上传一张图片");
					return false;
				}

				var	editorContent=$("#tm_content").val();
				
				if(editorContent.length <= 0 || editorContent > 20000){
					alert("正文的内容必须填写且不能超过20000个字");
					msg_editor.focus();
					return false;
				}
				
				var $form = $("#appmsg-form");
				var $btn = $("#save-btn");
				if($btn.hasClass("disabled")) return;
				var submitData = {
						title: $("input[name='title']", $form).val(),
						time: $("input[name='time']", $form).val(),
						author: $("input[name='author']", $form).val(),
						summary: $("textarea[name='summary']", $form).val(),
						coverurl: $("input[name='coverurl']", $form).val(),
						coverurl2: $("input[name='coverurl2']", $form).val(),
						source_url: $("input[name='source_url']" , $form).val(),
						link: $("input[name='link']", $form).val(),
						rid: $("input[name='rid']", $form).val(),
						m_id: $("input[name='m_id']", $form).val(),
						action: $("input[name='action']", $form).val(),
						maincontent: editorContent,
						keywords:$("input[name='keywords']", $form).val(),
						category:$("select[name='category']", $form).val(),
						from:"text"
				};
				$btn.addClass("disabled");
				
				$.post('/main/single_material_text', submitData,function(data) {
					$btn.removeClass("disabled");
					if (data.success == 'yes') {
					    alert(data.msg);
						location.href = "/main/single_list";
					}  else{
						alert(data.msg);
						
					}
				},"json");
				return false;
			}
		});
	  //  window.msg_editor = new UE.ui.Editor({initialFrameWidth:498});
	    //window.msg_editor.render('editor');
});