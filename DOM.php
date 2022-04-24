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

    <main class="container">
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
            <input type="url" name="url" placeholder="Your favorite RSS url" autofocus>
            <input type="submit" class="contrast" value="Feed">
        </form>

        <?php
            function isValidXML(string $url = null){
                /* Turn off errors if url is not RSS feed */
                libxml_use_internal_errors(true);
                try{
                    /* parameters : data, options, dataIsURL,namespace, isPrefix */
                    $xml = new SimpleXMLElement($url,0,true);
                }
                catch(exception $e) {
                    $xml = false;
                }
                finally{
                    return $xml;
                }
            }

            if (!empty($_POST["url"] && isValidXML($_POST["url"])) ) {
                $domObject = new DOMDocument();
                $domObject->load($_POST['url']);
                $content = $domObject->getElementsByTagName("item");
                $image = $domObject->getElementsByTagName("url")[0]->nodeValue;
                $imageSubstitute = "https://source.unsplash.com/7XRs2HIWLWI/150x100";
            }
            else{
                return "URL is not RSS";
            }
        ?>


        <?php foreach ($content as $data) : ?>
        <?php         
            $title = $data->getElementsByTagName("title")[0]->nodeValue;
            $link = $data->getElementsByTagName("link")[0]->nodeValue;
            $fullDescription = $data->getElementsByTagName("description")[0]->nodeValue;
            $shortDescription = substr($fullDescription,0, strpos( $fullDescription, "</p>"));
            
        ?>
        <article>
            <h3><?= $title ?></h3>
            <div class="grid">
                <img src=<?= Empty($image)? $imageSubstitute:$image ?> width="150" height="100" />
                <span><?= $shortDescription ?></span>
            </div>
            <h4><a href="<?= $link ?>">More...</a> </h4>
        </article>
        <?php endforeach ?>
    </main>
</body>

</html>



<style>
a,
a:hover,
a:focus,
a:active {
    text-decoration: none;
    color: grey !important;
}

h1 {
    color: white;
}

h4 {
    text-align: right;
}

/* Header */
.hero {
    background-color: #394046;
    background-image: url("https://source.unsplash.com/7XRs2HIWLWI/3000x1000");
    background-position: center;
    background-size: cover;
    padding: 1.5rem;
}

ul,
ol {
    list-style: none;
}
</style>