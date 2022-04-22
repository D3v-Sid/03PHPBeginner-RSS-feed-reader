<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://unpkg.com/@picocss/pico@latest/css/pico.min.css">
    <title>RSS Feed Reader</title>
</head>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RSS feed reader website</title>
    <link rel="stylesheet" href="styles.css">
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
            $domObject = new DOMDocument();

            if (!empty($_POST["url"]) ) {
                $domObject->load($_POST['url']);
                $content = $domObject->getElementsByTagName("item");
            }
        ?>


        <?php foreach ($content as $data) : ?>
        <?php         
            $title = $data->getElementsByTagName("title")->item(0)->nodeValue;
            $link = $data->getElementsByTagName("link")->item(0)->nodeValue;
            $description = $data->getElementsByTagName("description")->item(0)->nodeValue;
        ?>
        <article>
            <h3><?= $title ?></h3>
            <p><?= $description ?></p>
            <h4><a href="<?= $link ?>">More</a> </h4>
        </article>


        <?php endforeach ?>


    </main>
</body>

</html>



<style>
ul,
ol {
    list-style: none;
}

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


/* Header */
.hero {
    background-color: #394046;
    background-image: url("https://source.unsplash.com/7XRs2HIWLWI/3000x1000");
    background-position: center;
    background-size: cover;
    padding: 1.5rem;
}
</style>