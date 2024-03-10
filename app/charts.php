<?php 
    require_once("main_config.php");
?>

<!DOCTYPE html>
<!-- 
Template Name:  SmartAdmin Responsive WebApp - Template build with Twitter Bootstrap 4
Version: 4.5.1
Author: Sunnyat A.
Website: http://gootbootstrap.com
Purchase: https://wrapbootstrap.com/theme/smartadmin-responsive-webapp-WB0573SK0?ref=myorange
License: You must have a valid license purchased only from wrapbootstrap.com (link above) in order to legally use this theme for your project.
-->
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>
            Flot - Statistics - SmartAdmin v4.5.1
        </title>
        <meta name="description" content="Flot">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
        <!-- Call App Mode on ios devices -->
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <!-- Remove Tap Highlight on Windows Phone IE -->
        <meta name="msapplication-tap-highlight" content="no">
        <!-- base css -->
        <link id="vendorsbundle" rel="stylesheet" media="screen, print" href="smartadmin/css/vendors.bundle.css">
        <link id="appbundle" rel="stylesheet" media="screen, print" href="smartadmin/css/app.bundle.css">
        <link id="mytheme" rel="stylesheet" media="screen, print" href="#">
        <link id="myskin" rel="stylesheet" media="screen, print" href="smartadmin/css/skins/skin-master.css">
        <!-- Place favicon.ico in the root directory -->
        <link rel="apple-touch-icon" sizes="180x180" href="smartadmin/img/favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="smartadmin/img/favicon/favicon-32x32.png">
        <link rel="mask-icon" href="img/favicon/safari-pinned-tab.svg" color="#5bbad5">
    </head>
    <!-- BEGIN Body -->
    <!-- Possible Classes

        * 'header-function-fixed'         - header is in a fixed at all times
        * 'nav-function-fixed'            - left panel is fixed
        * 'nav-function-minify'           - skew nav to maximize space
        * 'nav-function-hidden'           - roll mouse on edge to reveal
        * 'nav-function-top'              - relocate left pane to top
        * 'mod-main-boxed'                - encapsulates to a container
        * 'nav-mobile-push'               - content pushed on menu reveal
        * 'nav-mobile-no-overlay'         - removes mesh on menu reveal
        * 'nav-mobile-slide-out'          - content overlaps menu
        * 'mod-bigger-font'               - content fonts are bigger for readability
        * 'mod-high-contrast'             - 4.5:1 text contrast ratio
        * 'mod-color-blind'               - color vision deficiency
        * 'mod-pace-custom'               - preloader will be inside content
        * 'mod-clean-page-bg'             - adds more whitespace
        * 'mod-hide-nav-icons'            - invisible navigation icons
        * 'mod-disable-animation'         - disables css based animations
        * 'mod-hide-info-card'            - hides info card from left panel
        * 'mod-lean-subheader'            - distinguished page header
        * 'mod-nav-link'                  - clear breakdown of nav links

        >>> more settings are described inside documentation page >>>
    -->
    <body class="mod-bg-1 mod-nav-link ">
        <!-- DOC: script to save and load page settings -->
        <script>
            /**
             *  This script should be placed right after the body tag for fast execution 
             *  Note: the script is written in pure javascript and does not depend on thirdparty library
             **/
            'use strict';

            var classHolder = document.getElementsByTagName("BODY")[0],
                /** 
                 * Load from localstorage
                 **/
                themeSettings = (localStorage.getItem('themeSettings')) ? JSON.parse(localStorage.getItem('themeSettings')) :
                {},
                themeURL = themeSettings.themeURL || '',
                themeOptions = themeSettings.themeOptions || '';
            /** 
             * Load theme options
             **/
            if (themeSettings.themeOptions)
            {
                classHolder.className = themeSettings.themeOptions;
                console.log("%c✔ Theme settings loaded", "color: #148f32");
            }
            else
            {
                console.log("%c✔ Heads up! Theme settings is empty or does not exist, loading default settings...", "color: #ed1c24");
            }
            if (themeSettings.themeURL && !document.getElementById('mytheme'))
            {
                var cssfile = document.createElement('link');
                cssfile.id = 'mytheme';
                cssfile.rel = 'stylesheet';
                cssfile.href = themeURL;
                document.getElementsByTagName('head')[0].appendChild(cssfile);

            }
            else if (themeSettings.themeURL && document.getElementById('mytheme'))
            {
                document.getElementById('mytheme').href = themeSettings.themeURL;
            }
            /** 
             * Save to localstorage 
             **/
            var saveSettings = function()
            {
                themeSettings.themeOptions = String(classHolder.className).split(/[^\w-]+/).filter(function(item)
                {
                    return /^(nav|header|footer|mod|display)-/i.test(item);
                }).join(' ');
                if (document.getElementById('mytheme'))
                {
                    themeSettings.themeURL = document.getElementById('mytheme').getAttribute("href");
                };
                localStorage.setItem('themeSettings', JSON.stringify(themeSettings));
            }
            /** 
             * Reset settings
             **/
            var resetSettings = function()
            {
                localStorage.setItem("themeSettings", "");
            }

        </script>
        <!-- BEGIN Page Wrapper -->
        <div class="page-wrapper" >
            <div class="page-inner" >
                <!-- BEGIN Left Aside -->
                <!--<aside class="page-sidebar">
                </aside>-->
                <!-- END Left Aside -->
                <div class="page-content-wrapper"  >
                    <!-- BEGIN Page Header -->
                    <!--<header class="page-header" role="banner">
                    </header> -->
                    <!-- END Page Header -->
                    <!-- BEGIN Page Content -->
                    <!-- the #js-page-content id is needed for some plugins to initialize -->
                    <main id="js-page-content" role="main" class="page-content"  >
                        <!--
                        <ol class="breadcrumb page-breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">SmartAdmin</a></li>
                            <li class="breadcrumb-item">Statistics</li>
                            <li class="breadcrumb-item active">Flot</li>
                            <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
                        </ol>
                        <div class="subheader">
                            <h1 class="subheader-title">
                                <i class='subheader-icon fal fa-chart-pie'></i> Flot <sup class='badge badge-primary fw-500'>ADDON</sup>
                                <small>
                                    Flot is a pure JavaScript plotting library for jQuery, with a focus on simple usage, attractive looks and interactive features
                                </small>
                            </h1>
                        </div>
                        <div class="alert alert-primary">
                            <div class="d-flex flex-start w-100">
                                <div class="mr-2 hidden-md-down">
                                    <span class="icon-stack icon-stack-lg">
                                        <i class="base base-6 icon-stack-3x opacity-100 color-primary-500"></i>
                                        <i class="base base-10 icon-stack-2x opacity-100 color-primary-300 fa-flip-vertical"></i>
                                        <i class="ni ni-blog-read icon-stack-1x opacity-100 color-white"></i>
                                    </span>
                                </div>
                                <div class="d-flex flex-fill">
                                    <div class="flex-fill">
                                        <span class="h5">Ease of use</span>
                                        <p>
                                            Flot is a pure JavaScript plotting library for jQuery, with a focus on simple usage, attractive looks and interactive features. Additional examples are bundled with Flot. Flot is easy to use, just a few lines of code, you can make a simple line chart, it also provides a comprehensive API documentation where you can find examples, usage and methods. The most important part, Flot continues to release new versions, each new version comes with new features.
                                        </p>
                                        <p class="m-0">
                                            Find more examples and guidelines on Flot's <a href="https://www.flotcharts.org/flot/examples/" target="_blank">official documentation</a> and detailed tutorials on <a href="http://www.jqueryflottutorial.com/how-to-make-jquery-flot-line-chart.html" target="_blank">Flot Tutorials</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>-->
                        <div class="row">
                            <div class="col-xl-12">
                                <div id="panel-1" class="panel">
                                    <div class="panel-hdr">
                                        <h2>
                                            Kitchen <span class="fw-300"><i>Sink (example)</i></span>
                                        </h2>
                                        <div class="panel-toolbar">
                                            <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                                            <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                                            <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                                        </div>
                                    </div>
                                    <div class="panel-container show">
                                        <div class="panel-content">
                                            <div class="panel-tag">
                                                We use a combination of various plots to create a more intricate diagram. More basic examples of plot can be found below
                                            </div>
                                            <div id="js-checkbox-toggles" class="d-flex mb-3">
                                                <div class="custom-control custom-switch mr-2">
                                                    <input type="checkbox" class="custom-control-input" name="gra-0" id="gra-0" checked="">
                                                    <label class="custom-control-label" for="gra-0">Target Profit</label>
                                                </div>
                                                <div class="custom-control custom-switch mr-2">
                                                    <input type="checkbox" class="custom-control-input" name="gra-1" id="gra-1" checked="">
                                                    <label class="custom-control-label" for="gra-1">Actual Profit</label>
                                                </div>
                                                <div class="custom-control custom-switch mr-2">
                                                    <input type="checkbox" class="custom-control-input" name="gra-2" id="gra-2" checked="">
                                                    <label class="custom-control-label" for="gra-2">User Signups</label>
                                                </div>
                                            </div>
                                            <div id="flot-toggles" class="w-100 mt-4" style="height: 300px"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xl-6">
                                <div id="panel-2" class="panel">
                                    <div class="panel-hdr">
                                        <h2>
                                            Flot <span class="fw-300"><i>Bar</i></span>
                                        </h2>
                                        <div class="panel-toolbar">
                                            <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                                            <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                                            <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                                        </div>
                                    </div>
                                    <div class="panel-container show">
                                        <div class="panel-content">
                                            <div class="panel-tag">
                                                Single barchart to display timeline differences. It is currently displaying only one group of data
                                            </div>
                                            <div id="flot-bar" style="width:100%; height:300px;"></div>
                                        </div>
                                    </div>
                                </div>
                                <div id="panel-3" class="panel">
                                    <div class="panel-hdr">
                                        <h2>
                                            Flot <span class="fw-300"><i>Line</i></span>
                                        </h2>
                                        <div class="panel-toolbar">
                                            <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                                            <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                                            <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                                        </div>
                                    </div>
                                    <div class="panel-container show">
                                        <div class="panel-content">
                                            <div class="panel-tag">
                                                Flot lines are the most easest to make and can display lots of data very nicely!
                                            </div>
                                            <div id="flot-line" style="width:100%; height:300px;"></div>
                                        </div>
                                    </div>
                                </div>
                                <div id="panel-4" class="panel">
                                    <div class="panel-hdr">
                                        <h2>
                                            Flot <span class="fw-300"><i>Line (tooltip)</i></span>
                                        </h2>
                                        <div class="panel-toolbar">
                                            <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                                            <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                                            <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                                        </div>
                                    </div>
                                    <div class="panel-container show">
                                        <div class="panel-content">
                                            <div class="panel-tag">
                                                Adding tooltips is easy, you will need to include the plugin <code>jquery.flot.tooltip.js</code>
                                            </div>
                                            <div id="flot-line-alt" style="width:100%; height:300px;"></div>
                                        </div>
                                    </div>
                                </div>
                                <div id="panel-5" class="panel">
                                    <div class="panel-hdr">
                                        <h2>
                                            Flot <span class="fw-300"><i>Area</i></span>
                                        </h2>
                                        <div class="panel-toolbar">
                                            <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                                            <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                                            <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                                        </div>
                                    </div>
                                    <div class="panel-container show">
                                        <div class="panel-content">
                                            <div class="panel-tag">
                                                Area chart overlaps one over the other, making it easier to see the proportion of data
                                            </div>
                                            <div id="flot-area" style="width:100%; height:300px;"></div>
                                        </div>
                                    </div>
                                </div>
                                <div id="panel-6" class="panel">
                                    <div class="panel-hdr">
                                        <h2>
                                            Flot <span class="fw-300"><i>Interval Curve</i></span>
                                        </h2>
                                        <div class="panel-toolbar">
                                            <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                                            <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                                            <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                                        </div>
                                    </div>
                                    <div class="panel-container show">
                                        <div class="panel-content">
                                            <div class="panel-tag">
                                                Generates random data to populate and redraw recursively, we use the <code>jquery.flot.spline.js</code> plugin to make the lines curvey
                                            </div>
                                            <div class="btn-group">
                                                <button class="btn btn-secondary btn-sm dropdown-toggle mb-g" type="button" data-toggle="dropdown" aria-expanded="false"> Change interval </button>
                                                <div class="dropdown-menu dropdown-lg p-0">
                                                    <div class="px-4 py-2 d-flex align-items-center justify-content-center">
                                                        <input type="range" class="custom-range js-set-interval" id="js-flot-realtime-curved-speed" min="-1000" max="-100" step="100" value="-1000">
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="flot-realtime-curved" style="width:100%; height:300px;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xl-6">
                                <div id="panel-7" class="panel">
                                    <div class="panel-hdr">
                                        <h2>
                                            Flot <span class="fw-300"><i>Multiple Bars</i></span>
                                        </h2>
                                        <div class="panel-toolbar">
                                            <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                                            <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                                            <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                                        </div>
                                    </div>
                                    <div class="panel-container show">
                                        <div class="panel-content">
                                            <div class="panel-tag">
                                                Here we compare relations of different data groups, the greater the length of bar, bigger the value
                                            </div>
                                            <div id="flot-bar-fill" style="width:100%; height:300px;"></div>
                                        </div>
                                    </div>
                                </div>
                                <div id="panel-8" class="panel">
                                    <div class="panel-hdr">
                                        <h2>
                                            Flot <span class="fw-300"><i>Curved Lines</i></span>
                                        </h2>
                                        <div class="panel-toolbar">
                                            <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                                            <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                                            <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                                        </div>
                                    </div>
                                    <div class="panel-container show">
                                        <div class="panel-content">
                                            <div class="panel-tag">
                                                Curved lines by using the plugin <code>jquery.flot.spline.js</code>, adding a nice transition to the eyes
                                            </div>
                                            <div id="flot-line-curves" style="width:100%; height:300px;"></div>
                                        </div>
                                    </div>
                                </div>
                                <div id="panel-9" class="panel">
                                    <div class="panel-hdr">
                                        <h2>
                                            Flot <span class="fw-300"><i>Curved (tooltip)</i></span>
                                        </h2>
                                        <div class="panel-toolbar">
                                            <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                                            <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                                            <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                                        </div>
                                    </div>
                                    <div class="panel-container show">
                                        <div class="panel-content">
                                            <div class="panel-tag">
                                                We take the flot chart from previous example (above) and add tooltips
                                            </div>
                                            <div id="flot-line-curves-alt" style="width:100%; height:300px;"></div>
                                        </div>
                                    </div>
                                </div>
                                <div id="panel-10" class="panel">
                                    <div class="panel-hdr">
                                        <h2>
                                            Flot <span class="fw-300"><i>Area Curved</i></span>
                                        </h2>
                                        <div class="panel-toolbar">
                                            <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                                            <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                                            <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                                        </div>
                                    </div>
                                    <div class="panel-container show">
                                        <div class="panel-content">
                                            <div class="panel-tag">
                                                This Area chart has smooth curved lines to make it easy to read
                                            </div>
                                            <div id="flot-area-fill" style="width:100%; height:300px;"></div>
                                        </div>
                                    </div>
                                </div>
                                <div id="panel-11" class="panel">
                                    <div class="panel-hdr">
                                        <h2>
                                            Flot <span class="fw-300"><i>Interval (fill)</i></span>
                                        </h2>
                                        <div class="panel-toolbar">
                                            <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                                            <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                                            <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                                        </div>
                                    </div>
                                    <div class="panel-container show">
                                        <div class="panel-content">
                                            <div class="panel-tag">
                                                In this interval example we fill the whitespace. You can also try the interval button to change the speed of the redrawing
                                            </div>
                                            <div class="btn-group">
                                                <button class="btn btn-secondary btn-sm dropdown-toggle mb-g" type="button" data-toggle="dropdown" aria-expanded="false"> Change interval </button>
                                                <div class="dropdown-menu dropdown-lg p-0">
                                                    <div class="px-4 py-2 d-flex align-items-center justify-content-center">
                                                        <input type="range" class="custom-range js-set-interval" id="js-flot-realtime-fill-speed" min="-1000" max="-100" step="100" value="-1000">
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="flot-realtime-fill" style="width:100%; height:300px;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div id="panel-12" class="panel">
                                    <div class="panel-hdr">
                                        <h2>
                                            Flot <span class="fw-300"><i>Pie</i></span>
                                        </h2>
                                        <div class="panel-toolbar">
                                            <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                                            <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                                            <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                                        </div>
                                    </div>
                                    <div class="panel-container show">
                                        <div class="panel-content">
                                            <div class="panel-tag">
                                                Pie chart is used to see the proprotion of each data groups, making Flot pie chart is pretty simple, in order to make pie chart you have to incldue <code>jquery.flot.pie.js</code> plugin
                                            </div>
                                            <div class="row">
                                                <div class="col-xl-5">
                                                    <div id="js-pie-options" class="w-100" style="height: 250px"></div>
                                                </div>
                                                <div class="col-xl-6 offset-xl-1">
                                                    <div class="h-100 d-flex align-items-center mt-3 mt-xl-0">
                                                        <div class="demo">
                                                            <button id="example-1" class="btn btn-outline-primary js-pie-example">Default Options</button>
                                                            <button id="example-2" class="btn btn-outline-primary js-pie-example">Without Legend</button>
                                                            <button id="example-3" class="btn btn-outline-primary js-pie-example">Label Formatter</button>
                                                            <button id="example-4" class="btn btn-outline-primary js-pie-example">Label Radius</button>
                                                            <button id="example-5" class="btn btn-outline-primary js-pie-example">Label Styles #1</button>
                                                            <button id="example-6" class="btn btn-outline-primary js-pie-example">Label Styles #2</button>
                                                            <button id="example-7" class="btn btn-outline-primary js-pie-example">Hidden Labels</button>
                                                            <button id="example-8" class="btn btn-outline-primary js-pie-example">Combined Slice</button>
                                                            <button id="example-9" class="btn btn-outline-primary js-pie-example">Rectangular Pie</button>
                                                            <button id="example-10" class="btn btn-outline-primary js-pie-example">Tilted Pie</button>
                                                            <button id="example-11" class="btn btn-outline-primary js-pie-example">Donut Hole</button>
                                                            <button id="example-12" class="btn btn-outline-primary js-pie-example">Interactivity</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="panel-13" class="panel">
                                    <div class="panel-hdr">
                                        <h2>
                                            Sales <span class="fw-300"><i>Chart (example)</i></span>
                                        </h2>
                                        <div class="panel-toolbar">
                                            <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                                            <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                                            <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                                        </div>
                                    </div>
                                    <div class="panel-container show">
                                        <div class="panel-content">
                                            <div class="panel-tag">
                                                Pie chart is used to see the proprotion of each data groups, making Flot pie chart is pretty simple, in order to make pie chart you have to incldue <code>jquery.flot.pie.js</code> plugin
                                            </div>
                                            <div id="flot-sales" class="w-100" style="height: 350px"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </main>
                    <!-- this overlay is activated only when mobile menu is triggered -->
                    <div class="page-content-overlay" data-action="toggle" data-class="mobile-nav-on"></div> <!-- END Page Content -->
                    <!-- BEGIN Page Footer -->
                    <!--<footer class="page-footer" role="contentinfo">
                        <div class="d-flex align-items-center flex-1 text-muted">
                            <span class="hidden-md-down fw-700">2020 © SmartAdmin by&nbsp;<a href='https://www.gotbootstrap.com' class='text-primary fw-500' title='gotbootstrap.com' target='_blank'>gotbootstrap.com</a></span>
                        </div>
                        <div>
                            <ul class="list-table m-0">
                                <li><a href="intel_introduction.html" class="text-secondary fw-700">About</a></li>
                                <li class="pl-3"><a href="info_app_licensing.html" class="text-secondary fw-700">License</a></li>
                                <li class="pl-3"><a href="info_app_docs.html" class="text-secondary fw-700">Documentation</a></li>
                                <li class="pl-3 fs-xl"><a href="https://wrapbootstrap.com/user/MyOrange" class="text-secondary" target="_blank"><i class="fal fa-question-circle" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </footer>-->
                    <!-- END Page Footer -->
                    <!-- BEGIN Shortcuts -->
                    <div class="modal fade modal-backdrop-transparent" id="modal-shortcut" tabindex="-1" role="dialog" aria-labelledby="modal-shortcut" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-top modal-transparent" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <ul class="app-list w-auto h-auto p-0 text-left">
                                        <li>
                                            <a href="intel_introduction.html" class="app-list-item text-white border-0 m-0">
                                                <div class="icon-stack">
                                                    <i class="base base-7 icon-stack-3x opacity-100 color-primary-500 "></i>
                                                    <i class="base base-7 icon-stack-2x opacity-100 color-primary-300 "></i>
                                                    <i class="fal fa-home icon-stack-1x opacity-100 color-white"></i>
                                                </div>
                                                <span class="app-list-name">
                                                    Home
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="page_inbox_general.html" class="app-list-item text-white border-0 m-0">
                                                <div class="icon-stack">
                                                    <i class="base base-7 icon-stack-3x opacity-100 color-success-500 "></i>
                                                    <i class="base base-7 icon-stack-2x opacity-100 color-success-300 "></i>
                                                    <i class="ni ni-envelope icon-stack-1x text-white"></i>
                                                </div>
                                                <span class="app-list-name">
                                                    Inbox
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="intel_introduction.html" class="app-list-item text-white border-0 m-0">
                                                <div class="icon-stack">
                                                    <i class="base base-7 icon-stack-2x opacity-100 color-primary-300 "></i>
                                                    <i class="fal fa-plus icon-stack-1x opacity-100 color-white"></i>
                                                </div>
                                                <span class="app-list-name">
                                                    Add More
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END Shortcuts -->
                    <!-- BEGIN Color profile -->
                    <!-- this area is hidden and will not be seen on screens or screen readers -->
                    <!-- we use this only for CSS color refernce for JS stuff -->
                    <p id="js-color-profile" class="d-none">
                        <span class="color-primary-50"></span>
                        <span class="color-primary-100"></span>
                        <span class="color-primary-200"></span>
                        <span class="color-primary-300"></span>
                        <span class="color-primary-400"></span>
                        <span class="color-primary-500"></span>
                        <span class="color-primary-600"></span>
                        <span class="color-primary-700"></span>
                        <span class="color-primary-800"></span>
                        <span class="color-primary-900"></span>
                        <span class="color-info-50"></span>
                        <span class="color-info-100"></span>
                        <span class="color-info-200"></span>
                        <span class="color-info-300"></span>
                        <span class="color-info-400"></span>
                        <span class="color-info-500"></span>
                        <span class="color-info-600"></span>
                        <span class="color-info-700"></span>
                        <span class="color-info-800"></span>
                        <span class="color-info-900"></span>
                        <span class="color-danger-50"></span>
                        <span class="color-danger-100"></span>
                        <span class="color-danger-200"></span>
                        <span class="color-danger-300"></span>
                        <span class="color-danger-400"></span>
                        <span class="color-danger-500"></span>
                        <span class="color-danger-600"></span>
                        <span class="color-danger-700"></span>
                        <span class="color-danger-800"></span>
                        <span class="color-danger-900"></span>
                        <span class="color-warning-50"></span>
                        <span class="color-warning-100"></span>
                        <span class="color-warning-200"></span>
                        <span class="color-warning-300"></span>
                        <span class="color-warning-400"></span>
                        <span class="color-warning-500"></span>
                        <span class="color-warning-600"></span>
                        <span class="color-warning-700"></span>
                        <span class="color-warning-800"></span>
                        <span class="color-warning-900"></span>
                        <span class="color-success-50"></span>
                        <span class="color-success-100"></span>
                        <span class="color-success-200"></span>
                        <span class="color-success-300"></span>
                        <span class="color-success-400"></span>
                        <span class="color-success-500"></span>
                        <span class="color-success-600"></span>
                        <span class="color-success-700"></span>
                        <span class="color-success-800"></span>
                        <span class="color-success-900"></span>
                        <span class="color-fusion-50"></span>
                        <span class="color-fusion-100"></span>
                        <span class="color-fusion-200"></span>
                        <span class="color-fusion-300"></span>
                        <span class="color-fusion-400"></span>
                        <span class="color-fusion-500"></span>
                        <span class="color-fusion-600"></span>
                        <span class="color-fusion-700"></span>
                        <span class="color-fusion-800"></span>
                        <span class="color-fusion-900"></span>
                    </p>
                    <!-- END Color profile -->
                </div>
            </div>
        </div>
        <!-- END Page Wrapper -->
        <!-- BEGIN Quick Menu -->
        <!-- to add more items, please make sure to change the variable '$menu-items: number;' in your _page-components-shortcut.scss -->
        <!--<nav class="shortcut-menu d-none d-sm-block">
            <input type="checkbox" class="menu-open" name="menu-open" id="menu_open" />
            <label for="menu_open" class="menu-open-button ">
                <span class="app-shortcut-icon d-block"></span>
            </label>
            <a href="#" class="menu-item btn" data-toggle="tooltip" data-placement="left" title="Scroll Top">
                <i class="fal fa-arrow-up"></i>
            </a>
            <a href="page_login.html" class="menu-item btn" data-toggle="tooltip" data-placement="left" title="Logout">
                <i class="fal fa-sign-out"></i>
            </a>
            <a href="#" class="menu-item btn" data-action="app-fullscreen" data-toggle="tooltip" data-placement="left" title="Full Screen">
                <i class="fal fa-expand"></i>
            </a>
            <a href="#" class="menu-item btn" data-action="app-print" data-toggle="tooltip" data-placement="left" title="Print page">
                <i class="fal fa-print"></i>
            </a>
            <a href="#" class="menu-item btn" data-action="app-voice" data-toggle="tooltip" data-placement="left" title="Voice command">
                <i class="fal fa-microphone"></i>
            </a>
        </nav>-->
        <!-- END Quick Menu -->
        <!-- BEGIN Messenger -->
        <div class="modal fade js-modal-messenger modal-backdrop-transparent" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-right">
                <div class="modal-content h-100">
                    <div class="dropdown-header bg-trans-gradient d-flex align-items-center w-100">
                        <div class="d-flex flex-row align-items-center mt-1 mb-1 color-white">
                            <span class="mr-2">
                                <span class="rounded-circle profile-image d-block" style="background-image:url('smartadmin/img/demo/avatars/avatar-d.png'); background-size: cover;"></span>
                            </span>
                            <div class="info-card-text">
                                <a href="javascript:void(0);" class="fs-lg text-truncate text-truncate-lg text-white" data-toggle="dropdown" aria-expanded="false">
                                    Tracey Chang
                                    <i class="fal fa-angle-down d-inline-block ml-1 text-white fs-md"></i>
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#">Send Email</a>
                                    <a class="dropdown-item" href="#">Create Appointment</a>
                                    <a class="dropdown-item" href="#">Block User</a>
                                </div>
                                <span class="text-truncate text-truncate-md opacity-80">IT Director</span>
                            </div>
                        </div>
                        <button type="button" class="close text-white position-absolute pos-top pos-right p-2 m-1 mr-2" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="fal fa-times"></i></span>
                        </button>
                    </div>
                    <div class="modal-body p-0 h-100 d-flex">
                        <!-- BEGIN msgr-list -->
                        <div class="msgr-list d-flex flex-column bg-faded border-faded border-top-0 border-right-0 border-bottom-0 position-absolute pos-top pos-bottom">
                            <div>
                                <div class="height-4 width-3 h3 m-0 d-flex justify-content-center flex-column color-primary-500 pl-3 mt-2">
                                    <i class="fal fa-search"></i>
                                </div>
                                <input type="text" class="form-control bg-white" id="msgr_listfilter_input" placeholder="Filter contacts" aria-label="FriendSearch" data-listfilter="#js-msgr-listfilter">
                            </div>
                            <div class="flex-1 h-100 custom-scroll">
                                <div class="w-100">
                                    <ul id="js-msgr-listfilter" class="list-unstyled m-0">
                                        <li>
                                            <a href="#" class="d-table w-100 px-2 py-2 text-dark hover-white" data-filter-tags="tracey chang online">
                                                <div class="d-table-cell align-middle status status-success status-sm ">
                                                    <span class="profile-image-md rounded-circle d-block" style="background-image:url('smartadmin/img/demo/avatars/avatar-d.png'); background-size: cover;"></span>
                                                </div>
                                                <div class="d-table-cell w-100 align-middle pl-2 pr-2">
                                                    <div class="text-truncate text-truncate-md">
                                                        Tracey Chang
                                                        <small class="d-block font-italic text-success fs-xs">
                                                            Online
                                                        </small>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="d-table w-100 px-2 py-2 text-dark hover-white" data-filter-tags="oliver kopyuv online">
                                                <div class="d-table-cell align-middle status status-success status-sm ">
                                                    <span class="profile-image-md rounded-circle d-block" style="background-image:url('smartadmin/img/demo/avatars/avatar-b.png'); background-size: cover;"></span>
                                                </div>
                                                <div class="d-table-cell w-100 align-middle pl-2 pr-2">
                                                    <div class="text-truncate text-truncate-md">
                                                        Oliver Kopyuv
                                                        <small class="d-block font-italic text-success fs-xs">
                                                            Online
                                                        </small>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="d-table w-100 px-2 py-2 text-dark hover-white" data-filter-tags="dr john cook phd away">
                                                <div class="d-table-cell align-middle status status-warning status-sm ">
                                                    <span class="profile-image-md rounded-circle d-block" style="background-image:url('smartadmin/img/demo/avatars/avatar-e.png'); background-size: cover;"></span>
                                                </div>
                                                <div class="d-table-cell w-100 align-middle pl-2 pr-2">
                                                    <div class="text-truncate text-truncate-md">
                                                        Dr. John Cook PhD
                                                        <small class="d-block font-italic fs-xs">
                                                            Away
                                                        </small>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="d-table w-100 px-2 py-2 text-dark hover-white" data-filter-tags="ali amdaney online">
                                                <div class="d-table-cell align-middle status status-success status-sm ">
                                                    <span class="profile-image-md rounded-circle d-block" style="background-image:url('smartadmin/img/demo/avatars/avatar-g.png'); background-size: cover;"></span>
                                                </div>
                                                <div class="d-table-cell w-100 align-middle pl-2 pr-2">
                                                    <div class="text-truncate text-truncate-md">
                                                        Ali Amdaney
                                                        <small class="d-block font-italic fs-xs text-success">
                                                            Online
                                                        </small>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="d-table w-100 px-2 py-2 text-dark hover-white" data-filter-tags="sarah mcbrook online">
                                                <div class="d-table-cell align-middle status status-success status-sm">
                                                    <span class="profile-image-md rounded-circle d-block" style="background-image:url('smartadmin/img/demo/avatars/avatar-h.png'); background-size: cover;"></span>
                                                </div>
                                                <div class="d-table-cell w-100 align-middle pl-2 pr-2">
                                                    <div class="text-truncate text-truncate-md">
                                                        Sarah McBrook
                                                        <small class="d-block font-italic fs-xs text-success">
                                                            Online
                                                        </small>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="d-table w-100 px-2 py-2 text-dark hover-white" data-filter-tags="ali amdaney offline">
                                                <div class="d-table-cell align-middle status status-sm">
                                                    <span class="profile-image-md rounded-circle d-block" style="background-image:url('smartadmin/img/demo/avatars/avatar-a.png'); background-size: cover;"></span>
                                                </div>
                                                <div class="d-table-cell w-100 align-middle pl-2 pr-2">
                                                    <div class="text-truncate text-truncate-md">
                                                        oliver.kopyuv@gotbootstrap.com
                                                        <small class="d-block font-italic fs-xs">
                                                            Offline
                                                        </small>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="d-table w-100 px-2 py-2 text-dark hover-white" data-filter-tags="ali amdaney busy">
                                                <div class="d-table-cell align-middle status status-danger status-sm">
                                                    <span class="profile-image-md rounded-circle d-block" style="background-image:url('smartadmin/img/demo/avatars/avatar-j.png'); background-size: cover;"></span>
                                                </div>
                                                <div class="d-table-cell w-100 align-middle pl-2 pr-2">
                                                    <div class="text-truncate text-truncate-md">
                                                        oliver.kopyuv@gotbootstrap.com
                                                        <small class="d-block font-italic fs-xs text-danger">
                                                            Busy
                                                        </small>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="d-table w-100 px-2 py-2 text-dark hover-white" data-filter-tags="ali amdaney offline">
                                                <div class="d-table-cell align-middle status status-sm">
                                                    <span class="profile-image-md rounded-circle d-block" style="background-image:url('smartadmin/img/demo/avatars/avatar-c.png'); background-size: cover;"></span>
                                                </div>
                                                <div class="d-table-cell w-100 align-middle pl-2 pr-2">
                                                    <div class="text-truncate text-truncate-md">
                                                        oliver.kopyuv@gotbootstrap.com
                                                        <small class="d-block font-italic fs-xs">
                                                            Offline
                                                        </small>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="d-table w-100 px-2 py-2 text-dark hover-white" data-filter-tags="ali amdaney inactive">
                                                <div class="d-table-cell align-middle">
                                                    <span class="profile-image-md rounded-circle d-block" style="background-image:url('smartadmin/img/demo/avatars/avatar-m.png'); background-size: cover;"></span>
                                                </div>
                                                <div class="d-table-cell w-100 align-middle pl-2 pr-2">
                                                    <div class="text-truncate text-truncate-md">
                                                        +714651347790
                                                        <small class="d-block font-italic fs-xs opacity-50">
                                                            Missed Call
                                                        </small>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="filter-message js-filter-message"></div>
                                </div>
                            </div>
                            <div>
                                <a class="fs-xl d-flex align-items-center p-3">
                                    <i class="fal fa-cogs"></i>
                                </a>
                            </div>
                        </div>
                        <!-- END msgr-list -->
                        <!-- BEGIN msgr -->
                        <div class="msgr d-flex h-100 flex-column bg-white">
                            <!-- BEGIN custom-scroll -->
                            <div class="custom-scroll flex-1 h-100">
                                <div id="chat_container" class="w-100 p-4">
                                    <!-- start .chat-segment -->
                                    <div class="chat-segment">
                                        <div class="time-stamp text-center mb-2 fw-400">
                                            Jun 19
                                        </div>
                                    </div>
                                    <!--  end .chat-segment -->
                                    <!-- start .chat-segment -->
                                    <div class="chat-segment chat-segment-sent">
                                        <div class="chat-message">
                                            <p>
                                                Hey Tracey, did you get my files?
                                            </p>
                                        </div>
                                        <div class="text-right fw-300 text-muted mt-1 fs-xs">
                                            3:00 pm
                                        </div>
                                    </div>
                                    <!--  end .chat-segment -->
                                    <!-- start .chat-segment -->
                                    <div class="chat-segment chat-segment-get">
                                        <div class="chat-message">
                                            <p>
                                                Hi
                                            </p>
                                            <p>
                                                Sorry going through a busy time in office. Yes I analyzed the solution.
                                            </p>
                                            <p>
                                                It will require some resource, which I could not manage.
                                            </p>
                                        </div>
                                        <div class="fw-300 text-muted mt-1 fs-xs">
                                            3:24 pm
                                        </div>
                                    </div>
                                    <!--  end .chat-segment -->
                                    <!-- start .chat-segment -->
                                    <div class="chat-segment chat-segment-sent chat-start">
                                        <div class="chat-message">
                                            <p>
                                                Okay
                                            </p>
                                        </div>
                                    </div>
                                    <!--  end .chat-segment -->
                                    <!-- start .chat-segment -->
                                    <div class="chat-segment chat-segment-sent chat-end">
                                        <div class="chat-message">
                                            <p>
                                                Sending you some dough today, you can allocate the resources to this project.
                                            </p>
                                        </div>
                                        <div class="text-right fw-300 text-muted mt-1 fs-xs">
                                            3:26 pm
                                        </div>
                                    </div>
                                    <!--  end .chat-segment -->
                                    <!-- start .chat-segment -->
                                    <div class="chat-segment chat-segment-get chat-start">
                                        <div class="chat-message">
                                            <p>
                                                Perfect. Thanks a lot!
                                            </p>
                                        </div>
                                    </div>
                                    <!--  end .chat-segment -->
                                    <!-- start .chat-segment -->
                                    <div class="chat-segment chat-segment-get">
                                        <div class="chat-message">
                                            <p>
                                                I will have them ready by tonight.
                                            </p>
                                        </div>
                                    </div>
                                    <!--  end .chat-segment -->
                                    <!-- start .chat-segment -->
                                    <div class="chat-segment chat-segment-get chat-end">
                                        <div class="chat-message">
                                            <p>
                                                Cheers
                                            </p>
                                        </div>
                                    </div>
                                    <!--  end .chat-segment -->
                                    <!-- start .chat-segment for timestamp -->
                                    <div class="chat-segment">
                                        <div class="time-stamp text-center mb-2 fw-400">
                                            Jun 20
                                        </div>
                                    </div>
                                    <!--  end .chat-segment for timestamp -->
                                </div>
                            </div>
                            <!-- END custom-scroll  -->
                            <!-- BEGIN msgr__chatinput -->
                            <div class="d-flex flex-column">
                                <div class="border-faded border-right-0 border-bottom-0 border-left-0 flex-1 mr-3 ml-3 position-relative shadow-top">
                                    <div class="pt-3 pb-1 pr-0 pl-0 rounded-0" tabindex="-1">
                                        <div id="msgr_input" contenteditable="true" data-placeholder="Type your message here..." class="height-10 form-content-editable"></div>
                                    </div>
                                </div>
                                <div class="height-8 px-3 d-flex flex-row align-items-center flex-wrap flex-shrink-0">
                                    <a href="javascript:void(0);" class="btn btn-icon fs-xl width-1 mr-1" data-toggle="tooltip" data-original-title="More options" data-placement="top">
                                        <i class="fal fa-ellipsis-v-alt color-fusion-300"></i>
                                    </a>
                                    <a href="javascript:void(0);" class="btn btn-icon fs-xl mr-1" data-toggle="tooltip" data-original-title="Attach files" data-placement="top">
                                        <i class="fal fa-paperclip color-fusion-300"></i>
                                    </a>
                                    <a href="javascript:void(0);" class="btn btn-icon fs-xl mr-1" data-toggle="tooltip" data-original-title="Insert photo" data-placement="top">
                                        <i class="fal fa-camera color-fusion-300"></i>
                                    </a>
                                    <div class="ml-auto">
                                        <a href="javascript:void(0);" class="btn btn-info">Send</a>
                                    </div>
                                </div>
                            </div>
                            <!-- END msgr__chatinput -->
                        </div>
                        <!-- END msgr -->
                    </div>
                </div>
            </div>
        </div>
        <!-- END Messenger -->
        <!-- BEGIN Page Settings -->
        <div class="modal fade js-modal-settings modal-backdrop-transparent" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-right modal-md">
                <div class="modal-content">
                    <div class="dropdown-header bg-trans-gradient d-flex justify-content-center align-items-center w-100">
                        <h4 class="m-0 text-center color-white">
                            Layout Settings
                            <small class="mb-0 opacity-80">User Interface Settings</small>
                        </h4>
                        <button type="button" class="close text-white position-absolute pos-top pos-right p-2 m-1 mr-2" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="fal fa-times"></i></span>
                        </button>
                    </div>
                    <div class="modal-body p-0">
                        <div class="settings-panel">
                            <div class="mt-4 d-table w-100 px-5">
                                <div class="d-table-cell align-middle">
                                    <h5 class="p-0">
                                        App Layout
                                    </h5>
                                </div>
                            </div>
                            <div class="list" id="fh">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="header-function-fixed"></a>
                                <span class="onoffswitch-title">Fixed Header</span>
                                <span class="onoffswitch-title-desc">header is in a fixed at all times</span>
                            </div>
                            <div class="list" id="nff">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="nav-function-fixed"></a>
                                <span class="onoffswitch-title">Fixed Navigation</span>
                                <span class="onoffswitch-title-desc">left panel is fixed</span>
                            </div>
                            <div class="list" id="nfm">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="nav-function-minify"></a>
                                <span class="onoffswitch-title">Minify Navigation</span>
                                <span class="onoffswitch-title-desc">Skew nav to maximize space</span>
                            </div>
                            <div class="list" id="nfh">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="nav-function-hidden"></a>
                                <span class="onoffswitch-title">Hide Navigation</span>
                                <span class="onoffswitch-title-desc">roll mouse on edge to reveal</span>
                            </div>
                            <div class="list" id="nft">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="nav-function-top"></a>
                                <span class="onoffswitch-title">Top Navigation</span>
                                <span class="onoffswitch-title-desc">Relocate left pane to top</span>
                            </div>
                            <div class="list" id="fff">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="footer-function-fixed"></a>
                                <span class="onoffswitch-title">Fixed Footer</span>
                                <span class="onoffswitch-title-desc">page footer is fixed</span>
                            </div>
                            <div class="list" id="mmb">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-main-boxed"></a>
                                <span class="onoffswitch-title">Boxed Layout</span>
                                <span class="onoffswitch-title-desc">Encapsulates to a container</span>
                            </div>
                            <div class="expanded">
                                <ul class="mb-3 mt-1">
                                    <li>
                                        <div class="bg-fusion-50" data-action="toggle" data-class="mod-bg-1"></div>
                                    </li>
                                    <li>
                                        <div class="bg-warning-200" data-action="toggle" data-class="mod-bg-2"></div>
                                    </li>
                                    <li>
                                        <div class="bg-primary-200" data-action="toggle" data-class="mod-bg-3"></div>
                                    </li>
                                    <li>
                                        <div class="bg-success-300" data-action="toggle" data-class="mod-bg-4"></div>
                                    </li>
                                    <li>
                                        <div class="bg-white border" data-action="toggle" data-class="mod-bg-none"></div>
                                    </li>
                                </ul>
                                <div class="list" id="mbgf">
                                    <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-fixed-bg"></a>
                                    <span class="onoffswitch-title">Fixed Background</span>
                                </div>
                            </div>
                            <div class="mt-4 d-table w-100 px-5">
                                <div class="d-table-cell align-middle">
                                    <h5 class="p-0">
                                        Mobile Menu
                                    </h5>
                                </div>
                            </div>
                            <div class="list" id="nmp">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="nav-mobile-push"></a>
                                <span class="onoffswitch-title">Push Content</span>
                                <span class="onoffswitch-title-desc">Content pushed on menu reveal</span>
                            </div>
                            <div class="list" id="nmno">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="nav-mobile-no-overlay"></a>
                                <span class="onoffswitch-title">No Overlay</span>
                                <span class="onoffswitch-title-desc">Removes mesh on menu reveal</span>
                            </div>
                            <div class="list" id="sldo">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="nav-mobile-slide-out"></a>
                                <span class="onoffswitch-title">Off-Canvas <sup>(beta)</sup></span>
                                <span class="onoffswitch-title-desc">Content overlaps menu</span>
                            </div>
                            <div class="mt-4 d-table w-100 px-5">
                                <div class="d-table-cell align-middle">
                                    <h5 class="p-0">
                                        Accessibility
                                    </h5>
                                </div>
                            </div>
                            <div class="list" id="mbf">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-bigger-font"></a>
                                <span class="onoffswitch-title">Bigger Content Font</span>
                                <span class="onoffswitch-title-desc">content fonts are bigger for readability</span>
                            </div>
                            <div class="list" id="mhc">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-high-contrast"></a>
                                <span class="onoffswitch-title">High Contrast Text (WCAG 2 AA)</span>
                                <span class="onoffswitch-title-desc">4.5:1 text contrast ratio</span>
                            </div>
                            <div class="list" id="mcb">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-color-blind"></a>
                                <span class="onoffswitch-title">Daltonism <sup>(beta)</sup> </span>
                                <span class="onoffswitch-title-desc">color vision deficiency</span>
                            </div>
                            <div class="list" id="mpc">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-pace-custom"></a>
                                <span class="onoffswitch-title">Preloader Inside</span>
                                <span class="onoffswitch-title-desc">preloader will be inside content</span>
                            </div>
                            <div class="list" id="mpi">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-panel-icon"></a>
                                <span class="onoffswitch-title">SmartPanel Icons (not Panels)</span>
                                <span class="onoffswitch-title-desc">smartpanel buttons will appear as icons</span>
                            </div>
                            <div class="mt-4 d-table w-100 px-5">
                                <div class="d-table-cell align-middle">
                                    <h5 class="p-0">
                                        Global Modifications
                                    </h5>
                                </div>
                            </div>
                            <div class="list" id="mcbg">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-clean-page-bg"></a>
                                <span class="onoffswitch-title">Clean Page Background</span>
                                <span class="onoffswitch-title-desc">adds more whitespace</span>
                            </div>
                            <div class="list" id="mhni">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-hide-nav-icons"></a>
                                <span class="onoffswitch-title">Hide Navigation Icons</span>
                                <span class="onoffswitch-title-desc">invisible navigation icons</span>
                            </div>
                            <div class="list" id="dan">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-disable-animation"></a>
                                <span class="onoffswitch-title">Disable CSS Animation</span>
                                <span class="onoffswitch-title-desc">Disables CSS based animations</span>
                            </div>
                            <div class="list" id="mhic">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-hide-info-card"></a>
                                <span class="onoffswitch-title">Hide Info Card</span>
                                <span class="onoffswitch-title-desc">Hides info card from left panel</span>
                            </div>
                            <div class="list" id="mlph">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-lean-subheader"></a>
                                <span class="onoffswitch-title">Lean Subheader</span>
                                <span class="onoffswitch-title-desc">distinguished page header</span>
                            </div>
                            <div class="list" id="mnl">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-nav-link"></a>
                                <span class="onoffswitch-title">Hierarchical Navigation</span>
                                <span class="onoffswitch-title-desc">Clear breakdown of nav links</span>
                            </div>
                            <div class="list" id="mdn">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-nav-dark"></a>
                                <span class="onoffswitch-title">Dark Navigation</span>
                                <span class="onoffswitch-title-desc">Navigation background is darkend</span>
                            </div>
                            <hr class="mb-0 mt-4">
                            <div class="mt-4 d-table w-100 pl-5 pr-3">
                                <div class="d-table-cell align-middle">
                                    <h5 class="p-0">
                                        Global Font Size
                                    </h5>
                                </div>
                            </div>
                            <div class="list mt-1">
                                <div class="btn-group btn-group-sm btn-group-toggle my-2" data-toggle="buttons">
                                    <label class="btn btn-default btn-sm" data-action="toggle-swap" data-class="root-text-sm" data-target="html">
                                        <input type="radio" name="changeFrontSize"> SM
                                    </label>
                                    <label class="btn btn-default btn-sm" data-action="toggle-swap" data-class="root-text" data-target="html">
                                        <input type="radio" name="changeFrontSize" checked=""> MD
                                    </label>
                                    <label class="btn btn-default btn-sm" data-action="toggle-swap" data-class="root-text-lg" data-target="html">
                                        <input type="radio" name="changeFrontSize"> LG
                                    </label>
                                    <label class="btn btn-default btn-sm" data-action="toggle-swap" data-class="root-text-xl" data-target="html">
                                        <input type="radio" name="changeFrontSize"> XL
                                    </label>
                                </div>
                                <span class="onoffswitch-title-desc d-block mb-0">Change <strong>root</strong> font size to effect rem
                                    values (resets on page refresh)</span>
                            </div>
                            <hr class="mb-0 mt-4">
                            <div class="mt-4 d-table w-100 pl-5 pr-3">
                                <div class="d-table-cell align-middle">
                                    <h5 class="p-0 pr-2 d-flex">
                                        Theme colors
                                        <a href="#" class="ml-auto fw-400 fs-xs" data-toggle="popover" data-trigger="focus" data-placement="top" title="" data-html="true" data-content="The settings below uses <code>localStorage</code> to load the external <strong>CSS</strong> file as an overlap to the base css. Due to network latency and <strong>CPU utilization</strong>, you may experience a brief flickering effect on page load which may show the intial applied theme for a split second. Setting the prefered style/theme in the header will prevent this from happening." data-original-title="<span class='text-primary'><i class='fal fa-exclamation-triangle mr-1'></i> Heads up!</span>" data-template="<div class=&quot;popover bg-white border-white&quot; role=&quot;tooltip&quot;><div class=&quot;arrow&quot;></div><h3 class=&quot;popover-header bg-transparent&quot;></h3><div class=&quot;popover-body fs-xs&quot;></div></div>"><i class="fal fa-info-circle mr-1"></i> more info</a>
                                    </h5>
                                </div>
                            </div>
                            <div class="expanded theme-colors pl-5 pr-3">
                                <ul class="m-0">
                                    <li>
                                        <a href="#" id="myapp-0" data-action="theme-update" data-themesave data-theme="" data-toggle="tooltip" data-placement="top" title="Wisteria (base css)" data-original-title="Wisteria (base css)"></a>
                                    </li>
                                    <li>
                                        <a href="#" id="myapp-1" data-action="theme-update" data-themesave data-theme="css/themes/cust-theme-1.css" data-toggle="tooltip" data-placement="top" title="Tapestry" data-original-title="Tapestry"></a>
                                    </li>
                                    <li>
                                        <a href="#" id="myapp-2" data-action="theme-update" data-themesave data-theme="css/themes/cust-theme-2.css" data-toggle="tooltip" data-placement="top" title="Atlantis" data-original-title="Atlantis"></a>
                                    </li>
                                    <li>
                                        <a href="#" id="myapp-3" data-action="theme-update" data-themesave data-theme="css/themes/cust-theme-3.css" data-toggle="tooltip" data-placement="top" title="Indigo" data-original-title="Indigo"></a>
                                    </li>
                                    <li>
                                        <a href="#" id="myapp-4" data-action="theme-update" data-themesave data-theme="css/themes/cust-theme-4.css" data-toggle="tooltip" data-placement="top" title="Dodger Blue" data-original-title="Dodger Blue"></a>
                                    </li>
                                    <li>
                                        <a href="#" id="myapp-5" data-action="theme-update" data-themesave data-theme="css/themes/cust-theme-5.css" data-toggle="tooltip" data-placement="top" title="Tradewind" data-original-title="Tradewind"></a>
                                    </li>
                                    <li>
                                        <a href="#" id="myapp-6" data-action="theme-update" data-themesave data-theme="css/themes/cust-theme-6.css" data-toggle="tooltip" data-placement="top" title="Cranberry" data-original-title="Cranberry"></a>
                                    </li>
                                    <li>
                                        <a href="#" id="myapp-7" data-action="theme-update" data-themesave data-theme="css/themes/cust-theme-7.css" data-toggle="tooltip" data-placement="top" title="Oslo Gray" data-original-title="Oslo Gray"></a>
                                    </li>
                                    <li>
                                        <a href="#" id="myapp-8" data-action="theme-update" data-themesave data-theme="css/themes/cust-theme-8.css" data-toggle="tooltip" data-placement="top" title="Chetwode Blue" data-original-title="Chetwode Blue"></a>
                                    </li>
                                    <li>
                                        <a href="#" id="myapp-9" data-action="theme-update" data-themesave data-theme="css/themes/cust-theme-9.css" data-toggle="tooltip" data-placement="top" title="Apricot" data-original-title="Apricot"></a>
                                    </li>
                                    <li>
                                        <a href="#" id="myapp-10" data-action="theme-update" data-themesave data-theme="css/themes/cust-theme-10.css" data-toggle="tooltip" data-placement="top" title="Blue Smoke" data-original-title="Blue Smoke"></a>
                                    </li>
                                    <li>
                                        <a href="#" id="myapp-11" data-action="theme-update" data-themesave data-theme="css/themes/cust-theme-11.css" data-toggle="tooltip" data-placement="top" title="Green Smoke" data-original-title="Green Smoke"></a>
                                    </li>
                                    <li>
                                        <a href="#" id="myapp-12" data-action="theme-update" data-themesave data-theme="css/themes/cust-theme-12.css" data-toggle="tooltip" data-placement="top" title="Wild Blue Yonder" data-original-title="Wild Blue Yonder"></a>
                                    </li>
                                    <li>
                                        <a href="#" id="myapp-13" data-action="theme-update" data-themesave data-theme="css/themes/cust-theme-13.css" data-toggle="tooltip" data-placement="top" title="Emerald" data-original-title="Emerald"></a>
                                    </li>
                                    <li>
                                        <a href="#" id="myapp-14" data-action="theme-update" data-themesave data-theme="css/themes/cust-theme-14.css" data-toggle="tooltip" data-placement="top" title="Supernova" data-original-title="Supernova"></a>
                                    </li>
                                    <li>
                                        <a href="#" id="myapp-15" data-action="theme-update" data-themesave data-theme="css/themes/cust-theme-15.css" data-toggle="tooltip" data-placement="top" title="Hoki" data-original-title="Hoki"></a>
                                    </li>
                                </ul>
                            </div>
                            <hr class="mb-0 mt-4">
                            <div class="mt-4 d-table w-100 pl-5 pr-3">
                                <div class="d-table-cell align-middle">
                                    <h5 class="p-0 pr-2 d-flex">
                                        Theme Modes (beta)
                                        <a href="#" class="ml-auto fw-400 fs-xs" data-toggle="popover" data-trigger="focus" data-placement="top" title="" data-html="true" data-content="This is a brand new technique we are introducing which uses CSS variables to infiltrate color options. While this has been working nicely on modern browsers without much issues, some users <strong>may still face issues on Internet Explorer </strong>. Until these issues are resolved or Internet Explorer improves, this feature will remain in Beta" data-original-title="<span class='text-primary'><i class='fal fa-question-circle mr-1'></i> Why beta?</span>" data-template="<div class=&quot;popover bg-white border-white&quot; role=&quot;tooltip&quot;><div class=&quot;arrow&quot;></div><h3 class=&quot;popover-header bg-transparent&quot;></h3><div class=&quot;popover-body fs-xs&quot;></div></div>"><i class="fal fa-question-circle mr-1"></i> why beta?</a>
                                    </h5>
                                </div>
                            </div>
                            <div class="pl-5 pr-3 py-3">
                                <div class="ie-only alert alert-warning d-none">
                                    <h6>Internet Explorer Issue</h6>
                                    This particular component may not work as expected in Internet Explorer. Please use with caution.
                                </div>
                                <div class="row no-gutters">
                                    <div class="col-4 pr-2 text-center">
                                        <div id="skin-default" data-action="toggle-replace" data-replaceclass="mod-skin-light mod-skin-dark" data-class="" data-toggle="tooltip" data-placement="top" title="" class="d-flex bg-white border border-primary rounded overflow-hidden text-success js-waves-on" data-original-title="Default Mode" style="height: 80px">
                                            <div class="bg-primary-600 bg-primary-gradient px-2 pt-0 border-right border-primary"></div>
                                            <div class="d-flex flex-column flex-1">
                                                <div class="bg-white border-bottom border-primary py-1"></div>
                                                <div class="bg-faded flex-1 pt-3 pb-3 px-2">
                                                    <div class="py-3" style="background:url('smartadmin/img/demo/s-1.png') top left no-repeat;background-size: 100%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                        Default
                                    </div>
                                    <div class="col-4 px-1 text-center">
                                        <div id="skin-light" data-action="toggle-replace" data-replaceclass="mod-skin-dark" data-class="mod-skin-light" data-toggle="tooltip" data-placement="top" title="" class="d-flex bg-white border border-secondary rounded overflow-hidden text-success js-waves-on" data-original-title="Light Mode" style="height: 80px">
                                            <div class="bg-white px-2 pt-0 border-right border-"></div>
                                            <div class="d-flex flex-column flex-1">
                                                <div class="bg-white border-bottom border- py-1"></div>
                                                <div class="bg-white flex-1 pt-3 pb-3 px-2">
                                                    <div class="py-3" style="background:url('smartadmin/img/demo/s-1.png') top left no-repeat;background-size: 100%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                        Light
                                    </div>
                                    <div class="col-4 pl-2 text-center">
                                        <div id="skin-dark" data-action="toggle-replace" data-replaceclass="mod-skin-light" data-class="mod-skin-dark" data-toggle="tooltip" data-placement="top" title="" class="d-flex bg-white border border-dark rounded overflow-hidden text-success js-waves-on" data-original-title="Dark Mode" style="height: 80px">
                                            <div class="bg-fusion-500 px-2 pt-0 border-right"></div>
                                            <div class="d-flex flex-column flex-1">
                                                <div class="bg-fusion-600 border-bottom py-1"></div>
                                                <div class="bg-fusion-300 flex-1 pt-3 pb-3 px-2">
                                                    <div class="py-3 opacity-30" style="background:url('smartadmin/img/demo/s-1.png') top left no-repeat;background-size: 100%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                        Dark
                                    </div>
                                </div>
                            </div>
                            <hr class="mb-0 mt-4">
                            <div class="pl-5 pr-3 py-3 bg-faded">
                                <div class="row no-gutters">
                                    <div class="col-6 pr-1">
                                        <a href="#" class="btn btn-outline-danger fw-500 btn-block" data-action="app-reset">Reset Settings</a>
                                    </div>
                                    <div class="col-6 pl-1">
                                        <a href="#" class="btn btn-danger fw-500 btn-block" data-action="factory-reset">Factory Reset</a>
                                    </div>
                                </div>
                            </div>
                        </div> <span id="saving"></span>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Page Settings -->
        <!-- base vendor bundle: 
             DOC: if you remove pace.js from core please note on Internet Explorer some CSS animations may execute before a page is fully loaded, resulting 'jump' animations 
                        + pace.js (recommended)
                        + jquery.js (core)
                        + jquery-ui-cust.js (core)
                        + popper.js (core)
                        + bootstrap.js (core)
                        + slimscroll.js (extension)
                        + app.navigation.js (core)
                        + ba-throttle-debounce.js (core)
                        + waves.js (extension)
                        + smartpanels.js (extension)
                        + src/../jquery-snippets.js (core) -->
        <script src="smartadmin/js/vendors.bundle.js"></script>
        <script src="smartadmin/js/app.bundle.js"></script>
        <!-- flot bundle: 
     DOC: you may remove the extensions if you do not plan on using them. Learn more about these extensions at https://flotcharts.org
                + jquery.flot.js (core)
                + jquery.flot.canvas.js (extension)
                + jquery.flot.categories.js (extension)
                + jquery.flot.crosshair.js (extension)
                + jquery.flot.errorbars.js (extension)
                + jquery.flot.fillbetween.js (extension)
                + jquery.flot.image.js (extension)
                + jquery.flot.navigate.js (extension)
                + jquery.flot.pie.js (extension)
                + jquery.flot.resize.js (recommended)
                + jquery.flot.selection.js (extension)
                + jquery.flot.stack.js (extension)
                + jquery.flot.spline.js (extension)
                + jquery.flot.symbol.js (extension)
                + jquery.flot.threshold.js (extension)
                + jquery.flot.tooltip.js (extension)
                + jquery.flot.time.js (extension) -->
        <script src="smartadmin/js/statistics/flot/flot.bundle.js"></script>
        <script>
            /* defined datas */
            var dataTargetProfit = [
                [1354586000000, 153],
                [1364587000000, 658],
                [1374588000000, 198],
                [1384589000000, 663],
                [1394590000000, 801],
                [1404591000000, 1080],
                [1414592000000, 353],
                [1424593000000, 749],
                [1434594000000, 523],
                [1444595000000, 258],
                [1454596000000, 688],
                [1464597000000, 364]
            ]
            var dataProfit = [
                [1354586000000, 53],
                [1364587000000, 65],
                [1374588000000, 98],
                [1384589000000, 83],
                [1394590000000, 980],
                [1404591000000, 808],
                [1414592000000, 720],
                [1424593000000, 674],
                [1434594000000, 23],
                [1444595000000, 79],
                [1454596000000, 88],
                [1464597000000, 36]
            ]
            var dataSignups = [
                [1354586000000, 647],
                [1364587000000, 435],
                [1374588000000, 784],
                [1384589000000, 346],
                [1394590000000, 487],
                [1404591000000, 463],
                [1414592000000, 479],
                [1424593000000, 236],
                [1434594000000, 843],
                [1444595000000, 657],
                [1454596000000, 241],
                [1464597000000, 341]
            ]

            var dataSales = [
                [1196463600000, 0],
                [1196550000000, 0],
                [1196636400000, 0],
                [1196722800000, 1177],
                [1196809200000, 3636],
                [1196895600000, 3575],
                [1196982000000, 2736],
                [1197068400000, 1086],
                [1197154800000, 1676],
                [1197241200000, 1205],
                [1197327600000, 1906],
                [1197414000000, 1710],
                [1197500400000, 1639],
                [1197586800000, 1540],
                [1197673200000, 1435],
                [1197759600000, 1301],
                [1197846000000, 1575],
                [1197932400000, 1481],
                [1198018800000, 1591],
                [1198105200000, 1608],
                [1198191600000, 1459],
                [1198278000000, 1234],
                [1198364400000, 1352],
                [1198450800000, 1686],
                [1198537200000, 1279],
                [1198623600000, 1449],
                [1198710000000, 1468],
                [1198796400000, 1392],
                [1198882800000, 1282],
                [1198969200000, 1208],
                [1199055600000, 1229],
                [1199142000000, 1177],
                [1199228400000, 1374],
                [1199314800000, 1436],
                [1199401200000, 1404],
                [1199487600000, 1253],
                [1199574000000, 1218],
                [1199660400000, 1476],
                [1199746800000, 1462],
                [1199833200000, 1500],
                [1199919600000, 1700],
                [1200006000000, 1750],
                [1200092400000, 1600],
                [1200178800000, 1500],
                [1200265200000, 1900],
                [1200351600000, 1930],
                [1200438000000, 1200],
                [1200524400000, 1980],
                [1200610800000, 1950],
                [1200697200000, 1900],
                [1200783600000, 1000],
                [1200870000000, 1050],
                [1200956400000, 1150],
                [1201042800000, 1100],
                [1201129200000, 1200],
                [1201215600000, 1300],
                [1201302000000, 1700],
                [1201388400000, 1450],
                [1201474800000, 1500],
                [1201561200000, 1546],
                [1201647600000, 1614],
                [1201734000000, 1954],
                [1201820400000, 1700],
                [1201906800000, 1800],
                [1201993200000, 1900],
                [1202079600000, 2000],
                [1202166000000, 2100],
                [1202252400000, 2200],
                [1202338800000, 2300],
                [1202425200000, 2400],
                [1202511600000, 2550],
                [1202598000000, 2600],
                [1202684400000, 2500],
                [1202770800000, 2700],
                [1202857200000, 2750],
                [1202943600000, 2800],
                [1203030000000, 3245],
                [1203116400000, 3345],
                [1203202800000, 3000],
                [1203289200000, 3200],
                [1203375600000, 3300],
                [1203462000000, 3400],
                [1203548400000, 3600],
                [1203634800000, 3700],
                [1203721200000, 3800],
                [1203807600000, 4000],
                [1203894000000, 4500]
            ];
            var dataSetBar1 = [
                [0, 3],
                [2, 8],
                [4, 5],
                [6, 13],
                [8, 5],
                [10, 7],
                [12, 4],
                [14, 6]
            ];
            var dataSetBar2 = [
                [0, 3],
                [2, 8],
                [4, 5],
                [6, 13],
                [8, 5],
                [10, 7],
                [12, 8],
                [14, 10]
            ];
            var dataSetBar3 = [
                [1, 5],
                [3, 7],
                [5, 10],
                [7, 7],
                [9, 9],
                [11, 5],
                [13, 4],
                [15, 6]
            ];
            var dataSet1 = [
                [0, 2],
                [1, 3],
                [2, 6],
                [3, 5],
                [4, 7],
                [5, 8],
                [6, 10]
            ];
            var dataSet2 = [
                [0, 1],
                [1, 2],
                [2, 5],
                [3, 3],
                [4, 5],
                [5, 6],
                [6, 9]
            ];
            var dataSet3 = [
                [0, 10],
                [1, 7],
                [2, 8],
                [3, 9],
                [4, 6],
                [5, 5],
                [6, 7]
            ];
            var dataSet4 = [
                [0, 8],
                [1, 5],
                [2, 6],
                [3, 8],
                [4, 4],
                [5, 3],
                [6, 6]
            ];
            var dataSetPie = [
            {
                label: "Asia",
                data: 4119630000,
                color: color.primary._500
            },
            {
                label: "Latin America",
                data: 590950000,
                color: color.info._500
            },
            {
                label: "Africa",
                data: 1012960000,
                color: color.warning._500
            },
            {
                label: "Oceania",
                data: 95100000,
                color: color.danger._500
            },
            {
                label: "Europe",
                data: 727080000,
                color: color.success._500
            },
            {
                label: "North America",
                data: 344120000,
                color: color.fusion._400
            }];
            var data = [],
                totalPoints = 50;
            var plotRealtimeCurvedInterval = 1000;
            var plotRealtimeFillInterval = 1000;

            /* generate random data */
            var getRandomData = function()
            {
                if (data.length > 0)
                    data = data.slice(1);
                while (data.length < totalPoints)
                {
                    var prev = data.length > 0 ? data[data.length - 1] : 50,
                        y = prev + Math.random() * 10 - 5;
                    if (y < 0)
                    {
                        y = 0;
                    }
                    else if (y > 100)
                    {
                        y = 100;
                    }
                    data.push(y);
                }
                var res = [];
                for (var i = 0; i < data.length; ++i)
                {
                    res.push([i, data[i]])
                }
                return res;
            }
            /* generate random data -- end */

            /* label formatter */
            var labelFormatter = function(label, series)
            {
                return "<div class='fs-xs text-center p-1 text-white'>" + label + "<br/>" + Math.round(series.percent) + "%</div>";
            }
            /* label formatter -- end */

            /* init() interval range */
            $(document).on('change', '.js-set-interval', function()
            {
                plotRealtimeFillInterval = Math.abs($('#js-flot-realtime-fill-speed').val());
                plotRealtimeCurvedInterval = Math.abs($('#js-flot-realtime-curved-speed').val());
            })

            $(document).ready(function()
            {
                /* flot bar */
                var flotBar = $.plot("#flot-bar", [
                {
                    data: [
                        [0, 3],
                        [2, 8],
                        [4, 5],
                        [6, 13],
                        [8, 5],
                        [10, 7],
                        [12, 4],
                        [14, 6]
                    ]
                }],
                {
                    series:
                    {
                        bars:
                        {
                            show: true,
                            lineWidth: 0,
                            fillColor: color.fusion._200
                        }
                    },
                    grid:
                    {
                        borderWidth: 1,
                        borderColor: '#eee'
                    },
                    yaxis:
                    {
                        tickColor: '#eee',
                        font:
                        {
                            color: '#999',
                            size: 10
                        }
                    },
                    xaxis:
                    {
                        tickColor: '#eee',
                        font:
                        {
                            color: '#999',
                            size: 10
                        }
                    }
                });
                /* flot bar lines -- end */

                /* flot bar lines multiple */
                var flotBarFill = $.plot("#flot-bar-fill", [
                {
                    data: [
                        [0, 3],
                        [2, 8],
                        [4, 5],
                        [6, 13],
                        [8, 5],
                        [10, 7],
                        [12, 8],
                        [14, 10]
                    ],
                    bars:
                    {
                        show: true,
                        lineWidth: 0,
                        fillColor: color.success._500
                    }
                },
                {
                    data: [
                        [1, 5],
                        [3, 7],
                        [5, 10],
                        [7, 7],
                        [9, 9],
                        [11, 5],
                        [13, 4],
                        [15, 6]
                    ],
                    bars:
                    {
                        show: true,
                        lineWidth: 0,
                        fillColor: color.primary._500
                    }
                }],
                {
                    grid:
                    {
                        borderWidth: 1,
                        borderColor: '#D9D9D9'
                    },
                    yaxis:
                    {
                        tickColor: '#d9d9d9',
                        font:
                        {
                            color: '#666',
                            size: 10
                        }
                    },
                    xaxis:
                    {
                        tickColor: '#d9d9d9',
                        font:
                        {
                            color: '#666',
                            size: 10
                        }
                    }
                });
                /* flot bar lines multiple -- end */

                /* flot simple lines */
                var flotLine = $.plot($('#flot-line'), [
                {
                    data: dataSet1,
                    label: 'New Customer',
                    color: color.primary._400
                },
                {
                    data: dataSet2,
                    label: 'Returning Customer',
                    color: color.fusion._400
                }],
                {
                    series:
                    {
                        lines:
                        {
                            show: true,
                            lineWidth: 1
                        },
                        shadowSize: 0
                    },
                    points:
                    {
                        show: false,
                    },
                    legend:
                    {
                        noColumns: 1,
                        position: 'nw'
                    },
                    grid:
                    {
                        hoverable: true,
                        clickable: true,
                        borderColor: '#ddd',
                        borderWidth: 0,
                        labelMargin: 5,
                        backgroundColor: '#fff'
                    },
                    yaxis:
                    {
                        min: 0,
                        max: 15,
                        color: '#eee',
                        font:
                        {
                            size: 10,
                            color: '#999'
                        }
                    },
                    xaxis:
                    {
                        color: '#eee',
                        font:
                        {
                            size: 10,
                            color: '#999'
                        }
                    }
                });
                /* flot simple lines -- end */

                /* flot lines curved */
                var flotLineCurves = $.plot($('#flot-line-curves'), [
                {
                    data: dataSet1,
                    label: 'New Customer',
                    color: color.primary._400
                },
                {
                    data: dataSet2,
                    label: 'Returning Customer',
                    color: color.fusion._400
                }],
                {
                    series:
                    {
                        lines:
                        {
                            show: false
                        },
                        splines:
                        {
                            show: true,
                            tension: 0.4,
                            lineWidth: 1,
                            //fill: 0.4
                        },
                        shadowSize: 0
                    },
                    points:
                    {
                        show: false,
                    },
                    legend:
                    {
                        noColumns: 1,
                        position: 'nw'
                    },
                    grid:
                    {
                        hoverable: true,
                        clickable: true,
                        borderColor: '#ddd',
                        borderWidth: 0,
                        labelMargin: 5,
                        backgroundColor: '#fff'
                    },
                    yaxis:
                    {
                        min: 0,
                        max: 15,
                        color: '#eee',
                        font:
                        {
                            size: 10,
                            color: '#999'
                        }
                    },
                    xaxis:
                    {
                        color: '#eee',
                        font:
                        {
                            size: 10,
                            color: '#999'
                        }
                    }
                });
                /* flot lines curved -- end */

                /* flot lines tooltip */
                var flotLineAlt = $.plot($('#flot-line-alt'), [
                {
                    data: dataSet3,
                    label: 'New Customer',
                    color: color.danger._500
                },
                {
                    data: dataSet4,
                    label: 'Returning Customer',
                    color: color.success._500
                }],
                {
                    series:
                    {
                        lines:
                        {
                            show: true,
                            lineWidth: 1
                        },
                        shadowSize: 0
                    },
                    points:
                    {
                        show: true,
                    },
                    legend:
                    {
                        noColumns: 1,
                        position: 'nw'
                    },
                    tooltip: true,
                    tooltipOpts:
                    {
                        cssClass: 'tooltip-inner',
                        defaultTheme: false,
                        shifts:
                        {
                            x: 10,
                            y: -40
                        }
                    },
                    grid:
                    {
                        hoverable: true,
                        clickable: true,
                        borderColor: '#ddd',
                        borderWidth: 0,
                        labelMargin: 5,
                        backgroundColor: '#fff'
                    },
                    yaxis:
                    {
                        min: 0,
                        max: 15,
                        color: '#eee',
                        font:
                        {
                            size: 10,
                            color: '#999'
                        }
                    },
                    xaxis:
                    {
                        color: '#eee',
                        font:
                        {
                            size: 10,
                            color: '#999'
                        }
                    }
                });
                /* flot lines tooltip -- end */

                /* flot lines curved tooltip */
                var flotLineCurvesAlt = $.plot($('#flot-line-curves-alt'), [
                {
                    data: dataSet3,
                    label: 'New Customer',
                    color: color.danger._500
                },
                {
                    data: dataSet4,
                    label: 'Returning Customer',
                    color: color.success._500
                }],
                {
                    series:
                    {
                        lines:
                        {
                            show: false
                        },
                        splines:
                        {
                            show: true,
                            tension: 0.4,
                            lineWidth: 1,
                            //fill: 0.4
                        },
                        shadowSize: 0
                    },
                    points:
                    {
                        show: true,
                    },
                    legend:
                    {
                        noColumns: 1,
                        position: 'nw'
                    },
                    tooltip: true,
                    tooltipOpts:
                    {
                        cssClass: 'tooltip-inner',
                        defaultTheme: false,
                        shifts:
                        {
                            x: 10,
                            y: -40
                        }
                    },
                    grid:
                    {
                        hoverable: true,
                        clickable: true,
                        borderColor: '#ddd',
                        borderWidth: 0,
                        labelMargin: 5,
                        backgroundColor: '#fff'
                    },
                    yaxis:
                    {
                        min: 0,
                        max: 15,
                        color: '#eee',
                        font:
                        {
                            size: 10,
                            color: '#999'
                        }
                    },
                    xaxis:
                    {
                        color: '#eee',
                        font:
                        {
                            size: 10,
                            color: '#999'
                        }
                    }
                });
                /* flot lines curved tooltip -- end */

                /* flot area */
                var flotArea = $.plot($('#flot-area'), [
                {
                    data: dataSet1,
                    label: 'New Customer',
                    color: color.primary._500
                },
                {
                    data: dataSet2,
                    label: 'Returning Customer',
                    color: color.fusion._500
                }],
                {
                    series:
                    {
                        lines:
                        {
                            show: true,
                            lineWidth: 0,
                            fill: 0.8
                        },
                        shadowSize: 0
                    },
                    points:
                    {
                        show: false,
                    },
                    legend:
                    {
                        noColumns: 1,
                        position: 'nw'
                    },
                    grid:
                    {
                        hoverable: true,
                        clickable: true,
                        borderColor: '#ddd',
                        borderWidth: 0,
                        labelMargin: 5,
                        backgroundColor: '#fff'
                    },
                    yaxis:
                    {
                        min: 0,
                        max: 15,
                        color: '#eee',
                        font:
                        {
                            size: 10,
                            color: '#999'
                        }
                    },
                    xaxis:
                    {
                        color: '#eee',
                        font:
                        {
                            size: 10,
                            color: '#999'
                        }
                    }
                });
                /* flot area -- end */

                /* flot area fill */
                var flotAreaFill = $.plot($('#flot-area-fill'), [
                {
                    data: dataSet1,
                    label: 'New Customer',
                    color: color.primary._500
                },
                {
                    data: dataSet2,
                    label: 'Returning Customer',
                    color: color.fusion._500
                }],
                {
                    series:
                    {
                        lines:
                        {
                            show: false
                        },
                        splines:
                        {
                            show: true,
                            tension: 0.4,
                            lineWidth: 0,
                            fill: 0.8
                        },
                        shadowSize: 0
                    },
                    points:
                    {
                        show: false,
                    },
                    legend:
                    {
                        noColumns: 1,
                        position: 'nw'
                    },
                    grid:
                    {
                        hoverable: true,
                        clickable: true,
                        borderColor: '#ddd',
                        borderWidth: 0,
                        labelMargin: 5,
                        backgroundColor: '#fff'
                    },
                    yaxis:
                    {
                        min: 0,
                        max: 15,
                        color: '#eee',
                        font:
                        {
                            size: 10,
                            color: '#999'
                        }
                    },
                    xaxis:
                    {
                        color: '#eee',
                        font:
                        {
                            size: 10,
                            color: '#999'
                        }
                    }
                });
                /* flot area fill -- end */

                /* flot realtime curved */
                var plotRealtimeCurved = $.plot('#flot-realtime-curved', [getRandomData()],
                {
                    colors: [color.primary._500],
                    series:
                    {
                        lines:
                        {
                            show: false
                        },
                        splines:
                        {
                            show: true,
                            tension: 0.4,
                            lineWidth: 1,
                            //fill: 0.9
                        },
                        shadowSize: 0 // Drawing is faster without shadows
                    },
                    grid:
                    {
                        borderColor: '#ddd',
                        borderWidth: 1,
                        labelMargin: 5
                    },
                    xaxis:
                    {
                        color: '#eee',
                        font:
                        {
                            size: 10,
                            color: '#999'
                        }
                    },
                    yaxis:
                    {
                        min: 0,
                        max: 100,
                        color: '#eee',
                        font:
                        {
                            size: 10,
                            color: '#999'
                        }
                    }
                });
                /* flot realtime curved -- end */

                /* flot realtime fill */
                var plotRealtimeFill = $.plot('#flot-realtime-fill', [getRandomData()],
                {
                    colors: [color.primary._200],
                    series:
                    {
                        lines:
                        {
                            show: true,
                            lineWidth: 0,
                            fill: 0.9
                        },
                        shadowSize: 0 // Drawing is faster without shadows
                    },
                    grid:
                    {
                        borderColor: '#ddd',
                        borderWidth: 1,
                        labelMargin: 5
                    },
                    xaxis:
                    {
                        color: '#eee',
                        font:
                        {
                            size: 10,
                            color: '#999'
                        }
                    },
                    yaxis:
                    {
                        min: 0,
                        max: 100,
                        color: '#eee',
                        font:
                        {
                            size: 10,
                            color: '#999'
                        }
                    }
                });
                /* flot realtime fill -- end */

                /* generate realtime data */
                var updateRealtimeCurved = function()
                {
                    plotRealtimeCurved.setData([getRandomData()]);
                    plotRealtimeCurved.draw();
                    setTimeout(updateRealtimeCurved, plotRealtimeCurvedInterval);
                }
                var updateRealtimeFill = function()
                {
                    plotRealtimeFill.setData([getRandomData()]);
                    plotRealtimeFill.draw();
                    setTimeout(updateRealtimeFill, plotRealtimeFillInterval);
                }
                /* generate realtime data -- end */
                updateRealtimeCurved();
                updateRealtimeFill();

                /* sales chart */
                var plotSales = $.plot($('#flot-sales'), [
                {
                    data: dataSales,
                }],
                {
                    series:
                    {
                        lines:
                        {
                            show: true,
                            lineWidth: 1,
                            fill: true,
                            fillColor:
                            {
                                colors: [
                                {
                                    opacity: 0.1
                                },
                                {
                                    opacity: 0.15
                                }]
                            }
                        },
                        points:
                        {
                            show: true
                        },
                        shadowSize: 0
                    },
                    selection:
                    {
                        mode: "x"
                    },
                    grid:
                    {
                        hoverable: true,
                        clickable: true,
                        tickColor: '#f2f2f2',
                        borderWidth: 1,
                        borderColor: '#f2f2f2'
                    },
                    tooltip: true,
                    tooltipOpts:
                    {
                        cssClass: 'tooltip-inner',
                        content: "Your sales for <span class='text-warning fw-500'>%x</span> was <span class='text-success fw-500'>$%y</span>",
                        dateFormat: "%y-%0m-%0d",
                        defaultTheme: false
                    },
                    colors: [color.primary._500],
                    xaxis:
                    {
                        mode: "time",
                        tickLength: 5
                    }
                });
                /* sales chart -- end */

                /* flot toggle example */
                var flot_toggle = function()
                {

                    var data = [
                    {
                        label: "Target Profit",
                        data: dataTargetProfit,
                        color: color.danger._500,
                        bars:
                        {
                            show: true,
                            align: "center",
                            barWidth: 30 * 30 * 60 * 1000 * 80,
                            lineWidth: 0,
                            fillColor:
                            {
                                colors: [color.danger._900, color.danger._100]
                            }
                        },
                        highlightColor: 'rgba(255,255,255,0.3)',
                        shadowSize: 0
                    },
                    {
                        label: "Actual Profit",
                        data: dataProfit,
                        color: color.info._500,
                        lines:
                        {
                            show: true,
                            lineWidth: 5
                        },
                        shadowSize: 0,
                        points:
                        {
                            show: true
                        }
                    },
                    {
                        label: "User Signups",
                        data: dataSignups,
                        color: color.success._500,
                        lines:
                        {
                            show: true,
                            lineWidth: 2
                        },
                        shadowSize: 0,
                        points:
                        {
                            show: true
                        }
                    }]

                    var options = {
                        grid:
                        {
                            hoverable: true,
                            clickable: true,
                            tickColor: '#f2f2f2',
                            borderWidth: 1,
                            borderColor: '#f2f2f2'
                        },
                        tooltip: true,
                        tooltipOpts:
                        {
                            cssClass: 'tooltip-inner',
                            defaultTheme: false
                        },
                        xaxis:
                        {
                            mode: "time"
                        },
                        yaxes:
                        {
                            tickFormatter: function(val, axis)
                            {
                                return "$" + val;
                            },
                            max: 1200
                        }

                    };

                    var plot2 = null;

                    function plotNow()
                    {
                        var d = [];
                        $("#js-checkbox-toggles").find(':checkbox').each(function()
                        {
                            if ($(this).is(':checked'))
                            {
                                d.push(data[$(this).attr("name").substr(4, 1)]);
                            }
                        });
                        if (d.length > 0)
                        {
                            if (plot2)
                            {
                                plot2.setData(d);
                                plot2.draw();
                            }
                            else
                            {
                                plot2 = $.plot($("#flot-toggles"), d, options);
                            }
                        }

                    };

                    $("#js-checkbox-toggles").find(':checkbox').on('change', function()
                    {
                        plotNow();
                    });
                    plotNow()
                }
                flot_toggle();
                /* flot toggle example -- end*/

                /* flot pie chart */
                var flot_pie = function()
                {
                    // target 
                    var placeholder = $("#js-pie-options");
                    /* init first plot */
                    $.plot(placeholder, dataSetPie,
                    {
                        series:
                        {
                            pie:
                            {
                                show: true
                            }
                        },
                        legend:
                        {
                            show: true
                        }
                    });
                    //buttons
                    $(document).on('click', '.js-pie-example', function()
                    {
                        $("#js-pie-options").unbind();

                        var id = this.id;

                        $(".js-pie-example").removeClass("active");
                        $("#" + id).addClass("active");
                        //$("#panel-12 .panel-hdr").addClass("highlight");

                        switch (true)
                        {
                            case (id == "example-1"):
                                $("#panel-12 h2").html('Pie <span class="fw-300 font-italic">Chart (default)</span>');
                                $("#panel-12 .panel-tag").text("The default pie chart with no options set");
                                $.plot(placeholder, dataSetPie,
                                {
                                    series:
                                    {
                                        pie:
                                        {
                                            show: true
                                        }
                                    }
                                });
                                break;
                            case (id == "example-2"):
                                // code block
                                $("#panel-12 h2").html('Pie <span class="fw-300 font-italic">Chart (legend)</span>');
                                $("#panel-12 .panel-tag").text("The default pie chart when the legend is disabled. Since the labels would normally be outside the container, the chart is resized to fit");
                                $.plot(placeholder, dataSetPie,
                                {
                                    series:
                                    {
                                        pie:
                                        {
                                            show: true
                                        }
                                    }
                                });
                                break;
                            case (id == "example-3"):
                                $("#panel-12 h2").html('Pie <span class="fw-300 font-italic">Custom Label Formatter</span>');
                                $("#panel-12 .panel-tag").text("Added a semi-transparent background to the labels and a custom labelFormatter function");
                                $.plot(placeholder, dataSetPie,
                                {
                                    series:
                                    {
                                        pie:
                                        {
                                            show: true,
                                            radius: 1,
                                            label:
                                            {
                                                show: true,
                                                radius: 1,
                                                formatter: labelFormatter,
                                                background:
                                                {
                                                    opacity: 0.8
                                                }
                                            }
                                        }
                                    },
                                    legend:
                                    {
                                        show: false
                                    }
                                });
                                break;
                            case (id == "example-4"):
                                $("#panel-12 h2").html('Pie <span class="fw-300 font-italic">Label Radius</span>');
                                $("#panel-12 .panel-tag").html("Slightly more transparent label backgrounds and adjusted the radius values to place them within the pie <code>radius: 3 / 4</code>");
                                $.plot(placeholder, dataSetPie,
                                {
                                    series:
                                    {
                                        pie:
                                        {
                                            show: true,
                                            radius: 1,
                                            label:
                                            {
                                                show: true,
                                                radius: 3 / 4,
                                                formatter: labelFormatter,
                                                background:
                                                {
                                                    opacity: 0.5
                                                }
                                            }
                                        }
                                    },
                                    legend:
                                    {
                                        show: false
                                    }
                                });
                                break;
                            case (id == "example-5"):
                                $("#panel-12 h2").html('Pie <span class="fw-300 font-italic">Label Styles #1</span>');
                                $("#panel-12 .panel-tag").html("Semi-transparent, black-colored label background");
                                $.plot(placeholder, dataSetPie,
                                {
                                    series:
                                    {
                                        pie:
                                        {
                                            show: true,
                                            radius: 1,
                                            label:
                                            {
                                                show: true,
                                                radius: 3 / 4,
                                                formatter: labelFormatter,
                                                background:
                                                {
                                                    opacity: 0.5,
                                                    color: "#000"
                                                }
                                            }
                                        }
                                    },
                                    legend:
                                    {
                                        show: false
                                    }
                                });
                                break;
                            case (id == "example-6"):
                                $("#panel-12 h2").html('Pie <span class="fw-300 font-italic">Label Styles #2</span>');
                                $("#panel-12 .panel-tag").html("Semi-transparent, black-colored label background placed at pie edge");
                                $.plot(placeholder, dataSetPie,
                                {
                                    series:
                                    {
                                        pie:
                                        {
                                            show: true,
                                            radius: 3 / 4,
                                            label:
                                            {
                                                show: true,
                                                radius: 3 / 4,
                                                formatter: labelFormatter,
                                                background:
                                                {
                                                    opacity: 0.5,
                                                    color: "#000"
                                                }
                                            }
                                        }
                                    },
                                    legend:
                                    {
                                        show: false
                                    }
                                });
                                break;
                            case (id == "example-7"):
                                $("#panel-12 h2").html('Pie <span class="fw-300 font-italic">Hidden Labels</span>');
                                $("#panel-12 .panel-tag").html("Labels can be hidden if the slice is less than a given percentage of the pie (10% in this case)");
                                $.plot(placeholder, dataSetPie,
                                {
                                    series:
                                    {
                                        pie:
                                        {
                                            show: true,
                                            radius: 1,
                                            label:
                                            {
                                                show: true,
                                                radius: 2 / 3,
                                                formatter: labelFormatter,
                                                threshold: 0.1
                                            }
                                        }
                                    },
                                    legend:
                                    {
                                        show: false
                                    }
                                });
                                break;
                            case (id == "example-8"):
                                $("#panel-12 h2").html('Pie <span class="fw-300 font-italic">Combined Slice</span>');
                                $("#panel-12 .panel-tag").html("Multiple slices less than a given percentage (5% in this case) of the pie can be combined into a single, larger slice");
                                $.plot(placeholder, dataSetPie,
                                {
                                    series:
                                    {
                                        pie:
                                        {
                                            show: true,
                                            combine:
                                            {
                                                color: "#999",
                                                threshold: 0.05
                                            }
                                        }
                                    },
                                    legend:
                                    {
                                        show: false
                                    }
                                });
                                break;
                            case (id == "example-9"):
                                $("#panel-12 h2").html('Pie <span class="fw-300 font-italic">Rectangular Pie</span>');
                                $("#panel-12 .panel-tag").html("The radius can also be set to a specific size (even larger than the container itself)");
                                $.plot(placeholder, dataSetPie,
                                {
                                    series:
                                    {
                                        pie:
                                        {
                                            show: true,
                                            radius: 500,
                                            label:
                                            {
                                                show: true,
                                                formatter: labelFormatter,
                                                threshold: 0.1
                                            }
                                        }
                                    },
                                    legend:
                                    {
                                        show: false
                                    }
                                });
                                break;
                            case (id == "example-10"):
                                $("#panel-12 h2").html('Pie <span class="fw-300 font-italic">Tilted Pie</span>');
                                $("#panel-12 .panel-tag").html("The pie can be tilted at an angle");
                                $.plot(placeholder, dataSetPie,
                                {
                                    series:
                                    {
                                        pie:
                                        {
                                            show: true,
                                            radius: 1,
                                            tilt: 0.5,
                                            label:
                                            {
                                                show: true,
                                                radius: 1,
                                                formatter: labelFormatter,
                                                background:
                                                {
                                                    opacity: 0.8
                                                }
                                            },
                                            combine:
                                            {
                                                color: "#999",
                                                threshold: 0.1
                                            }
                                        }
                                    },
                                    legend:
                                    {
                                        show: false
                                    }
                                });
                                break;
                            case (id == "example-11"):
                                $("#panel-12 h2").html('Pie <span class="fw-300 font-italic">Donut Hole</span>');
                                $("#panel-12 .panel-tag").html("A donut hole can be added");
                                $.plot(placeholder, dataSetPie,
                                {
                                    series:
                                    {
                                        pie:
                                        {
                                            innerRadius: 0.5,
                                            show: true
                                        }
                                    }
                                });
                                break;
                            case (id == "example-12"):
                                $("#panel-12 h2").html('Pie <span class="fw-300 font-italic">Interactivity</span>');
                                $("#panel-12 .panel-tag").html("The pie can be made interactive with hover and click events");
                                $.plot(placeholder, dataSetPie,
                                {
                                    series:
                                    {
                                        pie:
                                        {
                                            innerRadius: 0.5,
                                            show: true
                                        }
                                    }
                                });
                                $.plot(placeholder, dataSetPie,
                                {
                                    series:
                                    {
                                        pie:
                                        {
                                            show: true
                                        }
                                    },
                                    grid:
                                    {
                                        hoverable: true,
                                        clickable: true
                                    }
                                });

                                placeholder.bind("plothover", function(event, pos, obj)
                                {

                                    if (!obj)
                                    {
                                        return;
                                    }

                                    var percent = parseFloat(obj.series.percent).toFixed(2);
                                    $("#hover").html("<span style='font-weight:bold; color:" + obj.series.color + "'>" + obj.series.label + " (" + percent + "%)</span>");
                                });

                                placeholder.bind("plotclick", function(event, pos, obj)
                                {

                                    if (!obj)
                                    {
                                        return;
                                    }

                                    percent = parseFloat(obj.series.percent).toFixed(2);
                                    alert("" + obj.series.label + ": " + percent + "%");
                                });
                                break;
                        }

                    });
                }
                flot_pie();
                /* flot pie chart -- end*/
            });

        </script>
    </body>
    <!-- END Body -->
</html>
