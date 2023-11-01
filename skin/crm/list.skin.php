<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);


?>

<style>
.btn_bo_user { margin-top: -30px; }
</style>


<!-- 게시판 목록 시작 { -->
<div id="bo_gall" style="max-width:900px; min-width: 320px; width:100%; margin:0 auto -100px;">

    <?php if ($is_category) { ?>
    <nav id="bo_cate">
        <h2><?php echo $board['bo_subject'] ?> 카테고리</h2>
        <ul id="bo_cate_ul">
            <?php echo $category_option ?>
        </ul>
    </nav>
    <?php } ?>

    <form name="fboardlist"  id="fboardlist" action="<?php echo G5_BBS_URL; ?>/board_list_update.php" onsubmit="return fboardlist_submit(this);" method="post">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="spt" value="<?php echo $spt ?>">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="sw" value="">

    <!-- 게시판 페이지 정보 및 버튼 시작 { -->
    <div id="bo_btn_top">
        <!-- <div id="bo_list_total">
            <span>Total <?php echo number_format($total_count) ?>건</span>
            <?php echo $page ?> 페이지
        </div> -->
      
        <?if($is_admin || $member[mb_level] >=9){?>
        <div class="ortho_sch">
            <button type="button" class="btn_bo_sch btn_b01 btn" title="게시판 검색"><i class="fa fa-search" aria-hidden="true"></i><span class="">차트번호를 먼저 검색해주세요.</span></button>
        </div>
        <?}?>
        <?if($stx){?>
        <?if($is_admin || $member[mb_level] >=9 ){?>        
            <a href="/bbs/board.php?bo_table=ortho_story" style="font-size:16px;"><img src="/theme/basic/svg/back.svg" alt="">차트 전체보기</a>        
        <?}?>
        <?}?>

    </div>
    <!-- } 게시판 페이지 정보 및 버튼 끝 -->

      
    <? // 검색된 회원 정보 가져오기
    $sql1="select * from {$g5['member_table']} where mb_level=6 and mb_id = '$stx' order by mb_name ";
    $res1=sql_query( $sql1);
    $row= sql_fetch_array( $res1);
    ?>


    <? // 치료시작일
    $date1 = substr($row['mb_10'],0,10); //날짜표시형식변경
    $date = explode("-", $date1);
    $year = $date[0];
    $month = $date[1];
    $day = $date[2];
    $latest_date = substr($year,2,4)."".$month."".$day;
    ?>
    <? //치료종료일
    $d_day2 = floor((strtotime($row['mb_1']) -
      strtotime(date('Y-m-d'))) / 86400);
    if ($d_day2 < 0) {
      $d_day2 = '<div class="event_btn event_end">치료종료</div>';
    } else {
      $d_day2 = '<div class="event_btn event_ongoing">D-' . $d_day2 . '</div>';
    }
    ?>
    <? // 만나이 계산
    $birth_time   = strtotime($row['mb_1']);
    $now          = date('Y');
    $birthday     = date('Y' , $birth_time);
    $age           = $now - $birthday - 1  ;
    ?>

    <br><br>
    <?if(!$is_admin && $member[mb_level] <=8){?>
    <div class="ortho_info_wrap">
        <div class="ortho_pf">
            <p class="g8"><?= $row[mb_name]?></p>
        </div>
        <div class="ortho_info">
            <div class="ortho_info2">
                <span class="dm fw700"><?php echo $latest_date ?></span>
                <p>치료 시작일</p>
            </div>
            <div class="ortho_info3">
                <span class="dm fw700"><?php echo number_format($total_count) ?></span>
                <p>스토리</p>
            </div>
            <div class="ortho_info4">
                <span class="dm fw700"><?= $d_day2 ?></span>
                <p>남은 기간</p>
            </div>
        </div>
    </div>

    <div class="customer_info_wrap">
        <div class="customer_info1">
            <p class="fw700">CASE</p>
            <p><?= $row[mb_2]?></p>
        </div>
        <div class="customer_info2">
            <p class="fw700">치료형태</p>
            <p><?= $row[mb_3]?></p>
        </div>
        <div class="customer_info3">
            <p class="fw700">사용장치</p>
            <p><?= $row[mb_4]?></p>
        </div>
    </div>
   <?}?>

   <br><br>
   <?if($is_admin || $member['mb_level'] >=9 ){?>
    <div class="ortho_info_wrap">
        <div class="ortho_pf">
            <p class="g8"><?= $row['mb_name']?></p>
        </div>
        <div class="ortho_info">
            <div class="ortho_info2">
                <span class="dm fw700"><?php echo $latest_date ?></span>
                <p>치료 시작일</p>
            </div>
            <div class="ortho_info3">
                <span class="dm fw700"><?php echo number_format($total_count) ?></span>
                <p>스토리</p>
            </div>
            <div class="ortho_info4">
                <span class="dm fw700"><?= $d_day2 ?></span>
                <p>남은 기간</p>
            </div>
        </div>
    </div>

    <div class="customer_info_wrap">
	 <div class="admin_info">
            <p class="fw700">차트번호</p>
            <p><?= $row['mb_id']?></p>
        </div>
        <div class="admin_info">
            <p class="fw700">환자정보</p>
            <p><?= $row['mb_name']?>(<?=$row['mb_1']?>) / <span class="dm"><?= $row['mb_9']?> </span>(만 <span class="dm"><?=$age?></span>세)</p>
        </div>
        <div class="admin_info">
            <p class="fw700">전화번호</p>
            <p class="dm"><?= $row['mb_hp']?> <? if($row['mb_8']) {?>보호자: <?= $row['mb_8']?> <? } ?></p>
        </div>
        <div class="customer_info1">
            <p class="fw700">CASE</p>
            <p><?= $row['mb_2']?></p>
        </div>
        <div class="customer_info2">
            <p class="fw700">치료형태</p>
            <p><?= $row['mb_7']?>, <?= $row['mb_3']?>, <?= $row['mb_5']?>, <?= $row['mb_6']?></p>
        </div>
        <div class="customer_info3">
            <p class="fw700">사용장치</p>
            <p><?= $row['mb_4']?></p>
        </div>
    </div>
   <?}?>

<?if($sfl=='wr_2'){?>
<br><br>
<div style="width:100%; text-align:center; color:red; font-size:20px;">환자명으로 검색하신 경우 아래 목록에서 "올소스토리 아이콘" 을 선택하신 후<br>"환자 정보가 나오는 화면"으로 이동 후 새글을 작성해주세요.</div>
<?}?>

<br><br>
   <?php if ($is_checkbox) { ?>
    <div id="gall_allchk" class="all_chk chk_box">
        <input type="checkbox" id="chkall" onclick="if (this.checked) all_checked(true); else all_checked(false);" class="selec_chk">
    	<label for="chkall">
        	<span></span>
        	<b class="sound_only">현재 페이지 게시물 </b> 전체선택
        </label>
    </div>
    <?php } ?>
    <?if($is_admin || $member[mb_level] >=9 ){?>     
        <ul class="btn_bo_user">
        	<?php if ($admin_href) { ?><li><a href="<?php echo $admin_href ?>" class="btn_admin btn" title="관리자"><i class="fa fa-cog fa-spin fa-fw"></i><span class="sound_only">관리자</span></a></li><?php } ?>
            <?php if ($rss_href) { ?><li><a href="<?php echo $rss_href ?>" class="btn_b01 btn" title="RSS"><i class="fa fa-rss" aria-hidden="true"></i><span class="sound_only">RSS</span></a></li><?php } ?>
            <!-- <li>
            	<button type="button" class="btn_bo_sch btn_b01 btn" title="게시판 검색"><i class="fa fa-search" aria-hidden="true"></i><span class="sound_only">게시판 검색</span></button> 
            </li> -->
            <?if($sfl=='wr_1'){?>
           <?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>&stx=<?=$stx?>" class="btn_b01 btn" title="글쓰기"><i class="fa fa-pencil" aria-hidden="true"></i><span class="sound_only">글쓰기</span></a></li><?php } ?>
           <?}?>
        	<?php if ($is_admin == 'super' || $is_auth) {  ?>         
        	<li>
        		<button type="button" class="btn_more_opt is_list_btn btn_b01 btn" title="게시판 리스트 옵션"><i class="fa fa-ellipsis-v" aria-hidden="true"></i><span class="sound_only">게시판 리스트 옵션</span></button>
        		<?php if ($is_checkbox) { ?>	
		        <ul class="more_opt is_list_btn">  
		            <li><button type="submit" name="btn_submit" value="선택삭제" onclick="document.pressed=this.value"><i class="fa fa-trash-o" aria-hidden="true"></i> 선택삭제</button></li>
		            <li><button type="submit" name="btn_submit" value="선택복사" onclick="document.pressed=this.value"><i class="fa fa-files-o" aria-hidden="true"></i> 선택복사</button></li>
		            <li><button type="submit" name="btn_submit" value="선택이동" onclick="document.pressed=this.value"><i class="fa fa-arrows" aria-hidden="true"></i> 선택이동</button></li>
		        </ul>
		        <?php } ?>
        	</li>
        	<?php }  ?>
        </ul>
        <?php }  ?>
    

    <ul id="gall_ul" class="gall_row">
        <?php for ($i=0; $i<count($list); $i++) {

            $classes = array();
            
            $classes[] = 'gall_li';
            $classes[] = 'col-gn-'.$bo_gallery_cols;

            if( $i && ($i % $bo_gallery_cols == 0) ){
                $classes[] = 'box_clear';
            }

            if( $wr_id && $wr_id == $list[$i]['wr_id'] ){
                $classes[] = 'gall_now';
            }
         ?>
     
     
       <li class="<?php echo implode(' ', $classes); ?>">
       
            <div class="gall_box">
                <div class="gall_chk">
                <?php if ($is_checkbox) { ?>
                <label for="chk_wr_id_<?php echo $i ?>" class="sound_only"><?php echo $list[$i]['subject'] ?></label>
                <input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>">
                <?php } ?>
                <span class="sound_only">
                    <?php
					if ($list[$i]['is_notice']) // 공지사항
						echo '<strong class="notice_icon"><i class="fa fa-bullhorn" aria-hidden="true"></i><span class="sound_only">공지</span></strong>';
					else if ($wr_id == $list[$i]['wr_id'])
						echo "<span class=\"bo_current\">열람중</span>";
					else
						echo $list[$i]['num'];
					 ?>
                </span>
                </div>
                <div class="gall_con">
                <?if($is_admin && $member[mb_level] >=9){?>
                    <div class="gall_pos">
                        <small><?=$list[$i]['wr_1']?></small>
                        <p><?=$list[$i]['wr_2']?></p>
                    </div>
                    <div class="gall_more">
                         <a href="/bbs/board.php?bo_table=ortho_story&page=&sca=&sfl=wr_1&stx=<?=$list[$i][wr_1]?>"><img src="/theme/basic/svg/ortho_story.svg" alt=""></a>
                    </div>
                <?}?>
                    <div class="gall_img">
                        <a href="<?php echo $list[$i]['href'] ?>">
                      <?
                            $thumb = get_list_thumbnail($board['bo_table'], $list[$i]['wr_id'], $board['bo_gallery_width'], $board['bo_gallery_height'], false, true);
                            $cut_content = cut_str(strip_tags($list[$i]['wr_content']),50);

                            if($thumb['src']) {
                              echo '<img src="'.$thumb['src'].'" alt="'.$thumb['alt'].'">';
                           
                            } else {
                                echo '<p style="padding:0 20px;">'.$cut_content.'</p>';
                            }

                         ?>
                        
                        </a>
                
                        
                    </div>
                    <div class="gall_text_href">       
                                   

						<?php
                        if ($is_category) {
                         ?>
                        <?php } ?>					
	
                        <a href="<?php echo $list[$i]['href'] ?>" class="bo_tit">			
                            <?php if ($list[$i]['comment_cnt']) { ?>
                                <div class="ortho_comment">
                                    <img src="/theme/basic/svg/comment_w.svg" alt="">
                                <span class="cnt_cmt"><?php echo $list[$i]['wr_comment']; ?></span>
                               </div>
                            <?php } ?>                          
                         </a>
                    </div>                  	
                </div>
				
            </div>

        </li>
        <?php } ?>
        <?php if (count($list) == 0) { echo "<li class=\"empty_list\">게시물이 없습니다.</li>"; } ?>
    </ul>
	
	<!-- 페이지 -->
	<?php echo $write_pages; ?>
	<!-- 페이지 -->
	
	<?php if ($list_href || $is_checkbox || $write_href) { ?>
    <div class="bo_fx">
        <?php if ($list_href || $write_href) { ?>
        <ul class="btn_bo_user">
        	<?php if ($admin_href) { ?><li><a href="<?php echo $admin_href ?>" class="btn_admin btn" title="관리자"><i class="fa fa-cog fa-spin fa-fw"></i><span class="sound_only">관리자</span></a></li><?php } ?>
            <?php if ($rss_href) { ?><li><a href="<?php echo $rss_href ?>" class="btn_b01 btn" title="RSS"><i class="fa fa-rss" aria-hidden="true"></i><span class="sound_only">RSS</span></a></li><?php } ?>
        </ul>	
        <?php } ?>
    </div>
    <?php } ?> 
    </form>

    <!-- 게시판 검색 시작 { -->
    <div class="bo_sch_wrap">	
        <fieldset class="bo_sch">
            <h3>검색</h3>
            <form name="fsearch" method="get">
            <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
            <input type="hidden" name="sca" value="<?php echo $sca ?>">
            <input type="hidden" name="sop" value="and">
            <label for="sfl" class="sound_only">검색대상</label>
            <select name="sfl" id="sfl">
                <?php //echo get_board_sfl_select_options($sfl); ?>
                <option value="wr_1"<?php echo get_selected($sfl, 'wr_1', true); ?>>차트번호</option>
                <option value="wr_2"<?php echo get_selected($sfl, 'wr_2', true); ?>>환자명</option>
            </select>
            <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
            <div class="sch_bar">
                <input type="text" name="stx" value="<?php echo stripslashes($stx) ?>" required id="stx" class="sch_input" size="25" maxlength="20" placeholder="차트번호 5자리를 입력해주세요">
                <button type="submit" value="검색" class="sch_btn"><i class="fa fa-search" aria-hidden="true"></i><span class="sound_only">검색</span></button>
            </div>
            <button type="button" class="bo_sch_cls"><i class="fa fa-times" aria-hidden="true"></i><span class="sound_only">닫기</span></button>
            </form>
        </fieldset>
        <div class="bo_sch_bg"></div>
    </div>
    <script>
        // 게시판 검색
        $(".btn_bo_sch").on("click", function() {
            $(".bo_sch_wrap").toggle();
        })
        $('.bo_sch_bg, .bo_sch_cls').click(function(){
            $('.bo_sch_wrap').hide();
        });
    </script>
    <!-- } 게시판 검색 끝 -->
</div>

<?php if($is_checkbox) { ?>
<noscript>
<p>자바스크립트를 사용하지 않는 경우<br>별도의 확인 절차 없이 바로 선택삭제 처리하므로 주의하시기 바랍니다.</p>
</noscript>
<?php } ?>

<?php if ($is_checkbox) { ?>
<script>
function all_checked(sw) {
    var f = document.fboardlist;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]")
            f.elements[i].checked = sw;
    }
}

function fboardlist_submit(f) {
    var chk_count = 0;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]" && f.elements[i].checked)
            chk_count++;
    }

    if (!chk_count) {
        alert(document.pressed + "할 게시물을 하나 이상 선택하세요.");
        return false;
    }

    if(document.pressed == "선택복사") {
        select_copy("copy");
        return;
    }

    if(document.pressed == "선택이동") {
        select_copy("move");
        return;
    }

    if(document.pressed == "선택삭제") {
        if (!confirm("선택한 게시물을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다\n\n답변글이 있는 게시글을 선택하신 경우\n답변글도 선택하셔야 게시글이 삭제됩니다."))
            return false;

        f.removeAttribute("target");
        f.action = g5_bbs_url+"/board_list_update.php";
    }

    return true;
}

// 선택한 게시물 복사 및 이동
function select_copy(sw) {
    var f = document.fboardlist;

    if (sw == 'copy')
        str = "복사";
    else
        str = "이동";

    var sub_win = window.open("", "move", "left=50, top=50, width=500, height=550, scrollbars=1");

    f.sw.value = sw;
    f.target = "move";
    f.action = g5_bbs_url+"/move.php";
    f.submit();
}

// 게시판 리스트 관리자 옵션
jQuery(function($){
    $(".btn_more_opt.is_list_btn").on("click", function(e) {
        e.stopPropagation();
        $(".more_opt.is_list_btn").toggle();
    });
    $(document).on("click", function (e) {
        if(!$(e.target).closest('.is_list_btn').length) {
            $(".more_opt.is_list_btn").hide();
        }
    });
});
</script>
<?php } ?>
<!-- } 게시판 목록 끝 -->
