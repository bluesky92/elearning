<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
//-------------
?>
<!-- .footer -->
<footer class="footer-wrap">
	<div class="container">
		<div class="row">
			<div class="foo-top clearfix">
				<div class="pull-left signature">
					<a href="<?php echo HOME_URL_LANG . '/home';?>" title="<?php echo getConstant('title');?>"><imgalt="<?php echo getConstant('meta_site_name');?>"></a>
				</div>
				<div class="pull-right social">
					<?php
					echo '<ul>';
					if(getConstant('link_facebook')!="") echo '<li class="facebook"><a target="_blank" href="' . getConstant('link_facebook') . '" title="Facebook"><i class="fa fa-facebook"></i></a></li>';
					if(getConstant('link_googleplus')!="") echo '<li class="google-plus"><a target="_blank" href="' . getConstant('link_googleplus') . '" title="Google Plus"><i class="fa fa-google-plus"></i></a></li>';
					if(getConstant('link_twitter')!="") echo '<li class="twitter"><a target="_blank" href="' . getConstant('link_twitter') . '" title="Twitter"><i class="fa fa-twitter"></i></a></li>';
					if(getConstant('link_youtube')!="") echo '<li class="youtube"><a target="_blank" href="' . getConstant('link_youtube') . '" title="Youtube"><i class="fa fa-youtube"></i></a></li>';
					echo '</ul>';
					?>
				</div>
			</div>
			<div class="foo-content clearfix">
				<div class="col col-md-5 col-sm-6 info"><?php echo getPage('copyright');?></div>
				<div class="col col-md-3 about-us">
					<h4><?php echo getNameCategory(94);?></h4>
					<?php
					$slug = getSlugCategory(94);
					$db->table = "article_menu";
					$db->condition = "`is_active` = 1 AND `parent` = 0 AND `category_id` = 94";
					$db->order = "`sort` ASC";
					$db->limit = "";
					$rows = $db->select();
					if($db->RowCount>0) {
						echo '<ul class="clearfix">';
						foreach($rows as $row) {
							echo '<li><a href="' . HOME_URL_LANG . '/' . $slug . '/' . stripslashes($row['slug']) . '" title="' . stripslashes($row['name']) . '">' . stripslashes($row['name']) . '</a></li>';
						}
						echo '</ul>';
					}
					?>
				</div>
				<div class="col col-md-4 col-sm-6 contact"><?php echo getPage('contact');?></div>
			</div>
		</div>
	</div>
</footer>
<!-- / .footer -->
