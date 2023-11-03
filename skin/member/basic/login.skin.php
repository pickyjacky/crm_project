<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/css/intro.css">', 0);
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 1);
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/css/login.css">', 2);
?>

<script>
$(document).ready(function(){
    $('#intro_pop').delay(1000).fadeOut(500);
})
</script>

<div class="intro_wrap" id="intro_pop">
    <div class="intro_wrap_in">
        <div class="intro_tt_box">
            <img src="/skin/member/basic/img/logo.png" alt="logo">
            <p class="text">안전하고 믿을 수 있는<br><strong>분야별 전문 의료진</strong></p>
        </div> 
        <div class="intro_logo2">
            <img src="/skin/member/basic/img/logo2.png" alt="연세고운미소 삼성점">
        </div>
    </div>
</div>

<!-- 로그인 시작 { -->
<div id="mb_login" class="mbskin">
    <div class="mbskin_box">
        <h2 class="login_logo">
            <img src="/skin/member/basic/img/logo.png" alt="logo">
        </h2>
        <form name="flogin" action="<?php echo $login_action_url ?>" onsubmit="return flogin_submit(this);" method="post">
            <input type="hidden" name="url" value="<?php echo $login_url ?>">
            <fieldset id="login_fs">
                <legend>회원로그인</legend>
                <label for="login_id" class="sound_only">회원아이디<strong class="sound_only"> 필수</strong></label>
                <input type="text" name="mb_id" id="login_id" required class="frm_input required" size="20" maxLength="20" placeholder="차트번호">
                <label for="login_pw" class="sound_only">비밀번호<strong class="sound_only"> 필수</strong></label>
                <input type="password" name="mb_password" id="login_pw" required class="frm_input required" size="20" maxLength="20" placeholder="전화번호">
                <button type="submit" class="btn_submit">로그인</button>
                <a class="login_pp" href="<?php echo get_pretty_url('content', 'privacy'); ?>">개인정보 처리방침</a>
            </fieldset>
        </form>
    </div>
    <div class="login_logo2">
        <a href="/">
            <img src="/skin/member/basic/img/logo2.png" alt="연세고운미소 삼성점">
        </a>
    </div>
</div>

<script>
    function flogin_submit(f)
    {
        if( $( document.body ).triggerHandler( 'login_sumit', [f, 'flogin'] ) !== false ){
            return true;
        }
        return false;
    }
</script>
<!-- } 로그인 끝 -->
