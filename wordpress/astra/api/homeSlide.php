<?php
header('Access-Control-Allow-Headers:x-requested-with,content-type'); 
//����WP�����ļ�������֮��Ϳ���ʹ��WP�����к��� 
require( '../../../../wp-load.php' );

//���巵�����飬Ĭ����Ϊ��
$data=[];

// ʹ��wp�Ĳ�ѯ���º�����ѯ����ƪ�õ�Ƭ����
// 1�������ѯ����
$args = array( 
	'post_type'=>'post',  //��ѯ��������
	'post_status'=>'publish', //��ѯ����״̬
	'post__in' => get_option('sticky_posts'),//ȷ�����õ����ö������б�
	'caller_get_posts' => 1
);
// 2����ʼ��ѯ����
query_posts($args);
if (have_posts()){ //�����ѯ����������
	// ��������������ݵ�����
	$posts=[];
	// ѭ����������
	while ( have_posts() ) : the_post();
		// ��ȡ����id
		$post_id=get_the_ID();
		// ���嵥����������Ҫ������
		$list=[
			"id"=>$post_id,  //����id
			"title"=>get_the_title(), //���±���
			"img"=>get_the_post_thumbnail_url() //��������ͼ
		];
		// ��ÿһ�����ݷֱ���ӽ�$posts
		array_push($posts,$list);
	endwhile;
	// ���巵��ֵ
	$data['code']=200;
	$data['msg']="��ѯ���ݳɹ���";
	$data['post']=$posts;
}else {
	// ���û������
	$data['code']=404;
	$data['msg']="û���������";
	$data['post']=[];
}
// ����json���ݸ�ʽ
print_r(json_encode($data));
?>