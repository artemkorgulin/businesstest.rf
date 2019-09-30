<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="Author" content="WebThemez">
    <title>Black Coming Soon Responsive Template</title>
    <meta name="description" content="Examples for creative website header animations using Canvas and JavaScript" />
    <meta name="keywords" content="header, canvas, animated, creative, inspiration, javascript" />
    <meta name="author" content="Codrops" />
    <link rel="stylesheet" type="text/css" href="/block/css/normalize.css" />
    <link href='http://fonts.googleapis.com/css?family=Raleway:200,400,800' rel='stylesheet' type='text/css'>
    <!--[if IE]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="/block/css/styles.css">
</head>
<body>

<body id="home">
<div id="large-header" class="large-header">
    <canvas id="demo-canvas"></canvas>
</div>
<div id="Content" class="wrapper">
    <div class="top-wrapper">
        <div id="header">
            <div class="wrapper">
                <h1><a href="#" class="logo"><img style="max-width: 80%;" src="/block/img/logo.png"></a></h1>
            </div>
        </div>
        <div class="countdown styled"></div>

    </div>
    <div class="bottom-wrapper wrapper">
        <h2 class="intro"><?=Yii::$app->params['frontend_block_mess']?></h2>
        <?php /*
        <div id="subscribe">

            <div id="socialIcons">
                <ul>
                    <li><a href="" title="Twitter" class="twitterIcon"></a></li>
                    <li><a href="" title="facebook" class="facebookIcon"></a></li>
                    <li><a href="" title="linkedIn" class="linkedInIcon"></a></li>
                    <li><a href="" title="Pintrest" class="pintrestIcon"></a></li>
                </ul>
            </div>
        </div>
        <span class="tempBy">Template by: <a href="http://webthemez.com" alt="webthemez">WebThemez.com</a></span>
        */ ?>
    </div>
</div>

<script src="/block/js/TweenLite.min.js"></script>
<script src="/block/js/EasePack.min.js"></script>
<script src="/block/js/rAF.js"></script>
<script src="/block/js/demo-1.js"></script>


<!--Scripts-->
<script type="text/javascript" src="/block/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="/block/js/jquery.countdown.js"></script>
<script>
    var openDate = '<?=Yii::$app->params['frontend_block_date']?>';
</script>
<script type="text/javascript" src="/block/js/global.js"></script>

</body>
</html>