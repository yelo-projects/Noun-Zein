	<% if Images %>
	<div id="Gallery" class="gallery">
		<ul>
		<% control Images %>
			<li class="$FirstLast $EvenOdd $ParentTitleXML collection-$CollectionWebSafeName" rel="$ParentTitleXML">
				<a class="image" href="$URL" rel="$ParentTitleXML" title="$Title">
				<% control setRandomCroppedSize %>
				<img width="$Width" height="$Height" src="$URL" alt="$Title">
				<span class="load-anim"></span>
				<% end_control %>
				</a>
			</li>
		<% end_control %>
		</ul>
	</div>
	<% end_if %>
