<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="/phpmotors/css/main.css" media="screen">
  <title>Home | PHP Motors</title>
</head>
<body>

    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>
    
    <nav>
         <?php //require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/nav.php';
         echo $navList;?> 
    </nav>
    <main>
        <h1 class="heading_welcome">Welcome to PHP Motors!</h1>
        <div class="car">
            <section class="car_discription">
                <h2 class="car_name">DMC Delorean</h2>
                <p>
                    3 Cup holders<br>
                    Superman doors<br>
                    Fuzzy dice!
                </p>
            </section>
            <img src="/phpmotors/images/vehicles/delorean.jpg" alt="Picture of a Delorean" class="picture_of_car responsive">
        </div>
        <button type="button" class="buy_button">Own Today</button>
        <div class="large_size_grid">
        <section class="reviews">
            <h2 class="heading_reviews">DMC Delorean Reviews</h2>
            <ul class="list_reviews">
                <li>"So fast its almost like traveling in time." (4/5)</li>
                <li>"Coolest ride on the road." (4/5)</li>
                <li>"I'm feeling Marty McFly!" (5/5)</li>
                <li>"The most futuristic ride of our day" (4.5/5)</li>
                <li>"80's livin and I love it!" (5/5)</li>
            </ul>
        </section>
        <aside class="upgrades">
            <h2 class="heading_upgrades">Delorean Upgrades</h2>
            <figure class="upgrade">
                <div class="rectangle">
                <img src="/phpmotors/images/upgrades/flux-cap.png" alt="Picture of a flux capacitor" class="upgrade_img responsive">
                </div>
                <figcaption class="upgrade_link"><a href="/flux_capacitor">Flux Capacitor</a></figcaption>
            </figure>
            <figure class="upgrade">
                <div class="rectangle">
                <img src="/phpmotors/images/upgrades/flame.jpg" alt="Picture of flame decal" class="upgrade_img">
                </div>
                <figcaption class="upgrade_link"><a href="/flame_decals">Flame Decals</a></figcaption>
            </figure>
            <figure class="upgrade">
                <div class="rectangle">
                <img src="/phpmotors/images/upgrades/bumper_sticker.jpg" alt="Picture of Bumper  with a sticker on it" class="upgrade_img">
                </div>
                <figcaption class="upgrade_link"><a href="/bumper_stickers">Bumper Stickers</a></figcaption>
            </figure>
            <figure class="upgrade">
                <div class="rectangle">
                <img src="/phpmotors/images/upgrades/hub-cap.jpg" alt="Picture of a hub cap" class="upgrade_img">
                </div>
                <figcaption class="upgrade_link"><a href="/hub_caps">Hub Caps</a></figcaption>
            </figure>
        </aside>
        </div>
    </main>
    <footer>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
    </footer>
</body>
</html>