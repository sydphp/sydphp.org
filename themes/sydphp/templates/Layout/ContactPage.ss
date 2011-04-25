	
	<div class="app_posts_related">
	
		<div class="inner">
		
			<% include BreadCrumbs %>
	
			<% include Share %>
	
			<h2>$Title</h2>
			
			<div class="post">
		
				$Content
				
				<% include Clearer %>
			
				<% if ContactFormSuccess %>
					<p class="success"><span>Thanks, your submission has been received.</span></p>
				<% end_if %>
				
				$ContactForm
			</div>
			
		</div>
	
	</div>