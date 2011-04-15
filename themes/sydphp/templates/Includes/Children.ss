	<% if Children %>
	<div class="category-other category-other-children">
		<h3>More $Title</h3>
		<dl>
			<% control Children %>
				<dt>
					<a href="$Link" title="Go to the $Title.XML page">
					<% if FeatureImageID %>
						$FeatureImage.SetWidth(240)
					<% else %>
						<span>$MenuTitle</span>
					<% end_if %>
					</a>
				</dt>
				<dd>
					<p>$Excerpt ... <a href="$Link" title="Go to the $Title.XML page">+</a></p>
					<% include Clearer %>
				</dd>
			<% end_control %>
		</dl>
		<% include Clearer %>
	</div>
	<% end_if %>