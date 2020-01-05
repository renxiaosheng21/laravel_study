<?php

namespace App\Http\Controllers;//命名空间
use App\Member;
class MemberController extends Controller//继承Controller控制器
{
	public function info()
	{
		//return 'MemberController-info';
		// return view('info');//输出根目录下的info.php视图
		// return view('member/info');//输出member目录下的视图
		// return view('member/info',array('name'=>'ryh'));//输出视图并传递参数

		return Member::getMember();
	}
	public function info2($info)
	{
		return 'MemberController-info2-'.$info;
	}
}