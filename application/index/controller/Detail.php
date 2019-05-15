<?php
namespace app\index\controller;
/**
 * 
 */
class Detail
{
	public function test()
	{
		phpinfo();die;
		$dbh= new PDO('127.0.0.1','root','','shop');
		$count = $dbh->exec("SELECT * FROM banner");
		echo $count;
	}	
	
}