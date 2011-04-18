<% require themedCSS(EventRegistrationDetails) %>

	<div class="app_posts">
		
		<div class="inner">
			<% if Message %>
				<div class="reg_message">
					$Message
				</div>
			<% end_if %>
		</div>
	</div>

	<div class="app_posts_related">
		
		<div class="inner">
			
			<h2>$Title</h2>
			
			<div class="reg_roundup">
				<% control Registration %>
					<% if Status = Unconfirmed %>
					
						<p class="message message-info message-unconfirmed">
							This registration has not yet been confirmed. In order to confirm your registration, please check your emails for a confirmation email and click on confirmation link contained in it.
						</p>
						
						<% if ConfirmTimeLimit %>
							<p class="message message-info message-unconfirmed">
								If you do not confirm your registration within $ConfirmTimeLimit.TimeDiff, it will be canceled.
							</p>
						<% end_if %>
					<% end_if %>
					
					<% if Status = Canceled %>
						<p class="message message-info message-canceled">
							This registration has been canceled.
						</p>
					<% end_if %>
					
					<div class="reg_attendee_details">
						<table>
							<tr><th>Name:</th><td>$Name</td></tr>
							<tr><th>Email:</th><td>$Email</td></tr>
							<tr><th>Event:</th><td>$Time.EventTitle ($Time.Summary)</td></tr>
							<tr><th>Registered:</th><td>$Created.Nice</td></tr>
							<tr><th>Status:</th><td>$Status</td></tr>
							<% if Tickets %>
								<% control Tickets %>
								<tr><th>Ticket</th><td>$Description</td></tr>
								<tr><th>Quantity</th><td>$Quantity</td></tr>
								<tr><th>Price</th><td><% if Price %>$Price.Nice<% else %>Free<% end_if %></td></tr>
								<% end_control %>
							<% end_if %>
						</table>
					</div>
					
				<% end_control %>
			</div>
			
			<% if Registration.Payment %>
				<% control Registration.Payment %>
					<div class="reg_payment_details">
						<h3>Payment Details</h3>
						<table>
							<tr><th>Method:</th><td>$PaymentMethod</td><tr>
							<tr><th>Amount:</th><td>$Amount.Nice</td><tr>
							<tr><th>Status:</th><td>$Status</td></tr>
						</table>
					</div>
				<% end_control %>
			<% end_if %>
			
			<% if HasTicketFile %>
				<div class="reg_ticket_download">
					<% control Registration %>
						<% if Status = Valid %>
							<h3>Ticket File</h3>
							<p><a href="$Top.Link(ticketfile)">Download ticket file.</a></p>
						<% end_if %>
					<% end_control %>
				</div>
			<% end_if %>
			
		</div>
		
	</div>
