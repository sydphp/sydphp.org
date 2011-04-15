<% if PageLink %>
	<a id="ViewLink_$ID" title="$Caption.EscapeXML" rel="$ViewLink" href="$PageLink"><img src="$ThumbnailURL" alt="$Caption.EscapeXML"/></a>
<% else %>
	<span id="ViewLink_$ID" class="item" rel="$ViewLink"><img src="$ThumbnailURL" alt="$Caption.EscapeXML"/></span>
<% end_if %>