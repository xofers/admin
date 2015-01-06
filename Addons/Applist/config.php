<?php
return array(
	'title'=>array(//配置在表单中的键名 ,这个会是config[title]
		'title'=>'显示标题:', //表单的文字
		'type'=>'text',		 //表单的类型：text、textarea、checkbox、radio、select等
		'value'=>'列表信息',	 //表单的默认值
	),
	'display'=>array(
		'title'=>'是否显示:',
		'type'=>'radio',
		'options'=>array(
			'1'=>'显示',
			'0'=>'不显示'
		),
		'value'=>'1'
	),
	'actControl'=>array(
		'title'=>'是否开启时间控制开关:',
		'type'=>'radio',
		'options'=>array(
			'1'=>'开启',
			'0'=>'关闭'
		),
		'value'=>'1'
	)
);
