<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <link rel="stylesheet" href="https://unpkg.com/@picocss/pico@latest/css/pico.min.css">
        <title>RSS Feed Reader</title>
    </head>

    <body>
        <div class="hero">
            <h1>RSS Feeder</h1>
        </div>

        <main class="container ">
            <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                 <input type="url" name="url">
                 <input type="submit" class="contrast" value="Feed me">
            </form>

            <?php     

                function _isValidXML(string $url) {
                       libxml_use_internal_errors(true);
                       try {
                            $xml = new SimpleXMLElement($url,0,true);
                            return  true;

                       } catch (\Throwable $th) {
                           return false;
                       }

                }
                
                function _displayXML(string $url)
                {
                    $content = simplexml_load_file($url,"SimpleXMLElement",LIBXML_NOCDATA);
              /*       var_dump($content); */   
                   foreach ($content->channel->item as $item) {
                        echo "
                            <article>
                                <h3> $item->title </h3>
                                <p> $item->description </p>
                                <a href=$item->link> $item->link </a>
                            </article> ";
                    } 
                }


                isset($_POST["url"]) 
                &&  $_POST["url"] !== "" 
                && _isValidXML($_POST["url"]) ?   
                 _displayXML($_POST["url"])
                : print "Feed me with RSS please"
            ?>



                         
        </main>

    </body>

</html>



<style>
.hero {
  background-color: #394046;
  background-image: url("https://source.unsplash.com/7XRs2HIWLWI/3000x1000");
  background-position: center;
  background-size: cover;
  padding: 1.5rem;
}
h1{
    color: white;
}
</style>

