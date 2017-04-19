<style>
    /* --------------------------------

Primary style

-------------------------------- */
    *, *::after, *::before {
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }

    *::after, *::before {
        content: '';
    }

    body {
        font-size: 100%;
        font-family: "Open Sans", sans-serif;
        color: #4e5359;
        background-color: #f3f3f5;
    }
    body::after {
        /* overlay layer visible on small devices when the right panel slides in */
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(78, 83, 89, 0.8);
        visibility: hidden;
        opacity: 0;
        -webkit-transition: opacity .3s 0s, visibility 0s .3s;
        -moz-transition: opacity .3s 0s, visibility 0s .3s;
        transition: opacity .3s 0s, visibility 0s .3s;
    }
    body.cd-overlay::after {
        visibility: visible;
        opacity: 1;
        -webkit-transition: opacity .3s 0s, visibility 0s 0s;
        -moz-transition: opacity .3s 0s, visibility 0s 0s;
        transition: opacity .3s 0s, visibility 0s 0s;
    }
    @media only screen and (min-width: 768px) {
        body::after {
            display: none;
        }
    }

    a {
        color: #a9c056;
        text-decoration: none;
    }

    /* --------------------------------

    Main components

    -------------------------------- */
    header {
        position: relative;
        height: 180px;
        line-height: 180px;
        text-align: center;
        background-color: #a9c056;
    }
    header h1 {
        color: #ffffff;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        font-size: 20px;
        font-size: 1.25rem;
    }
    @media only screen and (min-width: 1024px) {
        header {
            height: 240px;
            line-height: 240px;
        }
        header h1 {
            font-size: 36px;
            font-size: 2.25rem;
            font-weight: 300;
        }
    }

    .cd-faq {
        width: 90%;
        max-width: 1024px;
        margin: 2em auto;
        box-shadow: 0 1px 5px rgba(0, 0, 0, 0.1);
    }
    .cd-faq:after {
        content: "";
        display: table;
        clear: both;
    }
    @media only screen and (min-width: 768px) {
        .cd-faq {
            position: relative;
            margin: 4em auto;
            box-shadow: none;
        }
    }

    .cd-faq-categories a {
        position: relative;
        display: block;
        overflow: hidden;
        height: 50px;
        line-height: 50px;
        padding: 0 28px 0 16px;
        background-color: #4e5359;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        color: #ffffff;
        white-space: nowrap;
        border-bottom: 1px solid #555b61;
        text-overflow: ellipsis;
    }
    .cd-faq-categories a::before, .cd-faq-categories a::after {
        /* plus icon on the right */
        position: absolute;
        top: 50%;
        right: 16px;
        display: inline-block;
        height: 1px;
        width: 10px;
        background-color: #7f868e;
    }
    .cd-faq-categories a::after {
        -webkit-transform: rotate(90deg);
        -moz-transform: rotate(90deg);
        -ms-transform: rotate(90deg);
        -o-transform: rotate(90deg);
        transform: rotate(90deg);
    }
    .cd-faq-categories li:last-child a {
        border-bottom: none;
    }
    @media only screen and (min-width: 768px) {
        .cd-faq-categories {
            width: 20%;
            float: left;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.08);
        }
        .cd-faq-categories a {
            font-size: 13px;
            font-size: 0.8125rem;
            font-weight: 600;
            padding-left: 24px;
            padding: 0 24px;
            -webkit-transition: background 0.2s, padding 0.2s;
            -moz-transition: background 0.2s, padding 0.2s;
            transition: background 0.2s, padding 0.2s;
        }
        .cd-faq-categories a::before, .cd-faq-categories a::after {
            display: none;
        }
        .no-touch .cd-faq-categories a:hover {
            background: #555b61;
        }
        .no-js .cd-faq-categories {
            width: 100%;
            margin-bottom: 2em;
        }
    }
    @media only screen and (min-width: 1024px) {
        .cd-faq-categories {
            position: absolute;
            top: 0;
            left: 0;
            width: 200px;
            z-index: 2;
        }
        .cd-faq-categories a::before {
            /* decorative rectangle on the left visible for the selected item */
            display: block;
            top: 0;
            right: auto;
            left: 0;
            height: 100%;
            width: 3px;
            background-color: #a9c056;
            opacity: 0;
            -webkit-transition: opacity 0.2s;
            -moz-transition: opacity 0.2s;
            transition: opacity 0.2s;
        }
        .cd-faq-categories .selected {
            background: #42464b !important;
        }
        .cd-faq-categories .selected::before {
            opacity: 1;
        }
        .cd-faq-categories.is-fixed {
            /* top and left value assigned in jQuery */
            position: fixed;
        }
        .no-js .cd-faq-categories {
            position: relative;
        }
    }

    .cd-faq-items {
        position: fixed;
        height: 100%;
        width: 90%;
        top: 0;
        right: 0;
        background: #ffffff;
        padding: 0 5% 1em;
        overflow: auto;
        -webkit-overflow-scrolling: touch;
        z-index: 1;
        -webkit-backface-visibility: hidden;
        backface-visibility: hidden;
        -webkit-transform: translateZ(0) translateX(100%);
        -moz-transform: translateZ(0) translateX(100%);
        -ms-transform: translateZ(0) translateX(100%);
        -o-transform: translateZ(0) translateX(100%);
        transform: translateZ(0) translateX(100%);
        -webkit-transition: -webkit-transform .3s;
        -moz-transition: -moz-transform .3s;
        transition: transform .3s;
    }
    .cd-faq-items.slide-in {
        -webkit-transform: translateZ(0) translateX(0%);
        -moz-transform: translateZ(0) translateX(0%);
        -ms-transform: translateZ(0) translateX(0%);
        -o-transform: translateZ(0) translateX(0%);
        transform: translateZ(0) translateX(0%);
    }
    .no-js .cd-faq-items {
        position: static;
        height: auto;
        width: 100%;
        -webkit-transform: translateX(0);
        -moz-transform: translateX(0);
        -ms-transform: translateX(0);
        -o-transform: translateX(0);
        transform: translateX(0);
    }
    @media only screen and (min-width: 768px) {
        .cd-faq-items {
            position: static;
            height: auto;
            width: 78%;
            float: right;
            overflow: visible;
            -webkit-transform: translateZ(0) translateX(0);
            -moz-transform: translateZ(0) translateX(0);
            -ms-transform: translateZ(0) translateX(0);
            -o-transform: translateZ(0) translateX(0);
            transform: translateZ(0) translateX(0);
            padding: 0;
            background: transparent;
        }
    }
    @media only screen and (min-width: 1024px) {
        .cd-faq-items {
            float: none;
            width: 100%;
            padding-left: 220px;
        }
        .no-js .cd-faq-items {
            padding-left: 0;
        }
    }

    .cd-close-panel {
        position: fixed;
        top: 5px;
        right: -100%;
        display: block;
        height: 40px;
        width: 40px;
        overflow: hidden;
        text-indent: 100%;
        white-space: nowrap;
        z-index: 2;
        /* Force Hardware Acceleration in WebKit */
        -webkit-transform: translateZ(0);
        -moz-transform: translateZ(0);
        -ms-transform: translateZ(0);
        -o-transform: translateZ(0);
        transform: translateZ(0);
        -webkit-backface-visibility: hidden;
        backface-visibility: hidden;
        -webkit-transition: right 0.4s;
        -moz-transition: right 0.4s;
        transition: right 0.4s;
    }
    .cd-close-panel::before, .cd-close-panel::after {
        /* close icon in CSS */
        position: absolute;
        top: 16px;
        left: 12px;
        display: inline-block;
        height: 3px;
        width: 18px;
        background: #6c7d8e;
    }
    .cd-close-panel::before {
        -webkit-transform: rotate(45deg);
        -moz-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        -o-transform: rotate(45deg);
        transform: rotate(45deg);
    }
    .cd-close-panel::after {
        -webkit-transform: rotate(-45deg);
        -moz-transform: rotate(-45deg);
        -ms-transform: rotate(-45deg);
        -o-transform: rotate(-45deg);
        transform: rotate(-45deg);
    }
    .cd-close-panel.move-left {
        right: 2%;
    }
    @media only screen and (min-width: 768px) {
        .cd-close-panel {
            display: none;
        }
    }

    .cd-faq-group {
        /* hide group not selected */
        display: none;
    }
    .cd-faq-group.selected {
        display: block;
    }
    .cd-faq-group .cd-faq-title {
        background: transparent;
        box-shadow: none;
        margin: 1em 0;
    }
    .no-touch .cd-faq-group .cd-faq-title:hover {
        box-shadow: none;
    }
    .cd-faq-group .cd-faq-title h2 {
        text-transform: uppercase;
        font-size: 12px;
        font-size: 0.75rem;
        font-weight: 700;
        color: #bbbbc7;
    }
    .no-js .cd-faq-group {
        display: block;
    }
    @media only screen and (min-width: 768px) {
        .cd-faq-group {
            /* all groups visible */
            display: block;
        }
        .cd-faq-group > li {
            background: #ffffff;
            margin-bottom: 6px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.08);
            -webkit-transition: box-shadow 0.2s;
            -moz-transition: box-shadow 0.2s;
            transition: box-shadow 0.2s;
        }
        .no-touch .cd-faq-group > li:hover {
            box-shadow: 0 1px 10px rgba(108, 125, 142, 0.3);
        }
        .cd-faq-group .cd-faq-title {
            margin: 2em 0 1em;
        }
        .cd-faq-group:first-child .cd-faq-title {
            margin-top: 0;
        }
    }

    .cd-faq-trigger {
        position: relative;
        display: block;
        margin: 1.6em 0 .4em;
        line-height: 1.2;
    }
    @media only screen and (min-width: 768px) {
        .cd-faq-trigger {
            font-size: 24px;
            font-size: 1.5rem;
            font-weight: 300;
            margin: 0;
            padding: 24px 72px 24px 24px;
        }
        .cd-faq-trigger::before, .cd-faq-trigger::after {
            /* arrow icon on the right */
            position: absolute;
            right: 24px;
            top: 50%;
            height: 2px;
            width: 13px;
            background: #cfdca0;
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
            -webkit-transition-property: -webkit-transform;
            -moz-transition-property: -moz-transform;
            transition-property: transform;
            -webkit-transition-duration: 0.2s;
            -moz-transition-duration: 0.2s;
            transition-duration: 0.2s;
        }
        .cd-faq-trigger::before {
            -webkit-transform: rotate(45deg);
            -moz-transform: rotate(45deg);
            -ms-transform: rotate(45deg);
            -o-transform: rotate(45deg);
            transform: rotate(45deg);
            right: 32px;
        }
        .cd-faq-trigger::after {
            -webkit-transform: rotate(-45deg);
            -moz-transform: rotate(-45deg);
            -ms-transform: rotate(-45deg);
            -o-transform: rotate(-45deg);
            transform: rotate(-45deg);
        }
        .content-visible .cd-faq-trigger::before {
            -webkit-transform: rotate(-45deg);
            -moz-transform: rotate(-45deg);
            -ms-transform: rotate(-45deg);
            -o-transform: rotate(-45deg);
            transform: rotate(-45deg);
        }
        .content-visible .cd-faq-trigger::after {
            -webkit-transform: rotate(45deg);
            -moz-transform: rotate(45deg);
            -ms-transform: rotate(45deg);
            -o-transform: rotate(45deg);
            transform: rotate(45deg);
        }
    }

    .cd-faq-content p {
        font-size: 14px;
        font-size: 0.875rem;
        line-height: 1.4;
        color: #6c7d8e;
    }
    @media only screen and (min-width: 768px) {
        .cd-faq-content {
            display: none;
            padding: 0 24px 30px;
        }
        .cd-faq-content p {
            line-height: 1.6;
        }
        .no-js .cd-faq-content {
            display: block;
        }
    }

    /* http://meyerweb.com/eric/tools/css/reset/
       v2.0 | 20110126
       License: none (public domain)
    */

    html, body, div, span, applet, object, iframe,
    h1, h2, h3, h4, h5, h6, p, blockquote, pre,
    a, abbr, acronym, address, big, cite, code,
    del, dfn, em, img, ins, kbd, q, s, samp,
    small, strike, strong, sub, sup, tt, var,
    b, u, i, center,
    dl, dt, dd, ol, ul, li,
    fieldset, form, label, legend,
    table, caption, tbody, tfoot, thead, tr, th, td,
    article, aside, canvas, details, embed,
    figure, figcaption, footer, header, hgroup,
    menu, nav, output, ruby, section, summary,
    time, mark, audio, video {
        margin: 0;
        padding: 0;
        border: 0;
        font-size: 100%;
        font: inherit;
        vertical-align: baseline;
    }
    /* HTML5 display-role reset for older browsers */
    article, aside, details, figcaption, figure,
    footer, header, hgroup, menu, nav, section, main {
        display: block;
    }
    body {
        line-height: 1;
    }
    ol, ul {
        list-style: none;
    }
    blockquote, q {
        quotes: none;
    }
    blockquote:before, blockquote:after,
    q:before, q:after {
        content: '';
        content: none;
    }
    table {
        border-collapse: collapse;
        border-spacing: 0;
    }
</style>


<html >




<head>
    <link href="<?php echo public_url('user')?>/css/login.css" rel="stylesheet">
    <?php
    $this->load->view('site/head');
    ?>

</head>
<body >
<div id="header">
    <?php $this->load->view('site/header'); ?>
</div>

<section class="cd-faq">
    <ul class="cd-faq-categories">
        <li><a class="selected" href="#basics">Các quy định trên trang web</a></li>
        <li><a href="#mobile">Quy định đăng tin</a></li>
        <li><a href="#account">Quy định hoạt động</a></li>
        <li><a href="#payments">Quy định riêng tư</a></li>
        <li><a href="#privacy">Quy định hàng hóa, dịch vụ</a></li>
    </ul> <!-- cd-faq-categories -->

    <div class="cd-faq-items">
        <ul id="mobile" class="cd-faq-group">
            <li class="cd-faq-title"><h2>Quy định cơ bản về tin đăng</h2></li>
            <li>
                <a class="cd-faq-trigger" href="#0">1. Thông tin liên lạc</a>
                <p class="cd-faq-content">
                    <p>•	Tên: Điền đầy đủ họ tên thật của người bán.</p>
                    <p>   •	Email: Hãy cung cấp địa chỉ email thật. Chúng tôi liên lạc với bạn chủ yếu qua email. Email của bạn sẽ được E-market bảo mật.</p>
                    <p>   •	Số điện thoại: Để đảm bảo an toàn mua bán, bạn cần xác nhận sở hữu của số điện thoại dùng để đăng tin.</p>
                    <p>  •Địa chỉ: Hãy cung cấp địa chỉ giao dịch chính xác bao gồm: tên đường, quận/huyện, thành phố nơi bạn đang sống.</p>
                </p> <!-- cd-faq-content -->
            </li>

            <li>
                <a class="cd-faq-trigger" href="#0">2. Tiêu đề tin đăng</a>
                <p class="cd-faq-content">
                    <p>•	Tiêu đề cần thể hiện chi tiết chính của mặt hàng hoặc dịch vụ được quảng cáo, bao gồm các thông tin như: </p>
                    <p>	Tên sản phẩm, model, tình trạng …. (Ví dụ: Iphone 5S 16gb còn bảo hành …) </p>
                    <p>    •	Loại nhà đất, tên đường, số phòng ngủ… (đối với bất động sản). Ví dụ: Nhà 3 lầu 6 phòng ngủ đường Nguyễn Trãi …)</p>
                    <p>   •	Trên tiêu đề tin, không sử dụng các thông tin/ từ ngữ sau: </p>
                    <p>  o	Các từ khoá : cần mua/ mua, cần bán/ bán, tuyển/tìm, thanh lý, … </p>
                    <p>  o	Giá, website, tên hoặc thông tin liên lạc của người bán. </p>
                    <p>  o	Các từ ngữ miêu tả nhằm thu hút sự chú ý của người mua như: siêu rẻ, siêu hot, rất đẹp, đẹp, khuyến mãi, gấp, giảm giá hoặc các từ ngữ không được phép theo luật quảng cáo như : nhất, tốt nhất, rẻ nhất, số 1, hàng đầu hoặc từ ngữ có ý nghĩa tương tự.</p>
                </p> <!-- cd-faq-content -->
            </li>

            <li>
                <a class="cd-faq-trigger" href="#0">3. Hình ảnh trong tin đăng</a>
                <div class="cd-faq-content">
                    <p>Hình ảnh trong tin đăng phải là hình chụp từ mặt hàng, dịch vụ bạn đăng bán, và phải thể hiện rõ & chân thực mặt hàng dịch vụ đó.</p>
                </div> <!-- cd-faq-content -->
            </li>


        </ul> <!-- cd-faq-group -->

        <ul id="account" class="cd-faq-group">
            <li class="cd-faq-title"><h2>Quy định hoạt động</h2></li>
            <li>
                <a class="cd-faq-trigger" href="#0">I. NGUYÊN TẮC CHUNG</a>
                <p class="cd-faq-content">
                    <p>Theo quy tắc của Sàn giao dịch thương mại điện tử </p>
                    <p>      1. Mục đích </p>
                    <p> –Cho phép người mua và người bán kết nối và giao dịch an toàn, dễ dàng trong một môi trường tiện lợi và rõ ràng.</p>
                    <p>2. Nguyên tắc </p>
                    <p> –Tất cả các nội dung trong bản Quy chế này phải tuân thủ theo hệ thống pháp luật hiện hành của Việt Nam. </p>
                    <p> -Mọi người tham gia giao dịch trên website có trách nhiệm thực hiện đúng nội dung Quy chế.</p>
                </p> <!-- cd-faq-content -->
            </li>

            <li>
                <a class="cd-faq-trigger" href="#0">II. QUY ĐỊNH CHUNG</a>
                <p class="cd-faq-content">
                <p>   – Tên miền: Sàn giao dịch TMĐT </p>
                <p> – Người dùng: là một Cá nhân hoặc Doanh nghiệp như được định nghĩa dưới đây, và bao gồm bất kỳ người nào duyệt và/hoặc xem Trang web, cũng như bất kỳ người nào đăng bất kỳ quảng cáo nào và rao bán bất kỳ món đồ nào trên Trang web.</p>
                <p> + ‘Cá nhân’ – Các dịch vụ chỉ được cung cấp cho các cá nhân có khả năng tham gia vào một thỏa thuận có hiệu lực pháp lý theo luật Việt Nam.</p>
                <p>+ ‘Doanh nghiệp’ – Các dịch vụ được cung cấp cho các công ty và/hoặc doanh nghiệp. Bất kỳ người nào sử dụng Các dịch vụ với tư cách đại diện cho các doanh nghiệp đó cam đoan rằng mình có thẩm quyền ràng buộc doanh nghiệp vào các điều khoản và điều kiện được đặt ra trong Quy chế.</p>
                <p> – Công ty có thể sửa đổi Quy chế tùy từng thời điểm vì các lý do liên quan đến luật pháp hay quy định, hoặc để đảm bảo Trang web hoạt động đúng cách và suôn sẻ.</p>
                <p> – Nếu Người dùng tiếp tục sử dụng Trang web và/hoặc các dịch vụ Công ty cung cấp trên Trang web (‘Các dịch vụ’) sau ngày các sửa đổi bắt đầu có hiệu lực, Người dùng sẽ được cho là đã đồng ý bị ràng buộc bởi quy chế sửa đổi. Trong trường hợp Người dùng không đồng ý với các sửa đổi, Người dùng không được tiếp tục sử dụng Trang web và/hoặc Các dịch vụ.</p>
                <p> – Hàng hóa, sản phẩm dịch vụ tham gia giao dịch phải đáp ứng đầy đủ các quy định của pháp luật có liên quan, không thuộc các trường hợp cấm kinh doanh, cấm quảng cáo theo quy định của pháp luật.</p>
                <p> – Hoạt động mua bán hàng hóa qua website phải được thực hiện công khai, minh bạch, đảm bảo quyền lợi của người tiêu dùng.</p>
            </p> <!-- cd-faq-content -->
            </li>
            <li>
             <a class="cd-faq-trigger" href="#0">III. QUY TRÌNH GIAO DỊCH</a>
            <p class="cd-faq-content">
            <p>1. Quy trình dành cho người bán hàng (“Người Bán”)</p>
            <p>   – Người Bán đăng tin rao vặt lên website Khi đăng tin phải cung cấp thông tin cá nhân và địa chỉ email cho Website để xác nhận tin đăng.</p>
            <p>  – Sau khi tin rao vặt được kiểm duyệt, tin sẽ được đăng lên website và sẽ gửi email thông báo đã đăng tin cho Người Bán.</p>
            <p>  2. Quy trình dành cho người mua hàng (“Người Mua”)</p>
            <p>  – Người Mua tự tìm kiếm, tham khảo thông tin sản phẩm trên trang Web và lựa chọn sản phẩm.</p>
            <p> – Người Mua tự liên lạc với Người Bán để thỏa thuận việc mua bán.</p>
        </p> <!-- cd-faq-content -->
    </li>

    </ul> <!-- cd-faq-group -->



    <ul id="payments" class="cd-faq-group">
        <li class="cd-faq-title"><h2>Quy định riêng tư</h2></li>
        <li>
            <a class="cd-faq-trigger" href="#0">Quy định riêng tư</a>
            <p class="cd-faq-content">
                <p>•	Bạn có thể xem và thay đổi các thông tin cá nhân tại trang Hồ sơ cá nhân.</p>
                <p>  •	Bạn có thể yêu cầu truy cập các thông tin khác chúng tôi thu thập từ bạn, bằng cách liên hệ với chúng tôi qua hoặc email được công bố ở dưới.</p>
                <p> •	Bạn có thể yêu cầu chấm dứt việc sử dụng thông tin cá nhân bằng cách liên hệ với chúng tôi qua hoặc email được công bố ở dưới.</p>
                <p> •	Chúng tôi có thể từ chối bạn yêu cầu truy cập thông tin cá nhân nếu:</p>
                <p> o	Thông tin chỉ dùng với mục đích phân tích và đánh giá</p>
                <p> o	Thông tin sử dụng cho mục đích giải quyết tranh chấp (ví dụ: thông tin cá nhân của người khác/đối tượng tranh chấp)</p>
                <p> o	Thông tin tổn hại đến hoạt động thương mại & cạnh tranh của chúng tôi</p>
                <p> o	Chi phí, công sức cho việc cung cấp dữ liệu này không tương xứng với lợi ích nhận được của chúng tôi hoặc của bạn</p>
                <p> •	Chúng tôi có quyền xác định thông tin nào nằm trong phạm vi có thể từ chối.</p>
                <p> Các phương thức bảo vệ thông tin cá nhân</p>
                <p> •	Chúng tôi đảm bảo rằng mọi thông tin thu thập được sẽ được lưu giữ an toàn, bằng các phương thức sau:</p>
                <p> o	Giới hạn truy cập thông tin cá nhân bằng việc Đăng ký tài khoản </p>
                <p> o	Sử dụng sản phẩm công nghệ để ngăn chặn truy cập máy tính trái phép </p>
                <p> o	Xóa thông tin cá nhân của quý khách khi nó không còn cần thiết cho mục đích lưu trữ hồ sơ của chúng tôi</p>
            </p> <!-- cd-faq-content -->
        </li>




    </ul> <!-- cd-faq-group -->

    <ul id="privacy" class="cd-faq-group">
        <li class="cd-faq-title"><h2>Quy định hàng hóa, dịch vụ</h2></li>
        <li>
            <a class="cd-faq-trigger" href="#0">Quy định hàng hóa, dịch vụ</a>
            <p class="cd-faq-content">
                <p>Hàng hóa và dịch vụ cấm theo pháp luật Việt Nam</p>
                <p>Hàng hóa bất hợp pháp: Các hàng hóa bị cấm buôn bán theo luật pháp Việt Nam, bao gồm:</p>
                <p>•	Ma túy.</p>
                <p>•	Hàng hóa có chứa hình ảnh liên quan đến cần sa, hoa anh túc.</p>
                <p>•	Vũ khí và các sản phẩm thuộc lĩnh vực quân sự, an ninh quốc phòng khác, bao gồm nhưng không giới hạn bởi quân trang, quân hiệu, phù hiệu, thiết bị quân sự, cấp hiệu.</p>
                <p>•	Bộ phận cơ thể người.</p>
                <p>•	Thực vật, Động vật nguy cấp, quý hiếm.</p>
                <p>•	Sản phẩm khiêu dâm.</p>
                <p>•	Pháo hoa và chất nổ.</p>
                <p>•	Số xe và giấy tờ xe.</p>
            </p> <!-- cd-faq-content -->
        </li>

    </ul> <!-- cd-faq-group -->


    </div> <!-- cd-faq-items -->
    <a href="#0" class="cd-close-panel">Close</a>
</section> <!-- cd-faq -->















<link href="<?php echo public_url('user')?>/css/main.css" rel="stylesheet">
<script src="<?php echo public_url('user')?>/js/jquery.js"></script>
<script src="<?php echo public_url('user') ?>/js/bootstrap.min.js"></script>
<script src="<?php echo public_url('user') ?>/js/jquery.scrollUp.min.js"></script>
<script src="<?php echo public_url('user') ?>/js/price-range.js"></script>
<script src="<?php echo public_url('user') ?>/js/jquery.prettyPhoto.js"></script>
<script src="<?php echo public_url('user') ?>/js/main.js"></script>
<script src="<?php echo public_url('user') ?>/js/login.js"></script>
</body>
</html>


<script>
    jQuery(document).ready(function($){
        //update these values if you change these breakpoints in the style.css file (or _layout.scss if you use SASS)
        var MqM= 768,
            MqL = 1024;

        var faqsSections = $('.cd-faq-group'),
            faqTrigger = $('.cd-faq-trigger'),
            faqsContainer = $('.cd-faq-items'),
            faqsCategoriesContainer = $('.cd-faq-categories'),
            faqsCategories = faqsCategoriesContainer.find('a'),
            closeFaqsContainer = $('.cd-close-panel');

        //select a faq section
        faqsCategories.on('click', function(event){
            event.preventDefault();
            var selectedHref = $(this).attr('href'),
                target= $(selectedHref);
            if( $(window).width() < MqM) {
                faqsContainer.scrollTop(0).addClass('slide-in').children('ul').removeClass('selected').end().children(selectedHref).addClass('selected');
                closeFaqsContainer.addClass('move-left');
                $('body').addClass('cd-overlay');
            } else {
                $('body,html').animate({ 'scrollTop': target.offset().top - 19}, 200);
            }
        });

        //close faq lateral panel - mobile only
        $('body').bind('click touchstart', function(event){
            if( $(event.target).is('body.cd-overlay') || $(event.target).is('.cd-close-panel')) {
                closePanel(event);
            }
        });
        faqsContainer.on('swiperight', function(event){
            closePanel(event);
        });

        //show faq content clicking on faqTrigger
        faqTrigger.on('click', function(event){
            event.preventDefault();
            $(this).next('.cd-faq-content').slideToggle(200).end().parent('li').toggleClass('content-visible');
        });

        //update category sidebar while scrolling
        $(window).on('scroll', function(){
            if ( $(window).width() > MqL ) {
                (!window.requestAnimationFrame) ? updateCategory() : window.requestAnimationFrame(updateCategory);
            }
        });

        $(window).on('resize', function(){
            if($(window).width() <= MqL) {
                faqsCategoriesContainer.removeClass('is-fixed').css({
                    '-moz-transform': 'translateY(0)',
                    '-webkit-transform': 'translateY(0)',
                    '-ms-transform': 'translateY(0)',
                    '-o-transform': 'translateY(0)',
                    'transform': 'translateY(0)',
                });
            }
            if( faqsCategoriesContainer.hasClass('is-fixed') ) {
                faqsCategoriesContainer.css({
                    'left': faqsContainer.offset().left,
                });
            }
        });

        function closePanel(e) {
            e.preventDefault();
            faqsContainer.removeClass('slide-in').find('li').show();
            closeFaqsContainer.removeClass('move-left');
            $('body').removeClass('cd-overlay');
        }

        function updateCategory(){
            updateCategoryPosition();
            updateSelectedCategory();
        }

        function updateCategoryPosition() {
            var top = $('.cd-faq').offset().top,
                height = jQuery('.cd-faq').height() - jQuery('.cd-faq-categories').height(),
                margin = 20;
            if( top - margin <= $(window).scrollTop() && top - margin + height > $(window).scrollTop() ) {
                var leftValue = faqsCategoriesContainer.offset().left,
                    widthValue = faqsCategoriesContainer.width();
                faqsCategoriesContainer.addClass('is-fixed').css({
                    'left': leftValue,
                    'top': margin,
                    '-moz-transform': 'translateZ(0)',
                    '-webkit-transform': 'translateZ(0)',
                    '-ms-transform': 'translateZ(0)',
                    '-o-transform': 'translateZ(0)',
                    'transform': 'translateZ(0)',
                });
            } else if( top - margin + height <= $(window).scrollTop()) {
                var delta = top - margin + height - $(window).scrollTop();
                faqsCategoriesContainer.css({
                    '-moz-transform': 'translateZ(0) translateY('+delta+'px)',
                    '-webkit-transform': 'translateZ(0) translateY('+delta+'px)',
                    '-ms-transform': 'translateZ(0) translateY('+delta+'px)',
                    '-o-transform': 'translateZ(0) translateY('+delta+'px)',
                    'transform': 'translateZ(0) translateY('+delta+'px)',
                });
            } else {
                faqsCategoriesContainer.removeClass('is-fixed').css({
                    'left': 0,
                    'top': 0,
                });
            }
        }

        function updateSelectedCategory() {
            faqsSections.each(function(){
                var actual = $(this),
                    margin = parseInt($('.cd-faq-title').eq(1).css('marginTop').replace('px', '')),
                    activeCategory = $('.cd-faq-categories a[href="#'+actual.attr('id')+'"]'),
                    topSection = (activeCategory.parent('li').is(':first-child')) ? 0 : Math.round(actual.offset().top);

                if ( ( topSection - 20 <= $(window).scrollTop() ) && ( Math.round(actual.offset().top) + actual.height() + margin - 20 > $(window).scrollTop() ) ) {
                    activeCategory.addClass('selected');
                }else {
                    activeCategory.removeClass('selected');
                }
            });
        }
    });
</script>