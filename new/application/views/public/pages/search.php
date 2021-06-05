<div class="pages-breadcrumb">
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
           <li class="breadcrumb-item"><a href="<?= site_url() ?>"><?= lang('home') ?></a></li>
                    <li class="breadcrumb-item active" aria-current="page"><span><?= lang('search_result'); ?></span></li>
        </ol>
    </nav>
</div>
</div>

<style>
.search-item{margin-bottom: 15px;font-size: 18px;}
.search-item a{color: #000;}
.search-item a:hover{color: #D28C3B;}
</style>
<section class="pages">
    <div class="container">
          <div class="title inner_title">
                <h2><?= lang('search_result'); ?></h2>
            </div>
        <div class="pages-content">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="content" id="newsPrint" data-aos="fade-up">
                       
                        <div class="content-body">
                                 <div class="search-list">
                <?php if (@$results) { ?>
            <?php if (isset($results) && count($results) > 0) { ?>
                <ul class="list-unstyled">
                    <? $i = 0;
                            foreach ($results as $item) :  
                            $g = $item->group;
                            ?>
                        <li class="search-item">
                            <? //=$item->group
                                        ?>
        <?php if ($g == 'menu') {
            if ($item->options) {
                $link1 = site_url($item->options);
            } elseif ($item->option_2) {
                $link1 = site_url($item->option_2);
            } else {
                $link1 = site_url('menu/' . $item->alias);
            }
        } elseif ($g == 'news' || $g == 'region' || $g == 'tenders' || $g == 'programs' || $g == 'grants' || $g == 'activity' || $g == 'procurements' || $g == 'medical_tourism' || $g == 'projects' || $g == 'documentation' || $g == 'clinics' || $g == 'republican' || $g == 'educational') {
            $link1 = site_url($g.'/'.$item->alias);
        }elseif($g == 'manage' || $g == 'central_apparat'){ 
            $link1 = site_url($g);
        }elseif($g == 'partnership'){
            $options = getPosts($item->category_id, 'options');
            $link1 = site_url($options.'/'.$item->alias);
        } else {
            $link1 = site_url('pages/' . $item->alias);;
        }
        ?>
                            <a href="<?= $link1 ?>" <?=@$target?> ><?= highlight_phrase(_t($item->title, LANG), $word_2, '<span class="searchword">', '</span>') ?> <?//=$item->group
                                        ?></a>
                        </li>
                    <? endforeach; ?>
                </ul>
            <?php } else { ?>
                <div style="text-align: center;">
                    <span class="gray"><?= lang('search_no') ?></span>
                </div>
            <?php } ?>
            <div class="pagination-main"><?= $pagination; ?></div>
        <?php } else { ?>
            <div style="text-align: center;">
                <span class="gray"><?= lang('search_no') ?></span>
            </div>
        <?php } ?>
            </div> 
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</section>
