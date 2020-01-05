<?php

namespace APP;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
	//指定表名  table不能变
	protected $table = 'student';

	//指定id find(6)：代表查询的id=6的数据
	protected $primaryKey = 'id';

	//自动维护时间戳  true
	public $timestamps = true;
	//返回当前时间的unix时间戳
	protected function getdateFormat()
	{
		return time();
	}
}