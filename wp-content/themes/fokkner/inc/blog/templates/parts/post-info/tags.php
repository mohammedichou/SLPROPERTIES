<?php
$tags = get_the_tags();

if ( $tags ) { ?>
	<div class="qodef-e-info-item qodef-e-info-tags">
		<svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" width="9.0005" height="12" viewBox="0 0 9.0005 12"><defs><style>.svg-tag{fill:#fff;}</style></defs><path class="svg-tag" d="M7.75,0a1.2013,1.2013,0,0,1,.875.375A1.2,1.2,0,0,1,9,1.25V12L4.5,10,0,12V1.25A1.2,1.2,0,0,1,.375.375,1.199,1.199,0,0,1,1.25,0Z"/></svg>
		<?php the_tags( '', '', '' ); ?>
	</div>
<?php } ?>
