<!DOCTYPE html>
<html lang="en">

<head>


    <title>E-market</title>

    <!-- Bootstrap Core CSS -->
    <link href=" <?php echo public_url('user/home')  ?>/css/bootstrap.min.css" rel="stylesheet">
    <script rel="stylesheet" type="text/css" href="<?php echo public_url('user/home')?>/js/bootstrap-datetimepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo public_url('user/home/css')?>/bootstrap-datetimepicker.min.css">

    <!-- Custom CSS -->
    <link href="<?php echo public_url('user/home')  ?>/css/stylish-portfolio.css" rel="stylesheet">
    <link href="<?php echo public_url('user/home')  ?>/css/option.css" rel="stylesheet">
    <link href="<?php echo public_url('user/home')  ?>/css/shop.css" rel="stylesheet">
    <link href="<?php echo public_url('user/home')  ?>/css/category.css" rel="stylesheet">


    <!-- Custom Fonts -->
    <link href="<?php echo public_url('user/home')  ?>/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
</head>

<body style="background-color:rgba(110, 154, 75, 0.31) ">

    <!-- Navigation -->

     <div class="dropdown-menu-left"> <a id="menu-toggle" style="margin-right: 20%;margin-top: 2%;font-size:large;" href="<?php echo user_url('login') ?>"> <i  style="margin-right: 3px" class="fa fa-user"></i>Đăng nhập/Đăng kí</a></div>
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
<footer style="">

    <div class="container">
        <div class="row">
            <div class="main_portfolio_content">
                <div class="col-md-3 col-sm-4 col-xs-12 single_portfolio_text">
                    <img src="<?php echo public_url('user/images/home/rau1.jpg') ?>" alt="" />
                    <div class="portfolio_images_overlay text-center">
                        <h6>Rau</h6>
                   
                        <a href="#" class="btn btn-primary">Xem</a>
                    </div>
                </div>
                <div class="col-md-3 col-sm-4 col-xs-12 single_portfolio_text">
                    <img src="<?php echo public_url('user/images/home/qua1.jpg') ?>" alt="" />
                    <div class="portfolio_images_overlay text-center">
                        <h6>Quả</h6>
                        
                        <a href="#" class="btn btn-primary">Xem</a>
                    </div>                              
                </div>
                <div class="col-md-3 col-sm-4 col-xs-12 single_portfolio_text">
                    <img src="<?php echo public_url('user/images/home/cu1.jpg') ?>" alt="" />
                    <div class="portfolio_images_overlay text-center">
                        <h6>Củ</h6>
                     
                        <a href="#" class="btn btn-primary">Xem</a>
                    </div>                              
                </div>
                <div class="col-md-3 col-sm-4 col-xs-12 single_portfolio_text">
                    <img src="<?php echo public_url('user/images/home/thit1.jpg') ?>" alt="" />
                    <div class="portfolio_images_overlay text-center">
                        <h6>Thịt</h6>
                      
                        <a href="#" class="btn btn-primary">Xem</a>
                    </div>                              
                </div>
                <div class="col-md-3 col-sm-4 col-xs-12 single_portfolio_text">
                    <img src="<?php echo public_url('user/images/home/ca1.jpg') ?>" alt="" />
                    <div class="portfolio_images_overlay text-center">
                        <h6>Cá</h6>
                     
                        <a href="" class="btn btn-primary">Xem</a>
                    </div>                              
                </div>
                <div class="col-md-3 col-sm-4 col-xs-12 single_portfolio_text">
                    <img src="<?php echo public_url('user/images/home/cakho1.jpg') ?>" alt="" />
                    <div class="portfolio_images_overlay text-center">
                        <h6>Cá khô</h6>
                       
                        <a href="#" class="btn btn-primary">Xem</a>
                    </div>                              
                </div>
                <div class="col-md-3 col-sm-4 col-xs-12 single_portfolio_text" style="width:570px;height: 300px;margin-left: 1px">
                    <img src="<?php echo public_url('user/images/home/sua.jpg') ?>" alt="" />
                    <div class="portfolio_images_overlay text-center">
                        <h6>Sữa</h6>
                     
                        <a href="#" class="btn btn-primary">Xem</a>
                    </div>                              
                </div>

            </div>
        </div>
    </div>



</footer> 

<!-- jQuery -->

    </script>
    <script src="<?php echo public_url('user/home')?>/js/option.js"></script>
    <script src="<?php echo public_url('user/home')?>/js/shop.js"></script>

</body>

</html>
