<?php
//exit("<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />生成索引中，明天再来吧~");
// 引用sphinxapi类
require ( "sphinxapi.php" );
require ( "./include/safe.php" );
require ( "./include/conn.php" );
if (isset($_COOKIE['user'])&& !empty($_COOKIE['usercookie'])) {
$username=post_check($_COOKIE['user']);
$sql="select * from md5_user where username='$username'";
$rrss=mysql_query($sql);
$r=mysql_fetch_assoc($rrss);
$cookie=md5(sha1($r['username']).$r['password']);
if ($_COOKIE['usercookie']==$cookie) {
$use=$r['username'];
}else{

$use="游客";
}
}else{
$use="游客";
}
 
//关闭错误提示
error_reporting(E_ALL & ~E_NOTICE);
$num = 0;
if(!empty($_GET)&&!empty($_GET['q'])){

if(strlen(trim($_GET['q']))<4){ 
exit("<script language='javascript' type='text/javascript'>alert('关键字不能少于4个,你想卡死我啊？');window.location.href='sgk1.php';</script>");

}
if($use!=="游客"){
if($r['jb']>=3){
mysql_query("update md5_user set jb=jb-3 where username='$username'");

}

}
	$Keywords=strip_tags(trim($_GET['q']));

	$Keywords=sgk_replace($Keywords);
	$cl = new SphinxClient ();
	// 返回结果设置
	$opts = array
	(
		"before_match"		=> "",
		"after_match"		=> "",
		"chunk_separator"	=> " ... ",
		"limit"				=> 150,
		"around"			=> 3,
	);
	$cl->SetServer ('127.0.0.1', 9312);
	$cl->SetConnectTimeout ( 3 );
	$cl->SetArrayResult ( true );
	// 设置是否全文匹配
	if(!empty($_GET)&&!empty($_GET['f'])){
	//$cl->SetMatchMode(SPH_MATCH_ANY);	
$cl->SetMatchMode(SPH_MATCH_PHRASE);	
	//$cl->SetMatchMode(SPH_MATCH_ALL);
	}
	else
	{
	$cl->SetMatchMode(SPH_MATCH_ALL);
		
	}
	if(!empty($_GET)&&!empty($_GET['p'])){
		$p = !intval(trim($_GET['p']))==0?intval(trim($_GET['p']))-1:0;
		$p = $p *20;
		// 我在csft.conf 设置了最大返回结果数2000。但是我在生成页码的时候 最多生成20页，我想能满足大部分搜索需求了。
		// 以下语句表示从P参数偏移开始每次返回20条。
		$cl->setLimits($p,20);
	}
	else
	{
		$cl->setLimits(0,20);
	}
	
	$res = $cl->Query ( ".$Keywords.", "*" );
							

	if ( is_array($res["matches"]) )
	{
		foreach ( $res["matches"] as $docinfo )
		{
			$ids = $ids.$docinfo[id].',';
		}
		$ids = rtrim($ids,','); 
		$sql = "select * from md5_sgk where id in($ids)";		//注意修改表名
		mysql_query("set names utf8");
		$ret = mysql_query($sql);
		$num = mysql_num_rows($ret);
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-CN">

﻿﻿﻿
<!--
╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳
╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳
╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳
╳╳▓▓▓▓╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳▓▓╳╳╳╳╳╳▓╳╳╳╳╳╳╳╳╳
╳▓╳╳╳▓╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳▓╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳
╳▓╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳▓╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳
╳╳▓▓╳╳╳▓▓╳▓▓╳▓▓▓▓╳╳╳▓▓▓▓╳╳▓▓▓╳╳╳▓▓╳╳╳╳╳▓▓╳╳
╳╳╳╳▓╳╳╳▓╳╳▓╳╳▓╳╳▓╳╳▓╳╳╳╳╳▓╳╳▓╳╳╳▓╳╳╳╳▓╳╳▓╳
╳╳╳╳╳▓╳╳▓╳╳▓╳╳▓╳╳▓╳╳╳▓▓╳╳╳▓╳╳▓╳╳╳▓╳╳╳╳▓▓▓▓╳
╳▓╳╳╳▓╳╳▓╳╳▓╳╳▓╳╳▓╳╳╳╳╳▓╳╳▓╳╳▓╳╳╳▓╳╳╳╳▓╳╳╳╳
╳▓▓▓▓╳╳╳╳▓▓▓▓▓▓▓╳▓▓╳▓▓▓▓╳▓▓▓╳▓▓╳▓▓▓╳╳╳╳▓▓▓╳
╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳
╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳╳


-->

<head>
<title>社工库-密码泄露查询</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="Author" content="Ph4nt0m" />
      <meta name="description" content="本社工库所有数据均来至网络,程序采用Php+Mysql+Sphinx,本社工库仅作技术交流之用,不可用于不良用途!">
        <meta name="keywords" content="社工库,密码查看器,MD5库,密码泄露查询,密码安全,密码泄露,社工数据库,社工数据,社工密码,泄漏密码">

<link rel="stylesheet" type="text/css" href="html/default.css" />
	<style type="text/css">
	body,td,th {
	color: #FFF;
}
    a:link {
	color: #0C0;
	text-decoration: none;
}
    body {
	background-color: #000;
}
    a:visited {
	text-decoration: none;
	color: #999;
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: none;
	color: #F00;
}
.pages{
	clear: both;
	text-align: right;
	padding: 8px 0;
}
.pages a{
	display: inline-block;
	height: 20px;
	line-height: 20px;
	border: 1px solid #228B22;
	padding: 0 8px;
	color: #228B22;
	margin: 5px 2px;
	background: #2F2F2F;
}
.pages a:hover{
	background: #228B22;
	color: white;
}
.pages span {
	display: inline-block;
	height: 20px;
	line-height: 20px;
	border: 1px solid #228B22;
	padding: 0 8px;
	margin: 5px 2px;
	background: #228B22; /*#228B22;*/
	color: white;	
}
#create_form label{
	margin-left: 10px;
}
#create_form em{
	margin-left: 60px;
}
    </style>
<script>
<!--
    function check(form){
if(form.q.value==""){
  alert("Not null！");
  form.q.focus();
  return false;
 }
}
-->
</script>
	</head>
	<body>
	<?php echo "当前登录用户：<font color=red>$use</font>"; ?><a href="user.php">[login]</a>
	<div id="container"><div id="header"><h1><a href='sgk1.php'>Sunshie社工库</a></h1></div><br /><br />
	<form name="from"action="" method="GET">
			<div id="content"><div id="create_form"><p><em></em><label for=""><input type="checkbox" name="f" value="1" <?php echo !empty($_GET['f'])?'checked':''; ?>/>模糊匹配</label>
			
			</p><p style="text-align:center;margin:0 auto;"><label><input class="inurl" size="26" id="unurl" name="q" value="<?php echo strip_tags(trim($_GET['q'])); ?>"/></label><span class="but"><input onclick="check(form)" type="submit" value="Search" class="submit" /></span></p>
		</form></div>﻿
		<?php	
			if (!$num == 0){
				echo "<br/>找到与&nbsp{$Keywords}&nbsp相关的结果 {$res[total_found]} 个。用时 {$res[time]} 秒。（密码泄露啦，赶紧修改密码吧~， QQ群:188062431 ）<ol>";
					if($use=="游客" or $r['jb']<3){
					
					
					if($use!=="游客" and $r['jb']<3){
					echo "骚年，你的金币不足三个，查询是会带星号的哦";
					}
				 
					
					 }else{
					 $jjb=$r['jb']-3;
					 echo "<font color=red>JB -3个</font>&nbsp剩余jb:".$jjb;
					 
					 }
				while ($row = mysql_fetch_assoc($ret)) {
					 /**$sql2 = "SELECT * FROM md5_sgk WHERE id =".$row['did'];  // 这里的表名也改改。根据数据库ID名查找数据库名称的。
					 $ret2 = mysql_query($sql2);
					 **/
					 $retContent = $cl->BuildExcerpts($row,"test1",$Keywords,$opts);
					 //echo '<li><font color=228B22>From_['.mysql_result($ret2, 0,"dataname").'_Datas]</font> <br /><font color=#00CD00>Content:</font>　'.$retContent[2].'</li><br/>';
					 
					if($use=="游客" or $r['jb']<3){
					
					
				
				 
					$retContent[1]=substr($retContent[1],0,2)."************".substr ($$retContent[1],-2);
					 $retContent[2]=substr($retContent[2],0,2)."************".substr ($$retContent[2],-2);
					 $retContent[3]=substr($retContent[3],0,2)."************".substr ($$retContent[3],-2);
					 //$retContent[5]=substr($retContent[5],0,2)."************".substr ($$retContent[5],-2);
					 }
					 
					
					 echo '<li><font color=228B22>From_['.$retContent[5].'_Data]-md5.phpinfo.me</font> <br /><font color=#00CD00>Content:</font>&nbsp;<font color=#D9006C>user：</font><b>'.htmlspecialchars($retContent[1])."</b>&nbsp;<font color=#D9006C>password：</font>".htmlspecialchars($retContent[2])."&nbsp;<font color=#D9006C>email：</font><b>".htmlspecialchars($retContent[3])."</b>&nbsp;<font color=#D9006C>salt:</font><b>".htmlspecialchars($retContent[4]).'</b></li><br/>';
					}
				echo '</ol>';
			} 
			else
			{
				if(!empty($_GET)&&!empty($_GET['q'])){
					echo "<br/>找不到与&nbsp{$Keywords}&nbsp相关的结果。请更换其他关键词试试。";
				    echo '<ul><hr align="center" width="550" color="#2F2F2F" size="1"><font color=#ff0000>We cannot guarantee the entirely accurate,please voluntarily judge.';
					echo '<br />The data is not complete? Do you want to add or remove it?';
					echo '<br />Contact Email:root@phpinfo.me</font>';
					echo '</ul>';					
				}
			}

		?>
		<div class="pages">
			<?php
			if(!$num == 0){
				$pagecount = (int)($res[total_found] / 20);
				if(!($res[total_found] % 20)==0){ 
					$pagecount = $pagecount + 1;
				}
				if($pagecount>20){
					$pagecount = 20;
				}
				$highlightid = !intval(trim($_GET['p']))==0?intval(trim($_GET['p'])):1;
				// if($highlightid==0){ $highlightid = 1;}
				for ($i=1; $i <= $pagecount; $i++) { 
					if($highlightid==$i){
						echo "<span>{$i}</span>";
					}
					else
					{
						echo "<a href=\"sgk1.php?q={$Keywords}&p={$i}\">{$i}</a>";
					}
					
				}				
			}
			?>
		</div>
		<div id="nav">
		<ul><li class="current"><a href="http://md5.phpinfo.me">首页</a></li><li><a href="http://phpinfo.me" target="_blank">blog</a></li></ul>
		</div>
<div id="footer">
<p>本社工库所有数据均来至于互联网，切勿用于非法用途... <br> &copy;2010-2014</p><script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_5851843'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s5.cnzz.com/stat.php%3Fid%3D5851843%26show%3Dpic' type='text/javascript'%3E%3C/script%3E"));</script>
</div>
</div>
</body>
</html>