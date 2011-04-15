<!DOCTYPE html>
<html lang="en">
  <head>
		<% base_tag %>
		<title><% if MetaTitle %>$MetaTitle<% else %>$Title<% end_if %>: $SiteConfig.Title - $SiteConfig.Tagline</title>
		$MetaTags(false)
		<link rel="shortcut icon" href="/favicon.ico" />
		<link rel="stylesheet" href="/themes/sydphp/css/base.css" media="all" />
		<link rel="stylesheet" href="/themes/sydphp/css/typography.php" media="all" />
		<link rel="stylesheet" href="/themes/sydphp/css/all.php" media="all" />
		<link rel="stylesheet" href="/themes/sydphp/css/image_gallery.css" media="all" />
		
		<link rel="stylesheet" href="/themes/sydphp/css/nav.css" media="all" />
		
		<link rel="alternate" type="application/rss+xml" title="Sydney PHP Group RSS Feed" href="http://feeds2.feedburner.com/SydneyPHPGroup" />
		
		<link rel="alternate" type="application/rss+xml" title="Sydney PHP Group : last 15 announcements" href="http://groups.google.com.au/group/sydphp/feed/rss_v2_0_msgs.xml" />
	
		<link rel="alternate" type="application/rss+xml" title="Sydney PHP Group : twitter feed" href="http://twitter.com/statuses/user_timeline/17483841.rss" />
	
		<link rel="alternate" type="application/rss+xml" title="Sydney PHP Group : flickr pool" href="http://api.flickr.com/services/feeds/groups_pool.gne?id=94256273@N00&lang=en-us&format=rss_200" />
		
		<link rel="alternate" type="application/rss+xml" title="sydphp site feed"  href="$RSSLink" />
		
		<!--[if IE]>
			<link rel="stylesheet" href="/themes/sydphp/css/for_stupid.css" media="all" />
		<![endif]-->
	</head>
<body class="$CssClass">

	<div id="app_wrap">
	
			<div id="app_sidebar">
				
				<!-- skip to content links -->
				<ul id="app_skip">
					<li><a href="#app_content">content</a></li>
	
				</ul>
				<!-- end app_skip -->
				
				<!-- google_ad_section_start -->
				<div id="app_header">
					<h1><a href="/" title="go to the Group home page"><img src="/themes/sydphp/images/logo.png" alt="=&quot;sydphp&quot;" width="201" height="37"></a></h1>
					
					<% include Navigation %>
					
					<% if GetLoggedIn %>
						<% control GetLoggedIn %>
							<p>You are logged in as <a href="/member/">$FirstName $LastName ($Email)</a> - <a href="/logout/">log out</a></p>
						<% end_control %>
					<% else %>
						<p><a href="/member/">Become a member to get notified of PHP events in the Sydney region</a></p>
					<% end_if %>
					
					<% include Clearer %>
					
				</div>
				<!-- google_ad_section_end -->
			
			</div>
	
			<div id="app_msg">
			
				<a class="feed" href="/home/rssfeed" title="feed"><img src="/themes/sydphp/images/application-rss+xml.png" width="48" height="48" alt="RSS"></a>

				<p class="text"><strong>Sydney PHP Group</strong> is a community of <a href="http://au.php.net">PHP</a> developers in Sydney, Australia. We run <a href="/events/">regular meetings in the city</a>. <strong>Membership is free and open</strong> to anyone with an interest in web development. <a href="/member/" class="feature">Become a group member</a>.</p>
				
				<h4>Other ways you can join in...</h4>
	
				<ul>
					<li><a href="/events/">come to a meeting Sydney</a></li>
					<li><a href="$SiteConfig.TwitterURL" title="twitter page"><img src="/themes/sydphp/images/tweet.png" width="32" height="32" alt="follow sydphp on twitter" /> following @sydphp on twitter</a></li>
					<li>getting <a href="/syndication/">your RSS/ATOM feed syndicated on sydphp.org</a></li>
					<li>subscribing to the one-way <a href="http://groups.google.com/group/sydphp">announcement mailing list at Google Groups</a> for updates.</li>
				</ul>

			</div>
			
			<% include Clearer %>
			
			<div id="app_content">
			