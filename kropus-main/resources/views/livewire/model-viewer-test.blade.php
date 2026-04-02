<div>
    @assets
        <script type="module" src="https://ajax.googleapis.com/ajax/libs/model-viewer/4.0.0/model-viewer.min.js"></script>
    @endassets

    <div class="grid grid-cols-2 gap-5">
        <div>
            <h1 class="title-2 mb-[2.5rem]">Корпуса по вашему ТЗ</h1>
            <p class="subtitle-1">Любой сложности по любой цене</p>
        </div>
        <div>
            <model-viewer style="width: 100%; height: 400px;" alt="3D model" src="{{ asset('3d/case.glb') }}" shadow-intensity="1" camera-controls touch-action="pan-y"></model-viewer>
        </div>
    </div>
</div>
