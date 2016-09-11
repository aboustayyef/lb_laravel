<div class="noresults" style="width:100%;text-align:center">

  @if (Session::get('pageKind') == 'searchResults')
    <div><img src="/img/nothing-found.png" width="107" height="auto" alt="Bucket of Hearts">
        <h1 class="pageKind__title">Uh-Oh!</h1>
        <p style="font-size:22px;line-height:1.5">{{Session::get('searchMeta')['errorMessage']}}</p></div>
  @endif

</div>
