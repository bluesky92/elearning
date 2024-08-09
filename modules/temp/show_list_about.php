<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }

echo '<li>';
echo '<a class="toggle-faq" href="javascript:;" id="faq_no_' . $i . '"><i class="fa fa-chevron-right"></i><span>' . stripslashes($row['name']) . '</span></a>';
echo '<div class="faq-answer"><div class="detail-wp">' . stripslashes($row['content']) . '</div></div>';
echo '</li>';