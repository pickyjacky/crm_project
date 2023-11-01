
<?php
		include_once('./_common.php');
		include_once(G5_LIB_PATH.'/icode.lms.lib.php'); 


			$sql15 = " select * from $g5[member_table] where mb_id = 'admin'";
			$res15=sql_query( $sql15);
			$row15= sql_fetch_array( $res15);
			//echo $row5[mb_hp];

			$sql = " select * from $g5[member_table] where mb_id = '$wr_1' "; 
			$result = sql_query($sql); 
			$row=sql_fetch_array($result);

			if($member[mb_level] == '10'){
				$sHp = "029512275"; // 발송번호
					
				if($row[mb_hp]){ $rHp = $row[mb_hp]; };// 환자 핸드폰
				if(!$row[mb_hp]){ $rHp = $row[mb_8]; };// 보호자 핸드폰 번호
					
				$msg = '[퍼스트원교정치과]'.$row[mb_name].'('.$row[mb_id].')님 올소스토리에 새로운 댓글이 등록되었습니다. '.$wr_8.' (예약일 변경은 전화만 가능합니다)';  //발송내용
			if (lmsSend($sHp,$rHp,$msg)) 
			   alert('문자가 정상적으로 발송되었습니다.');
			else
			   alert('문자 발송 오류 관리자 문의 요망');
			};

			if($member[mb_level] == '6'){
				$sHp = "029512275"; // 발송번호
				$rHp = $row15[mb_hp]; // 수신번호 원장님 번호 / admin 에 등록된 휴대폰 번호로 발송됨(모바일 스킨에서 소스도 변경해야함)
				$msg = '[퍼스트원교정치과]'.$row[mb_name].'('.$row[mb_id].')님 올소스토리에 새로운 댓글이 등록되었습니다. '.$wr_8.' ';  //발송내용
			if (lmsSend($sHp,$rHp,$msg)) 
			   alert('문자가 정상적으로 발송되었습니다.');
			else
			   alert('문자 발송 오류 관리자 문의 요망');
			};

?>
