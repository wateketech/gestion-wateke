@switch($icon_type)
    @case('valid')
        <span class="fa-stack" style="transform: scale(0.45);">
            <i class="fas fa-certificate fa-stack-2x text-info"></i>
            <i class="fas fa-check fa-stack-1x fa-inverse"></i>
        </span>
        @break
    @case('not valid')
        <span class="fa-stack" style="transform: scale(0.45);">
            <i class="fas fa-certificate fa-stack-2x text-danger"></i>
            <i class="fas fa-check fa-stack-1x fa-inverse"></i>
        </span>
        @break
    @default
        <span class="fa-stack" style="transform: scale(0.45);">
            <i class="fas fa-certificate fa-stack-2x"></i>
            <i class="fas fa-check fa-stack-1x fa-inverse"></i>
        </span>
@endswitch
