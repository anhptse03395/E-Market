<!DOCTYPE html>
<html lang="en">

<head>


    <title>E-market</title>

    <!-- Bootstrap Core CSS -->
    <link href=" <?php echo public_url('user/home')  ?>/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo public_url('user/home')  ?>/css/stylish-portfolio.css" rel="stylesheet">
        <link href="<?php echo public_url('user/home')  ?>/css/option.css" rel="stylesheet">
        <link href="<?php echo public_url('user/home')  ?>/css/shop.css" rel="stylesheet">


    <!-- Custom Fonts -->
    <link href="<?php echo public_url('user/home')  ?>/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
    </head>

    <body style="background-color:rgba(110, 154, 75, 0.31) ">

        <!-- Navigation -->
        <a id="menu-toggle" style="margin-right: 20%;margin-top: 2%;font-size:large;" href="<?php echo user_url('login') ?>"> <i  style="margin-right: 3px" class="fa fa-user"></i>Đăng nhập/Đăng kí</a>


        <!-- Header -->
        <header id="top" class="header">
            <div class="text-vertical-center">
                <h1>Chào mừng bạn đến với E-market</h1>
              
                <br>
                <a href="#container" class="btn btn-dark btn-lg">Khám phá chợ</a>

                
            </div>


        </header>

      
        <div  id ="container" class="container" style="margin-left: 20%">
            <h1 style="color: rgba(26, 42, 88, 0.78)">Lựa chọn địa điểm muốn xem</h1>
            <div class="row">
             <form action="<?php echo base_url('home/index') ?>" method="post">
              
              
              
                <div class="col-xs-6 col-sm-3">
                        <div class="form-group">
                            <label for="subject">
                                Tỉnh thành</label>
                                <div class="input-group"> 
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-list-alt"></span>
                                </span>
                                <select style="background-color:rgba(247, 185, 22, 0.76);"  name="province" class="form-control"  onchange="this.form.submit();">
                                    <option value="">Chọn</option>
                                    <?php foreach ($provinces as $row) :?>
                                        
                                        <option data-subtext="<i class='glyphicon glyphicon-eye-open'></i>"   value="<?php echo $row->id?>" <?php echo ($this->input->post('province') == $row->id) ? 'selected' : '' ?>> <?php echo $row->local_name ?> </option>

                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                </div>
            
                <div class="col-xs-6 col-sm-3">
                    <div class="form-group">
                            <label for="subject">
                                Địa điểm chợ</label>
                                <div class="input-group"> 
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-list-alt"></span>
                                </span>
                                <select style="background-color:rgba(247, 185, 22, 0.76);" name="market_place"   class="form-control"  onchange="this.form.submit();">
                                    <option value="">Chọn</option>
                                    <?php if($market_places) :?>
                                        <?php foreach ($market_places as $row) :?>

                                            <option value="<?php echo $row->id?>" <?php echo ($this->input->post('market_place') == $row->id) ? 'selected' : '' ?>> <?php echo $row->market_name ?> </option>

                                        <?php endforeach;?>
                                    <?php endif ; ?>
                                </select>
                            </div>
                        </div>
                </div>
                    </form>
            </div>
            
        </div>



   


    <!-- Portfolio -->
    <section id="portfolio" class="portfolio">
     <div class="container">
      <?php if (isset($shops)) {?>
    <div style="display: block;" class="row">
        <h1>
        Danh sách cửa hàng
        </h1>
    </div>
      <?php  }?> 
    

    <div class="row">
    <?php if (isset($shops)) {?>
         <?php foreach ($shops as $row): ?>

             <div class="col-sm-3">
            <div class="card">
                <canvas class="header-bg" width="250" height="70" id="header-blur"></canvas>
                <div class="avatar">
                    <img src="<?php echo base_url('upload/shop/'.$row->image_shop)?>" alt="" />
                </div>
                <div class="content">
                    <p><?php echo $row->shop_name ?> <br>
                       <?php echo $row->address ?></br>
                        <?php echo $row->address ?></p>
                    <a href="<?php echo user_url('listproduct/product_detail_shop/'.$row->id)?>"><button  class="btn btn-default">Xem</button></p></a>
                </div>
            </div>
        </div>
        <?php endforeach ?>
        
    <?php  }?> 
    
         
       
    </div>
</div>                 
                        
        <!-- /.container -->
    </section>
                <div style="margin-left: 10%" >
                <?php if (isset($shops)) {?>
                       <ul class="pagination">
                         

                            <li><?php echo $this->pagination->create_links()?></li>

                        </ul>
        
                    <?php  }?> 
                </div>

    <!-- Call to Action -->

    <!-- Map -->

    <!-- Footer -->
<!--     <footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1 text-center">
                <h4><strong>Start Bootstrap</strong>
                </h4>
                <p>3481 Melrose Place
                    <br>Beverly Hills, CA 90210</p>
                    <ul class="list-unstyled">
                        <li><i class="fa fa-phone fa-fw"></i> (123) 456-7890</li>
                        <li><i class="fa fa-envelope-o fa-fw"></i> <a href="mailto:name@example.com">name@example.com</a>
                        </li>
                    </ul>
                    <br>
                    <ul class="list-inline">
                        <li>
                            <a href="#"><i class="fa fa-facebook fa-fw fa-3x"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-twitter fa-fw fa-3x"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-dribbble fa-fw fa-3x"></i></a>
                        </li>
                    </ul>
                    <hr class="small">
                    <p class="text-muted">Copyright &copy; Your Website 2014</p>
                </div>
            </div>
        </div>
        <a id="to-top" href="#top" class="btn btn-dark btn-lg"><i class="fa fa-chevron-up fa-fw fa-1x"></i></a>
    </footer> -->

        <!-- jQuery -->
        <script src="js/jquery.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="js/bootstrap.min.js"></script>

        <!-- Custom Theme JavaScript -->
        <script>
    // Closes the sidebar menu
    $("#menu-close").click(function(e) {
        e.preventDefault();
        $("#sidebar-wrapper").toggleClass("active");
    });
    // Opens the sidebar menu
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#sidebar-wrapper").toggleClass("active");
    });
    // Scrolls to the selected menu item on the page
    $(function() {
        $('a[href*=#]:not([href=#],[data-toggle],[data-target],[data-slide])').click(function() {
            if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') || location.hostname == this.hostname) {
                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                if (target.length) {
                    $('html,body').animate({
                        scrollTop: target.offset().top
                    }, 1000);
                    return false;
                }
            }
        });
    });
    //#to-top button appears after scrolling
    var fixed = false;
    $(document).scroll(function() {
        if ($(this).scrollTop() > 250) {
            if (!fixed) {
                fixed = true;
                // $('#to-top').css({position:'fixed', display:'block'});
                $('#to-top').show("slow", function() {
                    $('#to-top').css({
                        position: 'fixed',
                        display: 'block'
                    });
                });
            }
        } else {
            if (fixed) {
                fixed = false;
                $('#to-top').hide("slow", function() {
                    $('#to-top').css({
                        display: 'none'
                    });
                });
            }
        }
    });
    // Disable Google Maps scrolling
    // See http://stackoverflow.com/a/25904582/1607849
    // Disable scroll zooming and bind back the click event
    var onMapMouseleaveHandler = function(event) {
        var that = $(this);
        that.on('click', onMapClickHandler);
        that.off('mouseleave', onMapMouseleaveHandler);
        that.find('iframe').css("pointer-events", "none");
    }
    var onMapClickHandler = function(event) {
        var that = $(this);
            // Disable the click handler until the user leaves the map area
            that.off('click', onMapClickHandler);
            // Enable scrolling zoom
            that.find('iframe').css("pointer-events", "auto");
            // Handle the mouse leave event
            that.on('mouseleave', onMapMouseleaveHandler);
        }
        // Enable map zooming with mouse scroll when the user clicks the map
        $('.map').on('click', onMapClickHandler);
    </script>
        <script src="<?php echo public_url('user/home')?>/js/option.js"></script>
        <script src="<?php echo public_url('user/home')?>/js/shop.js"></script>

</body>

</html>
