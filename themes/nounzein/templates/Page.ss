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
		<% require javascript(nounzein/javascript/jquery.history.js) %>
		<% require javascript(nounzein/javascript/main.js) %>
	</head>
<body>
	<div id="Body">
		
		<div id="Header">
			<div id="Navigation">
				<ul id="MainMenu" class="menu">
					<li id="SiteMenu"><h2>
					<% control SiteConfig %>
						<% if HeaderImage %>
							<% control HeaderImage %>
							<a href="$BaseHref" title="home" id="Logo">
								$SetWidth(50)
							</a>
							<% end_control %>
						<% else %>
						<a href="$BaseHref" title="home">
						<span class="line1" align="justify">$Title</span>
						<span class="line2" align="justify">$Tagline</span>
						</a>
						<% end_if %>
					<% end_control %><span id="nounzein-Title">Nounzein</span></h2>
						<ul>
						<li class="menuFooter"><a href="#/" id="nounzein-all" class="filter" title="Go to Home">Home</a></li>
						<li class="menuFooter"><a href="#/nounzein/about" id="nounzein-about" class="filter" title="Go to About">About</a></li>
						<% control CustomMenu(Footer) %><li class="menu$ID"><a href="$Link" class="$LinkingMode" title="Go to the &quot;{$Title}&quot; page">$MenuTitle</a></li><% end_control %>
						</ul>
					</li>
					<li id="CollectionsMenu"><h2><span id="collection-Title">Collections</span></h2><ul>
						<li class="item">
							<a href="$BaseHref" title="Show All" id="collection-all" class="filter">All</a>
						</li>
						<% control Collections %>
						<li class="$LinkingMode item-$Pos $FirstLast">
							<a href="$Link" title="show $Name.XML" id="collection-$WebSafeName" class="$LinkingMode item-$Pos $FirstLast $WebSafeName filter">$Name</a>
							<div class="category-content">$Content</div>
						</li>
						<% end_control %>
					</ul></li>
					<li id="CategoriesMenu"><h2><span id="gallery-Title">Categories</span></h2><ul>
						<li class="item">
							<a href="$BaseHref" title="Show All" id="gallery-all" class="filter current">All</a>
						</li>
						<% control ChildrenOf(Galleries) %>
						<li class="$linkingMode item-$Pos $FirstLast">
							<a href="$Link" title="Show $Title.XML" id="gallery-$TitleXML" class="$LinkingMode item-$Pos  $FirstLast $MenuTitle.XML-$Top.GalleryTitle filter">$MenuTitle.XML</a>
							<div class="category-content">$Content</div>
						</li>
						<% end_control %>
					</ul></li>
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
			<div class="links">
				<a href="$BaseHref" class="" title="Go to the Home Page">Home</a>
				<% control CustomMenu(Footer) %>
				|	<a href="$Link" class="" title="Go to the &quot;{$Title}&quot; page">$MenuTitle</a>
				<% end_control %>
			</div>
			<div class="contents">
				<p class="address">$SiteConfig.BusinessAddress</p><p class="copyright">Copyright &copy; nounzein 2010</p>
			</div>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
	</div>

</body>
</html>
