<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

include_once(G5_LIB_PATH.'/thumbnail.lib.php');

$sql = " select * from {$g5['board_table']} where bo_table = '{$bo_table}' ";
$board = sql_fetch($sql);
	
if (!$width) $width = 180;
if (!$height) $height = 132;

$listHtml_s = "";

$indexNum = 0;

for ($i=0; $i<count($list); $i++) {
	$indexNum ++;
	$thumb = get_list_thumbnail($board['bo_table'], $list[$i]['wr_id'], $width, $height);
	$cut_content = cut_str(strip_tags($list[$i]['wr_content']),50);
	$cut_content2 = cut_str(strip_tags($list[$i]['wr_subject']),15);

// 서명
	$sid = $list[$i]['mb_id'];
	$mb1_dir = substr($sid,0,2);
	$mb_img = G5_DATA_URL.'/member_image/'.$mb1_dir.'/'.$sid.'.gif';
//


	$listHtml_s .= "
	<a href='".$list[$i]['href']."' style='display:block'>
	<div class='over_cope_story' id='over_story".$indexNum."'style='cursor:pointer; width:180px; height:300px; margin:0px; 	float:left;background: #ffffff;'>";

	$listHtml_s .= "
	<table>
		<tr>
			<td height='125' style='background: url(".$thumb['src'].") no-repeat center center; '></td>
		</tr>";

	$listHtml_s .= "
	<tr>
		<td style='background-color:;'>
			<table style='ont-size: 12px; width:170px; height:112px; margin-top:5px;'>
				<tr>
					<td style='line-height: 27px; font-size: 15px; letter-spacing: -2px; overflow: hidden; text-align:left; text-overflow: ellipsis; white-space: nowrap; font-weight: bold;'>".$cut_content2."</td>
				</tr>
				<tr>
					<td colspan='2' style='font-size: 12px; white-space: normal; line-height: 20px; height: 60px; text-align: left; word-wrap: break-word; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;    overflow: hidden; margin-top:5px; color:#626262; text-align:left;'>".$cut_content."</td>
				</tr>
				<tr>
					<tr style='text-align:left; float:left;'>
				<td style='text-align:left;'><img src='".$mb_img."' style='width:30px; margin-right:5px;'></td>
				<td style='text-align:left; font-size:12px; '><p>by  ".$list[$i]['name']."</p></td>
				</tr>
			</table>
		</td>
	</tr>
	</table>";
	$listHtml_s .= "
	</div>
	</a>";
	
}
echo $listHtml_s;

if (count($list) == 0) { //게시물이 없을 때
		echo "<li>게시물이 없습니다.</li>";
}
?>