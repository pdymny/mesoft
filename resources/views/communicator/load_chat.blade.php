<?php $date = date_create($tab['created_at']); ?>
<div class="media mb-3">
  <div class="media-body">
    <h5 class="mt-0">
      {{ $tab['firstname'] }} {{ $tab['name'] }} 
      <small>({{ date_format($date, 'Y-m-d H:i:s') }})</small>
    </h5>
    <div class="border border-primary rounded mt-1 p-2 @if(empty($tab['read_at'])) bg-light @endif">
      {{ $tab['body'] }}

      @if(empty($tab['read_at']))
      <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-envelope float-right" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2zm13 2.383l-4.758 2.855L15 11.114v-5.73zm-.034 6.878L9.271 8.82 8 9.583 6.728 8.82l-5.694 3.44A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.739zM1 11.114l4.758-2.876L1 5.383v5.73z"/>
      </svg>
      @endif
    </div>
  </div>
</div>
