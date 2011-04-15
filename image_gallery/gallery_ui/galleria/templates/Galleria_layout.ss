<div class="galleria_wrap">
<div id="main_image"></div>
	<% if GalleryItems %>
	<ul class="galleria-layout-unstyled" id="gallery-list">
		<% if GalleryItems.NotFirstPage %>
			<% control PreviousGalleryItems %>
						<li style="display:none;">$GalleryItem</li>
			<% end_control %>
		<% end_if %>
		<% control GalleryItems %>
			<li>
					$GalleryItem
			</li>
		<% end_control %>
		<% if GalleryItems.NotLastPage %>
			<% control NextGalleryItems %>
				<li style="display:none;">$GalleryItem</li>
			<% end_control %>
		<% end_if %>
	</ul>
	<% end_if %>
	<p class="nav"><a href="#" onclick="$.galleria.prev(); return false;">&laquo; previous</a> | <a href="#" onclick="$.galleria.next(); return false;">next &raquo;</a></p>

</div>