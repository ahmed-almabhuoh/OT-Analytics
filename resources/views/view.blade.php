 <html>

 <head>
     <meta charset="utf-8" />
     <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no" />
     <title>ArcGIS Maps SDK for JavaScript Tutorials: Display a map</title>

     <style>
         html,
         body,
         #viewDiv {
             padding: 0;
             margin: 0;
             height: 100%;
             width: 100%;
         }
     </style>

     <link rel="stylesheet" href="https://js.arcgis.com/4.25/esri/themes/light/main.css">
     <script src="https://js.arcgis.com/4.25/"></script>

     <script>
         require(["esri/config", "esri/Map", "esri/views/MapView"], function(esriConfig, Map, MapView) {

             esriConfig.apiKey = "5efc00eea6da49299ad8d1e7f6ed203f";

             const map = new Map({
                 basemap: "arcgis-topographic" // Basemap layer service
             });

             const view = new MapView({
                 map: map,
                 center: [-118.805, 34.027], // Longitude, latitude
                 zoom: 13, // Zoom level
                 container: "viewDiv" // Div element
             });

         });
     </script>

 </head>

 <body>
     <div id="viewDiv"></div>
 </body>

 </html>
