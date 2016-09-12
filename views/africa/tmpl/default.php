<?php if(isset($this->document) and isset($this->document->title)) : ?>
<h1 class="ui header">
    <?= $this->document->title; ?>
</h1>
<?php endif; ?>

<div id="infoBox" class="ui segment">
    <h3 class="ui header">Title</h3>
    <p>Pellentesque Fermentum Pharetra Justo Fringilla</p>
    <a href=""><i class="ui external icon"></i>View site</a>    
</div>

<canvas id="canvas" width="1110" height="815px" style="border: 0px solid black;">

<script>

    var green = '#E4002B'; // Now red
    var orange = '#003865';
    var green02 = '#A6192E';
    var scale = 1;
    var totalObjects = 0;
    var box = $("#infoBox");
    var base = "<?= JURI::base(); ?>";

    var infoData = {

        southafrica : {
            title: 'South Africa',
            desc: 'Cushman &amp; Wakefield Excellerate is Africa’s leading trusted provider of fully integrated, self-performing property solutions that deliver quality, cost-effective results.',
            url: 'http://epsgroup.co.za'
        },

        drc: {
            title: 'Democratic Republic of the Congo',
            desc: 'JHI has been active in the DRC since 2014 and has offices in Lubumbashi.',
            url: base + 'democratic-republic-of-the-congo-drc'
        },

        gana: {
            title: 'Ghana',
            desc: 'JHI has been active in Ghana since 2010 and has offices in Accra.',
            url: base + 'ghana'
        },

        kenya:{
            title: 'Kenya',
            desc: 'JHI has been active in Kenya since 2015 and has its office in the CBD of Westlands Nairobi.',
            url: base + 'kenya'
        },

        namibia:{
            title: 'Namibia',
            desc: 'JHI has been active in Namibia since 2003 and has offices in Windhoek.',
            url: base + 'namibia'
        },

        nigeria:{
            title: 'Nigeria',
            desc: 'JHI has been active in Nigeria since December 2014 and has an office in Lagos.',
            url: base + 'nigeria'
        },

        zambia:{
            title: 'Zambia',
            desc: 'JHI Properties Zambia Limited commenced operations in 2005 trading under the name Minerva.',
            url: base + 'zambia'
        },

        'zimbabwe':{
            title: 'Zimbabwe',
            desc: 'JHI has been active in Zimbabwe since 2011 and has a head office in Harare.',
            url: base + 'zimbabwe' 
        }
    }

    // Grab the canvas
    var element = $('#canvas'), // we are going to use it for event handling
    canvas = new fabric.Canvas(element.get(0), {
        selection: false, // disable groups selection
        scale: 1, // set default scale
        renderOnAddRemove: false,
        moveCursor: 'default', // reset mouse cursor - they are not used by us
        hoverCursor: 'default'
    });

    // Listen for and react to clicks on the map
    canvas.on('object:selected', function(options) {

        // Vars
        var country = options.target;
        var event = options.e;
        var current = canvas.getActiveObject();

        // Action only if we have a target and info is available
        if (country && country.info) {

            console.log(event);

            // Removes highlight color
            origionalColors();

            // The last object added would be the last line created, remove it if its been created before
            if(canvas._objects.length > totalObjects){
                canvas.item(totalObjects).remove();
            }

            // Change to highlight color
            country.fill = green02;
            
            // Modify info box
            box.css({
                'top' : event.clientY - box.height(),
                'left' : event.clientX - (box.width()/2)
            })
            .find('h3').html(country.info.title)
            .parent().find('p').html(country.info.desc)
            .parent().find('a').attr('href', country.info.url)
            .parent().show();

            // Draw line
            if(country.pathOffset){
                canvas.add(new fabric.Line([country.pathOffset.x, country.pathOffset.y, event.clientX, event.clientY], {
                    selectable: false,
                    stroke: green02,
                    hasControls: false,
                    hasBorders: false,
                    evented: false
                }));
            }

            // Stop select
            //canvas.deactivateAll();
        }
    });

    // Load the map
    fabric.loadSVGFromURL;

    // Catch
    fabric.util.loadImage(base + '/components/com_africa/assets/img/map.svg', function(img) {
        
        // Map
        var map = new fabric.Image(img), curBaseScale;
        
        // Disable all edit and object selecting functionality on the canvas
        map.set({
            hasRotatingPoint: false,
            hasBorders: false,
            hasControls: false,
            lockScalingY: true,
            lockScalingX: true,
            selectable: false,
            left: 750 / 2,
            top: 815 / 2,
            width: 750,
            height:815,
            originX: 'center',
            originY: 'center'
        });
        canvas.add(map);

        // Add each country, the last country is the top layered country
        addCountry({name:'Namibia', x:-120, y:0}, TerritoryPathData.namibia.path, green, infoData.namibia);
        addCountry({name:'South Africa', x:-120, y:50}, TerritoryPathData.southafrica.path, green, infoData.southafrica);
        addCountry({name:'', x:80, y:0}, TerritoryPathData.lesotho.path, green, false);
        addCountry({name:'', x:80, y:0}, TerritoryPathData.swaziland.path, green, false);
        addCountry({name:'Zimbabwe', x:0, y:-30}, TerritoryPathData.zimbabwe.path, green, infoData.zimbabwe);
        addCountry({name:'Zambia', x:-50, y:0}, TerritoryPathData.zambia.path, green, infoData.zambia);
        addCountry({name:'', x:0, y:0}, TerritoryPathData.tanzania.path, orange, false);
        addCountry({name:'Kenya', x:-50, y:0}, TerritoryPathData.kenya.path, green, infoData.kenya);
        addCountry({name:'Democratic \nRepublic of\nCongo', x:-20, y:-20}, TerritoryPathData.droc.path, green, infoData.drc);
        addCountry({name:'', x:-80, y:70}, TerritoryPathData.cameroon.path, orange, false);
        addCountry({name:'', x:-50, y:-20}, TerritoryPathData.uganda.path, orange, false);
        addCountry({name:'', x:-150, y:50}, TerritoryPathData.senegal.path, orange, false);
        addCountry({name:'', x:-100, y:100}, TerritoryPathData.cote.path, orange, false);
        addCountry({name:'Ghana', x:-30, y:30}, TerritoryPathData.ghana.path, green, infoData.gana);
        addCountry({name:'', x:-110, y:-10}, TerritoryPathData.gabon.path, orange, false);
        addCountry({name:'', x:-50, y:0}, TerritoryPathData.botswana.path, green, false);
        addCountry({name:'Nigeria', x:-50, y:-20}, TerritoryPathData.nigeria.path, green, infoData.nigeria);

        // Done render
        canvas.renderAll();

        // Remember total number of objects so we can add and remove lines
        totalObjects = canvas._objects.length;
    });

    // Add a clickable country
    var addCountry = function(text, path, color, info) {
        
        // Marker itself
        var marker = new fabric.Path(path, 
        {
            hasRotatingPoint: false,
            hasBorders: false,
            hasControls: false,
            lockScalingY: true,
            lockScalingX: true,
            lockMovementX: true,
            lockMovementY: true,
            selectable: true,
            perPixelTargetFind: true, // dont select by boundingbox but by path instead
            scaleX: scale, 
            scaleY: scale, 
            left: 0,
            top: 0,
            originX: 'center',
            originY: 'center',
            fill: color,
            origionalColor: color,
            stroke: '#ffffff',
            hoverCursor: 'pointer',
            info:info
        });
        
        // Text
        textObject = new fabric.Text(text.name, { 
            fontSize: 17,
            lineHeight:1,
            textAlign: 'center', 
            fill: '#000000',
            originX: 'left',
            originY: 'top',
            left: (marker.left * 2) + text.x,
            top: (marker.top * 2) + text.y,
        }),
        
        // Wrapper - try remove this
        background = new fabric.Rect({
            width: 100, 
            height: 40, 
            originX: 'center', 
            originY: 'center',
            fill: 'white',
            stroke: 'black'
        }),
        
        // Group for correct positioning - try remove this
        textGroup = new fabric.Group([background, textObject], { 
            scaleX: scale,
            scaleY: scale,
            left: 0,
            top: 0
        });

        canvas.add(marker);
        canvas.add(textObject);
    };

    // Put colors back to origional colours
    var origionalColors = function(){
        for (var i = 0; i < canvas._objects.length; i++) {
            if(canvas._objects[i].origionalColor){
                canvas._objects[i].fill = canvas._objects[i].origionalColor;
            }
        }
    }

</script>