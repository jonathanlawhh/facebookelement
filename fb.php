<head>
	<meta name="viewport" content="width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
	<link rel="stylesheet" href="css/fbelement.css">
</head>
<script src="js/three.js"></script>
<script src="js/libs/tween.min.js"></script>
<script src="js/controls/TrackballControls.js"></script>
<script src="js/renderers/CSS3DRenderer.js"></script>

<main>
  <body>
		<div id="container"></div>
		<div id="info"><a href="http://threejs.org" target="_blank" rel="noopener">three.js css3d</a> - periodic table. <a href="https://plus.google.com/113862800338869870683/posts/QcFk5HrWran" target="_blank" rel="noopener">info</a>.</div>
		<div id="menu">
			<button id="table">TABLE</button>
			<button id="sphere">SPHERE</button>
			<button id="helix">HELIX</button>
			<button id="grid">GRID</button>
			<button id="pyramid">Pyramid</button>
		</div>

		<script>
			var camera, scene, renderer;
			var controls;

			var objects = [];
			var targets = { table: [], sphere: [], helix: [], grid: [] , pyramid: [] };

			init();
			animate();

			function init() {

				camera = new THREE.PerspectiveCamera( 40, window.innerWidth / window.innerHeight, 1, 10000 );
				camera.position.z = 3000;

				scene = new THREE.Scene();

				// table
				var gender = 2
				for ( var i = 0; i < table.length; i += 5 ) {

					var element = document.createElement( 'div' );
					element.className = 'element';

					var number = document.createElement( 'div' );
					number.className = 'number';
					number.textContent = (i/5) + 1;
					element.appendChild( number );

					var symbol = document.createElement( 'div' );
					symbol.className = 'symbol';
					symbol.textContent = table[ i ];
					element.appendChild( symbol );

					var details = document.createElement( 'div' );
					details.className = 'details';
					details.innerHTML = table[ i + 1 ] + '<br>' + table[ i + 2 ];
					element.appendChild( details );

					var object = new THREE.CSS3DObject( element );
					object.position.x = Math.random() * 4000 - 2000;
					object.position.y = Math.random() * 4000 - 2000;
					object.position.z = Math.random() * 4000 - 2000;
					scene.add( object );

					objects.push( object );

					var object = new THREE.Object3D();
					object.position.x = ( table[ i + 3 ] * 140 ) - 1330;
					object.position.y = - ( table[ i + 4 ] * 180 ) + 990;

					"male" == table[gender] ? (element.style.backgroundColor = "rgba(0,127,127," + (0.5 * Math.random() + 0.25) + ")", element.style.boxShadow = "0px 0px 12px rgba(0,255,255,0.5)", symbol.style.textShadow = "0 0 10px rgba(0,255,255,0.95)")
					: (element.style.backgroundColor = "rgba(229,94,162," + (0.5 * Math.random() + 0.25) + ")", element.style.boxShadow = "0px 0px 12px rgba(229,94,162,0.5)", symbol.style.textShadow = "0px 0px 12px rgba(229,94,162,0.8)");
					gender +=5;

					targets.table.push( object );

				}

				// sphere

				var vector = new THREE.Vector3();
				var spherical = new THREE.Spherical();

				for ( var i = 0, l = objects.length; i < l; i ++ ) {

					var phi = Math.acos( -1 + ( 2 * i ) / l );
					var theta = Math.sqrt( l * Math.PI ) * phi;

					var object = new THREE.Object3D();

					spherical.set( 800, phi, theta );

					object.position.setFromSpherical( spherical );

					vector.copy( object.position ).multiplyScalar( 2 );

					object.lookAt( vector );

					targets.sphere.push( object );

				}

				// helix

				var vector = new THREE.Vector3();
				var cylindrical = new THREE.Cylindrical();

				for ( var i = 0, l = objects.length; i < l; i ++ ) {

					var theta = i * 0.175 + Math.PI;
					var y = - ( i * 8 ) + 450;

					var object = new THREE.Object3D();

					cylindrical.set( 900, theta, y );

					object.position.setFromCylindrical( cylindrical );

					vector.x = object.position.x * 2;
					vector.y = object.position.y;
					vector.z = object.position.z * 2;

					object.lookAt( vector );

					targets.helix.push( object );

				}

				// grid

				for ( var i = 0; i < objects.length; i ++ ) {

					var object = new THREE.Object3D();

					object.position.x = ( ( i % 5 ) * 400 ) - 800;
					object.position.y = ( - ( Math.floor( i / 5 ) % 5 ) * 400 ) + 800;
					object.position.z = ( Math.floor( i / 25 ) ) * 1000 - 2000;

					targets.grid.push( object );

				}

				//Pyramid
				for (var postx = 0, posty = 0, postz = 0, loop = 0, p = 0, xVal = 800, zVal = 300, xMul = 0, i = 0; i < objects.length; i++) {
				  var object = new THREE.Object3D;
				  p == loop ? (postx++, posty++, postz++, loop++, p = 0) : (p++, postx++);
				  xMul = 160 * loop;
				  20 > i ? (object.position.x = 400 * postx - xVal - xMul, object.position.y = -posty % 6 * 400 + 800, object.position.z = postz * zVal - 2000) : 20 <= i && 40 > i ? (object.position.z = 400 * postx - xVal - xMul - 1650, object.position.y = -posty % 6 * 400 + 800, object.position.x = postz * zVal - 200, object.lookAt(vector), object.rotation.z = Math.PI, object.rotation.y = Math.PI / 2, object.rotation.x = Math.PI) : 40 <= i && 60 > i ? (object.position.x = 400 * postx - xVal - xMul, object.position.y =
				  -posty % 6 * 400 + 800, object.position.z = -(postz * zVal) - 2000, object.rotation.y = Math.PI) : 60 <= i && 79 > i ? (object.position.z = 400 * postx - xVal - xMul - 1650, object.position.y = -posty % 6 * 400 + 800, object.position.x = -(postz * zVal) - 500, object.lookAt(vector), object.rotation.z = Math.PI, object.rotation.y = -Math.PI / 2, object.rotation.x = Math.PI) : 80 <= i && 116 > i ? (object.position.x = i % 6 * 500 - 1500, object.position.z = 500 * -(Math.floor(i / 6) % 6) - 800, object.position.y =
				  -1500, object.rotation.x = Math.PI / 2) : (object.position.x = -500 + i % 3 * 100, object.position.z = -2000, object.position.y = 800, object.rotation.y = Math.PI / 4);
				  if (19 == i || 39 == i || 59 == i || 79 == i) {
				    p = loop = xMul = postz = posty = postx = 0;
				  }
				  p == loop && (postx = 0);
				  targets.pyramid.push(object);
				}

				//

				renderer = new THREE.CSS3DRenderer();
				renderer.setSize( window.innerWidth, window.innerHeight );
				renderer.domElement.style.position = 'absolute';
				document.getElementById( 'container' ).appendChild( renderer.domElement );

				//

				controls = new THREE.TrackballControls( camera, renderer.domElement );
				controls.rotateSpeed = 0.5;
				controls.minDistance = 500;
				controls.maxDistance = 6000;
				controls.addEventListener( 'change', render );

				var button = document.getElementById( 'table' );
				button.addEventListener( 'click', function ( event ) {

					transform( targets.table, 2000 );

				}, false );

				var button = document.getElementById( 'sphere' );
				button.addEventListener( 'click', function ( event ) {

					transform( targets.sphere, 2000 );

				}, false );

				var button = document.getElementById( 'helix' );
				button.addEventListener( 'click', function ( event ) {

					transform( targets.helix, 2000 );

				}, false );

				var button = document.getElementById( 'grid' );
				button.addEventListener( 'click', function ( event ) {

					transform( targets.grid, 2000 );

				}, false );

				var button = document.getElementById( 'pyramid' );
				button.addEventListener( 'click', function ( event ) {

					transform( targets.pyramid, 2000 );

				}, false );

				transform( targets.table, 2000 );

				//

				window.addEventListener( 'resize', onWindowResize, false );

			}

			function transform( targets, duration ) {

				TWEEN.removeAll();

				for ( var i = 0; i < objects.length; i ++ ) {

					var object = objects[ i ];
					var target = targets[ i ];

					new TWEEN.Tween( object.position )
						.to( { x: target.position.x, y: target.position.y, z: target.position.z }, Math.random() * duration + duration )
						.easing( TWEEN.Easing.Exponential.InOut )
						.start();

					new TWEEN.Tween( object.rotation )
						.to( { x: target.rotation.x, y: target.rotation.y, z: target.rotation.z }, Math.random() * duration + duration )
						.easing( TWEEN.Easing.Exponential.InOut )
						.start();

				}

				new TWEEN.Tween( this )
					.to( {}, duration * 2 )
					.onUpdate( render )
					.start();

			}

			function onWindowResize() {

				camera.aspect = window.innerWidth / window.innerHeight;
				camera.updateProjectionMatrix();

				renderer.setSize( window.innerWidth, window.innerHeight );

				render();

			}

			function animate() {
				requestAnimationFrame( animate );
				TWEEN.update();
				controls.update();
			}

			function render() { renderer.render( scene, camera ); }
		</script>
  </body>
</main>
