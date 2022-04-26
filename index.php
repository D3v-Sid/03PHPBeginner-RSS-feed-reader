<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://unpkg.com/@picocss/pico@latest/css/pico.min.css">
    <title>RSS Feeder</title>
</head>

<body>
    <div class="hero">
        <h1>RSS Feeder</h1>
    </div>
    <main class="container ">
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
            <input type="url" name="url" placeholder="Your favorite RSS url" autofocus>
            <input type="submit" class="contrast" value="Feed">
        </form>
        <?php 
            function isXML(string $url){
            /* Explicitly return if url is valid XML */
                libxml_use_internal_errors(true);
                $Isxml = simplexml_load_file($url,"SimpleXMLElement",LIBXML_NOCDATA);
                return $Isxml;
            }
            
            if (isset($_POST["url"])){
                $url = $_POST["url"];
                $xml = isXML($url);
            }      
        ?>
        <?php if($xml):
                $imageUrl = $xml->channel->image->url;
                require_once("./Article.php");          
                foreach ($xml->channel->item as $item){
                    $article = new Article($item,$imageUrl);
                    $article->display();
                }
             ?>
        <?php else : ?>
        <article>
            <p>This URL is not a valid RSS feed.😥 </p>
            <a href="https://rss.com/blog/popular-rss-feeds/" target="_blank" rel="noopener noreferrer">
                Link to popular RSS Feed.
            </a>
            <br> <br>
            <i>
                <a href="https://rss.com/blog/how-do-rss-feeds-work/" target="_blank" rel="noopener noreferrer">
                    What's a RSS Feed ?
                </a> </i>



        </article>
        <?php endif ?>


    </main>
</body>

</html>

<style>
/* Header */
.hero {
    background-color: #394046;
    background-image: url("https://source.unsplash.com/7XRs2HIWLWI/1000x250");
    background-position: center;
    background-size: cover;
    padding: 1.5rem;
}

h1 {
    color: white;
}

ol {
    list-style: none;
}
</style>