	
	<% include Children %>
	
	<% if SiblingPages %>
		<div class="category-other category-other-siblings">
				<h3>Related content</h3>
				<dl>
					<% control SiblingPages %>
						<dt class="$FirstLast $LinkingMode">
							<a href="$Link" title="Go to the $Title.XML page">
							<% if FeatureImageID %>
								$FeatureImage.SetWidth(240)
							<% else %>
								<span>$MenuTitle</span>
							<% end_if %>
							</a>
						</dt>
						<dd>
							<p>$Excerpt.XML ... <a href="$Link" title="Go to the $Title.XML page">+</a></p>
							<% include Clearer %>
						</dd>
					<% end_control %>
				</dl>
				<% include Clearer %>
		</div>
	<% end_if %>