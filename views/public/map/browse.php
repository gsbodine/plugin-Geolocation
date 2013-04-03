<?php 
queue_js_url("http://maps.google.com/maps/api/js?sensor=false");
queue_js_file('map');


$css = "
            #map_browse {
                height: 436px;
            }
            .balloon {width:200px !important; font-size:1.2em;}
            .balloon .title {font-weight:bold;margin-bottom:1.5em;}
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

<div class="pagination text-center">
    <?php echo pagination_links(); ?>
</div><!-- end pagination -->

<div id="primary">

<div id="map_block">
    <?php echo $this->googleMap('map_browse', array('loadKml'=>true, 'list'=>'map-links'));?>
</div><!-- end map_block -->

<div id="link_block">
    <div id="map-links"><p class="lead text-center"><i class="icon-map-marker"></i> Locate An Item on the Map</p></div><!-- Used by JavaScript -->
</div><!-- end link_block -->

<div class="row">
    <?php 
        // calling view helper in Crowd-Ed
        echo $this->maps()->maps_search_form(array('id'=>'search'), $_SERVER['REQUEST_URI']); 
    ?>
</div>

</div><!-- end primary -->

<?php echo foot(); ?>