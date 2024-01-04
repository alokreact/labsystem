@php

    $report_urls = explode(',', $record['report_url']);

@endphp
<ul>
    @foreach ($report_urls as $url)
        <li>
            <a href="{{ asset('/public/images/reports/' . $url) }}" download>
                <i class="bi bi-download"></i> Download Report</a> &nbsp;

            <i class="bi bi-trash"></i>
        </li>
    @endforeach
</ul>

<button id="uploadButton">Upload File</button>

<!-- Hidden file input -->
<div id="report" style="display: none;" class="mt-2">
    <input type="file" id="newReport" data-id="{{ $record['id'] }}">

</div>
