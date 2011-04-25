	<div class="app_posts_related">
	
		<div class="inner content-search-results">
		
			<h2>$Title</h2>
		
			<% if Results %>
				<ul>
				<% control Results %>
					<li>
						<% if MenuTitle %>
						<h3><a class="searchResultHeader" href="$Link">$MenuTitle</a></h3>
						<% else %>
						<h3><a class="searchResultHeader" href="$Link">$Title</a></h3>
						<% end_if %>
					<% if Content %>
						$Content.FirstParagraph(html)
					<% end_if %>
					<a class="readMoreLink" href="$Link" title="Read more about &quot;{$Title}&quot;">Read more about &quot;{$Title}&quot;...</a>
					</li>
				<% end_control %>
				</ul>
			<% else %>
				<p>Sorry, your search query did not return any results.</p>
			<% end_if %>
	
			<% if Results.MoreThanOnePage %>
				<div class="pagination">
					<% if Results.NotLastPage %>
						<a class="next" href="$Results.NextLink" title="View the next page">Next</a>
					<% end_if %>
					<% if Results.NotFirstPage %>
						<a class="prev" href="$Results.PrevLink" title="View the previous page">Prev</a>
					<% end_if %>
					<span>
						<% control Results.SummaryPagination(5) %>
						<% if CurrentBool %>
							$PageNum
						<% else %>
							<a href="$Link" title="View page number $PageNum">$PageNum</a>
						<% end_if %>
						<% end_control %>
					</span>
				</div>
			<% end_if %>
			
		</div>
	</div>