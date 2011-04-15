

<% require javascript(event_calendar/javascript/calendar_core.js) %>

<div class="app_posts">
	<h2>$Title</h2>
    <div class="inner">
		$Content
		
		<div class="event-sidebar-content">
	
			<h3><% _t('BROWSECALENDAR','Browse the Calendar') %></h3>
		
			<div class="nav">
				<div class="calendar">
					$CalendarWidget
				</div>
				
				<div class="month">
					<h3>select a month</h3>
					$MonthNavigator
				</div>
			</div>
		</div>
		
	</div>
</div>

<div class="app_posts_related">
	
	<div class="inner">
		
		<% if DateHeader %>
			<h2>$DateHeader</h2>
		<% else %>
			<h2>Upcoming events</h2>
		<% end_if %>
		
		<div class="post">
			
			<% include BreadCrumbs %>

			<div class="events">
			
				<% if Events %>
				
					<% control Events %>
					
						<div class="event">
								
							<h3 class="summary"><% if Announcement %>$EventTitle<% else %><a href="$Link">$EventTitle</a><% end_if %> <a class="btn add" href="$ICSLink">(ics)</a> </h3>
							
							<div class="dates">
								$_Dates - <% if AllDay %><% _t('ALLDAY','All Day') %><% else %>$_Times<% end_if %>
							</div>
							
							<div class="description">
								<% if Announcement %>
									$Content
								<% else %>
									<% control Event %>$Content.LimitWordCount(60)<% end_control %> <a href="$Link/register">register</a> / <a href="$Link"><% _t('MORE','more') %></a>
								<% end_if %>
								
								<% if OtherDates %>
									<h4><% _t('SEEALSO','See also') %>:</h4>
									<ul>
									<% control OtherDates %>
										<li><a href="$Link" title="$Event.Title">$_Dates</a>
											<% if StartTime %>
												<ul>
													<li>$_Times</li>
												</ul>
											<% end_if %>
										</li>
									<% end_control %>
									</ul>
								<% end_if %>
							</div>
							
						</div>
					<% end_control %>
				
				<% else %>
					<p><% _t('NOEVENTS','There are no events for the date selected') %>.</p>
				<% end_if %>
			</div>
		</div>
	</div>
</div>