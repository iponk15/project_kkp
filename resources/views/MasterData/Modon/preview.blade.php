<div class="example">
    <div class="example-preview">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="9.9 67.66 480.2 245.766">
            <g transform="matrix(1.5, 0, 0, 1.5, 38.161758, 86.386719)" id="gmain">
                @foreach($records as $rows)
                    <g id="{{ $rows['modon_kode'] }}" transform="{!! $rows['modon_transform'] !!}">
                        @foreach($rows['modon_detail'] as $modets)
                            <polygon points="{!! $modets['modet_points'] !!}" stroke="navy" stroke-width="0.5" id="{{ $modets['modet_kode'] }}" opacity="1" style="fill: white; stroke-miterlimit: 2;"/>
                        @endforeach
                        <text style="fill: rgb(0, 0, 128); font-size: 8px; white-space: pre;" x="6" y="-5">{{ $rows['modon_no'] }}</text>
                    </g>
                @endforeach
                <path d="M 140.742 -8.763 L 140.742 -9.768 C 140.742 -10.037 140.958 -10.258 141.229 -10.258 C 141.493 -10.258 141.709 -10.037 141.709 -9.768 L 141.709 -8.763 L 143.392 -8.763 L 141.229 -5.82 L 139.059 -8.763 L 140.742 -8.763 Z" style="fill:#000080;"></path>
                <path d="M 140.742 65.352 L 140.742 66.357 C 140.742 66.626 140.958 66.847 141.229 66.847 C 141.493 66.847 141.709 66.626 141.709 66.357 L 141.709 65.352 L 143.392 65.352 L 141.229 62.409 L 139.059 65.352 L 140.742 65.352 Z" style="fill:#000080;" bx:origin="0.5 0.476983"></path>
                <path d="M 140.742 73.904 L 140.742 72.899 C 140.742 72.63 140.958 72.409 141.229 72.409 C 141.493 72.409 141.709 72.63 141.709 72.899 L 141.709 73.904 L 143.392 73.904 L 141.229 76.847 L 139.059 73.904 L 140.742 73.904 Z" style="fill:#000080;"></path>
                <path d="M 140.742 148.685 L 140.742 149.69 C 140.742 149.959 140.958 150.18 141.229 150.18 C 141.493 150.18 141.709 149.959 141.709 149.69 L 141.709 148.685 L 143.392 148.685 L 141.229 145.742 L 139.059 148.685 L 140.742 148.685 Z" style="fill:#000080;" bx:origin="0.5 0.476983"></path>
            </g>
        </svg>
    </div>
</div>