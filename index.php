<?php
require_once(__DIR__.'/libraries/vendor/phpFlickr/phpFlickr.php');

define('__FLICKR_API_KEY__', 'c4ab144d6da31a15125de4a43f7585c2');
define('__IMAGE_PER_PAGE__', 100);

$flickr = new phpFlickr(__FLICKR_API_KEY__);
$result = $flickr->photos_search(['text'=>'raccoon','tags'=>'raccoon','per_page'=>__IMAGE_PER_PAGE__]);

?>
<html>
<head>
    <meta charset="utf-8">
    <title>Raccoon for everyone!</title>
    <link rel="stylesheet" href="/css/style.css" />
    <script type="text/javascript" language="JavaScript" src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script type="text/javascript" language="JavaScript" src="/js/vendor/jquery/plugins/jquery.lazyload.js"></script>
    <script type="text/javascript" language="JavaScript">
        $(function () {
           $('.polaroids').lazyLoad({
               selector: '.lazyload',
               placeholder: '/img/placeholder.gif'
           });
        });
    </script>
</head>
<body>
<ul class="polaroids">
<?php
foreach($result['photo'] as $p) {
    if (strlen($p['title']) > 20) {
        $p['title'] = substr($p['title'], 0, 17) . '...';
    }

    echo '<li><a title="'.$p['title'].'" href="javascript:void(0);"><img class="lazyload" data-src="http://farm'.$p['farm'].'.static.flickr.com/'.$p['server'].'/'.$p['id'].'_'.$p['secret'].'.jpg" alt="'.$p['title'].'"></a></li>'."\n";
}
?>
</ul>
</body>
</html>

