<style>
    /* FOR DEMO ONLY */
    /* Import Bootswatch paper theme because it isn't provided by Bootsnipp and it is awesome! */
    @import url(//cdnjs.cloudflare.com/ajax/libs/bootswatch/3.3.4/paper/bootstrap.min.css);
    @import url(//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css);

    /* WHAT YOU NEED */
    .fading-side-menu.affix-top {
        opacity: 1;
        transition: opacity 1s
    }
    .fading-side-menu.affix {
        top: 11.5px;
    }
    .fading-side-menu.affix {
        opacity: 0.2;
        transition: opacity 5s
    }
    .fading-side-menu.affix:hover {
        opacity: 1;
        transition: opacity 0.3s
    }
    /* RECOMMENDED STYLING BUT NOT REQUIRED */
    .fading-side-menu a {
        color: rgb(102, 102, 102);
    }
    .fading-side-menu a .fa {
        padding-right:15px;
    }

    /* FOR DEMO ONLY */
    body {
        background-color: rgb(255, 255, 255);
        font-size: 16px;
    }

    header {
        background: url('https://unsplash.imgix.net/photo-1427955569621-3e494de2b1d2?fit=crop&fm=jpg&h=700&q=75&w=1050') no-repeat center bottom;
        background-size: cover;
        margin-bottom: 30px;
        min-height: 320px;
        overflow: hidden;
        position: relative;
        width: 100%;
    }
    header:after {
        bottom: 0px;
        box-shadow: 0px -0px 10px 10px rgb(255, 255, 255);
        content: '';
        height: 0px;
        left: 0px;
        width: 100%;
        position: absolute;
    }
    header .col-xs-12 {
        height: 320px;
    }

    header .alert-info {
        background-color: rgba(156, 39, 176, 0.7);
    }

    .title {
        font-weight: 700;
        margin-top: 0px;
    }

    p.small.text-muted {
        margin-bottom: 0px;
    }

    .lead {
        font-style: italic;
    }

    .no-margin {
        margin: 0px !important;
    }

    .vertical-center {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
    }
    #fullscreen {
        position: fixed;
        top: 10px;
        right: 10px;
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

<div class="container">
    <div class="hidden-xs col-sm-3">
        <div class="fading-side-menu" data-spy="affix" data-offset-top="350">
            <h5> <span style="color:blue;font-weight:bold">  Website rules </span></h5><hr class="no-margin">
            <ul class="list-unstyled">
                <li>
                    <a href="#intro">
                        <span class="fa fa-angle-double-right text-primary"></span>Rules of Posting
                    </a>
                </li>
                <li>
                    <a href="#getting-started">
                        <span class="fa fa-angle-double-right text-primary"></span>Rules of Functioning
                    </a>
                </li>
                <li>
                    <a href="#setting-up-our-page">
                        <span class="fa fa-angle-double-right text-primary"></span>Rules of Products
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <!-- THIS IS NOT NEEDED, THIS IS JUST THE CONTENT OF THE DEMO -->
    <div class="col-xs-12 col-sm-9">
        <h3>Website RULE</h3>
        <h4 id="intro" class="title">Rules of Posting</h4>
        <p>1.	Information:
            •	Name: Clear, exactly name of seller.
            •	Email: Please write the real email. We will contact with you by this email. Your email will be protected by our security.
            •	Phone number: To confirm the business, you need to confirm the phone number used to posting.
            •	Address: Please write the exactly address: district, city where you live.
        </p>
        <p>2.	Title:
            •	Title must describe the main detail of the product, include the information (name, status, quantity).
            •	In the title, do not use the words such as:
            1)	The keywords: need to buy/buy, need to sell/sell, recruit/find, liquidate, …
            2)	Price, website, name or contact information of the seller.
            3)	The words describe to attract the buyers such as: super cheap, very hot, very beautiful, beautiful, sale, fast, discount or the words is not permitted by the rules such as: best, number one, cheapest, top one or the words have the same meaning.
            3.	Images:
            •	The images must be taken from the product and describe the exactly the status of them.
        </p>


        <h4 id="getting-started">Rules of Functioning</h4>
        <p>I.	Basic Principles
            Following the principle of the e-commerce exchange
            1.	Purpose:
            •	Give a convenient and clear environment for buyers and sellers can contact, exchange.
            2.	Principle:
            •	All this document must follow the laws of Viet Nam.
            •	Everyone participate the exchange of website has the responsibility to follow the rules
        </p>
        <p>II.	Basic Rules
            •	Domain name: E-market
            •	User: a person or businesses are defined as below, and include everyone who are guess, or user.
            o	‘Person’:  The services must be only provided for the person can participate in an agreement has legal effect by Viet Nam’s laws.
            o	‘Businesses’: -The services are provided for companies or businesses. Anyone use the service as represent for businesses guarantees that he/her has the right constraints the businesses into Website’s regulation.
            - The company can change the regulation depends on time because of rules or principles, or to make sure the activities of the website.
            - If the user continues using the website after the changes, the user will be assumed to be constrained by the changes. If the user disagrees with the changes, the user cannot continue using the website.
            - The product must be legal by the law.
        </p>
        <p>III.	Trading Process
            1.	Process for the sellers
            •	The seller posting a topic in the website gives the exactly information.
            •	After checking by the admin, the topic will be posted and a notification email will be sent to the seller.
            2.	Process for the buyers
            •	The buyer find, read the information in the website to choose the product.
            •	The buyer contact with the seller to exchange.
            Principles of Personality
            •	The user can see and change the personal information in profile
            •	The user can require to access the other information we have collected by email of the website
            •	The user can require to stop using the personal information by email of the website
            •	We can refuse the require if:
            o	The information is only used to analyze and estimate
            o	The information is used to resolve conflict
            o	The information damages our activities
            o	The cost of giving the information is not suitable with website and user
            •	We have the right to define the domain of the information to refuse
            •	We confirm the information will be protected by:
            o	Limit the access by register
            o	Use the newest techniques to prevent the access is not permitted
            o	Delete the information of the user if it is not necessary for our purpose
        </p>
        <h4 id="setting-up-our-page">Rules of Products</h4>
    <p>
        The products are banned follow to the laws of Viet Nam
        The banned products include:
        o	Drug
        o	The products have the images about cannabis
        o	Weapons
        o	Human body
        o	In danger and rare plant, animal
        o	Porn
        o	Fireworks, explosives
        o	Number and documents of car
    </p>

    </div>
</div>


<script>
    /* THOUGH THIS PLUGIN DOES NOT CONTAIN
     ANY JAVASCRIPT ITSELF, IT DOES REQUIRE
     THE BOOTSTRAP AFFIX PLUGIN. */

    /* START OF DEMO JS - NOT NEEDED */
    $(function () {
        if (window.location == window.parent.location) {
            $('#fullscreen').html('<span class="fa fa-compress"></span>');
            $('#fullscreen').attr('href', 'http://bootsnipp.com/mouse0270/snippets/rVnOR');
            $('#fullscreen').attr('title', 'Back To Bootsnipp');
        }
        $('#fullscreen').on('click', function(event) {
            event.preventDefault();
            window.parent.location =  $('#fullscreen').attr('href');
        });
        $('#fullscreen').tooltip();
    });
    /* END DEMO OF JS - THAT IS RIGHT NO ADDITONAL JAVASCRIPT NEEDED FOR THIS SNIPPET */
</script>












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