<table class="action" align="center" width="100%" cellpadding="0" cellspacing="0">
    <tr>
        <td align="center">
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td align="center">
                        <table border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td>
                                    @if(isset($url))
                                        <a href="{{ $url }}" class="button button-{{ $color ?? 'green' }}" target="_blank">{{ $slot }}</a>
                                    @else
                                        <span class="button button-{{ $color ?? 'green' }}">{{ $slot }}</span>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
