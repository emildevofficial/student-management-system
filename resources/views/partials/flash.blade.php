@if(session('flash_message'))
  <div id="flash-data" data-message="{{ session('flash_message') }}" style="display:none"></div>
@endif
