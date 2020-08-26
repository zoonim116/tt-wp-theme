<?php
/**
 * My Account Dashboard
 *
 * Shows the first intro screen on the account dashboard.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/dashboard.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<div class="plan-list">
    <div class="plan-item">
        <p class="title">
            <span class="plan-icon" style="background-image: url(images/play1.png);"></span>
            מתחיל
        </p>
        <p>5 %הנחה</p>
        <p><span>3.000 ₪ </span>+ מכירות </p>
    </div>
    <div class="plan-item">
        <p class="title">
            <span class="plan-icon" style="background-image: url(images/play2.png);"></span>
            מחונן

        </p>
        <p>7 %הנחה</p>
        <p><span>5.000 ₪ </span>+ מכירות </p>
    </div>
    <div class="plan-item active">
        <p class="title">
            <span class="plan-icon" style="background-image: url(images/play3.png);"></span>
            מפורסם
        </p>
        <p>9 %הנחה</p>
        <p><span>15.000 ₪ </span>+ מכירות </p>
    </div>
    <div class="plan-item hover">
        <p class="title">
            <span class="plan-icon" style="background-image: url(images/play4.png);"></span>
            מאסטרו
        </p>
        <p>1 %הנחה</p>
        <p><span>100.000 ₪ </span>+ מכירות </p>
    </div>
</div>
<div class="proposition">
    <div class="proposition-list">
        <div class="proposition-item">
            <img src="images/proposition.png" alt="proposition image">
            <div class="proposition-info">
                <p class="subtitle"><span>15% -</span>הצעה מיוחדת</p>
                <p class="title">Guitar V-AMP 3</p>
                <p class="new-price">₪1.400</p>
                <p class="old-price">₪1.700</p>
            </div>
        </div>
        <div class="proposition-item">
            <img src="images/proposition.png" alt="proposition image">
            <div class="proposition-info">
                <p class="subtitle"><span>15% -</span>הצעה מיוחדת</p>
                <p class="title">Guitar V-AMP 3</p>
                <p class="new-price">₪1.400</p>
                <p class="old-price">₪1.700</p>
            </div>
        </div>
    </div>
</div>
<div class="last-order">
    <div class="last-order-header">
        <div class="last-order-title">
            <div>
                <p class="title">ההזמנה האחרונה שלך <span>0192#</span></p>
                <p class="ordered"><span>הוזמן:</span> 1.03.2020</p>
            </div>
            <div class="paid-delivery">
                <p><span>בתשלום, משלוח, </span>זמן אספקה משוער <span>23.04.2020</span></p>
            </div>
        </div>
        <div class="price"><p>₪1.400</p></div>
    </div>
    <div class="last-order-list">
        <div class="last-order-item">
            <p class="title">CRU-7 / CRU-7A</p>
            <p class="description"> ידועיי קספמ + םירוביח תספוק בלושמ תונקתה רבגמ
                IR תדוקפ ךרד 'וכו םינרקמ תלעפהל</p>
            <div class="price">
                <p>₪670</p>
                <p class="count">x10</p>
            </div>

        </div>
        <div class="last-order-item">
            <p class="title">CRU-7 / CRU-7A</p>
            <p class="description"> ידועיי קספמ + םירוביח תספוק בלושמ תונקתה רבגמ
                IR תדוקפ ךרד 'וכו םינרקמ תלעפהל</p>
            <div class="price">
                <p>₪670</p>
                <p class="count">x3</p>
            </div>
        </div>
        <div class="last-order-item">
            <p class="title">CRU-7 / CRU-7A</p>
            <p class="description"> ידועיי קספמ + םירוביח תספוק בלושמ תונקתה רבגמ
                IR תדוקפ ךרד 'וכו םינרקמ תלעפהל</p>
            <div class="price">
                <p>₪670</p>
                <p class="count">x3</p>
            </div>
        </div>
    </div>
    <div class="last-order-footer">
        <a href="#" class="see-more">צפה בכל הסדר <img src="images/arrow.svg" alt="arrow"></a>
        <div class="button-group">
            <a href="#" class="btn">להורות</a>
            <a href="#" class="btn">להזמין שוב</a>
            <a href="#" class="btn">שנה הזמנה</a>
        </div>
    </div>
</div>
<div class="new-products">
    <p class="title">מוצרים חדשים</p>
    <div class="new-products-list">
        <div class="products-item">
            <div class="item-img">
                <img src="images/new-product.jpg" alt="new product">
            </div>
            <div class="item-content">
                <p class="title">CRU-7 / CRU-7A</p>
                <p class="description">
                    ידועיי קספמ + םירוביח תספוק בלושמ תונקתה רבגמ
                    IR תדוקפ ךרד 'וכו םינרקמ תלעפהל
                </p>
            </div>
            <div class="item-footer">
                <p class="price">₪670</p>
                <div class="item-icons">
                    <a href="#" class="wishlist"><span></span></a>
                    <a href="#" class="cart"><span></span></a>
                </div>
            </div>
        </div>
        <div class="products-item">
            <div class="item-img">
                <img src="images/new-product.jpg" alt="new product">
            </div>
            <div class="item-content">
                <p class="title">CRU-7 / CRU-7A</p>
                <p class="description">
                    ידועיי קספמ + םירוביח תספוק בלושמ תונקתה רבגמ
                    IR תדוקפ ךרד 'וכו םינרקמ תלעפהל
                </p>
            </div>
            <div class="item-footer">
                <p class="price">₪670</p>
                <div class="item-icons">
                    <a href="#" class="wishlist"><span></span></a>
                    <a href="#" class="cart"><span></span></a>
                </div>
            </div>
        </div>
        <div class="products-item">
            <div class="item-img">
                <img src="images/new-product.jpg" alt="new product">
            </div>
            <div class="item-content">
                <p class="title">CRU-7 / CRU-7A</p>
                <p class="description">
                    ידועיי קספמ + םירוביח תספוק בלושמ תונקתה רבגמ
                    IR תדוקפ ךרד 'וכו םינרקמ תלעפהל
                </p>
            </div>
            <div class="item-footer">
                <p class="price">₪670</p>
                <div class="item-icons">
                    <a href="#" class="wishlist"><span></span></a>
                    <a href="#" class="cart"><span></span></a>
                </div>
            </div>
        </div>
        <div class="products-item">
            <div class="item-img">
                <img src="images/new-product.jpg" alt="new product">
            </div>
            <div class="item-content">
                <p class="title">CRU-7 / CRU-7A</p>
                <p class="description">
                    ידועיי קספמ + םירוביח תספוק בלושמ תונקתה רבגמ
                    IR תדוקפ ךרד 'וכו םינרקמ תלעפהל
                </p>
            </div>
            <div class="item-footer">
                <p class="price">₪670</p>
                <div class="item-icons">
                    <a href="#" class="wishlist"><span></span></a>
                    <a href="#" class="cart"><span></span></a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="blog">
    <p class="title">בלוג</p>
    <div class="blog-list">
        <div class="blog-item">
            <div class="blog-image">
                <img src="images/news1.jpg" alt="news">
                <p class="title">
                    MIDI DIN5 ו- USB בו זמנית ...
                    הליקון 3VL :כניסות / יציאות
                </p>
            </div>
            <p class="autor">JorgeR</p>
            <div class="blog-footer">
                <p class="data">2020 במרץ 12</p>
                <div class="blog-share">
                    <a href="#">
                        <img src="images/twitter.svg" alt="twitter">
                    </a>
                    <a href="#">
                        <img src="images/facebook.svg" alt="facebook">
                    </a>
                </div>
            </div>
        </div>
        <div class="blog-item">
            <div class="blog-image">
                <img src="images/news1.jpg" alt="news">
                <p class="title">
                    MIDI DIN5 ו- USB בו זמנית ...
                    הליקון 3VL :כניסות / יציאות
                </p>
            </div>
            <p class="autor">JorgeR</p>
            <div class="blog-footer">
                <p class="data">2020 במרץ 12</p>
                <div class="blog-share">
                    <a href="#">
                        <img src="images/twitter.svg" alt="twitter">
                    </a>
                    <a href="#">
                        <img src="images/facebook.svg" alt="facebook">
                    </a>
                </div>
            </div>
        </div>
        <div class="blog-item">
            <div class="blog-image">
                <img src="images/news1.jpg" alt="news">
                <p class="title">
                    MIDI DIN5 ו- USB בו זמנית ...
                    הליקון 3VL :כניסות / יציאות
                </p>
            </div>
            <p class="autor">JorgeR</p>
            <div class="blog-footer">
                <p class="data">2020 במרץ 12</p>
                <div class="blog-share">
                    <a href="#">
                        <img src="images/twitter.svg" alt="twitter">
                    </a>
                    <a href="#">
                        <img src="images/facebook.svg" alt="facebook">
                    </a>
                </div>
            </div>
        </div>
        <div class="blog-item">
            <div class="blog-image">
                <img src="images/news1.jpg" alt="news">
                <p class="title">
                    MIDI DIN5 ו- USB בו זמנית ...
                    הליקון 3VL :כניסות / יציאות
                </p>
            </div>
            <p class="autor">JorgeR</p>
            <div class="blog-footer">
                <p class="data">2020 במרץ 12</p>
                <div class="blog-share">
                    <a href="#">
                        <img src="images/twitter.svg" alt="twitter">
                    </a>
                    <a href="#">
                        <img src="images/facebook.svg" alt="facebook">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
