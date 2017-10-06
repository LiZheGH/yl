var isLoadBaike = false;
var isLoadDetail = false;
var hasNet = true;
var baikeUrl = "";
var type = "";
var baseUrl = "http://app.dict.baidu.com/dictapp/";

function toggleCallback(obj) {
	var arrowId = '#' + $(this).attr('arrow_id');
	if ($(this).is(':hidden')) {
		$(arrowId).attr('src', 'icon_down_arrow.png');
	} else {
		$(arrowId).attr('src', 'icon_up_arrow.png');
	}
}

function showDefinitions(data) {
	if (data == undefined || data.length == 0) {
		$(".detail_results").html("");
		return;
	}

	// alert(data);
	console.log(data);
	var dataJson;
	try {
		if (typeof (data) == "string") {
			dataJson = JSON.parse(data);
		} else {
			dataJson = data;
		}
	} catch (e) {
		// TODO handle the exception
		$(".detail-results").html("");
		return;
	}

	if (data.baseUrl != null && data.baseUrl.length > 0) {
		baseUrl = data.baseUrl;
	}

	$(".detail-results").html("");
	var resultsHtml = "";
	type = dataJson.type;
	if(dataJson.network != null){
		hasNet = dataJson.network;
	}

	var defText = "基本释义";
	if (type != "word" && type != "term") {
		defText = "详细释义";
	}

	if (dataJson.definition != undefined) {
		resultsHtml += "<div class=\"container\"><div class=\"c-flexbox d-title c-color-gray-a\" "
				+ "onclick=\"$('#base_definition').slideToggle('fast',toggleCallback);\">"
				+ "<span class=\"c-span6\" style=\"padding: 0px;\">"
				+ defText
				+ "</span><div class=\"c-span6 right-arrow\" style=\"padding-right: 0px;\">"
				+ "<img id=\"base_arrow\" src=\"icon_up_arrow.png\" /></div></div>";

		resultsHtml += "<div id=\"base_definition\" arrow_id=\"base_arrow\" "
				+ "class=\"c-flexbox d-content c-color\"><div>";

		var definition;
		if (dataJson.definition != null && dataJson.definition.length > 0) {

			for (var i = 0; i < dataJson.definition.length; i++) {
				definition = dataJson.definition[i];
				if (definition.pinyin != undefined) {
					resultsHtml += "<p>[" + definition.pinyin + "]</p>";
				}

				if (definition.definition != undefined) {
					if (type != "word" && type != "term") {
						resultsHtml += "<p>[释义]</p>";
					}
					resultsHtml += getDefinitionHtml(definition.definition);
				}

				// 其他几个
				if (definition.source != undefined) {
					resultsHtml += "<p>[出处]</p>";
					resultsHtml += getDefinitionHtml(definition.source);
				}

				if (definition.liju != undefined) {
					resultsHtml += "<p>[例句]</p>";
					resultsHtml += getDefinitionHtml(definition.liju);
				}

				if (definition.story != undefined) {
					resultsHtml += "<p>[典故]</p>";
					resultsHtml += getDefinitionHtml(definition.story);
				}

				if (definition.grammar != undefined) {
					resultsHtml += "<p>[语法]</p>";
					resultsHtml += getDefinitionHtml(definition.grammar);
				}
			}
		} else {
			resultsHtml += "无" + defText;
		}

		resultsHtml += "</div></div></div>";

	}

	if (hasNet == true || hasNet == "true") {
		if (type == "word" || type == "term") {
			if (dataJson.baike != undefined) {
				resultsHtml += "<div class=\"container\"><div class=\"c-flexbox d-title c-color-gray-a\" "
						+ "onclick=\"$('#detail_definition').slideToggle('fast',toggleCallback);getDetail('"
						+ dataJson.baike
						+ "');\"><span class=\"c-span6\" style=\"padding: 0px;\">详细释义</span>"
						+ "<div class=\"c-span6 right-arrow\" style=\"padding-right: 0px;\">"
						+ "<img id=\"detail_arrow\" src=\"icon_down_arrow.png\" /></div></div>";

				resultsHtml += "<div id=\"detail_definition\" arrow_id=\"detail_arrow\" "
						+ "class=\"c-flexbox d-content detail c-color\" style=\"display:none;\"><div id=\"detail_content\">加载中...</div></div></div>";

			}
		}

		if (dataJson.baike != undefined) {
			resultsHtml += "<div class=\"container\"><div class=\"c-flexbox d-title c-color-gray-a\" "
					+ "onclick=\"$('#baike_definition').slideToggle('fast',toggleCallback);getBaike('"
					+ dataJson.baike
					+ "');\"><span class=\"c-span6\" style=\"padding: 0px;\">百科释义</span>"
					+ "<div class=\"c-span6 right-arrow\" style=\"padding-right: 0px;\">"
					+ "<img id=\"baike_arrow\" src=\"icon_down_arrow.png\" /></div></div>";

			resultsHtml += "<div id=\"baike_definition\" arrow_id=\"baike_arrow\" "
					+ "class=\"c-flexbox d-content c-color\" style=\"display:none;\"><div style=\"width:100%;\"><div id=\"baike_content\">加载中...</div><div id=\"more_div\" style=\"text-align: right;\"><a onclick=\"openBaike()\">查看更多>></a></div></div></div></div>";

		}
	}

	$(".detail-results").html(resultsHtml);
}

function getDefinitionHtml(definition) {
	if (definition == undefined || definition.length == 0) {
		return "";
	}
	var definitionHTML = "";
	if (type == "word") {
		if (typeof (definition) == "string") {
			var def = definition.split(":");
			if (def.length > 1) {
				definitionHTML += "<div><span class=\"liju-title\">" + def[0]
						+ "</span><br/><span class=\"liju-content\">" + def[1]
						+ "</span></div>";
			} else {
				definitionHTML += "<div>" + definition + "</div>";
			}

		} else {
			for (var i = 0; i < definition.length; i++) {
				var def = definition[i].split(":");
				if (def.length > 1) {
					definitionHTML += "<div><span class=\"liju-title\">"
							+ def[0]
							+ "</span><br/><span class=\"liju-content\">"
							+ def[1] + "</span></div>";
				} else {
					definitionHTML += "<div>" + definition[i] + "</div>";
				}
			}
		}
	} else {
		if (typeof (definition) == "string") {
			definitionHTML += "<div>" + definition + "</div>";

		} else {
			for (var i = 0; i < definition.length; i++) {
				definitionHTML += "<div>" + definition[i] + "</div>";
			}
		}
	}

	return definitionHTML;
}

function getBaike(word) {
	if (isLoadBaike)
		return;
	
	WebViewJavascriptBridge.callHandler('on_event', {
		'eventId' : 'kDetailBaike',
		'eventLabel' : '详情页——百科释义展开按钮' 
	}, function(response) {
	});
	var url = baseUrl + "search_baikeinfo?mainkey=" + word + "&jsoncallback=?";
	$.getJSON(url, function(data) {
		alert(data);
	});
}

function getDetail(word) {
	if (isLoadDetail)
		return;
	WebViewJavascriptBridge.callHandler('on_event', {
		'eventId' : 'kDetailDetail',
		'eventLabel' : '详情页——详细释义展开按钮' 
	}, function(response) {
	});
	var url = baseUrl + "search_dictinfo?mainkey=" + word + "&jsoncallback=?";
	$.getJSON(url, function(data) {
		alert(data);
	});
}

function baikeCallback(data) {
	// alert(data);
	if (data == null || data.data == null || data.data.ret_num == 0) {
		$('#baike_content').text("无百科释义");
		$('#more_div').hide();
		return;
	}

	var baike_mean = data.data.baike_mean;
	if (baike_mean == null || baike_mean == "") {
		$('#baike_content').text("无百科释义");
		$('#more_div').hide();
		return;
	}
	$('#baike_content').text(baike_mean);
	baikeUrl = data.data.baike_url;
	isLoadBaike = true;
}

function detailCallback(data) {
	if (data == null || data.data == null || data.data.ret_num == 0) {
		$('#detail_content').text("无详细释义");
		return;
	}

	var dataStr = JSON.stringify(data);
	if (dataStr == null || dataStr.indexOf("detailmean") <= 0) {
		$('#detail_content').text("无详细释义");
		return;
	}

	var dictMean = data.data.dict_mean;
	if (dictMean == null || dictMean == "") {
		$('#detail_content').text("无详细释义");
		return;
	}

	$('#detail_content').html(dictMean.modules.detailmean[0]);

	isLoadDetail = true;
}

function openBaike() {
	WebViewJavascriptBridge.callHandler('open_baike', {
		'url' : baikeUrl
	}, function(response) {
	});
}
