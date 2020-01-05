<?php

namespace App\Http\Controllers;//命名空间
use Illuminate\Support\Facades\DB;
use App\Student;
class StudentController extends Controller//继承Controller控制器
{
	//原生sql赠删除查改
	public function test1()
	{
		/*查找*/
		$student = DB::select('select * from student');
		dd($student);//返回的是一个数组

		/*插入*/
		$bool = DB::insert('insert into student(name,age) values(?,?)',array('ryh',18));
		var_dump($bool);
		//$bool = DB::insert('insert into student(name,age,sex) values(?,?,?)',array('张营',21,'女'));
		//var_dump($bool);

		/*更新*/
		$num = DB::update('update student set age = :age where name = :name',array('age'=>20,'name'=>'sean'));
		var_dump($num);//返回的是影响的行数

		/*删除*/
		$num = DB::delete('delete from student where id=:id',array('id'=>4));
		var_dump($num);

	}
	//使用查询构造器插入数据
	function insert1()
	{
		//插入
		//$bool = DB::table('student')->insert(array('name'=>'梁英甲','age'=>21,'sex'=>'女'));
		//var_dump($bool);

		//插入一条数据并返回最后才Haru的主键自增ID
		/*$id = DB::table('student')->insertGetId(array('name'=>'张营','age'=>21,'sex'=>'女'));
		var_dump($id);*/
		//一次插入多条数据
		$bool = DB::table('student')->insert(array(
			array('name'=>'name1','age'=>21,'sex'=>'女'),
			array('name'=>'name2','age'=>22,'sex'=>'男'),
		));
		var_dump($bool);
	}
	//使用查询构造器删除数据
	function update1()
	{
		//修改指定数据的某些条件
		$num = DB::table('student')->where('name','=','name1')->update(array('sex'=>'女'));
		var_dump($num);
	}
	//使用查询构造器删除数据
	function delete1()
	{
		//delete
		$num = DB::table('student')->where('id','>',17)->delete();
		var_dump($num);
		//truncate
		DB::table('student')->truncate();
	}
	//使用查询构造器查询数据
	function select1()
	{
		//get()  :查询数据库表中的所有数据
		//$students = DB::table('student')->get();
		//var_dump($students);
		
		//first :查询结果集中的第一条数据
		//$students = DB::table('student')->first();
		//var_dump($students);
		
		//where() :查询满足条件的数据，如果是多条数据用whereRaw
		//$students = DB::table('student')->where('id','>',2)->get();
		//var_dump($students);
		
		//whereRaw 多条件查询
		//$students = DB::table('student')->whereRaw('id >? and age > ?',array(2,23))->get();
		//var_dump($students);
		
		//pluck() 返回结果集中指定的字段
		//$students = DB::table('student')->pluck('name');
		//var_dump($students);
		
		//lists和pluck类似，区别是lists可以指定某一个字段作为下标，并按下标排序
		//$students = DB::table('student')->lists('name','id');
		//var_dump($students);

		//select()查询指定的字段 select+get=pluck 
		//$students = DB::table('student')->select('id','name','age')->get();
		//var_dump($students);

		//chunk 查询指定数目的数据
		DB::table('student')->chunk(2,function($students)
			{
				var_dump($students);
			}
		);
	}
	//聚合函数
	function query()
	{
		//1、count 返回多少个数目
		$num = DB::table('student')->count();
		var_dump($num);

		//2、max() 最大值
		$max = DB::table('student')->max('age'); 
		var_dump($max);
		//3、min() 最小值
		$min = DB::table('student')->min('age'); 
		var_dump($min);

		//4、avg() 平均数
		$avg = DB::table('student')->avg('age'); 
		var_dump($avg);

		//5、sum() 求和
		$sumage = DB::table('student')->sum('age'); 
		var_dump($sumage);
	}
	public function orm1()
	{
		//返回的是一个集合 all():查询表的所有记录
		//$students = Student::all();
		//var_dump($students);
		
		//find  查找指定的数据
		//$student = Student::find(6);
		
		//findOrFail() 根据id查找。查找不到则返回错误
		//$student = Student::findOrFail(10);
		
		//查询构造器在orm中的使用
		//get() 查询所有的
		//$students = Student::get();
		
		//first() 取第一条
		//$student = Student::where('id','>',4)->orderBy('age','desc')->first();
		
		//chunk()的使用
		/*$student = Student::chunk(2,function($students)
			{
				var_dump($students);
			}
		);*/

		//聚合函数1：count		
		$num = Student::count();
		var_dump($num);

		//聚合函数2:max
		$num = Student::where('id','>',4)->max('age');
		var_dump($num);

		//聚合函数2:min
		$num = Student::min('age');
		var_dump($num);
	}
	//ORM新增数据、自定义时间戳及批量赋值的使用
	function orm2()
	{
		//使用模型新增数据
		$student = new Student();
		$student->name = 'ryh';
		$student->age = 20 ;
		//print_r($student->save());//保存数据 
		
		$student = Student::find(6);
		dd($student);
	}
}