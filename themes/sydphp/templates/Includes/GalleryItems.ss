	<div id="GalleryItems">
			<ul id="GalleryList">
				<% control GalleryItems %>
					<li $Top.GalleryItemStyle class="$EvenOdd $FirstLast"><% if GalleryItem %><span class="cb gi">$GalleryItem</span><% end_if %></li>
				<% end_control %>
			</ul>
	</div>