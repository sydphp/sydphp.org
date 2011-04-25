
	<div class="app_posts_related">
	
		<div class="inner">
		
			<% include BreadCrumbs %>
	
			<% include Share %>
	
			<h2>$Title</h2>
			
			<div class="post">
				
					$Content
					
					<!-- start form -->
					
					$Form
					
					<!-- end form -->
					
					$PageComments
					
					<% include SlideShow %>
					
					<% include Pagination %>
				
			</div>
		
		</div>
		
	</div>
	
	<div class="app_posts">
	
		<div class="inner">
		
			<% if Blurb %>
				<div class="blurb">
					$Blurb
				</div>
			<% end_if %>
			<% include SideBar %>
		
		
		</div>
		
	</div>