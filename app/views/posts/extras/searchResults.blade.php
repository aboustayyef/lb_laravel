<div id="searchResults" class="card card--fullWidth card--transparent">
    <h1 class="pageKind__title" style="margin-left:0">Search Results for "{{\Session::get('searchQuery')}}"</h1>
    @if (isset(\Session::get('searchMeta')['message']))
		<h3 class="page__message">{{\Session::get('searchMeta')['message']}}</h3>    	
    @endif
</div>
