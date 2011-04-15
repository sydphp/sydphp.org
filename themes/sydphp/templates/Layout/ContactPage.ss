<div class="typography">
	
	<% include BreadCrumbs %>
	
	<div class="story">
	
		<h2>$Title</h2>
		
		$Content
		
		<% include Clearer %>
	
		<% if ContactFormSuccess %>
			<div class="focus-all">
				<p class="success"><span>Thanks, your submission has been received.</span></p>
			</div>
		<% end_if %>
		
		$ContactForm
		
		<% include SlideShow %>
	
	</div>
		
</div>