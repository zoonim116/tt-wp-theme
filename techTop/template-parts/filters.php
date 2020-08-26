<?php if (get_class($wp_query->get_queried_object()) == 'WP_Term') {

	$filters = Categories::get_filters($wp_query->get_queried_object()->name);
	echo "<pre>";
	die(var_dump($filters));
}  ?>
<div class="catalog-filter">
	<form>
		<div class="filter-category">
			<a href="#">מערכות קשר במה ואולפן</a>
			<a href="#">תקנות ומכשירים בעבור לקויי שמיעה</a>
			<a href="#">קופסאות חיבור ישיר - ID</a>
			<a href="#">קופסת עיתונאים</a>
		</div>
		<div class="filter-form">
			<div class="form-item">
				<div class="form-head">
					<span>מותג</span>
					<img src="<?php echo get_template_directory_uri(); ?>/images/filter-arrow.svg">
				</div>
				<div class="form-body">
					<div class="filter-param">
						<ul>
							<li>
								<div class="info-checkbox">
									<input type="checkbox" id="check1" name="item1">
									<label for="check1">את כל</label>
								</div>
								<div class="count">
									<span>567</span>
								</div>
							</li>
							<li>
								<div class="info-checkbox">
									<input type="checkbox" id="check2" name="item1">
									<label for="check2">Behringer</label>
								</div>
								<div class="count">
									<span>12</span>
								</div>
							</li>
							<li>
								<div class="info-checkbox">
									<input type="checkbox" id="check3" name="item1">
									<label for="check3">Lake</label>
								</div>
								<div class="count">
									<span>1</span>
								</div>
							</li>
							<li>
								<div class="info-checkbox">
									<input type="checkbox" id="check4" name="item1">
									<label for="check4">Klotz</label>
								</div>
								<div class="count">
									<span>4</span>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="form-item chosen">
				<div class="form-head">
					<span>סוג אוזניות</span>
					<img src="<?php echo get_template_directory_uri(); ?>/images/filter-arrow.svg">
				</div>
				<div class="form-body"></div>
			</div>
			<div class="form-item">
				<div class="form-head">
					<span>מיקרופון</span>
					<img src="<?php echo get_template_directory_uri(); ?>/images/filter-arrow.svg">
				</div>
				<div class="form-body"></div>
			</div>
			<div class="form-item">
				<div class="form-head">
					<span>אטימות</span>
					<img src="<?php echo get_template_directory_uri(); ?>/images/filter-arrow.svg">
				</div>
				<div class="form-body"></div>
			</div>
			<div class="form-item">
				<div class="form-head">
					<span>התנגדות</span>
					<img src="<?php echo get_template_directory_uri(); ?>/images/filter-arrow.svg">
				</div>
				<div class="form-body"></div>
			</div>
			<div class="form-item">
				<div class="form-head">
					<span>תחום הענות</span>
					<img src="<?php echo get_template_directory_uri(); ?>/images/filter-arrow.svg">
				</div>
				<div class="form-body"></div>
			</div>
			<div class="form-item">
				<div class="form-head">
					<span>ערוצי סטריאו</span>
					<img src="<?php echo get_template_directory_uri(); ?>/images/filter-arrow.svg">
				</div>
				<div class="form-body">
					<div class="filter-param">
						<div class="range-slider">
							<input type="text" id="input-with-keypress-0">
							<div></div>
							<input type="text" id="input-with-keypress-1">
						</div>
						<div id="steps-slider"></div>
					</div>
				</div>
			</div>
			<div class="form-item">
				<div class="form-head">
					<span>מחברי יציאה</span>
					<img src="<?php echo get_template_directory_uri(); ?>/images/filter-arrow.svg">
				</div>
				<div class="form-body">
					<div class="filter-param">
						<ul>
							<li>
								<div class="info-radio">
									<input type="radio" id="radio1" name="item1">
									<label for="radio1">6.3 mm</label>
								</div>
								<div class="count">
									<span>567</span>
								</div>
							</li>
							<li>
								<div class="info-radio">
									<input type="radio" id="radio2" name="item1">
									<label for="radio2">MIDI</label>
								</div>
								<div class="count">
									<span>12</span>
								</div>
							</li>
							<li>
								<div class="info-radio">
									<input type="radio" id="radio3" name="item1">
									<label for="radio3">USB 2.0</label>
								</div>
								<div class="count">
									<span>1</span>
								</div>
							</li>
							<li>
								<div class="info-radio">
									<input type="radio" id="radio4" name="item1">
									<label for="radio4">Headphone jack</label>
								</div>
								<div class="count">
									<span>4</span>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>