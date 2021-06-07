<style>
.error-page-404 {
    float: none;
    margin: 0 auto;
        padding-bottom: 20px;
}
.error-page{
        margin: 0 auto;
    width: 75%;
}
.error-page-404 .fa-exclamation-triangle {
    font-size: 350px;
    color: #222a32;
    -ms-transform: rotate(45deg);
    -webkit-transform: rotate(45deg);
    transform: rotate(45deg);
    margin-left: 100px;
}
.error-page h2 {
    font-size: 200px;
    font-weight: 700;
    display: inline-block;
    margin: 0 0 0 0px;
    line-height: 1.1;
}
.error-page-404 h4 {
    font-size: 58px;
    font-weight: 700;
    color: #000;
    text-transform: uppercase;
    border-bottom: 5px solid #222a32;
    border-top: 5px solid #222a32;
    position: relative;
    background-color: #fff;
    margin: 0;
    padding: 30px 0px;
    text-align: center;
    top: -20px;
}
.error-page span {
    font-size: 77px;
    color: #222a32;
    font-weight: 700;
    text-transform: uppercase;
    display: block;
}
@media screen and (max-width:1150px) {
    .error-page-404 .fa-exclamation-triangle {font-size: 318px;}
    .error-page {width: 100%;}
}

@media screen and (max-width:850px) { 
    .error-page-404 .fa-exclamation-triangle {font-size: 280px;}
    .error-page h2 {font-size: 145px;}
    .error-page span {font-size: 56px;}
}
@media screen and (max-width:720px) {
    .error-page-404 h4 {font-size: 48px;}
}
@media screen and (max-width:640px) {
.error-page-404 .fa-exclamation-triangle {font-size: 190px;}
.error-page h2 {font-size: 90px;}
.error-page span {font-size: 35px;}
.error-page-404 h4 {font-size: 32px;}
}
@media screen and (max-width:536px) {
    .error-page-404 .fa-exclamation-triangle {margin-left: 32px;}
}
@media screen and (max-width:424px) {
.error-page-404 .fa-exclamation-triangle {
    font-size: 170px;
}
.error-page-404 h4 {
    font-size: 26px;
    padding: 20px 0;
    margin-top: 10px;
}
}
@media screen and (max-width:400px) {
.error-page-404 .fa-exclamation-triangle {
    font-size: 140px;
}
.error-page h2 {
    font-size: 65px;
}
.error-page span {
    font-size: 26px;
}
.error-page-404 h4 {
    font-size: 24px;
    padding: 12px 0;
    margin-top: 15px;
}
.error-page-404 .fa-exclamation-triangle {font-size: 125px;}
}
@media screen and (max-width:390px) {
.error-page-404 .fa-exclamation-triangle {font-size: 125px;}
}
@media screen and (max-width:320px) {
.error-page-404 h4 {font-size: 21px;}
}
</style>

 <div class="pages-breadcrumb">
        <div class="container">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                   <li class="breadcrumb-item"><a href="<?= site_url() ?>"><?= lang('home') ?></a></li>
                            <li class="breadcrumb-item active" aria-current="page"><span>404 <?=lang('404_error')?></span></li>
                </ol>
            </nav>
        </div>
    </div>

<div class="error-page-404 body container vi-nopart">	
	<div class="error-page vi-nopart">
		<i class="fa fa-exclamation-triangle vi-nopart"></i>
		<h2 class="vi-nopart"> 404 <span class="vi-nopart"> <?=lang('404_error')?> </span></h2>
	</div>
	<h4 class="vi-nopart"><?=lang('404_error_text')?>! </h4>
</div>