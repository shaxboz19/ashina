<div id="bp_wrapper" class="popover-wrapper">
    <div class="bp_hdr">
        <h2 class="alignleft pph2">Remove a Teacher</h2>
        <a class="popover-close" href="javascript:void(0);" onClick="closePP();">Close</a>
    </div>
    <div class="clear"></div>
    
    <div class="bp_cont">
        <div class="pp_txtss">
            <?=$content?>
        </div>
        <p class="bpp_p">
            <a href="<?=site_url('teachers/hide/'.$teacher_id.'/1')?>" style="margin-right: 5px;" class="bbad_btn">Confirm</a>
            <a href="javascript:void(0);" onClick="closePP();" class="bbad_btn">Cancel</a>            
        </p>
    </div>    
</div>