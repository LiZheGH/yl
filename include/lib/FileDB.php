<?php
class FileDB {
	static public function insert($contact_db_file, $contact) {
		$data = '';
		if (file_exists ( $contact_db_file )) {
			$arr_data = file ( $contact_db_file );
			$contact_id = json_decode ( $arr_data [count ( $arr_data ) - 1] )->id + 1;
			$data = file_get_contents ( $contact_db_file );
		} else {
			$contact_id = 1;
		}
		$contact ['id'] = $contact_id;
		if ($data)
			$data .= "\n" . json_encode ( $contact );
		else
			$data .= json_encode ( $contact );
		$f = fopen ( $contact_db_file, 'w+' );
		fwrite ( $f, $data );
		fclose ( $f );
		
		return $contact;
	}
	static public function batch_insert($contact_db_file, $contacts) {
		$data = '';
		if (file_exists ( $contact_db_file )) {
			$arr_data = file ( $contact_db_file );
			$contact_id = json_decode ( $arr_data [count ( $arr_data ) - 1] )->id + 1;
			$data = file_get_contents ( $contact_db_file );
		} else {
			$contact_id = 1;
		}
		$add_contacts = array ();
		foreach ( $contacts as $key => $contact ) {
			$contact ['id'] = $contact_id + $key;
			$add_contacts [$contact ['id']] = $contact;
			if ($data)
				$data .= "\n" . json_encode ( $contact );
			else
				$data .= json_encode ( $contact );
		}
		$f = fopen ( $contact_db_file, 'w+' );
		fwrite ( $f, $data );
		fclose ( $f );
		
		return $add_contacts;
	}
	static public function update($contact_db_file, $contact) {
		if (file_exists ( $contact_db_file )) {
			$arr_data = file ( $contact_db_file );
			$data = '';
			if (is_array ( $arr_data ) && count ( $arr_data ) > 0) {
				foreach ( $arr_data as $line ) {
					$json = json_decode ( trim ( $line ) );
					if ($json->id == $contact ['id']) {
						if ($data)
							$data .= "\n";
						$data .= json_encode ( $contact );
					} else {
						if ($data)
							$data .= "\n";
						$data .= trim ( $line );
					}
				}
			}
			$f = fopen ( $contact_db_file, 'w+' );
			fwrite ( $f, $data );
			fclose ( $f );
		}
	}
	static public function batch_update($contact_db_file, $contacts) {
		if (file_exists ( $contact_db_file )) {
			$arr_data = file ( $contact_db_file );
			$data = '';
			if (is_array ( $arr_data ) && count ( $arr_data ) > 0) {
				foreach ( $arr_data as $line ) {
					$json = json_decode ( trim ( $line ) );
					$flag = false;
					foreach ( $contacts as $contact ) {
						if ($json->id == $contact ['id']) {
							$flag = true;
							if ($data)
								$data .= "\n";
							$data .= json_encode ( $contact );
							break;
						}
					}
					if ($flag) {
					} else {
						if ($data)
							$data .= "\n";
						$data .= trim ( $line );
					}
				}
			}
			$f = fopen ( $contact_db_file, 'w+' );
			fwrite ( $f, $data );
			fclose ( $f );
		}
	}
	static public function delete($contact_db_file, $id) {
		if (file_exists ( $contact_db_file )) {
			$arr_data = file ( $contact_db_file );
			$data = '';
			if (is_array ( $arr_data ) && count ( $arr_data ) > 0) {
				foreach ( $arr_data as $line ) {
					$json = json_decode ( $line );
					if ($json->id == $id) {
						// $data .= json_encode($contact) . "\n";
					} else {
						if ($data)
							$data .= "\n";
						$data .= trim ( $line );
					}
				}
			}
			$f = fopen ( $contact_db_file, 'w+' );
			fwrite ( $f, $data );
			fclose ( $f );
		}
	}
	static public function batch_delete($contact_db_file, $ids) {
		if (file_exists ( $contact_db_file )) {
			$arr_data = file ( $contact_db_file );
			$data = '';
			if (is_array ( $arr_data ) && count ( $arr_data ) > 0) {
				foreach ( $arr_data as $line ) {
					$json = json_decode ( $line );
					if (in_array ( $json->id, $ids )) {
						// $data .= json_encode($contact) . "\n";
					} else {
						if ($data)
							$data .= "\n";
						$data .= trim ( $line );
					}
				}
			}
			$f = fopen ( $contact_db_file, 'w+' );
			fwrite ( $f, $data );
			fclose ( $f );
		}
	}
	static public function get_data($contact_db_file) {
		if (file_exists ( $contact_db_file )) {
			return file ( $contact_db_file );
		} else {
			return false;
		}
	}
	static public function set_array($contact_db_file, $data) {
		$f = fopen ( $contact_db_file, 'w+' );
		fwrite ( $f, json_encode ( $data ) );
		fclose ( $f );
	}
	static public function get_array($contact_db_file) {
		if (file_exists ( $contact_db_file )) {
			return json_decode ( file_get_contents ( $contact_db_file ) );
		} else {
			return false;
		}
	}
	static public function getTagByType($tag_data_file, $tag_type) {
		$tag_data = self::get_data ( $tag_data_file );
		$tag = null;
		if ($tag_data) {
			foreach ( $tag_data as $line ) {
				$json = json_decode ( $line );
				if ($json->tag_type == $tag_type) {
					$tag = array (
							'id' => $json->id,
							'tag_name' => $json->tag_name,
							'tag_type' => $json->tag_type,
							'googleId' => isset($json->googleId) ? $json->googleId : 0 
					);
					break;
				}
			}
		}
		return $tag;
	}
}
// $file = 'c:/aaa.txt';
// $contacts = array(
// 		array('username' => 'eeeeee', 'company' => 'ffff', 'id' => 1),
// 		array('username' => 'ggggg', 'company' => 'hhhhh', 'id' => 4)
// 		);
// db::batch_insert($file, $contacts);
// db::batch_update($file, $contacts);
// db::batch_delete($file, array('1', '4'));
// insert('c:/aaa.txt', array('username' => 'aaaa', 'company' => 'bbbb'));
// update($file, array('username' => 'ccc', 'company' => 'ddddd', 'id' => 3),
// 3);
// update($file, array('username' => 'ccc', 'company' => 'ddddd', 'id' => 3),
// 3);
// delete ( $file, 3 );