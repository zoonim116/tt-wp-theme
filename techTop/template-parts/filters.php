<?php if (get_class($wp_query->get_queried_object()) == 'WP_Term') {

	$filters = Categories::get_filters($wp_query->get_queried_object()->name);
}  ?>
<div class="catalog-filter">
    <?php
    global $wp;
    $current_url = home_url(add_query_arg(array(), $wp->request));
    $params = $wp->query_vars;
    unset($params['action']);
    unset($params['CategoryPath']);
    unset($params['product_cat']);
    ?>
	<form method="get" name="filter_action" id="filters-form" action="<?php $current_url; ?>">
        <input type="hidden" name="action" value="filters">
        <input type="hidden" name="CategoryPath" value="<?php echo $filters->CategoryPath[0];?>">
<!--		<div class="filter-category">-->
<!--			<a href="#">מערכות קשר במה ואולפן</a>-->
<!--			<a href="#">תקנות ומכשירים בעבור לקויי שמיעה</a>-->
<!--			<a href="#">קופסאות חיבור ישיר - ID</a>-->
<!--			<a href="#">קופסת עיתונאים</a>-->
<!--		</div>-->
		<div class="filter-form">
            <?php if ($filters->Status == "OK"): ?>
                <?php foreach ($filters->StringTab as $string_filter): ?>
                    <div class="form-item">
                        <div class="form-head">
                            <span><?php echo $string_filter[1]; ?></span>
                            <img src="<?php echo get_template_directory_uri(); ?>/images/filter-arrow.svg">
                        </div>
                        <div class="form-body">
                            <div class="filter-param">
                                <ul>
                                    <?php foreach ($string_filter[2] as $index => $filter_value): ?>
                                    <li>
                                        <div class="info-radio">
                                            <?php if ($params[$string_filter[0]] && $params[$string_filter[0]] == $filter_value): ?>
                                                <input type="radio" id="<?php echo $string_filter[1] . '_' . $index; ?>" name="<?php echo $string_filter[0];?>" value="<?php echo $filter_value; ?>" checked="checked">
                                            <?php else: ?>
                                                <input type="radio" id="<?php echo $string_filter[1] . '_' . $index; ?>" name="<?php echo $string_filter[0];?>" value="<?php echo $filter_value; ?>">
                                            <?php endif; ?>
                                            <label for="<?php echo $string_filter[1] . '_' . $index; ?>"><?php echo $filter_value ?></label>
                                        </div>
                                    </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
			    <?php foreach ($filters->NumericTab as $index => $numeric_filter): ?>
                    <div class="form-item">
                        <div class="form-head">
                            <span><?php echo $numeric_filter[1]; ?></span>
                            <img src="<?php echo get_template_directory_uri(); ?>/images/filter-arrow.svg">
                        </div>
                        <div class="form-body">
                            <div class="filter-param">
                                <div class="range-slider">
                                    <input type="text" class="start_value" name="<?php echo $numeric_filter[0]; ?>[]"  value="<?php echo $filters->NumDefaultFrom; ?>">
                                    <div></div>
                                    <input type="text" class="end_value" name="<?php echo $numeric_filter[0]; ?>[]" value="<?php echo $filters->NumDefaultTo; ?>">
                                </div>
                                <div id="steps-slider-<?php echo $index; ?>"></div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
		</div>
	</form>
</div>