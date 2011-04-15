	
		
		<% if Testimonials %>
			<div id="slideshow">
				<div id="slides">
					<ul>
					<% control Testimonials %>
						
						<li class="slide slide-$EvenOdd<% if UseBubble %> testimonial<% end_if %>">
							
							<h4>$Project</h4>
							
							<% include Clearer %>
							
							<div class="content">
							
							<% if AssociatedImage %>
								<div class="image iceberg">
									$AssociatedImage.SetWidth(300)
								</div>
								<div class="inner inner-image iceberg">
							<% else %>
								<div class="inner iceberg">
							<% end_if %>
							
									<p class="heading quote">$Quote</p>
									<% if UseBubble %>
										<p class="from"><cite><a href="$LinkPage">$Author</a>, <a href="$LinkPage">$Position, $Company</a></cite><br /></p>
									<% end_if %>
								</div>
							
							<% if Note %>
								<div class="inner-note iceberg">
									<p>$Note <a href="$LinkPage">read more</a>.</p>
								</div>
							<% end_if %>
							
							<% include Clearer %>
							
							</div>
							
						</li>
					<% end_control %>
					</ul>
				</div>
				<% include SlidesActions %>
			</div>
		<% end_if %>
		
		