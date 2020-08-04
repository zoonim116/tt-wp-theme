<?php get_header(); ?>

<section class="main-catalog">
	<div class="container">
		<h1>סקירת חשבון</h1>
		<div class="catalog-category">
			<div class="category-item">
				<div class="category-img">
					<img src="<?php echo get_template_directory_uri(); ?>/images/category1.png">
				</div>
				<div class="category-info">
					<div class="count">
						<span>5</span>
						<span> מוצרים למכירה</span>
					</div>
					<div class="category-header">
						<a href="#"><h3>תונורתפו םירזיבא</h3></a>
					</div>
					<div class="category-body">
						<p>IRa ו UHF, VHF-ה ימוחתל ,םירדת רחבמבו םימושיי ןווגמל םייתוכיא םינופורקימIRa ימוחתל ,םירדת רחבמבו םימושיי
							ןווגמל םייתוכיא םינופורקימIRa ו UHF, VHF-ה ימוחתל ,םירדת רחבמבו םימושיי ןווגמל םייתוכיא םינופורקימ</p>
					</div>
					<div class="category-footer">
						<a href="#">ןפלואו המב רשק תוכרעמ</a>
						<a href="#">העימש ייוקל רובעב םירישכמו תונקת</a>
						<a href="#">DI - רישי רוביח תואספוק</a>
						<a href="#">םיאנותיע תספוק</a>
					</div>
				</div>
			</div>
			<div class="category-item">
				<div class="category-img">
					<img src="<?php echo get_template_directory_uri(); ?>/images/category2.png">
				</div>
				<div class="category-info">
					<div class="category-header">
						<a href="#"><h3>תוינזוא</h3></a>
					</div>
					<div class="category-body">
						<p>IRa ו UHF, VHF-ה ימוחתל ,םירדת רחבמבו םימושיי ןווגמל םייתוכיא םינופורקימIRa ימוחתל ,םירדת רחבמבו םימושיי
							ןווגמל םייתוכיא םינופורקימIRa ו UHF, VHF-ה ימוחתל ,םירדת רחבמבו םימושיי ןווגמל םייתוכיא םינופורקימ</p>
					</div>
					<div class="category-footer">
						<a href="#">אוזניות ומערכות ראש</a>
						<a href="#">אוזניות אלחוטיות</a>
						<a href="#">מגברי אוזניות</a>
					</div>
				</div>
			</div>
			<div class="category-item">
				<div class="category-img">
					<img src="<?php echo get_template_directory_uri(); ?>/images/category1.png">
				</div>
				<div class="category-info">
					<div class="count">
						<span>5</span>
						<span> מוצרים למכירה</span>
					</div>
					<div class="category-header">
						<a href="#"><h3>תונורתפו םירזיבא</h3></a>
					</div>
					<div class="category-body">
						<p>IRa ו UHF, VHF-ה ימוחתל ,םירדת רחבמבו םימושיי ןווגמל םייתוכיא םינופורקימIRa ימוחתל ,םירדת רחבמבו םימושיי
							ןווגמל םייתוכיא םינופורקימIRa ו UHF, VHF-ה ימוחתל ,םירדת רחבמבו םימושיי ןווגמל םייתוכיא םינופורקימ</p>
					</div>
					<div class="category-footer">
						<a href="#">ןפלואו המב רשק תוכרעמ</a>
						<a href="#">העימש ייוקל רובעב םירישכמו תונקת</a>
						<a href="#">DI - רישי רוביח תואספוק</a>
						<a href="#">םיאנותיע תספוק</a>
					</div>
				</div>
			</div>
		</div>
		<div class="have-question">
			<div class="have-question-image">
				<img src="<?php echo get_template_directory_uri();?>/images/question.png">
			</div>
			<div class="have-question-info">
				<p class="title">?ב תיפצ הנורחאל</p>
				<p>ךלש ישיאה ץעויה םע רשק רוצ</p>
				<a href="#" class="btn btn-blue">איש קשר </a>
			</div>
		</div>
	</div>
</section>
<?php
if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();
		the_content();
	}
}
?>
<?php get_footer(); ?>
