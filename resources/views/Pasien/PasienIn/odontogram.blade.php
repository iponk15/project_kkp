<style>
    * { box-sizing: border-box; }

    body { font-family: sans-serif; }

    .scene {
    width: 200px;
    height: 200px;
    border: 1px solid #CCC;
    margin: 80px;
    perspective: 400px;
    }

    .cube {
    width: 200px;
    height: 200px;
    position: relative;
    transform-style: preserve-3d;
    transform: translateZ(-100px);
    }

    .cube.is-spinning {
    animation: spinCube 8s infinite ease-in-out;
    }

    @keyframes spinCube {
        0% { transform: translateZ(-100px) rotateX(  0deg) rotateY(  0deg); }
    100% { transform: translateZ(-100px) rotateX(360deg) rotateY(360deg); }
    }

    .cube__face {
    position: absolute;
    width: 200px;
    height: 200px;
    border: 2px solid black;
    line-height: 200px;
    font-size: 40px;
    font-weight: bold;
    color: white;
    text-align: center;
    }

    .cube__face--front  { background: hsla(  0, 100%, 50%, 0.7); }
    .cube__face--right  { background: hsla( 60, 100%, 50%, 0.7); }
    .cube__face--back   { background: hsla(120, 100%, 50%, 0.7); }
    .cube__face--left   { background: hsla(180, 100%, 50%, 0.7); }
    .cube__face--top    { background: hsla(240, 100%, 50%, 0.7); }
    .cube__face--bottom { background: hsla(300, 100%, 50%, 0.7); }

    .cube__face--front  { transform: rotateY(  0deg) translateZ(100px); }
    .cube__face--right  { transform: rotateY( 90deg) translateZ(100px); }
    .cube__face--back   { transform: rotateY(180deg) translateZ(100px); }
    .cube__face--left   { transform: rotateY(-90deg) translateZ(100px); }
    .cube__face--top    { transform: rotateX( 90deg) translateZ(100px); }
    .cube__face--bottom { transform: rotateX(-90deg) translateZ(100px); }

    .cube.is-backface-hidden .cube__face {
    backface-visibility: hidden;
}
</style>
<div class="card card-custom">
    <div class="card-header">
        <div class="card-title">
            <span class="card-icon"><i class="{{ (!empty($cardIcon) ? $cardIcon : 'flaticon2-chat-1') }} text-info icon-xl"></i></span>
            <h3 class="card-label text-info">
                {!! (!empty($cardTitle) ? $cardTitle : 'Card Title' ) !!}
                <small>{!! (!empty($cardSubTitle) ? $cardSubTitle : 'Card Sub Title' ) !!}</small>
                <!-- <span class="d-block text-muted pt-2 font-size-sm">row selection and group actions</span> -->
            </h3>
        </div>
        <div class="card-toolbar"></div>
    </div>
    <div class="card-body">
        <div class="scene">
            <div class="cube">
                <div class="cube__face cube__face--front">front</div>
                <div class="cube__face cube__face--back">back</div>
                <div class="cube__face cube__face--right">right</div>
                <div class="cube__face cube__face--left">left</div>
                <div class="cube__face cube__face--top">top</div>
                <div class="cube__face cube__face--bottom">bottom</div>
            </div>
            </div>
        </div>
</div>

<script>
    $(document).ready(function(){
        
    });
</script>