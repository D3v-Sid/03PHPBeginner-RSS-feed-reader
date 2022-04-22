<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/@picocss/pico@latest/css/pico.min.css">
    <title>RSS Reader</title>
</head>

<body>
    <div class="hero">
        <h1>RSS Feeder</h1>
    </div>

    <main class="container">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
            <input type="url" name="url" placeholder="Your favorite RSS url" autofocus>
            <input type="submit" class="contrast" value="Feed">
        </form>
        <article>
            <?php
            if (isset($_POST["url"])): ?>
            <div>
                <?php 
                    $rssContent = ParseURL($_POST["url"]);
                    if ($rssContent):
                        foreach ($rssContent->channel->item as $item) {
                        $title = $item->title;
                        $description = mb_strimwidth($item->description,0,200,"...");
                        $fullDescription = $item->description;
                        $url = $rssContent->channel->link;
                        $image = empty($rssContent->channel->image->url)?  "https://source.unsplash.com/7XRs2HIWLWI/150x100":$rssContent->channel->image->url ;
                        $time = strtotime( $item->pubDate);
                        $date = date('d/m/Y',$time);
                        echo "
                            <article>
                                <hgroup>
                                    <h3> $title </h3>
                                    <span> $date </span>
                                </hgroup>
                                <div class='grid'>
                                    <img src='$image' width=150 height=100> 
                                    $fullDescription
                                    <a href='$url'> More </a>
                                </div>
                            </article>
                        ";
                    }
                    else:
                        echo"Unable to parse RSS from the given URL.Are you sure It's a RSS Feed?";
                    endif
                ?>

            </div>
            <?php else: ?>
            <p>Looking for RSS Feed :
                <a href="https://www.rsssearchhub.com/" target="_blank"> Instant RSS Search
                </a>
            </p>

            <?php endif ?>



        </article>
    </main>


</body>

</html>

<?php 
function ParseURL(string $url )
/** 
 * This function will parse the url passed by user into an XML object.
 * param url(string) : the url passed into the form, pointing to a RSS feed.
 * return simpleXML object OR false if the URL is not pointing at a RSS feed.
*/
{
    /* Turn off errors if url is not RSS feed */
    libxml_use_internal_errors(true);
    
    try{
        /* parameters : data, options, dataIsURL,namespace, isPrefix */
        $xml = new SimpleXMLElement($url,0,true);
    }
    catch(exception $e) {
        return false;
    }
    finally{
        $xmlContent = simplexml_load_file($url,"SimpleXMLElement",LIBXML_NOCDATA);
        
        return $xmlContent ;
       
    }
}
?>

<style>
.hero {
    background-color: #394046;
    background-image: url("https://source.unsplash.com/7XRs2HIWLWI/3000x1000");
    background-position: center;
    background-size: cover;
    padding: 1.5rem;
}

h1 {
    color: white;
}
</style>