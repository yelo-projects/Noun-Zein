	<% if Images %>
	<div id="Gallery" class="gallery">
		<ul>
		<% control Images %>
			<li class="$FirstLast $EvenOdd $ParentTitleXML" rel="$ParentTitleXML">
				<a class="image" href="$URL" rel="$ParentTitleXML">
				<% control setRandomSize %>
				<img width="$Width" height="$Height" src="$URL" alt="$Title">
				<span class="load-anim"></span>
				<% end_control %>
				</a>
			</li>
		<% end_control %>
		</ul>
	</div>
	<% end_if %>