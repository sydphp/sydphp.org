
<% require javascript(event_calendar/javascript/calendar_core.js) %>

	<div class="app_posts">
		<div class="inner">
			
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
	
	<div class="app_posts_related">
		
		<div class="inner">
			
			<h2>$Parent.Title</h2>
			
			<div class="post">
			
				<% include BreadCrumbs %>
			
				<div class="events">
				
					<div class="event">
						<div class="pin-right">
							<a class="btn add" href="$ICSLink"><img src="/themes/sydphp/images/resource-calendar-insert.png" alt-"_t('ADD','Add to Calendar')" width="48" height="48" /></a>
						</div>
						
						<h3 class="summary">$Title</h3>
			
						<span class="back"><a href="$CalendarBackLink"><% _t('BACKTO','Back to') %> $Parent.Title</a></span>
			
						<% if OtherDates %>
						<div id="additionalDates">
							<h4><% _t('ADDITIONALDATES','Additional Dates') %></h4>
							<dl class="date clearfix">
							<% control OtherDates %>
								<dt><a href="$Link" title="$Event.Title">$_Dates</a></dt>
									
							<% end_control %> 
							</dl>
						</div>
						<% end_if %>
				
						<% control CurrentDate %>
						
						<h4><a href="$ICSLink" title="Add to Calendar">$_Dates</a></h4>
						
						<% if StartTime %>
						<ul id="times">
							<li>$_Times</li>	
						</ul>
						<% end_if %>		
						<% end_control %>
				
						$Content
						$Form
						$PageComments
					</div>
				</div>
				
			</div>
			
		</div>
		
	</div>
	