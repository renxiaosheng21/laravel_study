<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});
//知识点1：get请求
Route::get('basic1',function()
	{
		return 'Hello Basic1';
	}
);
//知识点2：post请求
Route::post('basic2',function()
	{
		return 'Hello basic2';
	}
);
//知识点3.1：多请求路由 1：响应指定的类型 eg:get和post
Route::match(['get','post'],'match1',function()
	{
		return 'match1';
	}
);
//知识点3.2：多请求路由 2：可以响应所有的类型
Route::any('match2',function()
	{
		return 'match2';
	}
);
//知识点4.1：路由参数1:  (id必须传递)，传递时可以根据传递的具体类型来判断两者的区别
/*Route::get('user/{id}',function($id)
	{
		return 'User-id-'.$id;
	}
);*/

//知识点4.2：路由参数2:  (name可以不传)
/*Route::get('user/{name?}',function($name = 'hehe')
	{
		return 'User-name-'.$name;
	}
);*/

//知识点4.3：路由参数3:  (限制name只能传指定的字符)
/*Route::get('user/{name?}',function($name = 'hehe')
	{
		return 'User-name-'.$name;
	}
)->where('name','[A-Za-z]+');*/

//知识点4.4：路由参数4: 传递多个参数 
Route::get('user/{id}/{name?}',function($id, $name = 'hehe')
	{
		return 'User-id'.$id.'User-name-'.$name;
	}
)->where(array('id'=>'[0-9]+','name'=>'[A-Za-z]+'));

//知识点5：路由别名   访问还是靠前面的，下边的路由不用改：http://localhost:8085/laravel_test/public/user/membercenter
Route::get('user/membercenter',
	[
		'as'=>'center',function()
		{
			return route('center');//生成别名对应的url
		}
	]
);

//知识点6：路由群组 路由里面包含路由
Route::group(array('prefix'=>'member'),function()
	{
		//http://localhost:8085/laravel_test/public/member/user/member-center
		Route::get('user/member-center',
			[
				'as'=>'center',function()
				{
					return route('center');//生成别名对应的url
				}
			]
		);
		//http://localhost:8085/laravel_test/public/member/match2
		Route::any('match2',function()
			{
				return 'member-match2';
			}
		);
	}

);
//知识点7：路由访问视图：view函数
Route::get('view',function()
	{
		return view('welcome');//将访问resources/views/welcome.blade.php
	}
);

//路由和控制器进行关联1：基础 
Route::get('member/info1','MemberController@info');

//路由和控制器进行关联2:数组的形式 将访问MemberController控制器中的info方法
Route::get('member/info2',array('uses'=>'MemberController@info',));

//路由和控制器进行关联3:路由特性的使用1：起别名 将访问MemberController控制器中的info方法
/*Route::get('member/info3',array(
	'uses'=>'MemberController@info',
	'as' =>'memberinfo'
	)
);*/

//路由和控制器进行关联4:路由特性的使用2：参数绑定
Route::get('member/{info}',array(
	'uses'=>'MemberController@info2',
	)
);

Route::get('student/test1','StudentController@test1');

Route::get('student/insert1','StudentController@insert1');

Route::get('student/update1','StudentController@update1');

Route::get('student/delete1','StudentController@delete1');

Route::get('student/select1','StudentController@select1');

Route::get('student/query','StudentController@query');

Route::get('student/orm1','StudentController@orm1');

Route::get('student/orm2','StudentController@orm2');
