<div>
    <div class="row">

        <div class="col-4 form-group">
            <label for="direccion" class="form-control-label">Direccion *</label>
            <input class="form-control" type="text" placeholder="364 Bembeta"
                name="direccion" id="direccion" wire:model="direccion">
            
        </div>
        <div class="col-2 form-group">
            <label for="cod_postal" class="form-control-label">Cod Postal *</label>
            <input class="form-control" type="text" placeholder="70100"
                name="cod_postal" id="cod_postal" wire:model="cod_postal">
        </div>
        <div class="col-3 form-group">
            <label for="pais" class="form-control-label">Pais</label>                     
            <select class="form-control" id="pais"
                wire:model='pais_id'>
                @foreach ($paises as $pais)
                    <option value={{ $pais->id }}> {{ $pais->name }}</option>
                @endforeach
            </select>

        </div>
        <div class="col-3 form-group">
            <label for="provincia" class="form-control-label">Provincia / Com Autonoma*</label>

            <input list="provincias" name="provincias" class="form-control" id="provincia" 
                wire:model='provincia_id'>
            <datalist id="provincias">    
                @forelse ($provincias as $provincia)
                    <option data-value={{ $provincia->id }} value={{ $provincia->name }}>
                @empty
                    <option> nada </option>
                @endforelse
            </datalist>
        
        </div>
            
    </div>

    <div class="row">
        <div class="col-8">
                    
                <div class="row">
                    <div class="col-6 form-group">
                        <label for="municipio" class="form-control-label">Municipio</label>                     
                        <input class="form-control" type="text" placeholder="Camagüey"
                            name="municipio" id="municipio" wire:model="municipio">
                    </div>
                    <div class="col-3 form-group">
                        <label for="municipio_longitud" class="form-control-label">Longitud *</label>
                        <input class="form-control" type="num" placeholder="21.21672470"
                            name="municipio_longitud" id="municipio_longitud" wire:model="municipio_longitud">
                    </div>
                    <div class="col-3 form-group">
                        <label for="municipio_latitud" class="form-control-label">Latitud *</label>
                        <input class="form-control" type="num" placeholder="-77.74520810"
                            name="municipio_latitud" id="municipio_latitud" wire:model="municipio_latitud">
                    </div>
                </div>

                <div class="row">
                    <div class="col-6 form-group">
                        <label for="localidad" class="form-control-label">Localidad</label>                     
                        <input class="form-control" type="tet" placeholder="Centro"
                            name="localidad" id="localidad" wire:model="localidad">
                    </div>
                    <div class="col-3 form-group">
                        <label for="localidad_longitud" class="form-control-label">Longitud *</label>
                        <input class="form-control" type="num" placeholder="10.55672000"
                            name="localidad_longitud" id="localidad_longitud" wire:model="localidad_longitud">
                    </div>
                    <div class="col-3 form-group">
                        <label for="localidad_latitud" class="form-control-label">Latitud *</label>
                        <input class="form-control" type="num" placeholder="47.73420010"
                            name="localidad_latitud" id="localidad_latitud" wire:model="localidad_latitud">
                    </div>
                </div>
        </div>
        <div class="col-4">
            <div id="globe" class="peekaboo">
                <canvas ></canvas>
            </div>
        </div>
    </div>

</div>


@push('scripts')
    <script src="../../assets/js/plugins/threejs.js"></script>
    <script src="../../assets/js/plugins/orbit-controls.js"></script>
    
   <script type="text/javascript">
        (function() {
            const container = document.getElementById("globe");
            const canvas = container.getElementsByTagName("canvas")[0];

            const globeRadius = 100;
            const globeWidth = 4098 / 2;
            const globeHeight = 1968 / 2;

            function convertFlatCoordsToSphereCoords(x, y) {
            let latitude = ((x - globeWidth) / globeWidth) * -180;
            let longitude = ((y - globeHeight) / globeHeight) * -90;
            latitude = (latitude * Math.PI) / 180;
            longitude = (longitude * Math.PI) / 180;
            const radius = Math.cos(longitude) * globeRadius;

            return {
                x: Math.cos(latitude) * radius,
                y: Math.sin(longitude) * globeRadius,
                z: Math.sin(latitude) * radius
            };
            }

            function makeMagic(points) {
            const {
                width,
                height
            } = container.getBoundingClientRect();

            // 1. Setup scene
            const scene = new THREE.Scene();
            // 2. Setup camera
            const camera = new THREE.PerspectiveCamera(45, width / height);
            // 3. Setup renderer
            const renderer = new THREE.WebGLRenderer({
                canvas,
                antialias: true
            });
            renderer.setSize(width, height);
            // 4. Add points to canvas
            // - Single geometry to contain all points.
            const mergedGeometry = new THREE.Geometry();
            // - Material that the dots will be made of.
            const pointGeometry = new THREE.SphereGeometry(0.5, 1, 1);
            const pointMaterial = new THREE.MeshBasicMaterial({
                color: "#989db5",
            });

            for (let point of points) {
                const {
                x,
                y,
                z
                } = convertFlatCoordsToSphereCoords(
                point.x,
                point.y,
                width,
                height
                );

                if (x && y && z) {
                pointGeometry.translate(x, y, z);
                mergedGeometry.merge(pointGeometry);
                pointGeometry.translate(-x, -y, -z);
                }
            }

            const globeShape = new THREE.Mesh(mergedGeometry, pointMaterial);
            scene.add(globeShape);

            container.classList.add("peekaboo");

            // Setup orbital controls
            camera.orbitControls = new THREE.OrbitControls(camera, canvas);
            camera.orbitControls.enableKeys = false;
            camera.orbitControls.enablePan = false;
            camera.orbitControls.enableZoom = false;
            camera.orbitControls.enableDamping = false;
            camera.orbitControls.enableRotate = true;
            camera.orbitControls.autoRotate = true;
            camera.position.z = -265;

            function animate() {
                // orbitControls.autoRotate is enabled so orbitControls.update
                // must be called inside animation loop.
                camera.orbitControls.update();
                requestAnimationFrame(animate);
                renderer.render(scene, camera);
            }
            animate();
            }

            function hasWebGL() {
            const gl =
                canvas.getContext("webgl") || canvas.getContext("experimental-webgl");
            if (gl && gl instanceof WebGLRenderingContext) {
                return true;
            } else {
                return false;
            }
            }

            function init() {
            if (hasWebGL()) {
                window
                window.fetch("https://raw.githubusercontent.com/creativetimofficial/public-assets/master/soft-ui-dashboard-pro/assets/js/points.json")
                .then(response => response.json())
                .then(data => {
                    makeMagic(data.points);
                });
            }
            }
            init();
        })();
    </script>
    
@endpush()    


