<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css" media="screen" />
<link rel="stylesheet" href="/resource/css/admin/admin.css" media="screen" />
<link rel="stylesheet" href="/resource/css/admin/appmsg.css" media="screen" />
<link rel="stylesheet" href="/jquery-ui/css/uploadify.css" media="screen" />
<script type="text/javascript" src="/resource/js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/resource/js/plugin/operamasks-ui.min.js"></script>
<script type="text/javascript" src="/resource/js/page/appmsg.js"></script> 
<script type="text/javascript" src="/jquery-ui/js/jquery.uploadify.min.js?ver=<?php echo rand(0,9999);?>"></script>
<style>
.count{
		background-color: #FFEFAF;
		line-height: 30px;
		margin-bottom: 10px;
}
.member-count{
	margin: 0 50px 0 10px;
}
.info-block{
	text-align: center;
}
.statu_frozen{
	color: red;
}
</style>
<title>类别管理</title>
</head>
<body>
 <form class="form-horizontal"  id="tform" action="/store/category_add/<?php echo $pid;?>/<?php echo $id ;?>" method="POST">
		 
		<fieldset>
		   
			<legend><?php if ($pid){?>添加小类<?php }else{?>添加大类<?php }?></legend>
			<?php if ($pid){?> 
				 <div class="control-group">
					<label class="control-label" for="answer">大类:</label>
					<div class="controls">
						<select id="pcate" name="pcate">
							<?php foreach($pcate as $k=>$v){?>
							     <option value="<?php echo $v->id;?>" <?php if ($pid==$v->id){?>selected<?php }?>><?php echo $v->name;?></option>
							<?php }?> 
						</select> 
					</div>
				</div>
			<?php }?>
			<div class="control-group">
				<label class="control-label" for="option1">类名:</label>
				<div class="controls">
					<input type="text" id="name" name="name" <?php if($cate){?> value="<?php echo $cate->name; ?>" <?php }?>> 
				</div>
			</div>	
			<div class="control-group">
				<label class="control-label" for="option1">类简介:</label>
				<div class="controls">
					<textarea id="descriptions" name="descriptions"><?php if($cate){  echo $cate->descriptions;   }?></textarea>  
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label" for="option1">星期:</label>
				<div class="controls">
					<?php foreach($weeks as $k=>$v){
                                            
                                            ?>
					  <input type="checkbox" value="<?php echo $k+1;?>" <?php if($valid_weeks&&in_array($k,$valid_weeks)){?>checked=true<?php }?>class="weeks" name='weeks[]'/><?php echo $v;?>
					<?php }?>  
				</div>
			</div>
			
			<div class="control-group">
							<label class="control-label">封面</label>     
							<div class="controls">
								<div class="cover-area img-area">
									<div class="cover-hd">
										<input id="file_upload" name="file_upload" type="file" />
										<input id="coverurl" value="<?php if($cate){ echo $cate->coverurl;}?>" name="coverurl" type="hidden" />
									</div>
									 
									<p id="img-area" class="cover-bd" <?php if($cate){if(!$cate->coverurl){?>style="display: none;"<?php }}?>>
									<?php if($cate){if($cate->coverurl){?><img src="<?php echo $cate->coverurl;?>" width="100" height="100" /><?php }}?>
									<a href="javascript:;" class="vb cover-del" id="delImg">删除</a>
									</p>
								</div>
							</div>
						</div>
							
   		  	<div class="control-group">
			    <div class="controls">
			      
			      <button id="save-btn" type="submit" class="btn btn-primary">保存</button>
			      <button id="back-btn" type="button" class="btn btn-primary" onclick="location.href='/store/category_index'">返回</button>
			    </div>
		    </div>
		</fieldset>
	</form>
<script type="text/javascript">
$(function(){
	var validator = $("#tform").validate({
		rules: {
			name: {required: true}
		},
		messages: {
			name: {required: "请输入类名"}
		},
		showErrors: function(errorMap, errorList) {
			if (errorList && errorList.length > 0) {
				$.each(errorList,
				function(index, obj) {
					var item = $(obj.element);
					if(item.is(".cover")){
						alert(obj.message);
					}
					// 给输入框添加出错样式
					item.closest(".control-group").addClass('error');
					item.attr("title",obj.message);
				});
			} else {
				var item = $(this.currentElements);
				item.closest(".control-group").removeClass('error');
				item.removeAttr("title");
			}
		}
		 
	}); 
});

</script>
</body>	
</html>