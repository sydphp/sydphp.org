	
	<div class="app_posts_related">
	
		<div class="inner">
		
			<div class="post">
			
				<% include BreadCrumbs %>
				
				<div class="events">
				
					<div class="event">
						
						<% control DateTime %>
							<h2>$EventTitle <a class="btn" href="$ICSLink"><img src="/themes/sydphp/images/resource-calendar-insert.png" alt-"_t('ADD','Add to Calendar')" width="48" height="48" /></a></h2>
							<div class="dates">$Summary</div>
						<% end_control %>
						
						<div class="description">
							$DateTime.Event.Content
						</div>
						
					</div>
					
				</div>
				
			</div>
		</div>
	</div>
	
	<div class="event-sidebar app_posts">
		<div class="inner">
	
			<div class="event-sidebar-item">
			
				<h3>Event registration</h3>
				
				<div class="register">
					<% if EventInFuture %>
						<% if EventIsFull %>
							<p>This event is full.. <a href="/contact-us/">contact us</a> if you'd still like to attend. We'll put your name on a standby list.</p>
						<% else %>
							<p><a href="$Link(register)">Register for event &raquo;</a></p>
						<% end_if %>
					<% else %>
						<p>This event has already taken place. Never fear, have a look through our <a href="/events/">upcoming events list</a> to see what's happening.</p>
					<% end_if %>
				</div>
			
				<div class="cancel">
					$UnregisterForm
				</div>
				
			</div>
			
			
			<% if ExtraSidebarContent %>
				<div class="event-sidebar-item">
					$ExtraSidebarContent
				</div>
			<% end_if %>
			
		</div>
	</div>