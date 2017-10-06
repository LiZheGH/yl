var getArgs;

(function() {

	return comn = {
		getArgs:function () {
	      var args, i, item, items, name, qs, value;
	      qs = (location.search.length > 0 ? location.search.substring(1) : "");
	      items = (qs.length ? qs.split("&") : []);
	      args = {};
	      i = 0;
	      while (i < items.length) {
	        item = items[i].split("=");
	        name = decodeURIComponent(item[0]);
	        value = decodeURIComponent(item[1]);
	        if (name.length) {
	          args[name] = value;
	        }
	        i++;
	      }
	      return args;
	 },

		checknum:function(d){

			if(d){
				$(".left_lists:eq(1) .list_box").show();
				var listLi = $(".left_lists:eq(1) .list_box").children("li")
				var listLen = listLi.length;
				for(var i = 0;i<listLen;i++){
					if(i == d){
						$(".list_box").find("a").css({"color":"#666"});
						listLi.eq(i).find("a").css({"color":"#40a18f"});
						$(".ri_mi_tles span").eq(i).addClass("tle_line").siblings("span").removeClass("tle_line");
					}
				}
			}
		}
	}
})();



$(function(){

	//左侧导航
	//初始化
	var s = $("input[name='h_input']").val();
	loanTab('',s);

	$(".left_nav_tle").click(function(){
		loanTab($(this));
	})

	function loanTab(a,s){
		if(s){
			$(".list_box:eq(0)").slideDown();
			var b = $(".list_box").children("li")
			    bLen = b.length;
			for(var i =0;i<bLen;i++){
				if(b.eq(i).data('list') == s){
					b.eq(i).find("a").css({"color":"#ac9f5e"});
				}
			}
			return
		}
		if(a){
			var sta = a.attr("sta");
			if(sta == "hide"){
				a.removeClass("left_nav_bg");
				a.parent().siblings(".list_box").slideDown();
				a.attr("sta","show");
			}else{
				a.addClass("left_nav_bg");
				a.parent().siblings(".list_box").slideUp();
				a.attr("sta","hide");
			}
		}else{
			$(".list_box:eq(0)").slideDown();
			$(".dislist:eq(0) a").css({"color":"#ac9f5e"});
			$(".left_lists:eq(0)>a:eq(0)").attr("sta","hide");
		}
	}
	//顶端导航
	function headActive(){
		var a = $("input[name='h_header']").val();
		var b = $(".retailer_menu a"),
		    len = b.length;
		for(var i = 0;i<len;i++){
			if(b.eq(i).data("id") == a){
				b.eq(i).css({"border":"1px solid #fff"});
			}
		}
	}
	headActive();
})
