	
		<div><!-- app_content -->
	
		
		<div class="app_other">
		
			<h2>Other stuff</h2>
			
			<div class="item">
				<h3>Search</h3>
				$SearchForm
			</div>
			
			<div class="item">
				<h3>Who are the organisers?</h3>
				<p class="text">Currently Tim, James, Graham and Dean. One or more of us will be attending each meeting and you can reach us via <a href="http://twitter.com/sydphp"><img src="/themes/sydphp/images/ub-t.png" width="16" height="16" alt="twitter"/><strong>@sydphp on twitter</strong></a>  or <a href="/contact/">sending us an email</strong></p>
			</div>
			
			<div class="item">
				<h3>Find</h3>
				<ul>
					<% control Menu(1) %>
						<li><a href="$Link" title="Go to the $Title.XML page" class="$LinkingMode">$MenuTitle.XML</a></li>
					<% end_control %>
				</ul>
			</div>
			
			<% if FeaturedPages %>
			<div class="item">
				<h3>Featured</h3>
				<ul>
					<% control FeaturedPages %>
						<li><a href="$Link" title="Go to the $Title.XML page" class="$LinkingMode">$MenuTitle.XML</a></li>
					<% end_control %>
				</ul>
			</div>
			<% end_if %>
			
			<!--[if IE]>
				<div class="better">
					<div class="item item-last">
						<h4>Last column</h4>
						
						<div class="better">
							<h4>the web is better in...</h4>
							<ul>
								<li><a rel="nofollow" href="http://chrome.google.com/">Chrome</a></li>
								<li><a rel="nofollow" href="http://getfirefox.com">Firefox</a></li>
								<li><a rel="nofollow" href="http://www.opera.com/download">Opera</a></li>
								<li><a rel="nofollow" href="http://www.apple.com/safari">Safari</a></li>
								<li><a rel="nofollow" href="http://code.google.com/p/arora/">Arora</a></li>
								<li><a rel="nofollow" href="http://windows.microsoft.com/ie9">IE9b</a></li>
							</ul>
						</div>
						
					</div>
				</div>
			<![endif]-->
		
			<% include Clearer %>
		
		</div>
		
		<div id="app_footer">
			<p>Site development - The Sydney PHP Group Organisers.
			
			<% if SiteConfig.SourcePage %>
				<br />
				<span class="source">
				<a href="$SiteConfig.SourcePage">code</a>
				<% if SiteConfig.SourceBranch %>
					 / <a href="$SiteConfig.SourceBranch">fork</a>
				<% end_if %>
				</span>
			<% end_if %>
			
			<br />
			Content &copy; 2003-2011 The Sydney PHP Group members. Posted content is the responsibility of its author(s).
			
			</p>
		</div>
	
	
	</div><!-- app_wrapper -->
	
	<% include Scripts %>
	
</body>
