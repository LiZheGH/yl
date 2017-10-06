<?php
	/**
	 * ����JSONֵ�������ַ�
	 * @param unknown_type $document
	 * @return mixed
	 */
	function json_filter($document) {
		$search = array ("'<script[^>]*?>.*?</script>'si",  // ȥ�� javascript
				                 "'<[\/\!]*?[^<>]*?>'si",           // ȥ�� HTML ���
				                 "'([\r\n])[\s]+'",                 // ȥ���հ��ַ�
				                 "'&(quot|#34);'i",                 // �滻 HTML ʵ��
				                 "'&(amp|#38);'i",
				                 "'&(lt|#60);'i",
				                 "'&(gt|#62);'i",
				                 "'&(nbsp|#160);'i",
				                 "'&(iexcl|#161);'i",
				                 "'&(cent|#162);'i",
				                 "'&(pound|#163);'i",
				                 "'&(copy|#169);'i",
				                 "'&#(\d+);'e");                    // ��Ϊ PHP ��������
	
		$replace = array ("",
				                  "",
				                  "\\1",
				                  "\"",
				                  "&",
				                  "<",
				                  ">",
				                  " ",
				                  chr(161),
				                  chr(162),
				                  chr(163),
				                  chr(169),
				                  "chr(\\1)");
	
		return preg_replace ($search, $replace, $document);
	}
	
	