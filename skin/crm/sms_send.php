
<?php
include_once('./_common.php');
include_once(G5_LIB_PATH.'/icode.lms.lib.php'); 

$sql = " select * from $g5[member_table] where mb_id = '$stx' "; 
$result = sql_query($sql); 
$row=sql_fetch_array($result);

$sHp = "029512275"; // 발송번호
$rHp = $row[mb_hp]; // 수신번호
$msg = '[퍼스트원교정치과]'.$row[mb_name].'('.$row[mb_id].')님의 새로운 올소스토리가 등록되었습니다. http://first1ortho.com (예약일 변경은 전화만 가능합니다)';  //발송내용

if (lmsSend($sHp,$rHp,$msg)) 
   alert('상담 신청이 완료되었습니다');
else
   alert('상담 신청 오류 관리자 문의 요망');
?>


