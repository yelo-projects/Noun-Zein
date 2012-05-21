<!DOCTYPE html>

<html lang="$ContentLocale">
  <head>
		<% base_tag %>
		<title><% if MetaTitle %>$MetaTitle<% else %>$Title<% end_if %> | $SiteConfig.Title</title>
		$MetaTags(false)
		<link rel="shortcut icon" href="/favicon.ico" />
		
		<% require themedCSS(style) %>
		
		<!--[if IE 6]>
			<style type="text/css">
			 @import url(themes/blackcandy/css/ie6.css);
			</style> 
		<![endif]-->
		<% require javascript(nounzein/javascript/jquery-1.6.min.js) %>
		<% require javascript(nounzein/javascript/jquery.isotope.min.js) %>
		<% require javascript(nounzein/javascript/jquery.colorbox.min.js) %>
		<% require javascript(nounzein/javascript/main.js) %>
	</head>
<body class="typography">
	<div id="Body">
		
		<div id="Header">
			<div id="Navigation">
				<ul id="MainMenu" class="menu">
					<li id="Logo">
					<% control SiteConfig %>
						<% if HeaderImage %>
							<% control HeaderImage %>
							<h1><a href="$BaseHref" title="home">
								$SetWidth(50)
							</a></h1>
							<% end_control %>
						<% else %>
						<a href="$BaseHref" title="home">
						<span class="line1" align="justify">$Title</span>
						<span class="line2" align="justify">$Tagline</span>
						</a>
						<% end_if %>
					<% end_control %>
					</li>
					<li id="SiteMenu"><h2>site</h2>
						<ul>
						<% control CustomMenu(Footer) %><li class="menu$ID"><a href="$Link" class="$LinkingMode" title="Go to the &quot;{$Title}&quot; page">$MenuTitle</a></li><% end_control %>
						</ul>
					</li>
					<% if Title = Home %>
					<li id="CategoriesMenu"><h2>Categories</h2><ul>
						<li class="$linkingMode item-$Pos $FirstLast">
							<a href="$BaseHref" title="Show All" data-filter="*" class="filter current">Show All</a>
						</li>
						<% control ChildrenOf(Galleries) %>
						<li class="$linkingMode item-$Pos $FirstLast">
							<a href="$Link" title="Show $Title.XML" data-filter=".$TitleXML" class="$LinkingMode item-$Pos  $FirstLast $MenuTitle.XML-$Top.GalleryTitle filter">$MenuTitle.XML</a>
						</li>
						<% end_control %>
					</ul></li>
					<li id="CollectionsMenu"><h2>Collections</h2><ul>
						<% control Collections %>
						<li class="$LinkingMode item-$Pos $FirstLast">
							<a href="#" title="show $Name.XML" data-filter=".collection-$WebSafeName" class="$LinkingMode item-$Pos $FirstLast $WebSafeName filter">$Name</a>
						</li>
						<% end_control %>
					</ul></li>
					<% end_if %>
				</ul>
				<div class="clear"></div>
			</div>
		</div>

		<div id="Content">
			<div class="content">
		<% if SiteState = maintenance %>
		$SiteConfig.MaintenanceMode
		<% else %>
		  $Layout
		<% end_if %>
			<div class="clear"></div>
			</div>
			<div class="clear"></div>
		</div>


		<div id="Footer">
			<div class="contents">
				<p class="address">$SiteConfig.BusinessAddress</p><p class="copyright">Copyright &copy; nounzein 2010</p>
			</div>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
	</div>

</body>
</html>
