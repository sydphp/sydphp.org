	
	<div id="categories">
		<div class="inner">
			<ul class="rz root">
				<% control Menu(1) %>
					<li class="root $FirstLast $EvenOdd"><a class="root" href="$Link" title="Go to the $Title.XML page" class="$LinkingMode"><span>$MenuTitle.XML</span></a>
						<% if Children %>
						<ul class="sub">
							<% control Children %>
							<li class="sub $FirstLast $EvenOdd <% if LinkOrCurrent = current %> current<% end_if %><% if LinkingMode = section %> section<% end_if %>">
								<a class="sub" href="$Link">$MenuTitle</a>
							</li>
							<% end_control %>
						</ul>
						<% end_if %>
					</li>
				<% end_control %>
			</ul>
			<% include Clearer %>
		</div>
	</div>