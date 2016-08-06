<div id = "channel_info" class="card card--fullWidth card--transparent ut__flexWrapper ut__DesktopOnly">

<div style="background-color:{{Channel::color(Session::get('channel'))}};border-radius:50%;width:60px;height:60px;">&nbsp;</div>

<h1 class="pageKind__title">
	{{Channel::description(Session::get('channel'))}}
</h1>

</div>
