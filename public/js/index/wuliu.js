var guide = false;
var layerJh;
$(function(){
	ajaxJudgeLogin();
	//关于我们
	$("#dh").hover(function(){
		$(".dh_list").show();
	},function(){
		$(".dh_list").hide();
	});
	//管理中心
	$("#gl").hover(function(){
		$(".gl_list").show();
	},function(){
		$(".gl_list").hide();
	});
	//导航
	$("#our").hover(function(){
		$(".our_list").show();
	},function(){
		$(".our_list").hide();
	})
})

function jh(){
	layerJh = layer.load(1,{
		shade: [0.1,'#fff']
	});
}
function closeJh(){
	layer.close(layerJh);
}
//登出
	function LogOut1(){
		var user_type = $('#user_type').val();
		window.wxc.xcConfirm("确定退出吗 ?", window.wxc.xcConfirm.typeEnum.confirm,{
			onOk:function(){
				$.post("/Web/ajaxLogout",{'user_type':user_type},function(data){
					if(user_type == 1){
						$.session.remove('trader');
					}else{
						$.session.remove('retailer');						
					}
					$.session.remove('url');
					window.location.href="/wuliu/wLogin";
				},"json");
			}
		},'less');
	
	}
	
	function ajaxJudgeLogin(){
		$.ajax({
	        url:'/retailer/ajaxJudgeLogin',
	        type:'post',
			dataType : 'json',
			data : encodeURI('a='+'a&url='+window.location.href),
	        success:function(data){
	        	if(data['success']){
	        		$('.left_login').html('<a href="/wuliu/person">'+data['data']['user']['mobile']+'</a>');
					$('.left_reg').html('<a href="javascript:;" onclick="LogOut1();">退出</a>');					
	        	} else {
					$('#login_stat').val('0');
					$('.left_login').html('<a href="/wuliu/wLogin">请登录</a>');
	        	} 
	        	$('#index_a').html('首页'); 
	        },
	        error:function(){

	        }
	    });
	    
	    
	}