	
	<% if GalleryItems %>
	<div id="ImageGallery" class="galleria_gallery">
		<h4>$Title - gallery</h4>
		<div class="inner">
			<% include GalleryItems %>
			<% include GalleryMainImage %>
			<% include Clearer %>
		</div>
	</div>
	<% end_if  %>
	