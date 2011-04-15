	<div id="Pagination" class="offset">
	
		<% if PreviousPage %>
			<div id="PreviousPage"><a href="$PreviousPage.Link" title="$PreviousPage.Title">&laquo; previous - $PreviousPage.Title</a></div>
		<% end_if %>
		
		<% if NextPage %>
			<div id="NextPage"><a href="$NextPage.Link" title="$NextPage.Title">next up - $NextPage.Title &raquo;</a></div>
		<% end_if %>
	
	</div>