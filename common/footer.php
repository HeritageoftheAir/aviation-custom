    <!-- </div> -->
    <footer>
      
        <div class="container">

            <div class="row">

                <div class="col-sm-3 col-xs-6">

                    <a  href="http://connectingthenation.net.au"><img class="logo-img" src="<?php echo img('nav-logo-sm2.png'); ?>"></a>
                    <a href="http://www.airservicesaustralia.com"><img class="logo-img" src="<?php echo img('airservices-logo-white.png'); ?>"></a>
                    <a href="http://www.canberra.edu.au"><img class="logo-img" src="<?php echo img('UC-white-400.png'); ?>"></a>

                </div>

<!--                 <div class="col-sm-3">
                    <h3><a href="http://connectingthenation.net.au">Home</a></h3>
                </div> -->
                 <div class="col-sm-3 col-xs-6">
                    <h3><a href="our-heritage">Our Heritage</a></h3>
                    <ul>
                        <li><a href="http://connectingthenation.net.au/our-heritage/communications/">Communications</a></li>
                        <li><a href="http://connectingthenation.net.au/our-heritage/community-building">Community Building</a></li>
                        <li><a href="http://connectingthenation.net.au/our-heritage/defence">Defence</a></li>
                        <li><a href="http://connectingthenation.net.au/our-heritage/empire">Empire</a></li>
                        <li><a href="http://connectingthenation.net.au/our-heritage/environment">Environment</a></li>
                        <li><a href="http://connectingthenation.net.au/our-heritage/identity">Identity</a></li>
                        <li><a href="http://connectingthenation.net.au/our-heritage/innovation">Innovation</a></li>
                        <li><a href="http://connectingthenation.net.au/our-heritage/isolation">Isolation</a></li>
                        <li><a href="http://connectingthenation.net.au/our-heritage/modernity">Modernity</a></li>
                        <li><a href="http://connectingthenation.net.au/our-heritage/safety">Safety</a></li>
                        <li><a href="http://connectingthenation.net.au/our-heritage/security">Security</a></li>
                        <li><a href="http://connectingthenation.net.au/our-heritage/tourism">Tourism</a></li>
                        <li><a href="http://connectingthenation.net.au/our-heritage/training">Training</a></li>
                    </ul>
                </div>

                <div class="col-sm-3 col-xs-6">
                    <h3><a href="http://connectingthenation.net.au/items/browse">Browse Items</a></h3>
                    <ul>
                        <li><a href="http://connectingthenation.net.au/items/browse">Browse All</a></li>
                        <li><a href="http://connectingthenation.net.au/items/tags">Browse By Tag</a></li>
                        <li><a href="http://connectingthenation.net.au/collections">Browse By Collection</a></li>
                        <li><a href="http://connectingthenation.net.au/items/search">Search</a></li>
                    </ul>
                </div>

                <div class="col-sm-3 col-xs-6">
                    <h3><a href="http://connectingthenation.net.au/mosaic">Mosaic</a></h3>
                </div>

                <div class="col-sm-3 col-xs-6">
                    <h3><a href="http://connectingthenation.net.au/contact">Contact Us</a></h3>
                </div>

            </div>
     

        </div>
        <?php fire_plugin_hook('public_footer', array('view' => $this)); ?>
    </footer>
</body>
</html>



