<?php
/**
 * 数据库操作类
 * @author
 */

class DB {
	var $dbConn = "";
	var $errorMessage = "";
	
	/**
	 * 链接数据库
	 */
	function db_conn($cli=false) {
		if($cli) {
			if (! $this->dbConn) {
				$this->dbConn = mysqli_connect ( DB_SERVERNAME, DB_USERNAME, DB_PASSWORD, DB_DBNAME );
				mysql_query ( "SET NAMES 'utf8'" );
			}
		} else {
			if (! $this->dbConn) {
				$this->dbConn = mysql_connect ( DB_SERVERNAME, DB_USERNAME, DB_PASSWORD );
				mysql_select_db ( DB_DBNAME );
				mysql_query ( "SET NAMES 'utf8'" );
			}
		}
	}
	
	/**
	 * 关闭数据库
	 */
	function db_close($cli=false) {
		if (! $this->dbConn&& empty($this->dbConn) ) {
			if($cli)
				mysql_close ($this->dbConn);
			else 
				mysqli_close($this->dbConn);
		}
	}
	
	/**
	 * 功能：执行(insert/update/delete)数据库操作
	 * @sql sql语句
	 */
	function executeSql($sql) {
		$this->db_conn ();
		//mysql_select_db ( DB_DBNAME );
		mysql_query ( "SET NAMES 'utf8'" );
		$result = mysql_query ( $sql, $this->dbConn ) or die ( "mysql execute error" . mysql_error () );
		$this->db_close ();
		return $result;
	}
	
	/**
	 * 功能：得到记录集
	 * @sql sql语句
	 */
	function getInfo($sql) {
		$this->db_conn();
		//mysql_select_db ( DB_DBNAME );
		$records = "";
		$result = mysql_query ( $sql, $this->dbConn ) or die ( "executeSql Error" . mysql_error () );
		$this->db_close();
		while ( $record = mysql_fetch_array ( $result ) ) // 形成二维数组
			$records [] = $record;
		mysql_free_result ( $result );
		return $records;
	}
	
	/**
	 * 功能：得到一个字段的值
	 * @table 表名
	 * @field 字段名
	 * @where 查询条件
	 */
	function getOneFieldValue($table, $field, $where) {
		$sql = "select " . $field . " from " . $table . " where " . $where . "";
		$arr = mysql_fetch_array($this->executeSql ( $sql ));
		if (is_array ( $arr ))
			$field_value = $arr [0];
		else
			$field_value = "";
		return $field_value;
	}
	
	/**
	 * 功能： 验证信息是否存在
	 * @table 表名
	 * @selectItem 字段名
	 * @where 查询条件
	 */
	function getTrueFalse($table, $selectItem, $where) {
		$sql = "select " . $selectItem . " from " . $table . " where " . $where . "";
		$arr = $this->executeSql ( $sql );
		if (is_array ( $arr ))
			return true;
		else
			return false;
	}
	
	/**
	 * 功能：插入信息
	 * @table 表名
	 * @fields 字段串
	 * @fieldsValues 字段对应的值
	 */
	function insertInfo($table, $fields, $fieldsValue) {
		$sql = "INSERT INTO $table(" . $fields . ") VALUES(" . $fieldsValue . ")";
		$this->executeSql ( $sql );
	}
	
	function replaceInfo($table, $fields, $fieldsValue) {
		$sql = "REPLACE INTO $table(" . $fields . ") VALUES(" . $fieldsValue . ")";
		// 		echo $sql;return;
		$this->executeSql ( $sql );
	}
	
	/**
	 * 功能：更新信息
	 * @table 表名
	 * @setFields 更新的字段及对应的值
	 * @where 更新信息的条件
	 */
	function updateInfo($table, $setFields, $where) {
		$sql = "UPDATE $table SET " . $setFields . " WHERE " . $where . "";
		$this->executeSql ( $sql );
	}
	
	/**
	 * 功能：删除信息
	 * @table 表名
	 * @where 删除信息的条件
	 */
	function deleteInfo($table, $where) {
		$sql = "DELETE FROM $table WHERE " . $where . "";
		$this->executeSql ( $sql );
	}
	/**
	 * 功能：得到信息记录数
	 * @table 表名
	 * @selectItem 查询字段
	 * @where 查询条件
	 * 返回：记录数
	 */
	function getCountInfo($table, $selectItem, $where) {
		$sql = "SELECT COUNT($selectItem) FROM $table WHERE $where";
		$array = $this->getInfo ( $sql );
		if (is_array ( $array ))
			$countNum = $array [0] [0];
		else
			$countNum = "";
		return $countNum;
	}
}