<?php 
queue_js_url("http://maps.google.com/maps/api/js?sensor=false");
queue_js_file('map');


$css = "
            #map_browse {
                height: 436px;
            }
            .balloon {width:400px !important; font-size:1.2em;}
            .balloon .title {font-weight:bold;margin-bottom:1.5em;}
            .balloon .title, .balloon .description {float:left; width: 220px;margin-bottom:1.5em;}
            .balloon img {float:right;display:block;}
            .balloon .view-item {display:block; float:left; clear:left; font-weight:bold; text-decoration:none;}
            #map-links a {
                display:block;
            }
            #search_block {
                clear: both;
            }";
queue_css_string($css);

echo head(array('title' => __('Browse Map'),'bodyid'=>'map','bodyclass' => 'browse')); ?>


    <h1><i class="icon-globe"></i> Browse Items <small>on the map (<?php echo $totalItems; ?> total)</small></h1>

<nav class="items-nav navigation" id="secondary-nav">
    <?php echo public_nav_items()->setUlClass('nav nav-pills'); ?>
</nav>

<div class="pagination">
    <?php echo pagination_links(); ?>
</div><!-- end pagination -->

<div id="primary">

<div id="map_block">
    <?php echo $this->googleMap('map_browse', array('loadKml'=>true, 'list'=>'map-links'));?>
</div><!-- end map_block -->

<div id="link_block">
    <div id="map-links"><h2>Find An Item on the Map</h2></div><!-- Used by JavaScript -->
</div><!-- end link_block -->

</div><!-- end primary -->

<?php echo foot(); ?>