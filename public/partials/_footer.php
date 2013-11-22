<?php if($lang=='es'){ ?>
    <div class="container clearfix footer">
    <div class="clearfix">
        <ul>
            <li class="abundancia"><img alt="logo La Abundancia" src="images/public/img/logo-abundancia-gris.png" /></li>
            <li class="silcom"><img alt="logo Silcom" src="images/public/img/logo-silcom-gris.png"/></li> 
            <li class="kyoto"><img alt="logo Kyoto" src="images/public/img/logo-kyoto.png" /></li>
            <li class="bambina"><img alt="logo Bambina" src="images/public/img/logo-bambina.png" /></li>
            <li class="metro"><img alt="logo Metro" src="images/public/img/logo-metro.png" /></li> 
            <li class="frutero"><img alt="logo Don Frutero" src="images/public/img/logo-don-frutero.png" /></li> 
            <li class="last catering"><img alt="logo La Abundancia Catering" src="images/public/img/logo-la-abundancia-catering.png" /></li> 
        </ul>
        <div class="verde">  
            <h2>TRABAJA CON NOSOTROS</h2>           
            <div class="boton-verde"> 
                <div class="left">&nbsp;</div>
                <div class="medio"><a href="index.php?mod=trabaja_con_nosotros"> ver mas</a> </div>	
                <div class="right">&nbsp;</div>	
            </div> 
        </div>
    </div>
    <div class="copy clearfix">
        <p><?php echo $site_languages['footer1']; ?></p>
        <p><?php echo $site_languages['footer2']; ?></p>
    </div>
</div>
<?php } else { ?>
<div class="container eng clearfix footer">
	<div class="english-footer clearfix">
		<ul>
                    <li class="abundancia"><img alt="logo La Abundancia" src="images/public/img/logo-abundancia-gris.png" /></li>
                    <li class="silcom"><img alt="logo Silcom" src="images/public/img/logo-silcom-gris.png"/></li> 
                    <li class="kyoto"><img alt="logo Kyoto" src="images/public/img/logo-kyoto.png" /></li>
                    <li class="bambina"><img alt="logo Bambina" src="images/public/img/logo-bambina.png" /></li>
                    <li class="metro"><img alt="logo Metro" src="images/public/img/logo-metro.png" /></li> 
                    <li class="frutero"><img alt="logo Don Frutero" src="images/public/img/logo-don-frutero.png" /></li> 
                    <li class="last catering"><img alt="logo La Abundancia Catering" src="images/public/img/logo-la-abundancia-catering.png" /></li> 
		</ul>
	</div>
	<div class="copy clearfix">
		<p><?php echo $site_languages['footer1']; ?></p>
		<p><?php echo $site_languages['footer2']; ?></p>
	</div>
</div>
<?php } ?>
