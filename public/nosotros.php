<?php
$Tracking = Tracking::load();
$Tracking->add('index.php?mod=nosotros');
$Tracking->save();
?>

<div class="main clearfix">
    <div class="container clearfix nosotros">
        <div id="slider" class="banner clearfix">
            <ul> 
                <li><img alt="banner" src="images/public/bannernosotros/banner-silcom-1.jpg" /></li>
                <li><img alt="banner" src="images/public/bannernosotros/banner-silcom-2.jpg" /></li>
                <li><img alt="banner" src="images/public/bannernosotros/banner-silcom-3.jpg" /></li>
                <li><img alt="banner" src="images/public/bannernosotros/banner-silcom-4.jpg" /></li>
                <li><img alt="banner" src="images/public/bannernosotros/banner-silcom-5.jpg" /></li>
            </ul>
        </div>
        <div class="content clearfix">
            <div class="columna">
                <div class="text clearfix">
                    <h2><?php echo $site_languages['text1']; ?></h2>
                    <h3><?php echo $site_languages['text2']; ?></h3>
                    <p><?php echo $site_languages['text3']; ?></p>
                    <p><?php echo $site_languages['text4']; ?></p>
                    <p><?php echo $site_languages['text5']; ?></p>
                    <p><?php echo $site_languages['text6']; ?></p>
                    <p><?php echo $site_languages['text7']; ?></p>
                </div>
            </div>
            <!-- naranja-->
            <div class="columna last">				
                <div class="text clearfix">					
                    <h3><?php echo $site_languages['text8']; ?></h3>					
                    <p><?php echo $site_languages['text9']; ?></p>
                    <h3><?php echo $site_languages['text10']; ?></h3>
                    <p><?php echo $site_languages['text11']; ?></p>
                    <h3><?php echo $site_languages['text12']; ?></h3>
                    <p><?php echo $site_languages['text13']; ?></p>
                </div>
            </div>			
        </div>
    </div>
</div>