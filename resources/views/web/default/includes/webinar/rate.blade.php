<div class="stars-card d-flex align-items-center {{ $className ?? ' mt-15' }}">
    @php
        $i = 5;
    @endphp
    @while (--$i >= 5 - $rate)
        <i data-feather="star" width="20" height="20" class="active"></i>
    @endwhile
    @while ($i-- >= 0)
        <i data-feather="star" width="20" height="20" class=""></i>
    @endwhile

    @if (empty($dontShowRate) or !$dontShowRate)
        <span class="badge ml-10" style="background-color:#46aa52;color:#fff;">{{ $rate }}</span>
    @endif

</div>
