//验证邮箱
function check_email(email){
    var reg = /^([A-Za-z0-9]+)([._-]([A-Za-z0-9]+))*[@]([A-Za-z0-9]+)([._-]([A-Za-z0-9]+))*[.]([A-Za-z0-9]){2}([A-Za-z0-9])?$/;
    if(reg.test(email)){
        return true;
    }  else {
		return false;
	}
}
//菊花-显示
function juhuaShow(){
	$("#foo").show();
}
//菊花-隐藏
function juhuaHide(){
	$("#foo").hide();
}
//in_array
function in_array(search,array){
    for(var i in array){
        if(array[i]==search){
            return true;
        }
    }
    return false;
}
